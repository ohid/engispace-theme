<?php 

namespace Engispace\Services;

use Engispace\Component_Interface;
use WP_Query;

class Questions implements Component_Interface {

    public function get_slug() : string {
        return 'questions';
    }

    public function initialize() {
        add_action( 'wp_ajax_create_forum_question', [ $this, 'create_forum_question' ], 10, 3 );
        add_action( 'template_redirect', [ $this, 'track_question_view' ] );
    }

    public function track_question_view() {
        if ( !is_singular('question') ) {
            return;
        }

        $post_id = get_the_ID();
        $viewed_posts = isset($_COOKIE['es_viewed_questions']) ? explode(',', sanitize_text_field($_COOKIE['es_viewed_questions'])) : array();

        if (!in_array($post_id, $viewed_posts)) {
            $views = (int) get_post_meta($post_id, 'question_views', true);
            update_post_meta($post_id, 'question_views', ++$views);

            $viewed_posts[] = $post_id;
            setcookie('es_viewed_questions', implode(',', $viewed_posts), time() + (DAY_IN_SECONDS * 30), COOKIEPATH, COOKIE_DOMAIN);
        }
    }

    public function get_questions( $sort = 'recent', $category = null, $limit = 10  ) {
        $sort = isset( $_GET['sort'] ) ? sanitize_text_field($_GET['sort']) : $sort;

        $args = array(
            'post_type' => 'question',
            'posts_per_page' => $limit
        );

        switch ($sort) {
            case 'popular':
                $args['meta_key'] = 'question_views';
                $args['orderby'] = array(
                    'meta_value_num' => 'DESC',
                    'comment_count' => 'DESC'
                );
                break;

            case 'active':
                $args['orderby'] = 'comment_date';
                break;

            case 'recent':
            default:
                $args['orderby'] = 'date';
                break;
        }

        $args['order'] = 'DESC';

        if ($category) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'categories',
                    'field' => 'term_id',
                    'terms' => $category
                )
            );
        }

        $query = new WP_Query( $args );

        return $query;
    }

    public function get_questions_categories() {
        $args = array(
            'taxonomy' => 'categories',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC'
        );

        $categories = get_terms($args);

        return $categories;
    }

    public function print_categories( $post_id ) {
        $categories = get_the_terms( $post_id, 'categories');
        if (!empty($categories)) : ?>
            <div class="es-fce-entry-categories">
                <?php foreach ($categories as $category) : ?>
                    <span>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif;
    }

    public function print_author( $id ) {
        $author_posts_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
        $author_name = get_the_author();

        printf(
            '<a href="%1$s" title="%2$s">%3$s</a>',
            $author_posts_url,
            esc_attr( $author_name ),
            esc_html( $author_name )
        );
    }

    public function get_related_questions($post_id, $limit = 8) {
        // Get current post's categories
        $categories = get_the_terms($post_id, 'categories');
        $cat_ids = array();
        
        if ($categories) {
            foreach ($categories as $cat) {
                $cat_ids[] = $cat->term_id;
            }
        }
    
        // Query args for related posts
        $args = array(
            'post_type' => 'question',
            'posts_per_page' => $limit,
            'post__not_in' => array($post_id),
            'orderby' => 'rand'
        );
    
        // Add category filter if we have categories
        if (!empty($cat_ids)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'categories',
                    'field' => 'term_id',
                    'terms' => $cat_ids
                )
            );
        }
    
        return new WP_Query($args);
    }

    public function get_user_questions($limit = 10) {
        // Get current user ID
        $current_user_id = get_current_user_id();

        if (!$current_user_id) {
            return false;
        }

        // Query args for user's questions
        $args = array(
            'post_type' => 'question',
            'posts_per_page' => $limit,
            'author' => $current_user_id,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        return new WP_Query($args);
    }

    public function create_forum_question() {
        if (!wp_doing_ajax() || !is_user_logged_in()) {
            wp_send_json_error(array('message' => 'Unauthorized access'));
            die;
        }

        // Verify nonce
        check_ajax_referer('es_nonce', 'nonce');

        // Sanitize and validate input fields
        $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
        $content = isset($_POST['content']) ? wp_kses_post($_POST['content']) : '';
        $category = isset($_POST['category']) ? absint($_POST['category']) : 0;

        // Validate required fields
        if (empty($title) || empty($content) || empty($category)) {
            wp_send_json_error(array('message' => 'All fields are required'));
            die;
        }

        // Create post array
        $post_data = array(
            'post_title' => $title,
            'post_content' => $content,
            'post_status' => 'publish',
            'post_type' => 'question',
            'post_author' => get_current_user_id()
        );

        // Insert the post
        $post_id = wp_insert_post($post_data);

        if (is_wp_error($post_id)) {
            wp_send_json_error(array('message' => 'Failed to create question'));
            die;
        }

        // Set question category
        wp_set_object_terms($post_id, $category, 'question_category');

        wp_send_json_success(array(
            'message' => 'Question created successfully',
            'post_id' => $post_id,
            'post_url' => get_permalink($post_id)
        ));
        die;
    }

    public function get_question_comments() {
        // Get the current post ID (if you're in a loop or a singular post page)
        $post_id = get_the_ID();

        // Set up the arguments to retrieve only 'question_answer' comments for this post.
        $args = array(
            'post_id' => $post_id,
            'status'  => 'approve',           // Only get approved comments.
            'type'    => 'question_comment',   // Filter by your custom comment type.
        );

        // Retrieve the comments.
        $qa_comments = get_comments( $args );

        return $qa_comments;
    }

    public function get_question_answers( $post_id = null ) {
        // Get the current post ID (if you're in a loop or a singular post page)
        if ( !$post_id ) {
            $post_id = get_the_ID();
        }

        // Set up the arguments to retrieve only 'question_answer' comments for this post.
        $args = array(
            'post_id' => $post_id,
            'status'  => 'approve',           // Only get approved comments.
            'type'    => 'question_answers',   // Filter by your custom comment type.
        );

        // Retrieve the comments.
        $qa_comments = get_comments( $args );

        return $qa_comments;
    }

    public function get_question_answers_count( $post_id = null ) {
        // Get the current post ID (if you're in a loop or a singular post page)
        if ( !$post_id ) {
            $post_id = get_the_ID();
        }

        // Set up the arguments to retrieve only 'question_answer' comments for this post.
        $args = array(
            'post_id' => $post_id,
            'status'  => 'approve',           // Only get approved comments.
            'type'    => 'question_answers',   // Filter by your custom comment type.
            'count'   => true,                 // Return only the comment count.
        );

        // Retrieve the comments.
        $qa_comments = get_comments( $args );

        return $qa_comments;
    }
}