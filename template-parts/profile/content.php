<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php
    $profile_content_tabs = [
        [
            'page' => 'courses',
            'title' => esc_html__( 'Courses', 'engispace' ),
        ],
        [
            'page' => 'forum',
            'title' => esc_html__( 'Forum Questions', 'engispace' ),
        ],
        [
            'page' => 'comments_and_answer',
            'title' => esc_html__( 'Comments & Answer', 'engispace' ),
        ],
    ]
?>

<div class="es-profile-content-tabs">
    <ul>
        <?php
            foreach( $profile_content_tabs as $page ) {
                $url = add_query_arg( [
                    'tab' => $page['page'],
                    'intent' => 'view_content',
                ], get_home_url() . '/profile' );

                printf(
                    '<li class="%s"><a href="%s">%s</a></li>',
                    es_get_course_current_tab_class( $page['page'] ),
                    $url,
                    $page['title'],
                );
            }
        ?>
    </ul>
</div>

<div class="es-profile-page-content">
    <?php
        $current_page = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'courses';
        $intent = isset( $_GET['intent'] ) ? sanitize_text_field( $_GET['intent'] ) : 'view_content';

        if ( $intent === 'view_content' ) {
            get_template_part( 'template-parts/profile/' . $current_page );
        }
        if ( $intent === 'update_course_meta_data' ) {
            get_template_part( 'template-parts/profile/update-course-metadata' );
        }
    ?>
</div>