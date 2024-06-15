<?php
/**
 * Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-features-engi-tools-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-features-engi-tools';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title_boxed = get_field( 'title_boxed' );
$header_title = get_field( 'header_title' );
$header_description = get_field( 'header_description' );
$section_image = get_field( 'section_image' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background-image:url(<?php echo esc_url( $header_image ); ?>)">
    <div class="es-site-container">
        <div class="es-fet-inner">
            <div>
            </div>
            <div class="es-section-title">
                <span class="boxed-title"><?php esc_html_e( $title_boxed ); ?></span>
                <h3><?php esc_html_e( $header_title ); ?></h3>
                <p><?php esc_html_e( $header_description ); ?></p>
            </div>
        </div>
    </div>

    <div class="es-features-engitools-section-image">
        <?php printf('<img src="%s"/>', esc_url( $section_image )); ?>
    </div>
</div>