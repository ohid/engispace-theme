<header>
    <div class="es-site-container">
        <div class="es-site-inner-container">
            <div class="es-site-header-left">
                <div class="site-logo">
                    <?php
                        $es_header_logo = get_field( 'es_header_logo', 'option' );
                        if ( isset( $es_header_logo['normal_logo'] ) ) {
                            printf( '<a href="%s">', esc_url( home_url() ) );
                                es_img_with_srcset(
                                    esc_url( $es_header_logo['normal_logo'] ),
                                    esc_url( $es_header_logo['retina_logo'] ),
                                );
                            echo '</a>';
                        }
                    ?>
                </div>
                <?php if ( is_user_logged_in() ) : ?>
                    <div class="site-search-form">
                        <form action="">
                            <div class="es-form-control">
                                <input type="text" placeholder="<?php esc_attr_e( 'Search engispace', 'engispace' ); ?>">
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="site-menu">
                        <?php
                            if ( function_exists( 'wp_nav_menu' ) ) {
                                wp_nav_menu( array(
                                    'theme_location' => 'es-header-non-logged-in-menu',
                                    'menu_class' => 'navigation-menu'
                                ) );
                            }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="es-site-header-right">
                <div class="site-menu">
                    <?php
                        if ( function_exists( 'wp_nav_menu' ) ) {
                            wp_nav_menu( array(
                                'theme_location' => 'es-main-menu',
                                'menu_class' => 'navigation-menu'
                            ) );
                        }
                    ?>
                </div>
                <div class="site-right-buttons">
                    <?php get_template_part( 'templates/header-right-buttons' ); ?>
                </div>
            </div>
        </div>
    </div>

    <?php 
        if ( !is_user_logged_in() ) {
            get_template_part( 'templates/modal/site-auth-modal' ); 
        }
    ?>
</header>