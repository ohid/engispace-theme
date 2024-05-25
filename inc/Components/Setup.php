<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Setup implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'setup';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
    public function initialize() {
        add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
        add_filter( 'wp_nav_menu_objects', array( $this, 'nav_menu_objects' ), 10, 2 );
    }

    /**
     * Setup the theme onload and register menus, set thumbnail sizes etc
     * 
     * @since 1.0.0
     */
    public function after_setup_theme() {
        add_image_size( 'engispace-course-thumbnail', 324, 234, true );

        if ( function_exists( 'register_nav_menus' ) ) {
            register_nav_menus(
                array(
                    'es-main-menu' => esc_html__( 'Engispace Header Menu', 'engispace' ),
                    'es-footer-menu' => esc_html__( 'Engispace Footer Menu', 'engispace' )
                ),
            );
        }
    }

    /**
     * Add icons to the menu items
     * 
     * @param array $items
     * @param array $args
     * 
     * @return array $items
     * 
     * @since 1.0.0
     */
    public function nav_menu_objects( $items, $args ) {
        foreach( $items as &$item ) {
            // vars
            $icon = get_field('menu_icon', $item);
            // append icon
            if( $icon ) {
                $item->title = sprintf('<img src="%s">', $icon) . $item->title;
            }
        }

        return $items;
    }
}