<?php 

use Engispace\Services\Questions;

$questions = new Questions();
$query = $questions->get_questions( 'recent' );
?>

<?php if ( $query->have_posts() ) : ?>
    <?php while ( $query->have_posts() ) {
        $query->the_post(); ?>
        <div class="es-forum-content-entry">
            <div class="es-fce-left">
                <div class="es-fce-left-item">
                    <span class="es-comments-counter">
                        <img src="<?php echo THEME_URI . '/assets/img/comments.svg' ?>" alt="">
                        <?php 
                            $comments = $questions->get_question_answers_count(get_the_ID());
                            echo $comments; 
                        ?>
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
                        <!-- <div class="es-fce-entry-categories">
                            <span><a href="">Motion Control</a></span>
                        </div> -->
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
<?php endif; ?>