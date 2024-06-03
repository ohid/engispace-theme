<div class="es-modal-wrapper" id="site-auth-modal" modal-type="signin-modal">
    <div class="es-site-modal es-auth-modal">
        <div class="es-modal-body" id="es-user-signin-modal-body">
            <span class="close-modal">
                <?php echo es_get_svg_icon('/assets/img/cross-times'); ?>
            </span>
            <div class="modal-header">
                <?php
                    es_img_with_srcset(
                        esc_url( THEME_URI . '/assets/img/engispace-logo.png' ),
                    );
                ?>
            </div>
            <div class="es-modal-content">
                <form id="es-signin-form">
                    <div class="es-form-control">
                        <label for="login_email">Email</label>
                        <input type="email" id="login_email" name="email" class="es-form-input">
                    </div>
                    <div class="es-form-control">
                        <label for="login_password">Password</label>
                        <input type="password" id="login_password" name="login_password" class="es-form-input" minlength="8">
                    </div>
                    <p class="es-form-message"></p>
                    <div class="es-form-control es-submit-btn">
                        <input type="hidden" name="action" value="es_site_signin">
                        <?php wp_nonce_field( 'es_site_signin', 'es_signin_nonce' ); ?>
                        <button type="submit" class="es-btn-orange">
                            <span class="loader-icon"><?php echo es_get_svg_icon( '/assets/img/loader' ); ?></span>
                            Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="es-modal-footer">
                <p>New to Engispace? <button class="es-btn-switch-to-signup">Create an Account</button> </p>
            </div>
        </div>
        <div class="es-modal-body" id="es-user-signup-modal-body">
            <span class="close-modal">
                <?php echo es_get_svg_icon('/assets/img/cross-times'); ?>
            </span>
            <div class="modal-header">
                <?php
                    echo '<h3>Join ';
                        es_img_with_srcset(
                            esc_url( THEME_URI . '/assets/img/engispace-logo.png' ),
                        );
                    echo '</h3>';
                ?>
            </div>
            <div class="es-modal-content">
                <form id="es-signup-form">
                    <div class="es-form-control">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" class="es-form-input">
                    </div>
                    <div class="es-form-control">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" class="es-form-input">
                    </div>
                    <div class="es-form-control">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="es-form-input">
                    </div>
                    <div class="es-form-control">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="es-form-input" minlength="8">
                    </div>
                    <div class="es-form-control">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="password_confirm" class="es-form-input" minlength="8">
                    </div>
                    <p class="es-form-message"></p>
                    <div class="es-form-control es-submit-btn">
                        <input type="hidden" name="action" value="es_site_signup">
                        <?php wp_nonce_field( 'es_site_signup', 'es_signup_nonce' ); ?>
                        <button type="submit" class="es-btn-orange">
                            <span class="loader-icon"><?php echo es_get_svg_icon( '/assets/img/loader' ); ?></span>
                            Sign Up
                        </button>
                    </div>
                </form>
            </div>
            <div class="es-modal-footer">
                <p>Have an account? <button class="es-btn-switch-to-login">Log in</button> </p>
            </div>
        </div>
    </div>
</div>