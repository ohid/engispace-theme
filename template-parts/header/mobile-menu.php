<?php if ( is_user_logged_in() ) : ?>
    <!-- Header mobile menu for user logged in state -->
    <div class="es-header-mobile-navigation-wrapper">
        <div class="site-search-form">
            <?php get_search_form(); ?>
        </div>
        <?php
            if ( function_exists( 'wp_nav_menu' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'es-main-menu',
                    'menu_class' => 'navigation-menu'
                ) );
            }
        ?>
    </div>
<?php else: ?>
    <!-- Header mobile menu for user non logged in state -->
    <div class="es-header-mobile-navigation-wrapper">
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