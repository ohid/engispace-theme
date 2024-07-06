<?php

use Engispace\Components\Review_Course;

$course_id = intval($_GET['course_id']);
$course = get_post($course_id);

// Course author
$author_id = $course->post_author;
$author_name = get_the_author_meta('display_name', $author_id);

if ( $course ) : ?>

<div class="es-admin-course-review-wrapper">
    <div class="es-acr-container">
        <div class="es-course-header">
            <?php 
                printf( 
                    '<h3>%s <span>%s</span></h3>', 
                    esc_html__( 'Review course:', 'engispace' ),
                    $course->post_title
                );
            ?>
            <div class="es-acr-course-meta">
                <span class="es-acr-course-label">By Creator: </span> 
                <span class="es-acr-course-author"><?php echo $author_name; ?></span>
            </div>
        </div>
        <div class="es-course-reviews-list">
            <h3 class="course-reviews-title">Reviews:</h3>
            <?php
                $reviews = Review_Course::get_all_reviews( $course_id );
                if ( count( $reviews ) >= 1 ) { 
                    foreach( $reviews as $review ) { ?>
                    <div class="es-course-review">
                        <div class="es-author">
                            <?php printf('<span class="course-author">%s</span>', es_get_user_display_name( $review->author_id ) ); ?>
                            <?php printf('<span class="es-date">%s</span>', $review->date); ?>
                        </div>
                        <div class="es-review-body">
                            <?php printf('<p>%s</p>', $review->review); ?>
                        </div>
                    </div>
            <?php 
                } } else {
                    printf('<h4>%s</h4>', esc_html__( 'No reviews posted yet!', 'engispace' ));
                }
            ?>
            
        </div>
        <div class="es-course-review-form">
            <h3 class="es-course-form-title">Submit a review</h3>
            <form method="POST" id="admin-course-review-form">
                <div class="es-form-control">
                    <textarea name="course_review" id="course_review_field" placeholder="Have something in mind?"></textarea>
                </div>
                <input type="hidden" name="course_id" id="course_id" value="<?php echo esc_attr( $course_id ); ?>">
                <input type="hidden" name="action" value="es_admin_course_review">
                <div class="es-form-submit">
                    <button type="submit">
                        <span class="btn-text">Post review</span>
                        <span class="btn-icon"><?php echo es_get_svg_icon( '/assets/img/loader' ); ?></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php else:
    echo '<p>Invalid post ID.</p>';
endif;