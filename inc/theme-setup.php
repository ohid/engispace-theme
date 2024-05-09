<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function es_theme_setup () {

    if ( function_exists( 'register_nav_menus' ) ) {
        register_nav_menus(
            array(
                'es-main-menu' => esc_html__( 'Engispace Header Menu', 'engispace' ),
                'es-footer-menu' => esc_html__( 'Engispace Footer Menu', 'engispace' )
            ),
        );
    }
}

add_action( 'after_setup_theme', 'es_theme_setup' );


add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

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
function my_wp_nav_menu_objects( $items, $args ) {
    // loop
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