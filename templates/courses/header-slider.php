<div class="es-site-container">
    <div class="courses-header-slider owl-carousel owl-theme" id="courses-header-slider">

    <?php
        $sliders = get_field('courses_header_slider', 'option');

        if ( empty( $sliders ) ) {
            return;
        }

        foreach ( $sliders as $slide ) {
            printf( '<div class="es-slide" style="background-image: url(%s)">', $slide['slider_image'] );
            printf( '<h4>%s</h4>', esc_html( $slide['title'] ) );
            printf( '<p>%s</p>', esc_html( $slide['description'] ) );
            printf( '<a href="%s">%s</a>', esc_url( $slide['button_url'] ), esc_html( $slide['button_label'] ) );
            echo '</div>';
        }
    ?>
    </div>
</div>