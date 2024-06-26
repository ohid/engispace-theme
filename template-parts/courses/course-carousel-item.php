<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-course-item">
    <a href="<?php echo esc_url( $course_link ); ?>">
        <?php echo get_the_post_thumbnail( $post, 'es-course-carousel-item-thumbnail' ); ?>
    </a>

    <div class="es-course-details-wrap">
        <a href="<?php echo esc_url( $course_link ); ?>">
            <h4><?php echo esc_html( es_get_course_title_trimmed( get_the_title($post), 6 ) ); ?></h4>
        </a>

        <?php if ( isset( $course_category[0] ) ): ?>
            <a href="<?php echo $course_category_page ? esc_url( $course_category_page ) : ''; ?>" class="es-course-category">
                <p><?php echo esc_html( $course_category[0]->name ); ?></p>
            </a>
        <?php endif; ?>

        <div class="es-course-price">
            <div class="es-course-price-wrap">
                <?php if ( isset( $price_args['type'] ) && $price_args['type'] === 'free' ): ?>
                    <ins>Free</ins>
                <?php endif; ?>
                <?php if ( isset( $price_args['type'] ) && $price_args['type'] === 'paynow' ): ?>
                    <ins><?php echo $es_currency . esc_html( $price_args['price'] ); ?></ins>
                <?php endif; ?>
                <?php if ( isset( $price_args['type'] ) && $price_args['type'] === 'paynow' && !empty( $original_price ) ): ?>
                    <del><?php echo $es_currency . esc_html( $original_price ); ?></del>
                <?php endif; ?>
            </div>
            <div class="es-course-rating">
                <!-- Rating content here -->
            </div>
        </div>
    </div>

    <div class="es-course-details">
        <a href="<?php echo esc_url( $course_link ); ?>">
            <h4><?php echo esc_html( get_the_title() ); ?></h4>
        </a>
        <?php if ( isset( $course_category[0] ) ): ?>
            <a href="<?php echo $course_category_page ? esc_url( $course_category_page ) : ''; ?>" class="es-course-category">
                <p><?php echo esc_html( $course_category[0]->name ); ?></p>
            </a>
        <?php endif; ?>
        <?php if ( $short_description ): ?>
            <p class="es-course-description"><?php echo esc_html( es_get_course_title_trimmed( $short_description, 15 ) ); ?></p>
        <?php endif; ?>

        <div class="es-course-meta-data">
            <div class="es-course-meta-item">
                <?php echo es_get_svg_icon( '/assets/img/lectures-icon' ) . count( $lessons_data ) . esc_html__( ' lectures', 'engispace' ); ?>
            </div>
            <div class="es-course-meta-item">
                <?php echo es_get_svg_icon( '/assets/img/duration-icon' ) . esc_html( $course_duration ); ?>
            </div>
            <div class="es-course-meta-item">
                <?php echo es_get_svg_icon( '/assets/img/level-icon' ) . esc_html( $difficulty_level ); ?>
            </div>
        </div>

        <a href="<?php echo esc_url( $course_link ); ?>" class="es-add-to-cart-icon">
            <span class="es-cart-icon">
                <?php echo es_get_svg_icon( '/assets/img/cart-icon' ); ?>
            </span>
            <?php echo esc_html__('View course', 'engispace'); ?>
        </a>
    </div>
</div>
