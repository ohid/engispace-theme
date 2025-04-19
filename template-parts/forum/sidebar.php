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
                            <?php
                            $categories = $questions->get_questions_parent_categories();
                            $current_term_id = get_queried_object_id();
                            
                            if ($categories) :
                                foreach ($categories as $category) :
                                    $is_active = $current_term_id === $category->term_id ? 'active' : '';
                                    $term_link = get_term_link($category);
                                    $category_url = is_wp_error($term_link) ? '#' : $term_link; 
                                    $child_categories = get_terms([
                                        'taxonomy' => 'categories',
                                        'parent' => $category->term_id,
                                        'hide_empty' => false
                                    ]); ?>
                                    
                                    <li class="<?php echo esc_attr($is_active); ?>">
                                        <a href="<?php echo esc_url($category_url); ?>"><?php echo esc_html($category->name); ?></a>
                                        <?php if (!empty($child_categories)) : ?>
                                            <ul class="sub-categories">
                                                <?php foreach ($child_categories as $child) :
                                                    $child_is_active = $current_term_id === $child->term_id ? 'active' : '';
                                                    $child_link = get_term_link($child);
                                                    $child_url = is_wp_error($child_link) ? '#' : $child_link; ?>
                                                    <li class="<?php echo esc_attr($child_is_active); ?>">
                                                        <a href="<?php echo esc_url($child_url); ?>"><?php echo esc_html($child->name); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach;
                            else : ?>
                                <li><?php esc_html_e('No categories found', 'engispace-theme'); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

