<?php
// Limit direct access to template plate
if ( ! defined( 'ABSPATH' ) ) exit;

$es_currency = '$';

$post_id = get_the_ID();
$course_link = get_the_permalink( $post_id );
$thumbnail_url = wp_get_attachment_image_url( get_post_thumbnail_id($post_id), 'full' );
// Course category
$course_category = wp_get_post_terms( $post_id, 'ld_course_category' );
if ( isset( $course_category[0] ) ) {
    $course_category_page = get_term_link( $course_category[0], 'ld_course_category' );
}
// Get the related post meta
$short_description = get_post_meta( $post_id, 'es_course_short_description', true );
$difficulty_level = get_post_meta( $post_id, 'es_course_difficulty_level', true );
$course_duration = get_post_meta( $post_id, 'es_course_duration', true );
$original_price = get_post_meta( $post_id, 'es_course_original_price', true );
// Get learndash course data
$price_args = learndash_get_course_price( $post_id );
$lessons_data = learndash_course_get_steps_by_type( $post_id, 'sfwd-lessons' );
// Get the number of lessons
$lessons_count = count( $lessons_data );
?>

<div class="es-ca-course-item">
    <div class="es-ca-course-item-background-thubmnail" style="background-image: url(<?php echo esc_url( $thumbnail_url ); ?>)"></div>

    <div class="es-ca-course-item-thubmnail">
        <a href="<?php echo esc_url( $course_link ); ?>">
            <?php the_post_thumbnail( 'engispace-all-courses-thumbnail' ); ?>
        </a>
    </div>
    
    <div class="es-ca-course-details-wrap">
        <div class="es-ca-course-details-top-area">
            <div class="es-ca-course-details-title">
                <a href="<?php echo esc_url( $course_link ); ?>"><h4><?php echo esc_html( get_the_title() ); ?></h4></a>
                <?php if ( isset( $course_category[0] ) ): ?>
                    <a href="<?php echo $course_category_page ? esc_url( $course_category_page ) : ''; ?>"><p><?php echo esc_html( $course_category[0]->name ); ?></p></a>
                <?php endif; ?>
            </div>
        </div>
        <?php if ( $short_description ): ?>
            <p class="es-course-description"><?php echo esc_html( $short_description ); ?></p>
        <?php endif; ?>
        <div class="es-ca-course-details-meta-area">
            <div class="es-ca-course-details-meta-data">
                <div class="es-course-meta-item"><?php echo es_get_svg_icon( '/assets/img/lectures-icon' ) . count( $lessons_data ) . esc_html__( ' lectures', 'engispace' ); ?></div>
                <div class="es-course-meta-item"><?php echo es_get_svg_icon( '/assets/img/duration-icon' ) . esc_html( $course_duration ); ?></div>
                <div class="es-course-meta-item"><?php echo es_get_svg_icon( '/assets/img/level-icon' ) . esc_html( $difficulty_level ); ?></div>
            </div>
            <div class="es-ca-course-details-price-and-reviews">
                <div class="es-course-price">
                    <div class="es-course-price-wrap">
                        <?php if ( isset( $price_args['type'] ) && $price_args['type'] === 'free' ): ?>
                            <ins><?php esc_html_e( 'Free', 'engispace' ); ?></ins>
                        <?php endif; ?>
                        <?php if ( isset( $price_args['type'] ) && $price_args['type'] === 'paynow' ): ?>
                            <ins><?php echo $es_currency . esc_html( $price_args['price'] ); ?></ins>
                        <?php endif; ?>
                        <?php if ( isset( $price_args['type'] ) && $price_args['type'] === 'paynow' && !empty( $original_price ) ): ?>
                            <del><?php echo $es_currency . esc_html( $original_price ); ?></del>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="es-course-rating">
                    <!-- Rating content here -->
                </div>
            </div>
        </div>
    </div>
</div>
