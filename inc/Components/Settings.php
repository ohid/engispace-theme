<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Settings implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'settings';
	}

    public function initialize() {
        add_action( 'template_redirect', [ $this, 'redirect_settings_page' ] );
        add_action( 'wp_ajax_es_update_password', [ $this, 'update_user_password' ] );
    }

    public function redirect_settings_page() {
        if ( !is_user_logged_in() && is_page('settings') ) {
            wp_redirect( home_url() );
            exit;
        }
    }

    /**
     * Update user password on AJAX request
     * 
     * @since 1.0.0
     */
    public function update_user_password() {
        if ( !wp_doing_ajax() || !is_user_logged_in() ) {
            return;
        }
        check_ajax_referer('es_settings', 'es_update_password'); // Check nonce
        $old_password = isset( $_POST['old_password'] ) ? sanitize_text_field( $_POST['old_password'] ) : '';
        $new_password = isset( $_POST['new_password'] ) ? sanitize_text_field( $_POST['new_password'] ) : '';

        $user = get_user_by( 'id', get_current_user_id() );
        $password_verified = wp_check_password( $old_password, $user->data->user_pass, $user->ID );
        
        if ( !$password_verified ) {
            wp_send_json_error();
        }

        // Set the new password
        wp_set_password( $new_password, get_current_user_id() );

        wp_send_json_success();
    }
}