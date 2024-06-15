<?php
/**
 * Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-home-header-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-home-header';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$header_title = get_field( 'header_title' );
$header_description = get_field( 'header_description' );
$header_form = get_field( 'header_form' );
$header_image = get_field( 'background_image' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background-image:url(<?php echo esc_url( $header_image ); ?>)">
    <div class="es-full-overlay"></div>
    <div class="es-site-container">
        <div class="es-home-header-inner">
            <div class="es-left">
                <h3 class="es-text-white es-pr-10"><?php echo $header_title; ?></h3>
                <p class="es-text-white es-mt-14"><?php esc_html_e( $header_description ); ?></p>
            </div>
            <div class="es-right">
                <div class="es-header-signup-form">
                    <h4><?php esc_html_e( $header_form['form_title'] ); ?></h4>
                    <button class="es-home-cta-signup"><?php esc_html_e( $header_form['sign_up_button_label'] ); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>