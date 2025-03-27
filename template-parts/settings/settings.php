<div class="es-content-title">
    <h3>Settings</h3>
</div>

<div class="es-settings-update-password">
    <form method="POST" id="es-update-user-password">
        <h3>User details</h3>
        <div class="es-form-user-details-fields es-form-fields">
            <div class="es-form-control">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php esc_attr_e( es_get_current_user_email() ); ?>">
            </div>
            <div class="es-form-control">
                <label for="first_name">First name</label>
                <input type="text" name="first_name" id="first_name" value="<?php esc_attr_e( es_get_current_user_firstname() ); ?>">
            </div>
            <div class="es-form-control">
                <label for="last_name">Last name</label>
                <input type="text" name="last_name" id="last_name" value="<?php esc_attr_e( es_get_current_user_lastname() ); ?>">
            </div>
        </div>
        <h3>Change Password</h3>
        <div class="es-form-password-fields es-form-fields">
            <div class="es-form-control">
                <label for="old_password">Old password</label>
                <input type="password" name="old_password" id="old_password">
            </div>
            <div class="es-form-control">
                <label for="new_password">New password</label>
                <input type="password" name="new_password" id="new_password">
            </div>
            <div class="es-form-control">
                <label for="confirm_password">Confirm new password</label>
                <input type="password" name="confirm_password" id="confirm_password">
            </div>
        </div>
        <div class="es-submit-btn">
            <?php wp_nonce_field( 'es_settings', 'es_update_password' ); ?>
            <input type="hidden" name="action" value="es_update_password">
            <button class="es-btn-orange">
                <span class="btn-text">Save</span>
                <span class="btn-icon"><?php echo es_get_svg_icon( '/assets/img/loader' ); ?></span>
            </button>
        </div>

        <div class="es-form-message"></div>
    </form>
</div>