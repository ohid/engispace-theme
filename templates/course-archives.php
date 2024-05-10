<div class="es-all-courses-archive">
    <div class="es-site-container">
        <div class="es-aca-inner">
            <div class="es-course-categories">
                <h3><?php esc_html_e( 'Categories', 'engispace' ) ?></h3>
                <?php
                    $course_categories = get_terms( 'ld_course_category' );
                    ray($course_categories);
                ?>
                <ul>
                    <li><a href="#">Power Engineering</a></li>
                    <li><a href="#">Power Engineering</a></li>
                    <li><a href="#">Power Engineering</a></li>
                    <li><a href="#">Power Engineering</a></li>
                </ul>
            </div>
            <div class="es-course-archives">
                <div class="es-ca-title">
                    <h3>All Courses</h3>
                </div>
                <div class="es-ca-course-list">
                    <?php
                        $courses = new \WP_Query(array(
                            'post_type' => 'sfwd-courses',
                            'limit' => 20,
                            'post_status' => 'publish',
                            'order' => 'DESC', 
                        ));

                        if ( $courses->have_posts() ) {
                            while( $courses->have_posts() ) {
                                $courses->the_post();
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
                                $course_link = get_the_permalink( $post_id );
                                $thumbnail_url = wp_get_attachment_image_url( get_post_thumbnail_id($post_id), 'full' );
                                
                                echo '<div class="es-ca-course-item">';
                                    printf(
                                        '<div class="es-ca-course-item-background-thubmnail" style="background-image: url(%s)"></div>',
                                        esc_url( $thumbnail_url )
                                    );

                                    echo '<div class="es-ca-course-item-thubmnail">';
                                        echo '<a href="'. esc_url( $course_link ) .'">';
                                            the_post_thumbnail();
                                        echo '</a>';
                                    echo '</div>';
                                    
                                    echo '<div class="es-ca-course-details-wrap">';
                                        echo '<div class="es-ca-course-details-top-area">';
                                            echo '<div class="es-ca-course-details-title">';
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
                                            echo '</div>';
                                        echo '</div>';
                                        if ( $short_description ) {
                                            printf('<p class="es-course-description">%s</p>', esc_html( $short_description ));
                                        }
                                        echo '<div class="es-ca-course-details-meta-area">';
                                            echo '<div class="es-ca-course-details-meta-data">';
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
                                            echo '<div class="es-ca-course-details-price-and-reviews">';
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
                                                echo '</div>';
                                                echo '<div class="es-course-rating">';

                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                                wp_reset_postdata();
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>