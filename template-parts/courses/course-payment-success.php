<?php
get_header();

$course_id = isset( $_GET['course_id'] ) ? sanitize_text_field( $_GET['course_id'] ) : false;
$course_id = es_custom_decrypt_value( $course_id );
$course_post = get_post( $course_id );
if ( !$course_post ) {
    return;
}
?>
    <div class="es-course-notification-page es-course-success">
        <div class="es-site-container">
            <?php
                es_img_with_srcset(
                    THEME_URI . '/assets/img/success-icon.png'
                );
            ?>
            <h5><?php esc_html_e( 'Thank you for purchasing the course', 'engispace' ); ?></h5>
            <?php 
                printf(
                    '<h3>"%s"</h3>',
                    $course_post->post_title
                )
            ?>
            <a href="<?php echo get_the_permalink( $course_post->ID ); ?>" class="es-btn-orange">
                <?php esc_html_e( 'View Course', 'engispace' ); ?>
            </a>
        </div>
    </div>
<?php
get_footer();
