<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Scripts implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'scripts';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
    public function initialize() {
        add_action( 'wp_enqueue_scripts', array( $this, 'theme_scripts') );
    }

    /**
     * Enqueue styles in the theme front end
     * 
     * @since 1.0.0
     */
    public function theme_scripts() {
        wp_enqueue_script( 
            'engispace-owl-carousel', 
            get_template_directory_uri() . '/assets/js/owl.carousel.min.js', 
            ['jquery'] 
        );
        
        wp_enqueue_script( 
            'jquery-validation', 
            'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js', 
            ['jquery'] 
        );

        wp_enqueue_script( 
            'engispace-scripts', 
            get_template_directory_uri() . '/assets/js/dist/main.min.js', 
            ['engispace-owl-carousel'] 
        );
    
        wp_localize_script( 
            'engispace-scripts', 
            'engisapce_obj', 
            array(
                'siteurl' => get_home_url(),
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce('es_nonce'),
                'user_logged_in' => is_user_logged_in(),
            )
        );
    
        if ( is_singular() && comments_open() && get_option( 'thread_comment' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
}