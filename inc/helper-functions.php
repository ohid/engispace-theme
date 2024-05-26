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
 * Get current logged in user's display_name
 * 
 * @since 1.0.0
 * 
 * @return null|string
 */
function es_get_current_user_display_name() {
    if ( !is_user_logged_in() ) {
        return;
    }

    $current_user = wp_get_current_user();
    return $current_user->data->display_name;
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
    $user_avatar = get_user_meta( $current_user->data->ID, '_es_user_avatar', true );
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
function es_generate_buy_now_button() {
    global $post;
    $course_info = array(
        'id' => $post->ID
    );

    printf( '<button data-course-info=\'%s\' class="course-purchase-btn" id="course-purchase-btn">', json_encode( $course_info ) );
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

function es_get_course_current_tab_class( $tab ) {
    $current_page_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'content';

    if ( $current_page_tab === $tab ) {
        return ' active';
    }

    return;
}