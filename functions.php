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

// Load the autoload file
if ( file_exists( ENGISPACE_THEME_DIR . '/vendor/autoload.php' ) ) {
	require_once ENGISPACE_THEME_DIR . '/vendor/autoload.php';
}

/**
 *
 * Intialize Vapp Theme
 *
 */
require trailingslashit( get_template_directory() ) . 'inc/init.php';

$theme_setup = Theme::instance();