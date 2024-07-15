<div class="es-content-title">
    <h3>Stripe API</h3>
</div>

<div class="es-settings-tab-content es-settings-subscription-tab">
    <div class="es-creator-stripe">
        <?php

            if ( es_is_creator_user() ) { ?>
                <div class="es-creator-stripe-api-form">
                    <p>Enter your Stripe Connect API key to receive commissions by selling your courses. <a href="https://docs.stripe.com/keys">Learn more.</a></p>
                    <form method="POST" id="creator-stripe-api-form">
                        <div class="es-form-group">
                            <label for="es_creator_stripe_api">Stripe API</label>
                            <input type="password" name="es_creator_stripe_api" id="es_creator_stripe_api_field">
                        </div>

                        <div class="es-form-message es-form-group"></div>
                        <div class="es-form-group es-submit-btn">
                            <?php wp_nonce_field( 'es_nonce', 'es_stripe_api_form' ) ?>
                            <input type="hidden" name="action" value="es_creator_stripe_api_form">
                            <input type="hidden" name="course_id" value="<?php echo esc_attr( $course_id ); ?>">
                            <button class="es-btn-orange">
                                <span class="btn-text">Update</span>
                                <span class="btn-icon"><?php echo es_get_svg_icon( '/assets/img/loader' ); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            <?php } else {
                printf(
                    '<p class="es-user-upgrade-to-creator">%s <a href="%s">%s</a></p>',
                    esc_html__( 'You have to be a creator user to setup Stripe,', 'engispace' ),
                    add_query_arg( 'tab', 'billing' ),
                    esc_html__( 'Upgrade now.', 'engispace' )
                );
            }
        ?>
    </div>
</div>

