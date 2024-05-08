<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Theme Constants
require_once trailingslashit( get_template_directory() ) . 'inc/constants.php' ;

// Theme Style and Scripts Enqueye
require_once ENGISPACE_INC_DIR . '/theme-style-and-scripts.php';

/**
 * Generate IMG tag
 * 
 * @param string $regular_img
 * @param string $retina_img
 * @param string|null $alt
 * @param string|null $class
 * 
 * @return string
 */
function es_img_with_srcset( $regular_img, $retina_img = null, $alt = null, $class = null ) {
    $srcset = '';
    if ( $retina_img != null ) {
        $srcset .= $regular_img . ' 1x,';
        $srcset .= $retina_img . ' 2x,';
    }
    printf(
        '<img src="%s" %s alt="%s" class="%s">',
        $regular_img,
        $retina_img ? 'srcset="' . $srcset . '"' : '',
        esc_attr( $alt ), 
        esc_attr( $class )
    );
}

function es_get_course_title_trimmed( $string, $n = 10 ) {
    // Split the string into words based on spaces
    $words = explode(' ', $string);
    if ( count( $words ) <= $n ) {
        return $string;
    }

    // Remove the first $n words
    $remainingWords = array_slice($words, 0, $n);

    return implode(' ', $remainingWords) . '...';
}

/**
 * ACF Theme Options Page
 */
add_action('acf/init', 'es_theme_options_page');
function es_theme_options_page() {
    // Check function exists.
    if( function_exists('acf_add_options_page') ) {
        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Theme Settings'),
            'menu_title'    => __('Theme Settings'),
            'menu_slug'     => 'engispace-theme-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}