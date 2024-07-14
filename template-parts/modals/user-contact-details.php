<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-modal-wrapper es-user-contact-details-modal" id="user-contact-details-modal" modal-type="user-contact-details-modal">
    <div class="es-site-modal">
        <div class="es-modal-body">
            <span class="close-modal">
                <?php echo es_get_svg_icon('/assets/img/cross-times'); ?>
            </span>
            <div class="es-update-user-contact-details-form">
                <form id="es-update-user-contact-details-form" enctype="multipart/form-data">
                    <div class="es-form-group">
                        <label for="es_person_phone_number">Phone Number</label>
                        <input type="text" name="es_user_phone" id="es_person_phone_number" class="es-form-control" value="<?php echo esc_attr( es_get_current_user_phone() ); ?>">
                    </div>
                    <div class="es-form-group">
                        <label for="es_person_email">Email Address</label>
                        <input type="email" name="es_user_email" id="es_person_email" class="es-form-control" value="<?php echo esc_attr( es_get_current_user_email() ); ?>">
                    </div>
                    <div class="es-form-group">
                        <label for="es_person_url">URL</label>
                        <input type="url" name="es_user_url" id="es_person_url" class="es-form-control" value="<?php echo esc_attr( es_get_current_user_url() ); ?>">
                    </div>
                    <div class="es-form-group es-submit-btn">
                    <div class="es-form-message es-form-group"></div>
                        <div class="es-form-group es-submit-btn">
                            <?php wp_nonce_field( 'es_nonce', 'es_update_contact_details' ) ?>
                            <input type="hidden" name="action" value="es_update_contact_details">
                            <button class="es-btn-orange">
                                <span class="btn-text">Update</span>
                                <span class="btn-icon"><?php echo es_get_svg_icon( '/assets/img/loader' ); ?></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>