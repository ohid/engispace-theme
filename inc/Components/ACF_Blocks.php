<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class ACF_Blocks implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'acf_blocks';
	}

    public function initialize() {
        add_action( 'acf/init', array( $this, 'acf_blocks' ) );
        add_filter( 'block_categories_all', array( $this, 'es_custom_block_category' ), 10, 2 );
    }

    public function acf_blocks() {
        // Return if the plugin function not exists
        if( ! function_exists( 'acf_register_block_type' ) ) {
            return;
        }

        $this->register_blocks_for_courses_page();
    }

    public function register_blocks_for_courses_page() {

        // Register block for the courses page
        acf_register_block_type(array(
            'name'              => 'es_course_learn_context',
            'title'             => __('Engispace - Course Learn Content'),
            'description'       => __('Display info what you will learn from this course'),
            'render_template'   => 'template-parts/acf-blocks/course-learn-context.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->sb_logo,
            'keywords'          => array( 'what you will learn', 'course learn context', 'course', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'hero-home', THEME_URI . '/assets/css/blocks/course_learn_context.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));
    }

    /**
     * Add custom block category to the Gutenberg editor
     */
    public function es_custom_block_category( $block_categories, $editor_context ) {
        // Adding a new category.
        $categories[] = array(
            'slug'  => 'engispace-theme',
            'title' => 'Engispace'
        );

        return $categories;
    }
}