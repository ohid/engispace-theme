<div class="es-content-title">
    <h3>Settings</h3>
</div>

<div class="es-settings-update-password">
    <h3>Change Password</h3>
    <form method="POST" id="es-update-user-password">
        <div class="es-form-fields">
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