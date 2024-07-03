<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-modal-wrapper es-upgrade-subscription-modal" id="upgrade-subscription-modal" modal-type="upgrade-subscription-modal">
    <div class="es-site-modal">
        <div class="es-modal-body">
            <span class="close-modal">
                <?php echo es_get_svg_icon('/assets/img/cross-times'); ?>
            </span>
            <h3><?php esc_html_e( 'Upgrade to Creator', 'engispace' ); ?></h3>
            <p><?php esc_html_e( 'Upgrade your subscription to be able to create and sell courses', 'engispace' ); ?></p>
            <div class="es-modal-buttons">
                <button class="es-btn-default close-modal">Cancel</button>
                <a href="/pricing" class="es-btn-orange">Upgrade</a>
            </div>
        </div>
    </div>
</div>