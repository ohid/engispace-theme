<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Generate IMG tag
 * 
 * @param string $regular_img
 * @param string $retina_img
 * @param string|null $alt
 * @param string|null $class
 * 
 * @return string
 */
function es_img_with_srcset( $regular_img, $retina_img = null, $alt = null, $class = null ) {
    $srcset = '';
    if ( $retina_img != null ) {
        $srcset .= $regular_img . ' 1x,';
        $srcset .= $retina_img . ' 2x,';
    }
    printf(
        '<img src="%s" %s alt="%s" class="%s">',
        $regular_img,
        $retina_img ? 'srcset="' . $srcset . '"' : '',
        esc_attr( $alt ), 
        esc_attr( $class )
    );
}

/**
 * Building Comments Lists HTML Markup
 * 
 * @since 1.0.0
 * @param object $comment
 * @param array $args
 * @param $depth
 * 
 */
function engispace_comments_list( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch( $comment->comment_type ) :
        case 'tracback' :
        case 'pingback' : ?>

        <li <?php esc_attr( comment_class() ); ?> id="comment-<?php esc_attr( comment_ID() ); ?>">
		<p><span class="title"><?php esc_html_e( 'Pingback:', 'bluetec' ); ?></span> <?php esc_url( comment_author_link() ); ?> <?php esc_url ( edit_comment_link( esc_html__( '(Edit)', 'bluetec' ), '<span class="edit-link">', '</span>' ) ); ?></p>

        <?php break;
        default : ?>
		<li <?php esc_attr( comment_class() ); ?>  id="comment-<?php esc_attr(comment_ID() ); ?>">
			<div class="the-comment">
				<div class="comment-author">
					<span class="author__avatar">
						<?php echo get_avatar( $comment, 50 ); ?>
					</span>
					<div class="author-name">
						<strong><?php esc_html( comment_author() ); ?></strong>
						<span class="meta"><?php echo esc_html( the_time( get_option('date_format') ) );?> <?php  esc_html( comment_time() ); ?></span>
					</div>

				</div>
				<div class="comment-text">
					<?php
						if( $comment->comment_approved  == 0 ) {
							esc_html_e('Your comment is awating for moderation.', 'bluetec');
						} else {
							comment_text();
						}
					?>
				</div>

				<?php
					comment_reply_link( array_merge( $args, array(
						'reply_text' =>  esc_html__('Reply', 'bluetec'),
						'after' => ' <span> </span>',
						'depth' => $depth,
						'max_depth' => $args['max_depth']
					) ) );
				?>
			</div>
		</li>
        <?php // End the default styling of comment
        break;
    endswitch;
}

/**
 * Get course title trimmed by specific number of needed letters or words
 * 
 * @since 1.0.0
 * @param string $string
 * @param int $n
 * @param int $chars_length
 * 
 * @return string $output_string
 */
function es_get_course_title_trimmed( $string, $n = 10, $chars_length = 40 ) {
    // Split the string into words based on spaces
    $words = explode(' ', $string);
    if ( count( $words ) <= $n ) {
        return $string;
    }
    // Remove the first $n words
    $remainingWords = array_slice($words, 0, $n);
    // Get the output strings
    $output_string = implode(' ', $remainingWords);
    // check lowest chars 
    if ( strlen( $output_string ) <= $chars_length ) {
        $output_string = es_get_course_title_trimmed( $string, $n + 1 );
    }
    // Check max characters length
    if ( strlen( $output_string ) >= $chars_length ) {
        $output_string = mb_substr($output_string, 0, $chars_length, "UTF-8");
    }

    return $output_string . '...';
}

/**
 * Get SVG icon
 * 
 * @param string $path
 * 
 * @return string $icon
 */
function es_get_svg_icon( $path ) {
    if ( !file_exists( ENGISPACE_DIR . $path . '.svg' ) ) {
        return '';
    }
    return file_get_contents( ENGISPACE_DIR . $path . '.svg' );
}

function es_get_template_for_single_course() {
    $tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : '';
    $replytocom = isset( $_GET['replytocom'] ) ? sanitize_text_field( $_GET['replytocom'] ) : false;

    if ( $tab === 'comments' || $replytocom ) {
        get_template_part( 'templates/courses/single-course-comments' );
    } else if ( $tab === 'reviews' ) {
        get_template_part( 'templates/courses/single-course-reviews' );
    } else {
        get_template_part( 'templates/courses/single-course-content' );
    }

    return;
}

/**
 * Add support for comments to the learndash courses post type
 */
function engispace_sfwd_cpt_options( $post_options, $post_type ) {
    if ( $post_type === 'sfwd-courses' ) {
        $post_options['supports'][] = 'comments';
    }
    return $post_options;
}
add_filter( 'sfwd_cpt_options', 'engispace_sfwd_cpt_options', 99, 2 );

/**
 * Get first letter of each words
 * 
 * @since 1.0.0
 * @param string $words
 * 
 * @return string $first_letters
 */
function es_get_first_letters( $words ) {
    $words_arr = explode( ' ', $words );
    $first_letters = '';
    foreach( $words_arr as $word ) {
        if ( !empty( $word ) ) {
            $first_letters .= $word[0];
        }
    }
    return $first_letters;
}

/**
 * Get current logged in user's firstname
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_current_user_firstname() {
    if ( !is_user_logged_in() ) {
        return;
    }

    $current_user = wp_get_current_user();
    return $current_user->user_firstname;
}

/**
 * Get current logged in user's lastname
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_current_user_lastname() {
    if ( !is_user_logged_in() ) {
        return;
    }

    $current_user = wp_get_current_user();
    return $current_user->user_lastname;
}

/**
 * Get the profile page URL for a specific user
 * 
 * Generates the full URL for a user's profile page using their user_login.
 * If no user_id is provided or user doesn't exist, returns the base profile URL.
 * 
 * @since 1.0.0
 * @param int|false $user_id The ID of the user whose profile URL is needed. Default false.
 * @return string The complete profile page URL (e.g., http://example.com/profile/username)
 */
function es_get_profile_page_url( $user_id = false ) {
    // Get user name by user_id
    $user = get_user_by('id', $user_id);
    return get_site_url() . '/profile/' . $user->user_login;
}

/**
 * Get current logged in user's display_name
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_current_user_display_name( $user_id = false ) {
    if ( ! $user_id ) {
        $user_id = get_current_user_id();
    }

    $user = get_user_by( 'id', $user_id );
    if ( ! $user ) {
        return;
    }

    return $user->first_name . ' ' . $user->last_name;
}

/**
 * Get current logged in user's profile bio
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_current_user_profile_bio( $user_id = false ) {
    if ( ! $user_id ) {
        $user_id = get_current_user_id();
    }

    $user = get_user_by( 'id', $user_id );
    if ( ! $user ) {
        return;
    }

    return $user->description;
}

/**
 * Get current logged in user's personal phone
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_current_user_phone($user_id = false) {
    if ( !$user_id ) {
        if ( !is_user_logged_in() ) {
            return;
        }
        $user_id = get_current_user_id();
    }
    return get_user_meta( $user_id, 'es_user_phone', true );
}

/**
 * Get current logged in user's personal email
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_current_user_email($user_id = false) {
    if ( !$user_id ) {
        if ( !is_user_logged_in() ) {
            return;
        }
        $current_user = wp_get_current_user();
    } else if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
    }

    return $current_user->user_email;
}

/**
 * Get current logged in user's personal url
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_current_user_url($user_id = false) {
    if ( !$user_id ) {
        if ( !is_user_logged_in() ) {
            return;
        }
        $user_id = get_current_user_id();
    }
    return get_user_meta( $user_id, 'es_user_url', true );
}

/**
 * Get current logged in user's profile avatar
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_user_profile_avatar( $user_id = null ) {
    if ( !$user_id ) {
        $user_id = get_current_user_id();
    }

    $profile_avatar = THEME_URI . '/assets/img/default-avatar.jpg';

    $user_avatar = get_user_meta( $user_id, 'es_user_profile_avatar' );
    if ( !empty( $user_avatar[0] ) ) {
        $profile_avatar = $user_avatar[0];
    }

    return $profile_avatar;
}

/**
 * Get user's display_name
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_user_display_name( $user_id ) {
    $user = get_user_by( 'id', $user_id );
    if ( !$user ) {
        return;
    }
    $user_display_name = $user->first_name . ' ' . $user->last_name;

    if ( empty( $user->first_name ) ) {
        return $user->user_login;
    }

    return $user_display_name;
}

/**
 * Get current logged in user's profile avatar
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_current_user_avatar() {
    if ( !is_user_logged_in() ) {
        return;
    }
    $avatar_html = '';

    $current_user = wp_get_current_user();
    $user_avatar = get_user_meta( $current_user->data->ID, 'es_user_profile_avatar', true );
    if ( $user_avatar ) {
        $avatar_html = '<img class="es-user-avater-img" src="'. esc_url( $user_avatar ) .'" ?>';
    } else {
        $letters_of_username = es_get_first_letters( $current_user->data->display_name );
        if ( $letters_of_username ) {
            $avatar_html = '<span class="es-user-avater-letters">'. $letters_of_username .'</span>';
        }
    }

    return $avatar_html;
}

/**
 * Generate the button now button on the single course page
 * 
 * @since 1.0.0
 */
function es_generate_buy_now_button( $price_args ) {
    global $post;
    $course_info = array(
        'id' => $post->ID
    );
    $is_free_course = isset( $price_args['type'] ) && $price_args['type'] === 'free';

    printf( 
        '<button data-course-info=\'%s\' class="course-purchase-btn" id="course-purchase-btn" data-is-free-course="%s">', 
        json_encode( $course_info ) ,
        $is_free_course
    );
        printf(
            '<span class="pb-text">%s</span>',
            es_get_svg_icon( '/assets/img/cart-icon' ) . esc_html__( 'Buy now', 'engispace' )
        );
        
        printf(
            '<span class="pb-icon">%s</span>',
            es_get_svg_icon( '/assets/img/loader-2' )
        );
    echo '</button>';
}

/**
 * Determine the current tab on the single course page
 * 
 * @wsince 1.0.0
 * @param string $tab
 * 
 * @return null|string 
 */
function es_get_course_current_tab_class( $tab ) {
    $current_page_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'content';

    if ( $current_page_tab === $tab ) {
        return ' active';
    }

    return;
}

/**
 * Check the user capability to access any given course id
 * 
 * @since 1.0.0
 * @param int $course_id
 * 
 * @return null|boolean
 */
function es_user_has_access_to_course( $course_id ) {
    if ( !is_user_logged_in() || !$course_id ) {
        return;
    }
    return sfwd_lms_has_access( $course_id, get_current_user_id() );
}

/**
 * Custom function to encrypt value
 * 
 * @since 1.0.0
 * @param string $value
 * @return string
 */
function es_custom_encrypt_value( $value ) {
    $cipher = "aes-256-cbc";
    $key = substr( hash( 'sha256', AUTH_KEY . SECURE_AUTH_KEY . LOGGED_IN_KEY . NONCE_KEY ), 0, 32 );
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($value, $cipher, $key, $options=0, $iv);

    return base64_encode($iv . $ciphertext);
}

/**
 * Custom function to decrypt value
 * 
 * @since 1.0.0
 * @param string $encrypted_value
 * @return string
 */
function es_custom_decrypt_value( $encrypted_value ) {
    $cipher = "aes-256-cbc";
    $key = substr( hash( 'sha256', AUTH_KEY . SECURE_AUTH_KEY . LOGGED_IN_KEY . NONCE_KEY ), 0, 32 );
    $ivlen = openssl_cipher_iv_length($cipher);
    $data = base64_decode($encrypted_value);
    $iv = substr($data, 0, $ivlen);
    $ciphertext = substr($data, $ivlen);

    return openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
}

/**
 * Get membership checkout URL
 * 
 * @since 1.0.0
 * @param array $plan
 * 
 * @return string
 */
function es_get_membership_checkout_url( $plan ) {
    $base_url = get_site_url() . '/checkout';
    $download_id = !empty( $plan['download_id'] ) ? $plan['download_id'] : '';
    $price_id = !empty( $plan['price_id'] ) ? $plan['price_id'] : '';

    return add_query_arg( [
        'edd_action' => 'add_to_cart',
        'download_id' => $download_id,
        'edd_options[price_id]' => $price_id,
    ], $base_url );
}

function es_get_current_user_subscription() {
    $user_role = 'na';

    if ( !is_user_logged_in() ) {
        return $user_role;
    }
    // Change the role to freemium for logged in users
    $user_role = 'freemium';

    $user = get_user_by( 'id', get_current_user_id() );
    $user_roles = $user->roles;

    // skip user subscription check for the below user roles
    if ( 
        in_array( 'administrator', $user_roles ) ||
        in_array( 'author', $user_roles ) ||
        in_array( 'editor', $user_roles ) ||
        in_array( 'contributor', $user_roles )
    ) {
        $user_role = 'na';
    }

    // check for creator subscription user
    if ( in_array( 'wdm_instructor', $user_roles ) || in_array( 'engispace_user_creator', $user_roles ) ) {
        $user_role = 'creator';
    }
    // check for pro subscription user
    if ( in_array( 'engispace_user_pro', $user_roles ) ) {
        $user_role = 'pro';
    }

    return $user_role;
}

function es_is_creator_user() {
    if ( !is_user_logged_in() ) {
        return;
    }

    $user = get_user_by( 'id', get_current_user_id() );
    $user_roles = $user->roles;

    // check for creator subscription user
    if ( 
        in_array( 'wdm_instructor', $user_roles ) || 
        in_array( 'engispace_user_creator', $user_roles ) ||
        in_array( 'administrator', $user_roles )
    ) {
        return true;
    }

    return;
}

function es_all_courses_page_title() {
    $current_course_category_id = get_queried_object()->term_id;

    if ( $current_course_category_id ) {
        printf('<h3>%s</h3>', __( 'View Courses from "' ) . get_queried_object()->name . '"');
    } else if ( is_search() ) {
        printf('<h3>%s</h3>', __( 'See results from "' ) . get_search_query() . '"');
    } else {
        printf('<h3>%s</h3>', __( 'All Courses', 'engispace' ));
    }
}

/**
 * Custom callback function to display answers (comments) for questions
 * 
 * This function renders the HTML markup for individual answers in the forum.
 * It displays the answer content, author information, avatar, and posting date
 * in the forum's custom layout structure.
 * 
 * @since 1.0.0
 * @param WP_Comment $comment The comment object
 * @param array     $args    An array of arguments
 * @param int       $depth   The depth of the current comment in the tree
 * 
 * @return void
 */
function es_answer_callback($comment) {
    $reputation_count = es_get_answer_reputation($comment->comment_ID);
    ?>
    <div class="es-forum-answer">
        <div class="es-answer-reputation">
            <span class="es-ar-upvote">
                <button class="es-forum-upvote-answer <?php echo es_user_has_voted($comment->comment_ID, 'upvote') ? 'voted' : ''; ?>" 
                        data-comment-id="<?php echo esc_attr($comment->comment_ID); ?>">+1</button>
            </span>
            <span class="es-ar-reputation-count es-eng-severity-<?php echo es_eng_severity($reputation_count); ?>">
                <?php echo $reputation_count; ?>
            </span>
            <span class="es-ar-downvote">
                <button class="es-forum-downvote-answer <?php echo es_user_has_voted($comment->comment_ID, 'downvote') ? 'voted' : ''; ?>" 
                        data-comment-id="<?php echo esc_attr($comment->comment_ID); ?>">-1</button>
            </span>
        </div>

        <div class="es-answer-content">
            <div class="es-answer-author">
                <span class="es-author-img">
                    <?php 
                        $user = get_user_by( 'email', $comment->comment_author_email );
                        if ( es_user_profile_avatar( $user->ID ) ) {
                            echo '<a href="'. esc_url(es_get_profile_page_url($user->ID)) .'">';
                            printf('<img src="%s" />', es_user_profile_avatar( $user->ID ));
                            echo '</a>'    ;
                        } else {
                            echo get_avatar($comment, 50); 
                        }
                    ?>
                </span>
                <div class="es-right">
                    <span class="es-author-name">
                        <a href="<?php echo esc_url(es_get_profile_page_url($user->ID)); ?>">
                            <?php echo esc_html(get_comment_author($comment)); ?>
                        </a>
                    </span>
                    <span class="es-posted-date">
                        <?php echo esc_html(get_comment_date('F j, Y', $comment)); ?>
                    </span>
                </div>
            </div>
            <div class="es-answer-text">
                <?php comment_text(); ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Get the number of answers (approved comments) for the current question
 *
 * @since 1.0.0
 * @return int Number of approved comments
 */
function es_get_question_answer_count() {
    $post_id = get_the_ID();
    if (!$post_id) {
        return 0;
    }

    // Get approved comments count only
    $comments_count = get_comments([
        'post_id' => $post_id,
        'status' => 'approve',
        'count' => true
    ]);

    return absint($comments_count);
}


/**
 * Get and update the view count for the current question
 *
 * @return int Current view count
 */
function es_get_question_view_count() {
    $post_id = get_the_ID();
    if (!$post_id) {
        return 0;
    }

    $view_count = absint(get_post_meta($post_id, 'es_question_view_count', true));

    // Increment view count only when actually viewing the page
    if (!is_admin() && !is_preview()) {
        $view_count++;
        $updated = update_post_meta($post_id, 'es_question_view_count', $view_count);
        
        if (false === $updated) {
            error_log(sprintf('Failed to update view count for question ID: %d', $post_id));
            return $view_count - 1; // Return non-incremented count if update fails
        }
    }

    return $view_count;
}

function qa_set_comment_type( $commentdata ) {
    if ( $_POST['comment_type'] ) {
        $comment_type = sanitize_text_field( $_POST['comment_type'] );
        $commentdata['comment_type'] = $comment_type;
    }

    return $commentdata;
}
add_filter( 'preprocess_comment', 'qa_set_comment_type' );



/**
 * Redirect non-logged in users away from ask question page
 */
function es_redirect_non_logged_in_users() {
    if (is_page_template('template-ask-question.php') && !is_user_logged_in()) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('template_redirect', 'es_redirect_non_logged_in_users');


function es_eng_severity($count, $times = 1) {
    $color_value = 'gray';

    if ( $count >= 30 * $times ) {
        $color_value = 'orange_4';
    } elseif ( $count >= 15 * $times ) {
        $color_value = 'orange_3';
    } elseif ( $count >= 8 * $times ) {
        $color_value = 'orange_2';
    } elseif ( $count > 2 * $times ) {
        $color_value = 'orange_1';
    }

    return $color_value;
}


/**
 * Get answer reputation count
 */
function es_get_answer_reputation($comment_id) {
    $upvotes = get_comment_meta($comment_id, 'es_answer_upvotes', true) ?: [];
    $downvotes = get_comment_meta($comment_id, 'es_answer_downvotes', true) ?: [];
    return count((array)$upvotes) - count((array)$downvotes);
}

/**
 * Check if user has voted on an answer
 */
function es_user_has_voted($comment_id, $vote_type) {
    if (!is_user_logged_in()) return false;
    
    $user_id = get_current_user_id();
    $votes = get_comment_meta($comment_id, "es_answer_{$vote_type}s", true) ?: [];
    return in_array($user_id, (array)$votes);
}

/**
 * Allow specific HTML tags in comments
 */
function es_allow_html_in_comments($data) {
    global $allowedtags;
    
    // Add additional allowed tags
    $allowedtags['h1'] = array();
    $allowedtags['h2'] = array();
    $allowedtags['h3'] = array();
    $allowedtags['h4'] = array();
    $allowedtags['h5'] = array();
    $allowedtags['h6'] = array();
    $allowedtags['img'] = array(
        'src' => true,
        'alt' => true,
        'width' => true,
        'height' => true,
        'class' => true
    );
    $allowedtags['figure'] = array(
        'class' => true
    );
    $allowedtags['figcaption'] = array();
    
    // Remove WordPress's default filtering
    remove_filter('pre_comment_content', 'wp_filter_kses');
    add_filter('pre_comment_content', 'wp_kses_post');
    
    return $data;
}
add_filter('preprocess_comment', 'es_allow_html_in_comments');

/**
 * Remove autop from comment text
 */
function es_remove_comment_autop($content) {
    if (get_post_type() === 'question') {
        remove_filter('comment_text', 'wpautop', 30);
    }
    return $content;
}
add_filter('the_content', 'es_remove_comment_autop');



/**
 * Modify main query for search results pagination
 */
function es_modify_search_query($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'all';
        
        if ($sort === 'all') {
            $query->set('post_type', array('sfwd-courses', 'question'));
        } else {
            $query->set('post_type', array($sort));
        }
        
        $query->set('posts_per_page', 10);
    }
    return $query;
}
add_action('pre_get_posts', 'es_modify_search_query');

function handle_email_verification() {
    if (!isset($_GET['action']) || $_GET['action'] !== 'verify_email') {
        return;
    }
    
    $user_id = intval($_GET['user_id']);
    $token = sanitize_text_field($_GET['token']);
    
    if (!$user_id || !$token) {
        wp_die('Invalid verification link.');
    }
    
    $stored_token = get_user_meta($user_id, 'verification_token', true);
    
    if ($token !== $stored_token) {
        wp_die('Invalid or expired verification link.');
    }
    
    // Verify the user
    update_user_meta($user_id, 'account_verified', true);
    delete_user_meta($user_id, 'verification_token');
    
    wp_redirect(add_query_arg('verified', '1', home_url('/login')));
    exit;
}
add_action('init', 'handle_email_verification');