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
    }

    public function course_payment_pages() {
        add_rewrite_endpoint( 'course-payment-success', EP_PERMALINK );
        add_rewrite_endpoint( 'course-payment-error', EP_PERMALINK );
    }

    public function filter_request( $vars ) {
        if ( isset( $vars['course-payment-success'] ) ) {
            $vars['course-payment-success'] = true;
        }
        if ( isset( $vars['course-payment-error'] ) ) {
            $vars['course-payment-error'] = true;
        }
        return $vars;
    }

    public function load_template( $template ) {
        global $wp_query;
        if ( $wp_query->query_vars['pagename'] === 'course-payment-success') {
            $post = get_queried_object();
            Course_Purchase::process_course_after_purchase();
            return get_template_part( 'template-parts/courses/course-payment-success' );
        }
        if ( $wp_query->query_vars['pagename'] === 'course-payment-error') {
            $post = get_queried_object();
            return get_template_part( 'template-parts/courses/course-payment-error' );
        }

	    return $template;
    }
}