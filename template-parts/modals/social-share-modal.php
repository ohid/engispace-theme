<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-modal-wrapper es-social-share-modal" id="social-share-modal" modal-type="social-share-modal">
    <div class="es-site-modal">
        <div class="es-modal-body">
            <span class="close-modal">
                <?php echo es_get_svg_icon('/assets/img/cross-times'); ?>
            </span>
            <h3><?php esc_html_e( 'Sharing is Caring', 'engispace' ); ?></h3>
            <p><?php esc_html_e( 'Help spread the word. You\'re awesome for doing it', 'engispace' ); ?></p>
            <div class="es-social-share">
                <?php echo do_shortcode( '[Sassy_Social_Share]' ); ?>
            </div>
        </div>
    </div>
</div>