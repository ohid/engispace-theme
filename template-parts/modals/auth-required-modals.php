<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-modal-wrapper es-auth-require-modal display-modal" modal-type="auth-require-modal">
    <div class="es-site-modal">
        <div class="es-modal-body">
            <span class="close-modal">
                <?php echo es_get_svg_icon('/assets/img/cross-times'); ?>
            </span>
            <h2><?php esc_html_e( 'Sign in required to purchase', 'engispace' ); ?></h2>
            <p><?php esc_html_e( 'Log in to your account or create an account below!', 'engispace' ); ?></p>

            <div class="es-btns">
                <button class="es-btn es-btn-signin" id="es-open-signin-modal-from-auth"><?php echo esc_html__('Sign in'); ?></button>
                <span><?php esc_html_e( 'or', 'engispace' ); ?></span>
                <button class="es-btn es-btn-signup" id="es-open-signup-modal-from-auth"><?php echo esc_html__('Sign up'); ?></button>
            </div>
        </div>
    </div>
</div>