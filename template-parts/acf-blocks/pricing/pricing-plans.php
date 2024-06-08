<?php
/**
 * Pricing Plan Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-pricing-plan-wrapper-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-pricing-plan-wrapper';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$heading = get_field( 'heading' );
$pricing_plans = get_field( 'pricing_plans' );

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <h2><?php esc_html_e( $heading ); ?></h2>
    <div class="es-pricing-plans">
        <?php foreach( $pricing_plans as $plan ) : ?>
            <div class="es-pricing-plan">
                <h4><?php echo $plan['plan_title']; ?></h4>
                <div class="es-pricing-plan-price">
                    <span class="es-pricing-plan-cost"><sup>$</sup><?php echo $plan['plan_price']; ?></span>
                    <span class="es-pricing-plan-subs-type">Per month</span>
                </div>
                <div class="es-pricing-plan-features">
                    <?php echo $plan['plan_features']; ?>
                </div>
                <div class="plan-btn">
                    <a href="<?php echo es_get_membership_checkout_url( $plan ); ?>"class="es-btn-orange">Sign up</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>