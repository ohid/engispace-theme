<?php 

// Exit if accessed directly
if ( !ABSPATH ) exit;

use Engispace\Services\Questions;

$questions = new Questions();

$post_user_id = get_post_field('post_author', get_the_ID());
?>

<div class="es-forum-single-content-wrapper">
    <div class="es-content-area">
        <div class="es-content-title">
            <h3><?php  the_title(); ?></h3>
        </div>
        <div class="es-content-entry">
            <?php the_content(); ?>
        </div>
        <div class="es-content-comments">
            <ul>
                <?php
                $comments = $questions->get_question_comments(get_the_ID());
                if ($comments) :
                    foreach ($comments as $comment) : ?>
                        <li>
                            <span class="es-comment-comment"><?php echo esc_html($comment->comment_content); ?></span> -
                            <span class="es-comment-author">
                                <a href="<?php echo esc_url(es_get_profile_page_url($comment->user_id)); ?>">
                                    <?php echo esc_html(get_comment_author($comment)); ?>
                                </a>
                            </span>
                            <span class="comment-date">
                                <?php echo get_comment_date('M d \'y \a\t H:i', $comment); ?>
                            </span>
                        </li>
                    <?php endforeach;
                    if (count($comments) > 3) : ?>
                        <li class="more-comments">
                            <a href="#">View more comments</a>
                        </li>
                    <?php endif;
                endif; ?>
            </ul>
            <?php
                if ( comments_open() && is_user_logged_in() ) :
            ?>
            <div class="post-comment">
                <span class="es-author-img"><img src="<?php echo es_user_profile_avatar(); ?>" alt=""></span>
                <?php
                    comment_form(array(
                        'title_reply'          => '',
                        'comment_field'        => '<div class="es-post-comment-editor"><textarea id="comment" name="comment" placeholder="' . esc_attr__('Write your comment here...', 'engispace-theme') . '"></textarea></div>',
                        'submit_button'        => '<div class="es-post-comment-submit"><button type="submit" class="es-btn-orange">%4$s</button><input type="hidden" name="comment_type" value="question_comment" /></div>',
                        'submit_field'         => '%1$s %2$s',
                        'comment_type'         => 'question_comment',
                        'label_submit'         => esc_html__('Post your comments', 'engispace-theme'),
                    ));
                ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="es-content-sidebar">
        <div class="es-forum-post-author">
            <a href="<?php echo esc_url(es_get_profile_page_url($post_user_id)); ?>" class="es-fpa-name">
                <span><img src="<?php echo es_user_profile_avatar($post_user_id); ?>" alt=""></span>
                <span class="es-fpa-name"><?php echo es_get_current_user_display_name($post_user_id); ?></span>
            </a>
            <div class="es-fpa-author-info">
                <p><?php echo es_get_current_user_profile_bio($post_user_id); ?></p>
            </div>
            
            <?php echo $questions->print_categories( get_the_ID() ); ?>
            
            <div class="es-fpa-posted-date">
                <span>Posted: <?php echo get_the_date( 'F j, Y' ); ?></span>
            </div>
        </div>
    </div>
</div>