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
        ],
        [
            'title' => __( 'Comments', 'engispace' ),
            'icon' => es_get_svg_icon( '/assets/img/info-icon' ),
            'url' => $course_link . '?tab=comments',
        ],
        [
            'title' => __( 'Reviews', 'engispace' ),
            'icon' => es_get_svg_icon( '/assets/img/reviews-icon' ),
            'url' => $course_link . '?tab=reviews',
        ]
    )
?>

<div class="engispace-single-course-wrapper">
    <div class="es-site-container">
        <div class="es-sc-top-nav">
            <?php
                foreach( $es_top_nav_links as $nav ) {
                    echo '<div class="es-top-nav-item">';
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
            ?>

        </div>
    </div>
</div>

<?php
get_footer();
?>
