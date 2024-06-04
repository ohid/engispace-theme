<?php
// Limit direct access to template plate
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-ca-course-item">
    <div class="es-ca-course-item-background-thubmnail" style="background-image: url(<?php echo esc_url( $thumbnail_url ); ?>)"></div>

    <div class="es-ca-course-item-thubmnail">
        <a href="<?php echo esc_url( $course_link ); ?>">
            <?php the_post_thumbnail(); ?>
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
