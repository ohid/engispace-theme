<div class="es-sc-course-sidebar">
    <?php
        $es_currency = '$';
        $price_args = learndash_get_course_price( get_the_ID() );
        $original_price = get_post_meta( get_the_ID(), 'es_course_original_price', true );
        
        if ( ! es_user_has_access_to_course( get_the_ID() ) ) {
            echo '<div class="es-sc-course-price">';
                echo '<div class="es-course-price-wrap">';
                    if ( isset( $price_args['type'] ) && $price_args['type'] === 'free' ) {
                        printf('<ins>%s</ins>', 'Free');
                    }
                    if ( isset( $price_args['type'] ) && $price_args['type'] === 'paynow' ) {
                        printf('<ins>%s</ins>', $es_currency . esc_html( $price_args['price'] ));
                    }
                    if ( isset( $price_args['type'] ) && $price_args['type'] === 'paynow' && !empty( $original_price ) ) {
                        printf('<del>%s</del>', $es_currency . esc_html( $original_price ));
                    }
                echo '</div>';
            echo '</div>';
        }
    ?>

    <?php 
        if ( ! es_user_has_access_to_course( get_the_ID() ) ) {
            es_generate_buy_now_button(); 
        }
    ?>

    <?php
        echo '<div class="es-sc-post-dates">';
            printf('<p>%s</p>', esc_html__( 'Published: ', 'engispace' ) . get_the_date());
            printf('<p>%s</p>', esc_html__( 'Updated: ', 'engispace' ) . get_the_modified_date());
        echo '</div>';
    ?>

    <?php
        $lessons_data = learndash_course_get_steps_by_type( get_the_ID(), 'sfwd-lessons' );
        $difficulty_level = get_post_meta( get_the_ID(), 'es_course_difficulty_level', true );
        $course_duration = get_post_meta( get_the_ID(), 'es_course_duration', true );

        echo '<div class="es-course-meta-data">';
        printf(
            '<div class="es-course-meta-item">%s</div>',
            es_get_svg_icon( '/assets/img/lectures-icon' ) . count( $lessons_data ) . ' lectures'
        );
        printf(
            '<div class="es-course-meta-item">%s</div>',
            es_get_svg_icon( '/assets/img/duration-icon' ) . esc_html( $course_duration )
        );
        printf(
            '<div class="es-course-meta-item">%s</div>',
            es_get_svg_icon( '/assets/img/level-icon' ) . esc_html( $difficulty_level )
        );
        echo '</div>';
    ?>

    <a href="" class="es-sc-share-btn">
        <?php
            echo es_get_svg_icon( '/assets/img/share-icon' ) . esc_html__( 'Share', 'engispace' );
        ?>
    </a>
</div>