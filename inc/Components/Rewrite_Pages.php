<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Rewrite_Pages implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'rewrite_pages';
	}

    public function initialize() {
        add_action( 'init', array( $this, 'course_payment_pages' ) );
        add_filter( 'request', array( $this, 'filter_request' ) );
        add_filter( 'template_include', array( $this, 'load_template' ) );
        add_filter( 'query_vars', array( $this, 'es_register_query_vars') );
        add_filter( 'wp_title', array( $this, 'custom_page_title' ), 10, 2 );
        add_filter( 'document_title_parts', array( $this, 'custom_document_title_parts' ) );
    }

    public function course_payment_pages() {
        add_rewrite_endpoint( 'course-payment-success', EP_PERMALINK );
        add_rewrite_endpoint( 'course-payment-error', EP_PERMALINK );

        // Add rewrite rule for user profile
        add_rewrite_rule(
            'profile/([^/]+)/?$',
            'index.php?profile_username=$matches[1]',
            'top'
        );
    }

    public function filter_request( $vars ) {
        if ( isset( $vars['course-payment-success'] ) || $vars['name'] === 'course-payment-success' ) {
            $vars['course-payment-success'] = true;
        }
        if ( isset( $vars['course-payment-error'] ) ) {
            $vars['course-payment-error'] = true;
        }
        return $vars;
    }

    public function load_template( $template ) {
        global $wp_query;
        if ( $wp_query->query_vars['name'] === 'course-payment-success') {
            $post = get_queried_object();
            Course_Purchase::process_course_after_purchase();
            return get_template_part( 'template-parts/courses/course-payment-success' );
        }
        if ( $wp_query->query_vars['name'] === 'course-payment-error') {
            $post = get_queried_object();
            return get_template_part( 'template-parts/courses/course-payment-error' );
        }

        if (get_query_var('profile_username')) {
            $new_template = locate_template('template-profile-page.php');
            if (!empty($new_template)) {
                return $new_template;
            }
        }

	    return $template;
    }

    public function es_register_query_vars( $vars ) {
        $vars[] = 'profile_username';
        return $vars;
    }

    public function custom_page_title( $title, $sep ) {
        global $wp_query;
        
        if ( isset( $wp_query->query_vars['course_payment_page'] ) ) {
            $page_type = $wp_query->query_vars['course_payment_page'];
            
            if ( $page_type === 'success' ) {
                return 'Payment Successful' . ' ' . $sep . ' ' . get_bloginfo( 'name' );
            }
            
            if ( $page_type === 'error' ) {
                return 'Payment Error' . ' ' . $sep . ' ' . get_bloginfo( 'name' );
            }
        }
        
        return $title;
    }

    public function custom_document_title_parts( $title ) {
        global $wp_query;
        
        if ( $wp_query->query_vars['name'] === 'course-payment-success') {
            $title['title'] = 'Payment Successful';
        }
        if ( $wp_query->query_vars['name'] === 'course-payment-error') {
            $title['title'] = 'Payment Error';
        }

        return $title;
    }
}