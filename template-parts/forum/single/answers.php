<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="answers" class="es-forum-answers-section">
    <div class="es-forum-answers">
        <div class="es-comment-title">
            <?php
            $answer_count = get_comments_number();
            printf(
                esc_html(_n('%s Answer', '%s Answers', $answer_count, 'engispace-theme')),
                number_format_i18n($answer_count)
            );
            ?>
        </div>

        <?php if ( have_comments() ) : ?>
            <div class="es-forum-answers-list">
                <?php
                wp_list_comments(array(
                    'short_ping' => true,
                    'callback'   => 'es_answer_callback'
                ));
                ?>
            </div>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav class="es-answer-navigation">
                    <?php paginate_comments_links(); ?>
                </nav>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ( comments_open() ) : ?>
            <div class="es-form-post-answer">
                <div class="es-comment-title">
                    <?php esc_html_e('Your answer', 'engispace-theme'); ?>
                </div>
                
                <?php
                comment_form(array(
                    'title_reply'          => '',
                    'comment_field'        => '<div class="es-post-answer-editor"><textarea id="comment" class="quill-editor" name="comment" placeholder="' . esc_attr__('Write your answer here...', 'engispace-theme') . '"></textarea></div>',
                    'submit_button'        => '<div class="es-post-answer-submit"><button type="submit" class="es-btn-orange">%4$s</button></div>',
                    'submit_field'         => '%1$s %2$s',
                    'comment_type'         => 'answer',
                    'label_submit'         => esc_html__('Post your answer', 'engispace-theme'),
                ));
                ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="es-forum-answers-sidebar">
        <div class="es-forum-related-questions">
            <div class="es-sidebar-title">
                <h4>Related questions</h4>
            </div>
        </div>
        <div class="es-forum-related-questions-list">
            <ul>
                <?php
                $questions = new Engispace\Services\Questions();
                $related_questions = $questions->get_related_questions(get_the_ID());
                
                if ($related_questions->have_posts()) :
                    while ($related_questions->have_posts()) : $related_questions->the_post();
                        ?>
                        <li>
                            <span class="es-post-answers"><?php echo get_comments_number(); ?></span>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    ?>
                    <li><?php esc_html_e('No related questions found', 'engispace-theme'); ?></li>
                    <?php
                endif;
                ?>
            </ul>
        </div>
    </div>
</div>
