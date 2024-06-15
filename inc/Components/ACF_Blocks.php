<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class ACF_Blocks implements Component_Interface {

    public $es_logo = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0V0z" /><path d="M19 13H5v-2h14v2z" /></svg>';

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

        $this->register_blocks_for_home_page();
        $this->register_blocks_for_features_page();
        $this->register_blocks_for_courses_page();
        $this->register_blocks_for_pricing_page();
    }

    /**
     * Register blocks for the home page
     * 
     */
    public function register_blocks_for_home_page() {
        // Register block for the header
        acf_register_block_type(array(
            'name'              => 'es_home_header',
            'title'             => __('Engispace - Home Header'),
            'render_template'   => 'template-parts/acf-blocks/home/header.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'home', 'header', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'home_header', THEME_URI . '/assets/css/blocks/home/header.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));
        
        // Register block for the home page sections
        acf_register_block_type(array(
            'name'              => 'es_home_page_sections',
            'title'             => __('Engispace - Page Sections'),
            'render_template'   => 'template-parts/acf-blocks/home/page-sections.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'home', 'page sections', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'page_sections', THEME_URI . '/assets/css/blocks/home/page_sections.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));
        
        // Register block for the home courses section
        acf_register_block_type(array(
            'name'              => 'es_home_courses_section',
            'title'             => __('Engispace - Home Courses Section'),
            'render_template'   => 'template-parts/acf-blocks/home/courses-section.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'home', 'courses', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'home_courses_section', THEME_URI . '/assets/css/blocks/home/courses_section.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));
        
        // Register block for the home engineering section
        acf_register_block_type(array(
            'name'              => 'es_home_enginerring_section',
            'title'             => __('Engispace - Home Enginerring Section'),
            'render_template'   => 'template-parts/acf-blocks/home/enginerring-section.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'home', 'enginerring', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'home_engineering_section', THEME_URI . '/assets/css/blocks/home/engineering_section.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));
        
        // Register block for the home engineering section
        acf_register_block_type(array(
            'name'              => 'es_home_code_exchange_section',
            'title'             => __('Engispace - Home Code Exchange Section'),
            'render_template'   => 'template-parts/acf-blocks/home/code_exchange-section.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'home', 'code_exchange', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'code_exchange_section', THEME_URI . '/assets/css/blocks/home/code_exchange_section.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));
        
        // Register block for the home engineering section
        acf_register_block_type(array(
            'name'              => 'es_home_find_answers_section',
            'title'             => __('Engispace - Home Find Answers Section'),
            'render_template'   => 'template-parts/acf-blocks/home/find_answers-section.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'home', 'find_answers', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'find_answers_section', THEME_URI . '/assets/css/blocks/home/find_answers_section.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));

        // Register block for the home testimonials section
        acf_register_block_type(array(
            'name'              => 'es_home_testimonials_section',
            'title'             => __('Engispace - Home Testimonials Section'),
            'render_template'   => 'template-parts/acf-blocks/home/testimonials-section.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'home', 'testimonials', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'testimonials_section', THEME_URI . '/assets/css/blocks/home/testimonials_section.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));

        // Register block for the home features section
        acf_register_block_type(array(
            'name'              => 'es_home_features_section',
            'title'             => __('Engispace - Home Features Section'),
            'render_template'   => 'template-parts/acf-blocks/home/features-section.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'home', 'features', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'features_section', THEME_URI . '/assets/css/blocks/home/features_section.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));


        // Register block for the home features section
        acf_register_block_type(array(
            'name'              => 'es_home_cta_section',
            'title'             => __('Engispace - Home CTA Section'),
            'render_template'   => 'template-parts/acf-blocks/home/cta-section.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'home', 'cta', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'cta_section', THEME_URI . '/assets/css/blocks/home/cta_section.css' );
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
     * Register blocks for the features page
     */
    public function register_blocks_for_features_page() {
        // Register block for the header
        acf_register_block_type(array(
            'name'              => 'es_features_header',
            'title'             => __('Engispace - Features Header'),
            'render_template'   => 'template-parts/acf-blocks/features/header.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'features', 'header', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'features_header', THEME_URI . '/assets/css/blocks/features/header.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));
      
        // Register block for the courses
        acf_register_block_type(array(
            'name'              => 'es_features_courses',
            'title'             => __('Engispace - Features Courses'),
            'render_template'   => 'template-parts/acf-blocks/features/courses.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'features', 'courses', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'features_courses', THEME_URI . '/assets/css/blocks/features/courses.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));
    }

    public function register_blocks_for_courses_page() {

        // Register block for the courses page
        acf_register_block_type(array(
            'name'              => 'es_course_learn_context',
            'title'             => __('Engispace - Course Learn Content'),
            'description'       => __('Display info what you will learn from this course'),
            'render_template'   => 'template-parts/acf-blocks/course-learn-context.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'what you will learn', 'course learn context', 'course', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'courses_learn_context', THEME_URI . '/assets/css/blocks/course_learn_context.css' );
                }
            },
            'example'  => array(
                'attributes' => array(
                    'mode' => 'preview'
                )
            ),
        ));
    }

    public function register_blocks_for_pricing_page() {
        // Pricing plan block
        acf_register_block_type(array(
            'name'              => 'es_pricing_plan_block',
            'title'             => __('Engispace - Pricing Plan Block'),
            'description'       => __('Manage pricing plans'),
            'render_template'   => 'template-parts/acf-blocks/pricing/pricing-plans.php',
            'category'          => 'engispace-theme',
            'icon'              => $this->es_logo,
            'keywords'          => array( 'pricing', 'pricing plan', 'engispace', 'es' ),
            'enqueue_assets' => function() {
                // only enqueue the block assets for the admin gutenberg editor
                if ( is_admin() ) {
                    wp_enqueue_style( 'pricing-plan', THEME_URI . '/assets/css/blocks/pricing_plan.css' );
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