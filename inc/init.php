<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Theme Constants
require_once trailingslashit( get_template_directory() ) . 'inc/constants.php' ;

// Theme Style and Scripts Enqueye
require_once ENGISPACE_INC_DIR . '/theme-style-and-scripts.php';
// Theme Setup
require_once ENGISPACE_INC_DIR . '/theme-setup.php';
// AJAX 
require_once ENGISPACE_INC_DIR . '/ajax.php';


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
        $output_string = es_get_course_title_trimmed($string, $n + 1);
    }
    // Check max characters length
    if ( strlen( $output_string ) >= $chars_length ) {
        $output_string = mb_substr($output_string, 0, $chars_length, "UTF-8");
    }

    return $output_string . '...';
}

/**
 * ACF Theme Options Page
 */
add_action('acf/init', 'es_theme_options_page');
function es_theme_options_page() {
    // Check function exists.
    if( function_exists('acf_add_options_page') ) {
        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Engispace Settings'),
            'menu_title'    => __('Engispace Settings'),
            'menu_slug'     => 'engispace-theme-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
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
 * Enable comments open status for sfwd-courses post type
 */
function engispace_sfwd_comments_open($comments_open, $post_id) {
    if ( get_post_type( $post_id ) === 'sfwd-courses' ) {
        $comments_open = true;
    }

    return $comments_open;
}
add_filter( 'comments_open', 'engispace_sfwd_comments_open', 99, 2 );

function engispace_redirect_comments( $location, $commentdata ) {
    if(!isset($commentdata) || empty($commentdata->comment_post_ID) ){
        return $location;
    }
    $post_id = $commentdata->comment_post_ID;
    if('sfwd-courses' == get_post_type($post_id)){
        return wp_get_referer()."#comment-".$commentdata->comment_ID;
    }
    return $location;
}
add_filter( 'comment_post_redirect', 'engispace_redirect_comments', 10,2 );

/**
 *
 * Building Comments Lists
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
