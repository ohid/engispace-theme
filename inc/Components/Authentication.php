<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Authentication implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'authentication';
	}

    public function initialize() {
        add_action( 'wp_ajax_es_site_signin', array( $this, 'signin' ) );
        add_action( 'wp_ajax_nopriv_es_site_signin', array( $this, 'signin' ) );
        add_action( 'wp_ajax_es_site_signup', array( $this, 'signup' ) );
        add_action( 'wp_ajax_nopriv_es_site_signup', array( $this, 'signup' ) );
        add_action( 'wp_ajax_es_site_forget_password', array( $this, 'forget_password' ) );
        add_action( 'wp_ajax_nopriv_es_site_forget_password', array( $this, 'forget_password' ) );

        add_action( 'wp_ajax_es_auth_required_modal', array( $this, 'auth_required_modal' ) );
        add_action( 'wp_ajax_nopriv_es_auth_required_modal', array( $this, 'auth_required_modal' ) );
        
        // Handle email verification
        add_action( 'init', array( $this, 'handle_email_verification' ) );
        
        // Customize new user notification email to use verification email
        add_filter( 'wp_new_user_notification_email', array( $this, 'customize_new_user_notification' ), 10, 3 );
        add_filter( 'wp_new_user_notification_email_admin', '__return_false' );
        
        // Customize password reset email
        add_filter( 'retrieve_password_message', array( $this, 'customize_password_reset_email' ), 10, 4 );
    }

    public function signin() {
        if ( !wp_doing_ajax() ) {
            return;
        }
        check_ajax_referer('es_site_signin', 'es_signin_nonce'); // Check nonce

        $email = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL );
        $password = sanitize_text_field( $_POST['login_password'] );

        if ( empty( $email ) || empty( $password ) ) {
            wp_send_json_error( 'form_validation_failed' );
            die();
        }

        // Get the user by email
        $user = get_user_by( 'email', $email );

        $is_verified = get_user_meta($user->ID, 'account_verified', true);
        error_log($is_verified);
        if(!$is_verified) {
            wp_send_json_error( 'user_not_verified' );
            die();
        }

        if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID ) ) {
            // Password is correct, log the user in
            wp_set_current_user($user->ID, $user->user_login);
            wp_set_auth_cookie($user->ID);
            do_action('wp_login', $user->user_login, $user);

            wp_send_json_success();
            
            die();
        } else {
            // Invalid credentials, handle the error
            wp_send_json_error();
        }
    }

    public function signup() {
        if ( !wp_doing_ajax() ) {
            return;
        }
        check_ajax_referer('es_site_signup', 'es_signup_nonce'); // Check nonce

        // return if fields do not validate
        if ( ! $this->validate_input_fields( $_POST ) ) {
            wp_send_json_error( 'form_validation_failed' );
            die();
        }

        // get the user data
        $userdata = $this->get_form_fields( $_POST );
        // check whether username exists or not
        if ( email_exists( $userdata['email'] )) {
            wp_send_json_error( 'user_exists' );
            die();
        }

        // Create the new user
        $user_id = wp_create_user(
            $userdata['firstname'] . rand(0, 99999), 
            $userdata['password'], 
            $userdata['email']
        );

        if ( is_wp_error($user_id) ) {
            wp_send_json_error( 'user_error' );
            die();
        }

        // Set the user's first name, last name, and role
        wp_update_user(array(
            'ID' => $user_id,
            'first_name' => $userdata['firstname'],
            'last_name' => $userdata['lastname'],
            'role' => 'subscriber'
        ));

        // Make user inactive by adding meta
        update_user_meta($user_id, 'account_verified', false);
        update_user_meta($user_id, 'verification_token', wp_generate_password(32, false));
        // Send verification email
        $this->send_verification_email($user_id);

        // automatically sign in the user
        // wp_clear_auth_cookie();
        // wp_set_current_user( $user_id );
        // wp_set_auth_cookie( $user_id );

        // Send the JSON success to the client end
        wp_send_json_success( 'user_created' );
        die();
    }

    public function send_verification_email($user_id) {
        $user = get_userdata($user_id);
        
        // Validate user exists and has email
        if (!$user || empty($user->user_email)) {
            return false;
        }
        
        $token = get_user_meta($user_id, 'verification_token', true);
        
        $verification_url = add_query_arg([
            'action' => 'verify_email',
            'user_id' => $user_id,
            'token' => $token
        ], home_url());
        
        $subject = 'Welcome to EngiSpace! Please verify your email address';
        $title = 'Welcome to EngiSpace!';
        $content = Email_Templates::get_verification_email_content($user->first_name, $verification_url);
        
        $result = Email_Templates::send_email($user->user_email, $subject, $title, $content);
        
        
        return $result;
    }
    
    public function handle_email_verification() {
        if (!isset($_GET['action']) || $_GET['action'] !== 'verify_email') {
            return;
        }
        
        $user_id = absint($_GET['user_id']);
        $token = sanitize_text_field($_GET['token']);
        
        if (!$user_id || !$token) {
            wp_die('Invalid verification link.');
        }
        
        $stored_token = get_user_meta($user_id, 'verification_token', true);
        
        if ($token !== $stored_token) {
            wp_die('Invalid or expired verification token.');
        }
        
        // Verify the user
        update_user_meta($user_id, 'account_verified', true);
        delete_user_meta($user_id, 'verification_token');
        
        // Send welcome email after successful verification
        $this->send_welcome_email($user_id);
        
        // Redirect to login page with success message
        wp_redirect(home_url('/?verified=1'));
        exit;
    }
    
    public function send_welcome_email($user_id) {
        $user = get_userdata($user_id);
        
        $subject = 'Welcome to EngiSpace! Your account is now active';
        $title = 'Welcome to EngiSpace!';
        $content = Email_Templates::get_welcome_email_content($user->first_name);
        
        return Email_Templates::send_email($user->user_email, $subject, $title, $content);
    }
    
    /**
     * Customize new user notification email to send verification email instead
     */
    public function customize_new_user_notification($wp_new_user_notification_email, $user, $blogname) {
        // Generate verification token for the user
        update_user_meta($user->ID, 'account_verified', false);
        update_user_meta($user->ID, 'verification_token', wp_generate_password(32, false));
        
        // Get verification URL
        $token = get_user_meta($user->ID, 'verification_token', true);
        $verification_url = add_query_arg([
            'action' => 'verify_email',
            'user_id' => $user->ID,
            'token' => $token
        ], home_url());
        
        // Create custom email content using our template
        $subject = 'Welcome to EngiSpace! Please verify your email address';
        $title = 'Welcome to EngiSpace!';
        $content = Email_Templates::get_verification_email_content($user->first_name, $verification_url);
        $message = Email_Templates::get_template_wrapper($title, $content);
        
        // Return customized email array
        return array(
            'to'      => $user->user_email,
            'subject' => $subject,
            'message' => $message,
            'headers' => array(
                'Content-Type: text/html; charset=UTF-8',
                'From: EngiSpace <no-reply@engispace.com>'
            ),
        );
    }
    
    /**
     * Customize password reset email message
     */
    public function customize_password_reset_email($message, $key, $user_login, $user_data) {
        // Generate reset URL
        $reset_url = network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
        
        // Get user's first name, fallback to display name or username
        $first_name = !empty($user_data->first_name) ? $user_data->first_name : 
                     (!empty($user_data->display_name) ? $user_data->display_name : $user_data->user_login);
        
        // Create custom email content using our template
        $title = 'Password Reset Request';
        $content = Email_Templates::get_password_reset_email_content($first_name, $reset_url);
        $message = Email_Templates::get_template_wrapper($title, $content);
        
        // Set HTML content type for this email
        add_filter('wp_mail_content_type', function() { return 'text/html'; });
        
        return $message;
    }

    public function forget_password() {
        if ( !wp_doing_ajax() ) {
            return;
        }
        check_ajax_referer('es_nonce', 'es_site_forget_password'); // Check nonce

        if ( empty( $_POST['email'] ) ) {
            wp_send_json_error();
        }
        $email = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL );

        if ( ! email_exists( $email ) ) {
            wp_send_json_error();
        }

        $this->send_password_reset_email( $email );

        wp_send_json_success();
    }

    public function validate_input_fields( $data ) {
        $fields = $this->get_form_fields( $data );
        $validated = true;

        // check whether all fields are not empty
        foreach( $fields as $field ) {
            if ( empty( $field ) ) {
                $validated = false;
            }
        }

        // validate the email field
        if ( ! filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
            $validated = false;
        }

        // validate password field min chars
        if ( strlen( $fields['password'] ) < 8 || strlen( $fields['password_confirm'] ) < 8 ) {
            $validated = false;
        }

        // validate password match
        if ( $fields['password'] !== $fields['password_confirm'] ) {
            $validated = false;
        }

        return $validated;
    }

    public function get_form_fields( $data ) {
        $fields = $data;
        unset( $fields['action'] );
        unset( $fields['action'] );
        unset( $fields['es_action'] );
        unset( $fields['_wp_http_referer'] );

        $userdata = [];

        foreach( $fields as $key => $value ) {
            $userdata[ $key ] = sanitize_text_field( $value );
        }

        return $userdata;
    }

    /**
     * Output the Auth Required Modal HTML
     * 
     * @since 1.0.0
     */
    public function auth_required_modal() {
        if ( !wp_doing_ajax() ) {
            return;
        }
        check_ajax_referer( 'es_nonce', 'nonce' ); // Check nonce

        ob_start();
        get_template_part( 'template-parts/modals/auth-required-modals' );
        $modal = ob_get_clean();

        wp_send_json_success( $modal );
    }

    public function send_password_reset_email( $to ) {
        $subject = esc_html__( 'Reset your password', 'engispace' );
        $user = get_user_by_email( $to );
        $key = get_password_reset_key( $user );
        $reset_url = network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login');

        // Get user's first name, fallback to display name or username
        $first_name = !empty($user->first_name) ? $user->first_name : 
                     (!empty($user->display_name) ? $user->display_name : $user->user_login);

        $title = 'Password Reset Request';
        $content = Email_Templates::get_password_reset_email_content($first_name, $reset_url);

        return Email_Templates::send_email($to, $subject, $title, $content, 'EngiSpace', 'no-reply@engispace.com');
    }
}