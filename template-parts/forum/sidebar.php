<?php

// Exit if accessed directly
if ( !ABSPATH ) exit;

use Engispace\Services\Questions;

$questions = new Questions();

?>

<div class="es-forum-content-area">
    <div class="es-site-container">
        <div class="es-forum-content-inner">

            <div class="es-forum-sidebar">
                <div class="es-sidebar-widget es-widget-question">
                    <div class="widget-header">
                        <h4>Your questions</h4>
                        <a href="/ask-questions" class="btn es-btn-orange">Ask question</a>
                    </div>
                    <div class="es-widget-content">
                        <ul>
                            <?php
                                $questions = new Engispace\Services\Questions();
                                $user_questions = $questions->get_user_questions();
                                
                                if ($user_questions->have_posts()) :
                                    while ($user_questions->have_posts()) : $user_questions->the_post();
                                        $comment_count = $questions->get_question_answers_count(get_the_ID());
                                        ?>
                                        <li>
                                            <span class="es-post-answers"><?php echo $comment_count; ?></span>
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
                <div class="es-sidebar-widget es-widget-categories">
                    <div class="widget-header">
                        <h4>Categories</h4>
                    </div>
                    <div class="es-widget-content">
                        <ul>
                            <li><a href="#">Electrical Engineering Practical Theory</a></li>
                            <li><a href="#">Power Engineering</a></li>
                            <li><a href="#">Industrial Controls and Automation</a></li>
                            <li><a href="#">Instrumentation</a></li>
                            <li><a href="#">Industrial Networks</a></li>
                        </ul>
                    </div>
                </div>
            </div>

