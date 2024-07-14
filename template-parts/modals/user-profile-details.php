<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-modal-wrapper es-user-proifle-details-modal" id="user-proifle-details-modal" modal-type="user-proifle-details-modal">
    <div class="es-site-modal">
        <div class="es-modal-body">
            <span class="close-modal">
                <?php echo es_get_svg_icon('/assets/img/cross-times'); ?>
            </span>
            <div class="es-update-user-details-form">
                <form id="es-update-user-details-form" enctype="multipart/form-data">
                    <div class="es-form-group">
                        <label for="es_profile_picture">Upload profile picture</label>
                        <input type="file" name="us_profile_picture" id="es_profile_picture">
                    </div>
                    <div class="es-form-group">
                        <label for="es_person_first_name">First Name</label>
                        <input type="text" name="es_first_name" id="es_person_first_name" class="es-form-control" value="<?php echo esc_attr( es_get_current_user_firstname() ); ?>">
                    </div>
                    <div class="es-form-group">
                        <label for="es_person_last_name">Last Name</label>
                        <input type="text" name="es_last_name" id="es_person_last_name" class="es-form-control" value="<?php echo esc_attr( es_get_current_user_lastname() ); ?>">
                    </div>
                    <div class="es-form-group">
                        <label for="es_person_description">Profile Bio</label>
                        <textarea type="text" name="es_person_description" id="es_person_description" class="es-form-control"><?php echo esc_html( es_get_current_user_profile_bio() ); ?></textarea>
                    </div>
                    <div class="es-form-group es-submit-btn">
                    <div class="es-form-message es-form-group"></div>
                        <div class="es-form-group es-submit-btn">
                            <?php wp_nonce_field( 'es_nonce', 'es_update_profile_details' ) ?>
                            <input type="hidden" name="action" value="es_update_profile_details">
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