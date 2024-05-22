<?php

if ( is_user_logged_in() ) :
    echo '<div class="es-logged-in-user">';
        echo '<span class="es-user-name">Jason</span>';
    echo '</div>';
else : ?>
    <div class="es-user-auth-buttons">
        <button class="es-btn es-btn-signin" id="es-open-signin-modal"><?php echo esc_html__('Sign in'); ?></button>
        <button class="es-btn es-btn-signup" id="es-open-signup-modal"><?php echo esc_html__('Sign up'); ?></button>
    </div>
<?php
endif;
?>

