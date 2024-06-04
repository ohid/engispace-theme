<?php

// Fetch all courses
$courses = get_posts([
    'post_type'      => 'sfwd-courses',
    'posts_per_page' => -1,  // Retrieve all available courses
    'post_status'    => 'publish',
]);
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
                echo '<div class="courses-page-course-slider owl-carousel owl-theme courses_slider">';
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
                                printf('<p class="es-course-description">%s</p>', esc_html( es_get_course_title_trimmed( $short_description, 15) ));
                            }

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

                            printf(
                                '<a href="%s" class="es-add-to-cart-icon">%s</a>',
                                $course_link,
                                '<span class="es-cart-icon">' . es_get_svg_icon( '/assets/img/cart-icon' ) . '</span>' . esc_html__('View course', 'engispace')
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
                echo '<div class="courses-page-course-slider owl-carousel owl-theme courses_slider">';
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

                            printf(
                                '<a href="%s" class="es-add-to-cart-icon">%s</a>',
                                '#',
                                '<span class="es-cart-icon">' . es_get_svg_icon( '/assets/img/cart-icon' ) . '</span>' . ' Add to cart'
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