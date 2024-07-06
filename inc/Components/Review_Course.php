<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Review_Course implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'review-course';
	}

    public function initialize() {
        add_filter( 'post_row_actions', [ $this, 'course_review' ], 10, 2 );
        add_action( 'admin_menu', [ $this, 'review_course_page' ] );
        add_action( 'wp_ajax_es_admin_course_review', [ $this, 'submit_course_review' ] );
    }
    
    public function course_review($actions, $post) {
        // Check if the post type is 'post'
        if ($post->post_type === 'sfwd-courses') {
            // Add the review button
            $actions['review'] = sprintf(
                '<a href="%s">%s</a>', 
                admin_url('admin.php?page=review_course&course_id=' . $post->ID),
                esc_html__( 'Review', 'engispace' )
            );
        }

        return $actions;
    }

    public function review_course_page() {
        add_submenu_page(
            null,
            'Review Course', 
            'Review Course', 
            'manage_options', 
            'review_course', 
            [ $this, 'review_post_page' ]
        );
    }

    public function review_post_page() {
        wp_enqueue_style( 'engispace-admin-course-review-style' );
        wp_enqueue_script( 'engispace-admin-course-review-script' );

        if (!current_user_can('edit_posts')) {
            wp_die('You do not have sufficient permissions to access this page.');
        }

        if (isset($_GET['course_id'])) {
            get_template_part( 'templates/admin/review_course' ); 
        } else {
            echo '<p>No course found to review.</p>';
        }
    }

    public function submit_course_review() {
        $data = $_POST;
        $review = !empty( $data['course_review'] ) ? sanitize_text_field( $data['course_review'] ) : '';
        $course_id = !empty( $data['course_id'] ) ? sanitize_text_field( $data['course_id'] ) : ''; 
        if ( empty( $review ) || empty( $course_id ) ) {
            wp_send_json_error();
        }
        
        $submitted_review_id = $this->insert_course_review( $review, $course_id );

        if ( $submitted_review_id ) {
            wp_send_json_success();
        }

        wp_send_json_error();
        die;
    }

    public function insert_course_review( $review, $course_id ) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'course_reviews';

        return $wpdb->insert(
            $table_name,
            array(
                'course_id' => $course_id,
                'review' => $review,
                'author_id' => get_current_user_id(),
                'date' => current_time('mysql'),
            )
        );
    }

    public static function get_all_reviews( $course_id ) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'course_reviews';

        $reviews = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $table_name WHERE course_id = %d ORDER BY date DESC",
                $course_id
            )
        );

        return $reviews;
    }
}