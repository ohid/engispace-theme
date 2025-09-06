<?php

use Engispace\Services\Questions;

// Get the profile being viewed
$username = get_query_var('profile_username');
$viewed_user = get_user_by('login', $username);
$viewed_user_id = $viewed_user instanceof \WP_User ? $viewed_user->ID : get_current_user_id();

$questions = new Questions();

$comments_and_answers = $questions->get_comments_and_answers_by_user( $viewed_user_id );
?>

<?php if ( !empty( $comments_and_answers ) ) : ?>
    <?php foreach ( $comments_and_answers as $item ) : ?>
        <div class="es-forum-content-entry">
            <div class="es-fce-left">
                <div class="es-fce-left-item">
                    <?php if ( $item->comment_type === 'question_answers' ) : ?>
                        <?php 
                        $upvotes = get_comment_meta( $item->comment_ID, 'es_answer_upvotes', true ) ?: array();
                        $downvotes = get_comment_meta( $item->comment_ID, 'es_answer_downvotes', true ) ?: array();
                        $reputation = count( $upvotes ) - count( $downvotes );
                        ?>
                        <span class="es-comments-counter es-eng-severity-<?php echo es_eng_severity( $reputation ); ?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 2L10.4 5.6L14.8 6.2L11.4 9.4L12.2 13.8L8 11.6L3.8 13.8L4.6 9.4L1.2 6.2L5.6 5.6L8 2Z" fill="white"/>
                            </svg>
                            <?php echo $reputation; ?>
                        </span>
                    <?php else : ?>
                        <span class="es-comments-counter es-comment-type">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.700577">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00008 2C4.32408 2 1.33341 4.692 1.33341 8C1.33341 9.15667 1.69408 10.2613 2.38208 11.224L0.666748 14H8.00008C11.6761 14 14.6667 11.308 14.6667 8C14.6667 4.692 11.6761 2 8.00008 2Z" fill="white"/>
                                </g>
                            </svg>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="es-fce-right es-profile-comments-right">
                <div class="es-fce-title">
                    <h3>
                        <a href="<?php 
                            $permalink = get_permalink( $item->comment_post_ID );
                            $anchor = ( $item->comment_type === 'question_answers' ) ? '#answer-' . $item->comment_ID : '#comment-' . $item->comment_ID;
                            echo $permalink . $anchor;
                        ?>">
                            <?php echo get_the_title( $item->comment_post_ID ); ?>
                        </a>
                    </h3>
                    <p>
                        <strong><?php echo ( $item->comment_type === 'question_answers' ) ? 'Answer:' : 'Comment:'; ?></strong>
                        <?php 
                        $content = wp_strip_all_tags( $item->comment_content );
                        echo wp_trim_words( $content, 20, '...' ); 
                        ?>
                    </p>
                </div>

                <div class="es-fce-meta-data">
                    <div class="es-right">
                        <div class="es-entry-author">
                            <?php echo ( $item->comment_type === 'question_answers' ) ? 'Answered' : 'Commented'; ?> /
                        </div>
                        <div class="es-entry-date">
                            <?php echo mysql2date( 'F j, Y', $item->comment_date ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="es-no-content">
        <?php 
        $current_user_id = get_current_user_id();
        if ( $current_user_id === $viewed_user_id ) {
            // User viewing their own profile
            $message = esc_html__( 'You haven\'t made any comments or answers yet.', 'engispace' );
        } else {
            // User viewing someone else's profile
            $viewed_user_name = $viewed_user ? $viewed_user->display_name : 'This user';
            $message = sprintf( esc_html__( '%s hasn\'t made any comments or answers yet.', 'engispace' ), $viewed_user_name );
        }
        ?>
        <p><?php echo $message; ?></p>
    </div>
<?php endif; ?>