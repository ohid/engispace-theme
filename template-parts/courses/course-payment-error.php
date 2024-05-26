<?php
get_header();

$course_id = isset( $_GET['course_id'] ) ? (int) $_GET['course_id'] : false;
$course_post = get_post( $course_id );
if ( !$course_post ) {
    return;
}

?>
    <div class="es-course-notification-page es-course-success">
        <div class="es-site-container">
            <?php
                es_img_with_srcset(
                    THEME_URI . '/assets/img/error-icon.png'
                );
            ?>
            <?php 
                printf(
                    '<h3 style="margin-top: 40px">%s</h3>',
                    'Something went wrong while purchasing the course'
                )
            ?>

            <a href="<?php echo get_the_permalink( $course_post->ID ); ?>" class="es-btn-orange">
                <?php esc_html_e( 'View Course', 'engispace' ); ?>
            </a>
        </div>
    </div>
<?php
get_footer();
