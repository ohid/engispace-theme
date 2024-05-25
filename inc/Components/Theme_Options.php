<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Theme_Options implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'theme_options';
	}

    public function initialize() {
        add_action( 'acf/init', array( $this, 'es_theme_options_page' ) );
    }

    public function es_theme_options_page() {
       // Check function exists.
       if ( !function_exists( 'acf_add_options_page' ) ) { 
            return;
        }

        // Register options page.
        acf_add_options_page( array(
            'page_title'    => __('Engispace Settings'),
            'menu_title'    => __('Engispace Settings'),
            'menu_slug'     => 'engispace-theme-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ) );
    }
}