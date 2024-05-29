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
$information_row = get_field( 'information_row' );

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <h2><?php esc_html_e( $heading ); ?></h2>
    <div class="es-pricing-plans">
        <div class="es-pricing-plan">
            <h4>Freemium</h4>
            <div class="es-pricing-plan-price">
                <span class="es-pricing-plan-cost"><sup>$</sup>0</span>
                <span class="es-pricing-plan-subs-type">Per month</span>
            </div>
            <div class="es-pricing-plan-features">
                <ul>
                    <li>Personal profile</li>
                    <li>Unlimited forum viewing & Posting</li>
                    <li>Access to Purchasing of Courses</li>
                    <li>Limited Access to Code Exchange</li>
                </ul>
            </div>
            <div class="plan-btn">
                <a href=""class="es-btn-orange">Sign up</a>
            </div>
        </div>
        <div class="es-pricing-plan">
            <h4> <span>Most Popular</span> Pro</h4>
            <div class="es-pricing-plan-price">
                <span class="es-pricing-plan-cost"><sup>$</sup>5</span>
                <span class="es-pricing-plan-subs-type">Per month</span>
            </div>
            <div class="es-pricing-plan-features">
                <ul>
                    <li>Personal profile</li>
                    <li>Unlimited forum viewing & Posting</li>
                    <li>Access to Purchasing of Courses</li>
                    <li>Full Access to Code Exchange</li>
                    <li>Unlimited uploading & downloading of files</li>
                    <li>Access to purchasing courses</li>
                </ul>
            </div>
            <div class="plan-btn">
                <a href=""class="es-btn-orange">Sign up</a>
            </div>
        </div>
        <div class="es-pricing-plan">
            <h4>Creator</h4>
            <div class="es-pricing-plan-price">
                <span class="es-pricing-plan-cost"><sup>$</sup>49</span>
                <span class="es-pricing-plan-subs-type">Per month</span>
            </div>
            <div class="es-pricing-plan-features">
                <ul>
                    <li>Personal profile</li>
                    <li>Unlimited forum viewing & Posting</li>
                    <li>Access to Purchasing of Courses</li>
                    <li>Full Access to Code Exchange</li>
                    <li>Unlimited uploading & downloading of files</li>
                    <li>Access to sell courses</li>
                </ul>
            </div>

            <div class="plan-btn">
                <a href=""class="es-btn-orange">Sign up</a>
            </div>
        </div>
    </div>
</div>