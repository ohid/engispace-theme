<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'THEME_URI' ) ) {
    define( 'THEME_URI', get_template_directory_uri() );
}

// Define the DHRUBOK Folder
if( ! defined( 'ENGISPACE_DIR' ) ) {
	define('ENGISPACE_DIR', get_template_directory() );
}

// Define the DHRUBOK Partials Folder
if( ! defined( 'ENGISPACE_PARTIALS_DIR' ) ) {
	define('ENGISPACE_PARTIALS_DIR', trailingslashit( ENGISPACE_DIR ) . 'partials' );
}

// Define the Inc Folder of the DHRUBOK Directory
if( ! defined( 'ENGISPACE_ASSETS_DIR' ) ) {
	define('ENGISPACE_ASSETS_DIR', trailingslashit( ENGISPACE_DIR ) . 'assets' );
}

// Define the Inc Folder of the DHRUBOK Directory
if( ! defined( 'ENGISPACE_INC_DIR' ) ) {
	define('ENGISPACE_INC_DIR', trailingslashit( ENGISPACE_DIR ) . 'inc' );
}

// Define the Inc Folder of the DHRUBOK Directory
if( ! defined( 'ENGISPACE_FRAMEWORK_DIR' ) ) {
	define('ENGISPACE_FRAMEWORK_DIR', trailingslashit( ENGISPACE_INC_DIR ) . 'framework' );
}

// Define the Libs Folder of the DHRUBOK Directory
if( ! defined( 'ENGISPACE_LIBS_DIR' ) ) {
	define('ENGISPACE_LIBS_DIR', trailingslashit( ENGISPACE_DIR ) . 'libs' );
}

// Define the Shortcodes Folder of the DHRUBOK Directory
if( ! defined( 'ENGISPACE_SHORTCODES_DIR' ) ) {
	define('ENGISPACE_SHORTCODES_DIR', trailingslashit( ENGISPACE_INC_DIR ) . 'shortcodes' );
}

// Define the Classes Folder of the DHRUBOK Directory
if( ! defined( 'ENGISPACE_CLASSES_DIR' ) ) {
	define('ENGISPACE_CLASSES_DIR', trailingslashit( ENGISPACE_INC_DIR ) . 'classes' );
}

// Define the Widgets Folder of the DHRUBOK Directory
if( ! defined( 'ENGISPACE_WIDGETS_DIR' ) ) {
	define('ENGISPACE_WIDGETS_DIR', trailingslashit( ENGISPACE_INC_DIR ) . 'widgets' );
}

// Define the Widgets Folder of the DHRUBOK Directory
if( ! defined( 'ENGISPACE_INC_VC_DIR' ) ) {
	define('ENGISPACE_INC_VC_DIR', trailingslashit( ENGISPACE_INC_DIR ) . 'visual_composer' );
}

// Define the PLUGINS Folder of the DHRUBOK Directory
if( ! defined( 'ENGISPACE_INC_PLUGINS_DIR' ) ) {
	define('ENGISPACE_INC_PLUGINS_DIR', trailingslashit( ENGISPACE_INC_DIR ) . 'plugins' );
}
