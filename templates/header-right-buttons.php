<?php

if ( is_user_logged_in() ) : ?>
    <div class="es-user-profile-button">
        <button type="button">
                <?php 
                    // user avatar
                    echo es_get_current_user_avatar();
                    // user name
                    printf( '<span class="es-user-avatar">%s</span>', es_get_current_user_firstname() );
                    echo '<svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.894418" fill-rule="evenodd" clip-rule="evenodd" d="M4 5L0 0H8L4 5Z" fill="white"/>
                    </svg>'
                ?>
            </span>
        </button>
        <div class="es-user-profile-dropdown">
            <div class="es-upd-profile-name">
                <?php 
                    // user avatar
                    echo es_get_current_user_avatar();
                    // user name
                    printf( '<span class="es-user-avatar">%s</span>', es_get_current_user_display_name() );
                ?>
            </div>
            <ul class="es-user-profile-pages">
                <li><a href="/profile">Profile</a></li>
                <?php 
                    if ( es_is_creator_user() ) {
                        echo '<li><a href="/creator-dashboard">Creator Dashboard</a></li>';
                    }
                ?>
                <li><a href="/settings">Settings</a></li>
                <li><a href="<?php echo wp_logout_url( home_url()); ?>">Logout</a></li>
            </ul>
        </div>
    </div>
<?php else : ?>
    <div class="es-user-auth-buttons">
        <button class="es-btn es-btn-signin" id="es-open-signin-modal"><?php echo esc_html__('Sign in'); ?></button>
        <button class="es-btn es-btn-signup" id="es-open-signup-modal"><?php echo esc_html__('Sign up'); ?></button>
    </div>
<?php
endif;
?>

