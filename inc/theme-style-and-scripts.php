<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 
/**
 *
 * Enqueue style and scripts
 *
 */
function engispace_style_scripts() {

	wp_enqueue_style( 'engispace-google-font', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap', false );
	wp_enqueue_style( 'engispace-owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' );
	wp_enqueue_style( 'engispace-owl-theme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css' );
	wp_enqueue_style( 'engispace-main', get_template_directory_uri() . '/assets/css/main.css' );

	wp_enqueue_script( 'engispace-owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', ['jquery'] );
	wp_enqueue_script( 'jquery-validation', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js', ['jquery'] );
	wp_enqueue_script( 'engispace-scripts', get_template_directory_uri() . '/assets/js/dist/main.min.js', ['engispace-owl-carousel'] );

	wp_localize_script( 'engispace-scripts', 'engisapce_obj', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce('es_nonce')
	));

	if ( is_singular() && comments_open() && get_option( 'thread_comment' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'engispace_style_scripts' );


/**
 * Admin styles and scripts
 */
function engispace_admin_scripts() {
	if ( !empty( $_GET['page'] ) && $_GET['page'] === 'engispace-theme-settings' ) {
		wp_enqueue_style( 'engispace-theme-settings-style', get_template_directory_uri() . '/assets/css/admin/theme-settings.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'engispace_admin_scripts' );

