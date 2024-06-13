<?php
/**
 * Page Sections Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-home-code-exchange-section';
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-home-code-exchange-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field( 'title' );
$description = get_field( 'description' );
$title_boxed = get_field( 'title_boxed' );
$section_image = get_field( 'section_image' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-hec-section-img">
        <?php printf('<img src="%s"/>', $section_image); ?>
    </div>
    <div class="es-site-container">
        <div class="es-hce-inner-top">
            <div class="es-section-title">
                <span><?php esc_html_e( $title_boxed ); ?></span>
                <h3><?php esc_html_e( $title ); ?></h3>
                <p><?php esc_html_e( $description ); ?></p>
            </div>
        </div>
    </div>
</div>