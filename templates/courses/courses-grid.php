<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-courses-grid-area">
    <div class="es-site-container">
        <div class="es-course-grid-section-title">
            <?php
                $feature_title = get_field( 'courses__update_feature_title', 'option' );
                printf( '<p>%s</p>', $feature_title ? esc_html( $feature_title ) : esc_html__( 'Featured', 'engispace' ) );
            ?>
        </div>
        <div class="es-site-courses-grid">
            <div id="es-single-course-details-box" class="es-single-course-details-box"></div>
            <?php
                // Display the featured courses carousel
                Engispace\Components\Courses::featured_courses_carousel();
            ?>
        </div>
    </div>
</div>
<div class="es-courses-grid-area">
    <div class="es-site-container">
        <div class="es-course-grid-section-title">
            <?php
                $feature_title = get_field( 'courses__update_top_courses_title', 'option' );
                printf( '<p>%s</p>', $feature_title ? esc_html( $feature_title ) : esc_html__( 'Top courses in "Business"', 'engispace' ) );
            ?>
        </div>
        <div class="es-site-courses-grid">
            <?php
                // Display the top courses carousel
                Engispace\Components\Courses::top_courses_carousel();
            ?>
            <div id="es-single-course-details-box" class="es-single-course-details-box"></div>
        </div>
    </div>
</div>