<div class="es-sc-comments-area">
    <div id="course-comments" class="engispace-comments-area">
        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 42,
                    'per_page' => 10,
                    'callback' => 'engispace_comments_list'
                ) );
            ?>
        </ol><!-- .comment-list -->
    </div>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open()  && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bluetec' ); ?></p>
    <?php else:  ?>
        <div class="engispace-comments-form-area">
            <?php
                comment_form( array(
                    'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
                    'title_reply_after'  => '</h2>',
                    'class_submit' => 'es-button-regular'
                ) );
            ?>
        </div>
    <?php endif; ?>
</div>
