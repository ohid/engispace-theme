<?php 

// Exit if accessed directly
if ( !ABSPATH ) exit;

use Engispace\Services\Questions;

$questions = new Questions();

?>

<div class="es-aq-top">
    <div class="es-site-container">
        <div class="es-aq-top-inside">
            <a href="/forum" class="es-aq-top-btn">
                <?php echo es_img_with_srcset( THEME_URI . '/assets/img/cancel-icon.png'); ?>
                Cancel
            </a>
            <a href="/forum" class="es-aq-top-btn">
                <?php echo es_img_with_srcset( THEME_URI . '/assets/img/cog-icon.png'); ?>
                Manage your posts
            </a>
        </div>
    </div>
</div>

<div class="es-aq-form-wrapper">
    <div class="es-site-container">
        <div class="es-aq-form-container">
            <form id="es_ask_question">
                <div class="es-aq-form">
                    <div class="es-aq-form-left">
                        <div class="es-form-group es-aq-form-title">
                            <input type="text" name="question_title" placeholder="Write your question here">
                        </div>
                        <div class="es-form-group es-aq-form-content">
                            <textarea name="question_content" class="quill-editor"></textarea>
                        </div>
                        <div class="es-form-message"></div>
                    </div>
                    <div class="es-aq-form-right">
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
                        <div class="es-aq-categories">
                            <select name="question_category" id="question_category" class="engispace-select">
                                <option value="">Select a category</option>
                                <?php 
                                    $categories = $questions->get_questions_categories();
                                    if ( $categories ) {
                                        foreach ( $categories as $category ) {
                                            printf('<option value="%s">%s</option>', esc_attr($category->term_id), esc_html($category->name));
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="es-aq-form-submit es-btn-orange">
                            <button type="submit">Ask question</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>