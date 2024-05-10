<?php

// Fetch all courses
$courses = get_posts([
    'post_type'      => 'sfwd-courses',
    'posts_per_page' => -1,  // Retrieve all available courses
    'post_status'    => 'publish',
]);

$cart_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M15 1.66602C14.6117 1.66602 14.275 1.93352 14.1875 2.31185L13.3758 5.83268H2.50002C2.24335 5.83268 2.00085 5.95185 1.84335 6.15352C1.68502 6.35602 1.62918 6.61935 1.69168 6.86852L3.35835 13.5352C3.45085 13.906 3.78418 14.166 4.16668 14.166H12.5C12.8884 14.166 13.225 13.8985 13.3125 13.521L15.6625 3.33268H18.3334V1.66602H15Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M5.00004 15C4.08004 15 3.33337 15.7467 3.33337 16.6667C3.33337 17.5883 4.08004 18.3333 5.00004 18.3333C5.92004 18.3333 6.66671 17.5883 6.66671 16.6667C6.66671 15.7467 5.92004 15 5.00004 15Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.6667 15C10.7467 15 10 15.7467 10 16.6667C10 17.5883 10.7467 18.3333 11.6667 18.3333C12.5867 18.3333 13.3333 17.5883 13.3333 16.6667C13.3333 15.7467 12.5867 15 11.6667 15Z" fill="white"/></svg>';

$lectures_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M14.1667 16.6667V13.3333L16.6667 15L14.1667 16.6667ZM15 10C12.2425 10 10 12.2425 10 15C10 17.7575 12.2425 20 15 20C17.7575 20 20 17.7575 20 15C20 12.2425 17.7575 10 15 10Z" fill="#A9B7C7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M5 16.6667H8.55167C8.41417 16.1333 8.33333 15.5767 8.33333 15C8.33333 11.3183 11.3175 8.33333 15 8.33333V0.833333C15 0.373333 14.6267 0 14.1667 0H5V16.6667Z" fill="#A9B7C7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M3.33333 0H0.833333C0.373333 0 0 0.373333 0 0.833333V15.8333C0 16.2933 0.373333 16.6667 0.833333 16.6667H3.33333V0Z" fill="#A9B7C7"/></svg>';

$duration_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.293 13.707L9.293 10.707C9.105 10.52 9 10.266 9 10V5H11V9.586L13.707 12.293L12.293 13.707ZM10 1C5.038 1 1 5.038 1 10C1 14.962 5.038 19 10 19C14.962 19 19 14.962 19 10C19 5.038 14.962 1 10 1Z" fill="#A9B7C7"/></svg>';

$level_icon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M18.7059 5.92081L10.3725 1.75414C10.1384 1.63664 9.86171 1.63664 9.62671 1.75414L1.29337 5.92081C1.12504 6.00497 0.997541 6.14914 0.922541 6.30664C0.871707 6.40747 0.833374 6.57997 0.833374 6.66664V11.47C0.833374 11.93 1.20587 12.3033 1.66671 12.3033C2.12671 12.3033 2.50004 11.93 2.50004 11.47V7.63914L10.0117 10.7683L18.6425 7.43997C18.9467 7.31831 19.1525 7.02914 19.1659 6.70081C19.1792 6.37247 18.9992 6.06747 18.7059 5.92081Z" fill="#A9B7C7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M10.0001 12.3608C9.89091 12.3608 9.78175 12.3392 9.67925 12.2967L4.16675 10V12.5117C4.16675 12.8267 4.34508 13.115 4.62758 13.2567C6.05675 13.9717 7.52925 14.8558 10.0001 14.8558C12.4692 14.8558 13.9459 13.97 15.3726 13.2567C15.6551 13.115 15.8334 12.8267 15.8334 12.5117V10.1767L10.2992 12.3058C10.2026 12.3425 10.1017 12.3608 10.0001 12.3608Z" fill="#A9B7C7"/><path fill-rule="evenodd" clip-rule="evenodd" d="M1.66671 13.332C1.20671 13.332 0.833374 13.7054 0.833374 14.1654V15.832C0.833374 16.292 1.20671 16.6654 1.66671 16.6654C2.12671 16.6654 2.50004 16.292 2.50004 15.832V14.1654C2.50004 13.7054 2.12671 13.332 1.66671 13.332Z" fill="#A9B7C7"/></svg>';
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
                $courses = (array) get_field( 'courses__featured_courses', 'option' );
                if ( empty( $courses ) ) {
                    return;
                }
                echo '<div class="courses-page-course-slider owl-carousel owl-theme" id="courses_slider">';
                foreach( $courses as $post ) {
                    // Setup post data
                    setup_postdata($post);
                    $post_id = get_the_ID();
                    $es_currency = '$';
                    // Course category
                    $course_category = wp_get_post_terms( $post_id, 'ld_course_category' );
                    if ( isset( $course_category[0] ) ) {
                        $course_category_page = get_term_link( $course_category[0], 'ld_course_category' );
                    }
                    $short_description = get_post_meta( $post_id, 'es_course_short_description', true );
                    $difficulty_level = get_post_meta( $post_id, 'es_course_difficulty_level', true );
                    $course_duration = get_post_meta( $post_id, 'es_course_duration', true );
                    $original_price = get_post_meta( $post_id, 'es_course_original_price', true );

                    $price_args = learndash_get_course_price( $post_id );
                    $lessons_data = learndash_course_get_steps_by_type( $post_id, 'sfwd-lessons' );

                    $course_link = get_the_permalink( $post );
                    echo '<div class="es-course-item">';
                        echo '<a href="'. esc_url( $course_link ) .'">';
                            the_post_thumbnail();
                        echo '</a>';

                        echo '<div class="es-course-details-wrap">';
                            printf(
                                '<a href="%s"><h4>%s</h4></a>',
                                esc_url( $course_link ),
                                esc_html( es_get_course_title_trimmed( get_the_title(), 6) )
                            );
                            
                            if ( isset( $course_category[0] ) ) {
                                printf(
                                    '<a href="%s"><p>%s</p></a>',
                                    $course_category_page ? esc_url( $course_category_page ) : '',
                                    esc_html( $course_category[0]->name )
                                );
                            }
                            echo '<div class="es-course-price">';
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
                                echo '<div class="es-course-rating">';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="es-course-details">';
                            printf(
                                '<a href="%s"><h4>%s</h4></a>',
                                esc_url( $course_link ),
                                esc_html( get_the_title() )
                            );
                            if ( isset( $course_category[0] ) ) {
                                printf(
                                    '<a href="%s"><p>%s</p></a>',
                                    $course_category_page ? esc_url( $course_category_page ) : '',
                                    esc_html( $course_category[0]->name )
                                );
                            }
                            if ( $short_description ) {
                                printf('<p class="es-course-description">%s</p>', esc_html( $short_description ));
                            }

                            echo '<div class="es-course-meta-data">';
                                printf(
                                    '<div class="es-course-meta-item">%s</div>',
                                    $lectures_icon . count( $lessons_data ) . ' lectures'
                                );
                                printf(
                                    '<div class="es-course-meta-item">%s</div>',
                                    $duration_icon . esc_html( $course_duration )
                                );
                                printf(
                                    '<div class="es-course-meta-item">%s</div>',
                                    $level_icon . esc_html( $difficulty_level )
                                );
                            echo '</div>';

                            printf(
                                '<a href="%s" class="es-add-to-cart-icon">%s</a>',
                                '#',
                                '<span class="es-cart-icon">' . $cart_icon . '</span>' . ' Add to cart'
                            );
                        echo '</div>';

                    echo '</div>';
                    wp_reset_postdata();
                }

                echo '</div>';
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
            <div id="es-single-course-details-box" class="es-single-course-details-box"></div>
            <?php
                $courses = (array) get_field( 'courses__top_courses', 'option' );
                if ( empty( $courses ) ) {
                    return;
                }
                echo '<div class="courses-page-course-slider owl-carousel owl-theme" id="courses_slider_2">';
                foreach( $courses as $post ) {
                    // Setup post data
                    setup_postdata($post);
                    $post_id = get_the_ID();
                    $es_currency = '$';
                    // Course category
                    $course_category = wp_get_post_terms( $post_id, 'ld_course_category' );
                    if ( isset( $course_category[0] ) ) {
                        $course_category_page = get_term_link( $course_category[0], 'ld_course_category' );
                    }
                    $short_description = get_post_meta( $post_id, 'es_course_short_description', true );
                    $difficulty_level = get_post_meta( $post_id, 'es_course_difficulty_level', true );
                    $course_duration = get_post_meta( $post_id, 'es_course_duration', true );
                    $original_price = get_post_meta( $post_id, 'es_course_original_price', true );

                    $price_args = learndash_get_course_price( $post->ID );
                    $lessons_data = learndash_course_get_steps_by_type( $post->ID, 'sfwd-lessons' );

                    $course_link = get_the_permalink( $post );
                    echo '<div class="es-course-item">';
                        echo '<a href="'. esc_url( $course_link ) .'">';
                            the_post_thumbnail();
                        echo '</a>';

                        echo '<div class="es-course-details-wrap">';
                            printf(
                                '<a href="%s"><h4>%s</h4></a>',
                                esc_url( $course_link ),
                                esc_html( es_get_course_title_trimmed( get_the_title(), 6) )
                            );
                            
                            if ( isset( $course_category[0] ) ) {
                                printf(
                                    '<a href="%s"><p>%s</p></a>',
                                    $course_category_page ? esc_url( $course_category_page ) : '',
                                    esc_html( $course_category[0]->name )
                                );
                            }
                            echo '<div class="es-course-price">';
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
                                echo '<div class="es-course-rating">';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        
                        echo '<div class="es-course-details">';
                            printf(
                                '<a href="%s"><h4>%s</h4></a>',
                                esc_url( $course_link ),
                                esc_html( get_the_title() )
                            );
                            if ( isset( $course_category[0] ) ) {
                                printf(
                                    '<a href="%s"><p>%s</p></a>',
                                    $course_category_page ? esc_url( $course_category_page ) : '',
                                    esc_html( $course_category[0]->name )
                                );
                            }
                            if ( $short_description ) {
                                printf('<p class="es-course-description">%s</p>', esc_html( $short_description ));
                            }

                            echo '<div class="es-course-meta-data">';
                                printf(
                                    '<div class="es-course-meta-item">%s</div>',
                                    $lectures_icon . count( $lessons_data ) . ' lectures'
                                );
                                printf(
                                    '<div class="es-course-meta-item">%s</div>',
                                    $duration_icon . esc_html( $course_duration )
                                );
                                printf(
                                    '<div class="es-course-meta-item">%s</div>',
                                    $level_icon . esc_html( $difficulty_level )
                                );
                            echo '</div>';

                            printf(
                                '<a href="%s" class="es-add-to-cart-icon">%s</a>',
                                '#',
                                '<span class="es-cart-icon">' . $cart_icon . '</span>' . ' Add to cart'
                            );
                        echo '</div>';

                    echo '</div>';

                    wp_reset_postdata();
                }
                echo '</div>';
            ?>
        </div>
    </div>
</div>