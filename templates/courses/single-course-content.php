<div class="es-sc-content-area">
    <div class="es-sc-course-header">
        <div class="es-sc-thubmail">
            <?php the_post_thumbnail( 'engispace-course-thumbnail' ); ?>
        </div>
        <div class="es-sc-title">
            <h2><?php the_title(); ?></h2>
            <?php
                $course_category = wp_get_post_terms( get_the_ID(), 'ld_course_category' );
                if ( isset( $course_category[0] ) ) {
                    $course_category_page = get_term_link( $course_category[0], 'ld_course_category' );
                }

                if ( isset( $course_category[0] ) ) {
                    printf(
                        '<a href="%s" class="es-sc-course-category">%s</a>',
                        $course_category_page ? esc_url( $course_category_page ) : '',
                        esc_html( $course_category[0]->name )
                    );
                }

                $short_description = get_post_meta( get_the_ID(), 'es_course_short_description', true );
                if ( $short_description ) {
                    printf('<p>%s</p>', $short_description);
                }

            ?>
        </div>
    </div>
    <div class="es-sc-course-body">
        <?php the_content(); ?>

        <?php echo do_shortcode( '[course_content]' ); ?>
    </div>
</div>
