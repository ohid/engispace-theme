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
            // Send email notification to course author
            $this->send_review_notification_email( $course_id, $review );
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

    /**
     * Send email notification to course author when a new review is posted
     * 
     * @param int $course_id Course ID
     * @param string $review Review content
     * @return bool Success status
     */
    public function send_review_notification_email( $course_id, $review ) {
        // Get course data
        $course = get_post( $course_id );
        if ( !$course ) {
            return false;
        }

        // Get course author
        $author_id = $course->post_author;
        $author = get_userdata( $author_id );
        if ( !$author ) {
            return false;
        }

        // Get reviewer data
        $reviewer = wp_get_current_user();
        if ( !$reviewer ) {
            return false;
        }

        // Prepare email data
        $course_title = $course->post_title;
        $author_name = !empty($author->first_name) ? $author->first_name : 
                      (!empty($author->display_name) ? $author->display_name : $author->user_login);
        $reviewer_name = es_get_user_display_name( $reviewer->ID );
        $review_url = home_url('/course-builder/' . $course_id . '/');

        // Email content
        $subject = 'Requires attention for your course: ' . $course_title;
        $title = 'Course Update Required';
        $content = Email_Templates::get_course_review_email_content(
            $author_name, 
            $course_title, 
            $reviewer_name, 
            $review, 
            $review_url
        );

        // Send email
        return Email_Templates::send_email(
            $author->user_email, 
            $subject, 
            $title, 
            $content, 
            'EngiSpace', 
            'no-reply@engispace.com'
        );
    }
}