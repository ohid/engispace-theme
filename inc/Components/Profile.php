<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Profile implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'profile';
	}

    public function initialize() {
        add_action( 'template_redirect', [ $this, 'redirect_profile_page' ] );
        add_action( 'wp_ajax_es_update_profile_details', [ $this, 'update_profile_details' ] );
        add_action( 'wp_ajax_es_update_contact_details', [ $this, 'es_update_contact_details' ] );
    }

    public function redirect_profile_page() {
        if ( !is_user_logged_in() && is_page('profile') ) {
            wp_redirect( home_url() );
            exit;
        }
    }

    public function update_profile_details() {
        if ( !wp_doing_ajax() ) {
            return;
        }
        check_ajax_referer('es_nonce', 'es_update_profile_details'); // Check nonce
        $data = $_POST;

        $es_first_name = !empty( $data['es_first_name'] ) ? sanitize_text_field( $data['es_first_name'] ) : '';
        $es_last_name = !empty( $data['es_last_name'] ) ? sanitize_text_field( $data['es_last_name'] ) : '';
        $es_person_description = !empty( $data['es_person_description'] ) ? sanitize_text_field( $data['es_person_description'] ) : '';

        if ( empty( $es_first_name ) || empty( $es_last_name ) || empty( $es_person_description ) ) {
            wp_send_json_error();
        }

        // Get the current user ID
        $user_id = get_current_user_id();

        // Update the user first and last name
        $updated = wp_update_user( array(
            'ID' => $user_id,
            'first_name' => $es_first_name,
            'last_name' => $es_last_name,
            'description' => $es_person_description
        ) );

        // Check if a file is uploaded
        if ( !empty( $_FILES['us_profile_picture']['tmp_name'] ) ) {
            $updated = $this->update_profile_picture();
        }

        if ( $updated ) {
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }

        die;
    }

    public function update_profile_picture() {
        // Get the current user ID
        $user_id = get_current_user_id();

        // Handle the file upload
        $file = $_FILES['us_profile_picture'];
        $upload = wp_handle_upload( $file, array('test_form' => false) );

        if ( !$upload || isset( $upload['error'] ) ) {
            return false;
        }

        $avatar_url = $upload['url'];
        update_user_meta( $user_id, 'es_user_profile_avatar', $avatar_url );

        return true;
    }

    public function es_update_contact_details() {
        if ( !wp_doing_ajax() ) {
            return;
        }
        check_ajax_referer('es_nonce', 'es_update_contact_details'); // Check nonce

        $es_user_phone = !empty( $_POST['es_user_phone'] ) ? sanitize_text_field( $_POST['es_user_phone'] ) : '';
        $es_user_email = !empty( $_POST['es_user_email'] ) ? sanitize_text_field( $_POST['es_user_email'] ) : '';
        $es_user_url = !empty( $_POST['es_user_url'] ) ? sanitize_text_field( $_POST['es_user_url'] ) : '';

        // Get the current user ID
        $user_id = get_current_user_id();

        if ( !empty( $es_user_phone ) ) {
            update_user_meta( $user_id, 'es_user_phone', $es_user_phone );
        }
        if ( !empty( $es_user_email ) ) {
            wp_update_user( array( 'ID' => $user_id, 'user_email' => $es_user_email ) );
        }
        if ( !empty( $es_user_url ) ) {
            update_user_meta( $user_id, 'es_user_url', $es_user_url );
        }

        wp_send_json_success();
        die;
    }
}