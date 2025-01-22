<?php

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class CPT implements Component_Interface {
    
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'courses';
	}

    public function initialize() {
        add_action( 'init', [ $this, 'custom_post_types' ], 10 );
    }

    public function custom_post_types() {
        $this->register_question_post_type();
        $this->register_category_taxonomy();

    }
    
    public function register_question_post_type() {
        $labels = array(
            'name'                  => _x( 'Questions', 'Post type general name', 'engispace-theme' ),
            'singular_name'         => _x( 'Question', 'Post type singular name', 'engispace-theme' ),
            'menu_name'             => _x( 'Questions', 'Admin Menu text', 'engispace-theme' ),
            'name_admin_bar'        => _x( 'Question', 'Add New on Toolbar', 'engispace-theme' ),
            'add_new'               => __( 'Add New', 'engispace-theme' ),
            'add_new_item'          => __( 'Add New Question', 'engispace-theme' ),
            'new_item'              => __( 'New Question', 'engispace-theme' ),
            'edit_item'             => __( 'Edit Question', 'engispace-theme' ),
            'view_item'             => __( 'View Question', 'engispace-theme' ),
            'all_items'             => __( 'All Questions', 'engispace-theme' ),
            'search_items'          => __( 'Search Questions', 'engispace-theme' ),
            'parent_item_colon'     => __( 'Parent Questions:', 'engispace-theme' ),
            'not_found'             => __( 'No Questions found.', 'engispace-theme' ),
            'not_found_in_trash'    => __( 'No Questions found in Trash.', 'engispace-theme' ),
            'featured_image'        => _x( 'Question Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'engispace-theme' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'engispace-theme' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'engispace-theme' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'engispace-theme' ),
            'archives'              => _x( 'Question archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'engispace-theme' ),
            'insert_into_item'      => _x( 'Insert into Question', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'engispace-theme' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Question', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'engispace-theme' ),
            'filter_items_list'     => _x( 'Filter Questions list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'engispace-theme' ),
            'items_list_navigation' => _x( 'Questions list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'engispace-theme' ),
            'items_list'            => _x( 'Questions list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'engispace-theme' ),
        );
    
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'question' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );
    
        register_post_type( 'question', $args );
    }

    public function register_category_taxonomy() {
        $labels = array(
            'name'              => _x('Categories', 'taxonomy general name'),
            'singular_name'     => _x('Category', 'taxonomy singular name'),
            'search_items'      => __('Search Categories'),
            'all_items'         => __('All Categories'),
            'parent_item'       => __('Parent Category'),
            'parent_item_colon' => __('Parent Category:'),
            'edit_item'         => __('Edit Category'),
            'update_item'       => __('Update Category'),
            'add_new_item'      => __('Add New Category'),
            'new_item_name'     => __('New Category Name'),
            'menu_name'         => __('Categories'),
        );
    
        $args = array(
            'hierarchical'      => true, // Like categories, set to false if you want it to work like tags.
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'forum-categories'),
        );
    
        register_taxonomy( 'categories', 'question', $args );
    }
}