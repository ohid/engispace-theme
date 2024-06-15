<?php
/**
 * Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-features-header-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-features-header';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$header_title = get_field( 'header_title' );
$header_description = get_field( 'header_description' );
$header_image = get_field( 'background_image' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background-image:url(<?php echo esc_url( $header_image ); ?>)">
    <div class="es-full-overlay"></div>
    <div class="es-site-container">
        <div class="es-features-header-inner">
            <h3><?php echo $header_title; ?></h3>
            <p><?php esc_html_e( $header_description ); ?></p>
        </div>
    </div>
</div>