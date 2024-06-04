<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Courses {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'courses';
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

    public static function user_have_purchased_courses() {
        if ( !is_user_logged_in() ) {
            return;
        }
        $user_id = get_current_user_id();
        $courses_ids = learndash_user_get_enrolled_courses( $user_id );
        
        if ( empty( $courses_ids ) ) {
            return;
        }
        return true;
    }

    /**
     * Display the courses purchased by the user
     * 
     * @since 1.0.0
     */
    public static function user_purchased_courses() {
        if ( !self::user_have_purchased_courses() ) {
            return;
        }
        $user_id = get_current_user_id();
        $courses_ids = learndash_user_get_enrolled_courses( $user_id );
        $courses = self::get_courses( [ 'post__in' => $courses_ids ] );
        return self::course_grid_html( $courses->posts );
    }

    /**
     * Output the template with featured courses on the website
     * 
     * @since 1.0.0
     */
    public static function featured_courses_carousel() {
        $courses = (array) get_field( 'courses__featured_courses', 'option' );
        return self::course_grid_html( $courses );
    }

    /**
     * Output the template with top courses on the website
     * 
     * @since 1.0.0
     */
    public static function top_courses_carousel() {
        $courses = (array) get_field( 'courses__top_courses', 'option' );
        return self::course_grid_html( $courses );
    }

    /**
     * Output the course coursel items HTML
     * 
     * @since 1.0.0
     */
    public static function course_grid_html( $courses ) {
        if ( empty( $courses ) ) {
            return;
        }
        echo '<div class="courses-page-course-slider owl-carousel owl-theme courses_slider">';
        foreach( $courses as $post ) {
            // Setup post data
            $post_id = get_the_ID();
            $es_currency = '$';
            // Course category
            $course_category = wp_get_post_terms( $post_id, 'ld_course_category' );
            if ( isset( $course_category[0] ) ) {
                $course_category_page = get_term_link( $course_category[0], 'ld_course_category' );
            }
            $short_description = get_post_meta( $post_id, 'es_course_short_description', true );
            $difficulty_level = get_post_meta( $post_id, 'es_course_difficulty_level', true );
            $course_duration = get_post_meta( $post_id, 'es_course_duration', true );
            $original_price = get_post_meta( $post_id, 'es_course_original_price', true );

            $price_args = learndash_get_course_price( $post_id );
            $lessons_data = learndash_course_get_steps_by_type( $post_id, 'sfwd-lessons' );
            $course_link = get_the_permalink( $post );
        
            // Include the template
            include locate_template('template-parts/courses/course-carousel-item.php');
        }
        wp_reset_postdata();
        echo '</div>';
    }

    /**
     * Get courses object
     */
    public static function get_courses( $args = array() ) {
        // get current taxonomy id
        $current_course_category_id = get_queried_object()->term_id;

        $query_args = array(
            'post_type' => 'sfwd-courses',
            'limit' => 20,
            'post_status' => 'publish',
            'order' => 'DESC'
        );

        if ( $current_course_category_id ) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'ld_course_category',
                    'field' => 'id',
                    'terms' => $current_course_category_id,
                ),
            );
        }

        $args = wp_parse_args( $args, $query_args );

        // run the query
        $courses = new \WP_Query( $args );

        if ( is_wp_error( $courses ) ) {
            return;
        }

        return $courses;
    }
}