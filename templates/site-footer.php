<div class="es-site-footer">
    <div class="es-site-container">
        <div class="es-footer-inner">
            <div class="es-left">
                <div class="es-logo">
                    <?php
                        $es_footer_logo = get_field( 'es_footer_logo', 'option' );
                        if ( isset( $es_footer_logo['normal_logo'] ) ) {
                            printf( '<a href="%s">', esc_url( home_url() ) );
                                es_img_with_srcset(
                                    esc_url( $es_footer_logo['normal_logo'] ),
                                    esc_url( $es_footer_logo['retina_logo'] ),
                                );
                            echo '</a>';
                        }
                    ?>
                </div>
                <div class="es-copyright">
                    <?php
                        $es_footer_copyright = get_field( 'es_footer_copyright', 'option' );
                        printf( '<p>%s</p>', $es_footer_copyright ? $es_footer_copyright : '' );
                    ?>
                </div>
            </div>
            <div class="es-right">
                <div class="es-footer-menu">
                    <?php
                        if ( function_exists( 'wp_nav_menu' ) ) {
                            wp_nav_menu( array(
                                'theme_location' => 'es-footer-menu',
                                'menu_class' => 'navigation-menu'
                            ) );
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>