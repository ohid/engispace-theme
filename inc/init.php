<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Theme Constants
require_once trailingslashit( get_template_directory() ) . 'inc/constants.php' ;

// Theme Style and Scripts Enqueye
require_once ENGISPACE_INC_DIR . '/theme-style-and-scripts.php';
// Theme Setup
require_once ENGISPACE_INC_DIR . '/theme-setup.php';

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

function es_get_course_title_trimmed( $string, $n = 10, $chars_length = 40 ) {
    // Split the string into words based on spaces
    $words = explode(' ', $string);
    if ( count( $words ) <= $n ) {
        return $string;
    }
    // Remove the first $n words
    $remainingWords = array_slice($words, 0, $n);
    // Get the output strings
    $output_string = implode(' ', $remainingWords);
    // check lowest chars 
    if ( strlen( $output_string ) <= $chars_length ) {
        $output_string = es_get_course_title_trimmed($string, $n + 1);
    }
    // Check max characters length
    if ( strlen( $output_string ) >= $chars_length ) {
        $output_string = mb_substr($output_string, 0, $chars_length, "UTF-8");
    }

    return $output_string . '...';
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
            'page_title'    => __('Engispace Settings'),
            'menu_title'    => __('Engispace Settings'),
            'menu_slug'     => 'engispace-theme-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}

/**
 * Get SVG icon
 * 
 * @param string $path
 * 
 * @return string $icon
 */
function es_get_svg_icon( $path ) {
    if ( !file_exists( ENGISPACE_DIR . $path . '.svg' ) ) {
        return '';
    }
    return file_get_contents( ENGISPACE_DIR . $path . '.svg' );
}

function es_get_template_for_single_course() {
    $page = isset( $_GET['content'] ) ? sanitize_text_field( $_GET['content'] ) : '';

    if ( $page === 'comments' ) {
        get_template_part( 'templates/courses/single-course-comments' );
    } else if ( $page === 'reviews' ) {
        get_template_part( 'templates/courses/single-course-reviews' );
    } else {
        get_template_part( 'templates/courses/single-course-content' );
    }

    return;
}