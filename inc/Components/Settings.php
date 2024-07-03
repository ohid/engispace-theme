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
    }

    public function redirect_settings_page() {
        if ( !is_user_logged_in() && is_page('settings') ) {
            wp_redirect( home_url() );
            exit;
        }
    }

}