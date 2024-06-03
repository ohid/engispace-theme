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

        add_action( 'wp_ajax_es_auth_required_modal', array( $this, 'auth_required_modal' ) );
        add_action( 'wp_ajax_nopriv_es_auth_required_modal', array( $this, 'auth_required_modal' ) );
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
        if ( username_exists( $userdata['firstname'] ) || email_exists( $userdata['email'] )) {
            wp_send_json_error( 'user_exists' );
            die();
        }

        // Create the new user
        $user_id = wp_create_user(
            $userdata['firstname'], 
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

        // automatically sign in the user
        wp_clear_auth_cookie();
        wp_set_current_user( $user_id );
        wp_set_auth_cookie( $user_id );

        // Send the JSON success to the client end
        wp_send_json_success( 'user_created' );
        die();
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
}