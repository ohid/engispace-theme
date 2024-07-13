<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php

$course_id = isset( $_GET['course_id'] ) ? sanitize_text_field( $_GET['course_id'] ) : 0;
$course = get_post( $course_id );

if ( !$course ) {
    return;
}

// Get the related course meta
$short_description = get_post_meta( $course_id, 'es_course_short_description', true );
$difficulty_level = get_post_meta( $course_id, 'es_course_difficulty_level', true );
$course_duration = get_post_meta( $course_id, 'es_course_duration', true );
$original_price = get_post_meta( $course_id, 'es_course_original_price', true );

?>

<div class="es-creator-update-course-metadata">
    <?php printf( '<h3>%s</h3>', $course->post_title ); ?>

    <form method="post" id="creator-update-course-metadata">
        <h4 class="update-metadata-label">Update metadata</h4>

        <div class="es-form-group">
            <label for="es_course_short_description">Short description</label>
            <textarea name="es_course_short_description" id="es_course_short_description"><?php echo esc_html( $short_description ); ?></textarea>
        </div>
        <div class="es-form-group">
            <label for="es_course_difficulty_level">Difficulty Level</label>
            <input type="text" name="es_course_difficulty_level" id="es_course_difficulty_level" value="<?php echo esc_attr( $difficulty_level ); ?>">
        </div>
        <div class="es-form-group">
            <label for="es_course_duration">Course Duration</label>
            <input type="text" name="es_course_duration" id="es_course_duration" value="<?php echo esc_attr( $course_duration ); ?>">
        </div>
        <div class="es-form-group">
            <label for="es_course_original_price">Original Price</label>
            <input type="text" name="es_course_original_price" id="es_course_original_price" value="<?php echo esc_attr( $original_price ); ?>">
        </div>
        <div class="es-form-message es-form-group"></div>
        <div class="es-form-group es-submit-btn">
            <?php wp_nonce_field( 'es_nonce', 'es_update_course_metadata' ) ?>
            <input type="hidden" name="action" value="creator_save_course_metadata">
            <input type="hidden" name="course_id" value="<?php echo esc_attr( $course_id ); ?>">
            <button class="es-btn-orange">
                <span class="btn-text">Save Metadata</span>
                <span class="btn-icon"><?php echo es_get_svg_icon( '/assets/img/loader' ); ?></span>
            </button>
        </div>
    </form>
</div>