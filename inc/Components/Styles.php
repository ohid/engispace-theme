<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Styles implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'styles';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
    public function initialize() {
        add_action( 'wp_enqueue_scripts', array( $this, 'theme_styles') );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles') );
    }

    /**
     * Enqueue styles in the theme front end
     * 
     * @since 1.0.0
     */
    public function theme_styles() {
        wp_enqueue_style( 
            'engispace-google-font', 
            'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap',
            false
        );
        
        wp_enqueue_style( 
            'engispace-owl-carousel', 
            get_template_directory_uri() . '/assets/css/owl.carousel.min.css' 
        );
        
        wp_enqueue_style( 
            'engispace-owl-theme', 
            get_template_directory_uri() . '/assets/css/owl.theme.default.min.css' 
        );
        
        wp_enqueue_style( 
            'engispace-main', 
            get_template_directory_uri() . '/assets/css/main.css' 
        );
    }

    /**
     * Enqueue styles in the admin page
     * 
     * @since 1.0.0
     */
    public function admin_styles() {
        if ( !empty( $_GET['page'] ) && $_GET['page'] === 'engispace-theme-settings' ) {
            wp_enqueue_style( 
                'engispace-theme-settings-style', 
                get_template_directory_uri() . '/assets/css/admin/theme-settings.css' 
            );
        }
    }
}