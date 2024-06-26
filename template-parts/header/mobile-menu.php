<?php if ( is_user_logged_in() ) : ?>
    <!-- Header mobile menu for user logged in state -->
    <div class="es-header-mobile-navigation-wrapper">
        <div class="site-search-form">
            <form action="">
                <div class="es-form-control">
                    <input type="text" placeholder="<?php esc_attr_e( 'Search engispace', 'engispace' ); ?>">
                </div>
            </form>
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