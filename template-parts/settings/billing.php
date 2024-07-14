<?php
    $memberships = [
        'freemium' => [
            'title' => esc_html__( 'Freemium', 'engispace' ),
            'price' => '0',
            'help_text' => esc_html__( 'Free', 'engispace' ),
        ],
        'creator' => [
            'title' => esc_html__( 'Creator', 'engispace' ),
            'price' => '49',
            'download_id' => 247,
            'price_id' => 2,
            'help_text' => esc_html__( 'Most popular', 'engispace' ),
        ],
        'pro' => [
            'title' => esc_html__( 'Pro', 'engispace' ),
            'price' => '5',
            'download_id' => 247,
            'price_id' => 1,
        ],
    ]
?>

<!-- <div class="es-content-title">
    <h3>Billing</h3>
</div> -->

<!-- <div class="es-settings-tab-content">    
</div> -->

<div class="es-content-title">
    <h3>Subscription</h3>
</div>

<div class="es-settings-tab-content es-settings-subscription-tab">
    <?php 
        printf(
            '<h3>%s <span>%s</span></h3>', 
            esc_html__( 'Current Subscription:', 'engispace' ),
            ucfirst( es_get_current_user_subscription() )
        );
    ?>

    <div class="es-membership-plans">
        <?php 
            foreach( $memberships as $key => $membership ) :
        ?>
            <div class="es-membership-plan es_plan_<?php echo esc_attr( $key ); ?>" data-current-plan="<?php echo $key === es_get_current_user_subscription() ? 'true' : 'false' ?>" data-download-id="<?php echo esc_attr( $membership['download_id'] ); ?>" data-price-id="<?php echo esc_attr( $membership['price_id'] ); ?>">
                <input type="radio" name="membership_plan" id="membership_<?php echo esc_attr( $key ); ?>">
                <label for="membership_<?php echo esc_attr( $key ); ?>" class="es-flex">
                    <div class="es-flex es-left">
                        <span class="es-circle"></span>
                        <div class="es-flex es-membership-text-group">
                            <span class="es-membership-title"><?php echo esc_html( $membership['title'] ); ?></span>
                            <span class="es-membership-help-text"><?php echo esc_html( $membership['help_text'] ); ?></span>
                        </div>
                    </div>
                    <div class="es-membership-price">
                        <span>$<?php echo esc_html( $membership['price'] ); ?></span>/monthly
                    </div>
                </label>
            </div>
        <?php 
            endforeach;
        ?>

        <div class="es-upgrade-membership" data-button-disabled="true">
            <a href="/pricing" class="es-btn-orange">Upgrade</a>
        </div>
    </div>
</div>

