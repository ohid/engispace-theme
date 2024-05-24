<?php
/**
 * EngiSpace Theme functions and definitions
 */


// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'ENGISPACE_THEME_DIR' ) ) {
	define( 'ENGISPACE_THEME_DIR', __DIR__ );
}

/**
 *
 * Intialize Vapp Theme
 *
 */
require trailingslashit( get_template_directory() ) . 'inc/init.php';