<?php 

// Exit if accessed directly
if ( !ABSPATH ) exit;

use Engispace\Services\Questions;

$questions = new Questions();
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
                <li>
                    <span class="es-comment-comment">JHispa: please edit your answer, instead of adding code as a comment</span> -
                    <span class="es-comment-author">
                        <a href="#">Andre</a>
                    </span>
                    <span class="comment-date">
                        Jul 24 '12 at 15:06 
                    </span>
                </li>
                <li>
                    <span class="es-comment-comment">JHispa: please edit your answer, instead of adding code as a comment</span> -
                    <span class="es-comment-author">
                        <a href="#">Andre</a>
                    </span>
                    <span class="comment-date">
                        Jul 24 '12 at 15:06 
                    </span>
                </li>
                <li>
                    <span class="es-comment-comment">JHispa: please edit your answer, instead of adding code as a comment</span> -
                    <span class="es-comment-author">
                        <a href="#">Andre</a>
                    </span>
                    <span class="comment-date">
                        Jul 24 '12 at 15:06 
                    </span>
                </li>
                <li class="more-comments">
                    <a href="#">View more comments</a>
                </li>
            </ul>
            <div class="post-comment">
                <span class="es-author-img"><img src="<?php echo es_user_profile_avatar(); ?>" alt=""></span>
                <form action="">
                    <textarea name="comment" id="comment" placeholder="Write a comment"></textarea>
                    <button type="submit">Post Comment</button>
                </form>
            </div>
        </div>
    </div>
    <div class="es-content-sidebar">
        <div class="es-forum-post-author">
            <div class="es-fpa-name">
                <span><img src="<?php echo es_user_profile_avatar(); ?>" alt=""></span>
                <a href="#"><?php echo es_get_current_user_display_name(); ?></a>
            </div>
            <div class="es-fpa-author-info">
                <p><?php echo es_get_current_user_profile_bio(); ?></p>
            </div>
            
            <?php echo $questions->print_categories( get_the_ID() ); ?>
            
            <div class="es-fpa-posted-date">
                <span>Posted: <?php echo get_the_date( 'F j, Y' ); ?></span>
            </div>
        </div>
    </div>
</div>