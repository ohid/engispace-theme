<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Core implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'core';
	}

    public function initialize() {
        add_filter( 'comments_open', array( $this, 'comments_open' ), 99, 2 );
        add_filter( 'comment_post_redirect', array( $this, 'redirect_comments' ), 10,2 );
    }

    /**
     * Enable comment status
     * @since 1.0.0
     * 
     * @param int $comments_open
     * @param int $post_id
     * 
     * @return int $comments_open
     */
    public function comments_open( $comments_open, $post_id ) {
        // enable comments for sfwd-courses post type if it's turned off by the learndash plugin
        if ( get_post_type( $post_id ) === 'sfwd-courses' ) {
            $comments_open = true;
        }
    
        return $comments_open;
    }

    /**
     * Redirect to specific page tab on the sfwd-courses post type after a comment 
     * 
     * @since 1.0.0
     * @param string $location
     * @param object $commentdata
     * 
     * @return string $location
     */
    public function redirect_comments( $location, $commentdata ) {
        if ( !isset( $commentdata ) || empty( $commentdata->comment_post_ID ) ){
            return $location;
        }
        $post_id = $commentdata->comment_post_ID;
        if ( 'sfwd-courses' == get_post_type( $post_id ) ) {
            return wp_get_referer() . "#comment-". $commentdata->comment_ID;
        }
        return $location;
    }
}