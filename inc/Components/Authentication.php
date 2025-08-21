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
        
        // Disable WordPress default new user notification email
        add_filter( 'wp_new_user_notification_email', '__return_false' );
        add_filter( 'wp_new_user_notification_email_admin', '__return_false' );
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
        $token = get_user_meta($user_id, 'verification_token', true);
        
        $verification_url = add_query_arg([
            'action' => 'verify_email',
            'user_id' => $user_id,
            'token' => $token
        ], home_url());
        
        $subject = 'Welcome to EngiSpace! Please verify your email address';
        
        $message = "
        <html>
        <body>
            <h2>Welcome to " . get_bloginfo('name') . "!</h2>
            <p>Hi {$user->first_name},</p>
            <p>Thank you for registering! Please click the link below to verify your email address and activate your account:</p>
            <p><a href='{$verification_url}' style='background: #0073aa; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Verify Email Address</a></p>
            <p>Or copy and paste this link: {$verification_url}</p>
            <p>This link will expire in 24 hours.</p>
            <p>Best regards,<br>The " . get_bloginfo('name') . " Team</p>
        </body>
        </html>
        ";
        
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>'
        ];
        
        $result = wp_mail($user->user_email, $subject, $message, $headers);
        
        // Log email result for debugging
        if (!$result) {
            error_log('Verification email failed to send to: ' . $user->user_email);
        }
        
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
        
        $subject = 'Welcome to ' . get_bloginfo('name') . '! Your account is now active';
        
        $message = "
        <html>
        <body>
            <h2>Welcome to " . get_bloginfo('name') . "!</h2>
            <p>Hi {$user->first_name},</p>
            <p>Congratulations! Your email has been verified and your account is now active.</p>
            <p>You can now:</p>
            <ul>
                <li>Access all premium content</li>
                <li>Participate in our community forums</li>
                <li>Download course materials</li>
                <li>Track your learning progress</li>
            </ul>
            <p><a href='" . home_url() . "' style='background: #0073aa; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Start Learning Now</a></p>
            <p>If you have any questions, feel free to contact our support team.</p>
            <p>Best regards,<br>The " . get_bloginfo('name') . " Team</p>
        </body>
        </html>
        ";
        
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>'
        ];
        
        $result = wp_mail($user->user_email, $subject, $message, $headers);
        
        // Log email result for debugging
        if (!$result) {
            error_log('Welcome email failed to send to: ' . $user->user_email);
        }
        
        return $result;
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

        ob_start();
        include( locate_template( 'templates/email/reset-password.php', false, false ) );
        $message = ob_get_clean();

        $headers = array('Content-Type: text/html; charset=UTF-8','From: EngiSpace <admin@engiversity.com>');

        wp_mail( $to, $subject, $message, $headers );
    }
}