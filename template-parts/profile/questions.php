<?php

use Engispace\Services\Questions;

// Get the profile being viewed
$username = get_query_var('profile_username');
$viewed_user = get_user_by('login', $username);
$viewed_user_id = $viewed_user instanceof \WP_User ? $viewed_user->ID : get_current_user_id();

$questions = new Questions();

$query = $questions->get_question_by_user( $viewed_user_id );
?>

<?php 
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post(); ?>
            <div class="es-forum-content-entry">
                <div class="es-fce-left">
                    <div class="es-fce-left-item">
                        <?php $commentsCount = $questions->get_question_answers_count(get_the_ID()); ?>
                        <span class="es-comments-counter es-eng-severity-<?php echo es_eng_severity($commentsCount); ?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.700577"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.00008 2C4.32408 2 1.33341 4.692 1.33341 8C1.33341 9.15667 1.69408 10.2613 2.38208 11.224L0.666748 14H8.00008C11.6761 14 14.6667 11.308 14.6667 8C14.6667 4.692 11.6761 2 8.00008 2Z" fill="white"/></g></svg>
                            <?php echo $commentsCount; ?>
                        </span>
                    </div>
                </div>
                <div class="es-fce-right">
                    <div class="es-fce-title">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php the_excerpt(); ?></p>
                    </div>

                    <div class="es-fce-meta-data">
                        <div class="es-left">
                            <?php echo $questions->print_categories( get_the_ID() ); ?>
                        </div>
                        <div class="es-right">
                            <div class="es-entry-author"><?php $questions->print_author(get_the_ID()); ?> /</div>
                            <div class="es-entry-date"><?php echo get_the_date( 'F j, Y' ); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php 
    } 
?>