<?php
/**
 * EngiSpace Theme functions and definitions
 */

use Engispace\Theme;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'ENGISPACE_THEME_DIR' ) ) {
	define( 'ENGISPACE_THEME_DIR', __DIR__ );
}

if ( ! defined( 'THEME_URI' ) ) {
    define( 'THEME_URI', get_template_directory_uri() );
}

// Define the DHRUBOK Folder
if( ! defined( 'ENGISPACE_DIR' ) ) {
	define('ENGISPACE_DIR', get_template_directory() );
}

// Load the autoload file
if ( file_exists( ENGISPACE_THEME_DIR . '/vendor/autoload.php' ) ) {
	require_once ENGISPACE_THEME_DIR . '/vendor/autoload.php';
}

require trailingslashit( get_template_directory() ) . 'inc/helper-functions.php';

/**
 *
 * Intialize Engispace Theme
 *
 */
$theme_setup = Theme::instance();
