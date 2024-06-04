<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Courses implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'courses';
	}

    public function initialize() {

    }

    public static function sidebar_categories_html() {
        $current_course_category_id = get_queried_object()->term_id;
        $course_categories = get_terms( 'ld_course_category' );
        self::get_course_categories();
        
        if ( !empty( $course_categories ) ) {
            echo '<ul>';
            foreach ( $course_categories as $category ) {
                $course_category_page = get_term_link( $category, 'ld_course_category' );
                $classes = [];
                $classes[] = $current_course_category_id === $category->term_id ? 'active' : '';
                $classes[] = $category->parent != 0 ? 'has-parent' : '';
                printf(
                    '<li class="%s"><a href="%s">%s</a></li>',
                    implode( ' ', $classes ),
                    esc_url( $course_category_page ),
                    esc_html( $category->name )
                );
            }
            echo '</ul>';
        }
    }

    /**
     * Get list of courses
     * 
     * @since 1.0.0
     */
    public static function get_courses_list() {
        $courses = self::get_courses();
        if ( !$courses ) {
            return;
        }
        
        if ( $courses->have_posts() ) {
            while( $courses->have_posts() ) {
                $courses->the_post();
                
                $es_currency = '$';
                
                $post_id = get_the_ID();
                $course_link = get_the_permalink( $post_id );
                $thumbnail_url = wp_get_attachment_image_url( get_post_thumbnail_id($post_id), 'full' );
                // Course category
                $course_category = wp_get_post_terms( $post_id, 'ld_course_category' );
                if ( isset( $course_category[0] ) ) {
                    $course_category_page = get_term_link( $course_category[0], 'ld_course_category' );
                }
                // Get the related post meta
                $short_description = get_post_meta( $post_id, 'es_course_short_description', true );
                $difficulty_level = get_post_meta( $post_id, 'es_course_difficulty_level', true );
                $course_duration = get_post_meta( $post_id, 'es_course_duration', true );
                $original_price = get_post_meta( $post_id, 'es_course_original_price', true );
                // Get learndash course data
                $price_args = learndash_get_course_price( $post_id );
                $lessons_data = learndash_course_get_steps_by_type( $post_id, 'sfwd-lessons' );

                // Include the template
                include locate_template('template-parts/courses/course-item.php');
                
                wp_reset_postdata();
            }
        }
    }

    /**
     * Get courses object
     */
    public static function get_courses() {
        // get current taxonomy id
        $current_course_category_id = get_queried_object()->term_id;

        $args = array(
            'post_type' => 'sfwd-courses',
            'limit' => 20,
            'post_status' => 'publish',
            'order' => 'DESC'
        );

        if ( $current_course_category_id ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'ld_course_category',
                    'field' => 'id',
                    'terms' => $current_course_category_id,
                ),
            );
        }

        // run the query
        $courses = new \WP_Query( $args );

        if ( is_wp_error( $courses ) ) {
            return;
        }

        return $courses;
    }
}