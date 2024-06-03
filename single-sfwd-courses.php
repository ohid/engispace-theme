<?php
get_header();
?>

<?php
    $course_link = get_the_permalink(get_the_ID());

    $es_top_nav_links = array(
        [
            'title' => __( 'Details', 'engispace' ),
            'icon' => es_get_svg_icon( '/assets/img/info-icon' ),
            'url' => $course_link,
            'tab' => 'content',
        ],
        [
            'title' => __( 'Comments', 'engispace' ),
            'icon' => es_get_svg_icon( '/assets/img/info-icon' ),
            'url' => $course_link . '?tab=comments',
            'tab' => 'comments',
        ],
        [
            'title' => __( 'Reviews', 'engispace' ),
            'icon' => es_get_svg_icon( '/assets/img/reviews-icon' ),
            'url' => $course_link . '?tab=reviews',
            'tab' => 'reviews',
        ]
    )
?>

<div class="engispace-single-course-wrapper">
    <div class="es-site-container">
        <div class="es-sc-top-nav">
            <?php
                foreach( $es_top_nav_links as $nav ) {
                    printf('<div class="es-top-nav-item%s">', es_get_course_current_tab_class( $nav['tab'] ));
                        printf(
                            '<a href="%s">%s</a>',
                            esc_url( $nav['url'] ),
                            $nav['icon'] . esc_html( $nav['title'] )
                        );
                    echo '</div>';
                }
            ?>
        </div>

        <div class="es-sc-content-box">
            <?php
                es_get_template_for_single_course();

                get_template_part( 'templates/courses/single-course-sidebar' );

                get_template_part( 'template-parts/modals/social-share-modal' );
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>
