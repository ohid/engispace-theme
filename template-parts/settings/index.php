<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php
    $settings_pages = [
        [
            'page' => 'settings',
            'title' => esc_html__( 'Settings', 'engispace' ),
            'icon' => 'settings'
        ],
        // [
        //     'page' => 'privacy',
        //     'title' => esc_html__( 'Privacy', 'engispace' ),
        //     'icon' => 'privacy'
        // ],
        // [
        //     'page' => 'help-centre',
        //     'title' => esc_html__( 'Help Centre', 'engispace' ),
        //     'icon' => 'help-centre'
        // ],
        [
            'page' => 'billing',
            'title' => esc_html__( 'Billing & Subscription', 'engispace' ),
            'icon' => 'billing'
        ],
        [
            'page' => 'logout',
            'title' => esc_html__( 'Logout', 'engispace' ),
            'icon' => 'logout'
        ],
    ]
?>

<div class="es-site-container">
    <div class="es-settings-page-inner">
        <div class="es-settings-page-tabs">
            <ul>
                <?php
                    foreach( $settings_pages as $page ) {
                        if ( $page['page'] === 'logout' ) {
                            printf(
                                '<li><a href="%s">%s %s</a></li>',
                                wp_logout_url( home_url() ),
                                es_get_svg_icon( '/assets/img/' . $page['icon'] ),
                                $page['title'],
                            );
                        } else {
                            printf(
                                '<li class="%s"><a href="%s">%s %s</a></li>',
                                es_get_course_current_tab_class( $page['page'] ),
                                add_query_arg( 'tab', $page['page'] ) ,
                                es_get_svg_icon( '/assets/img/' . $page['icon'] ),
                                $page['title'],
                            );
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="es-settings-page-content">
            <?php
                $current_page = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'settings';

                get_template_part( 'template-parts/settings/' . $current_page );
            ?>
        </div>
    </div>
</div>