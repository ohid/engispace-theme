<?php
/**
 * Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-features-a-progress-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-features-a-progress es-features-questions';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title_boxed = get_field( 'title_boxed' );
$header_title = get_field( 'title' );
$header_description = get_field( 'description' );
$section_image = get_field( 'section_image' );
$is_coming_soon = get_field( 'is_coming_soon' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background-image:url(<?php echo esc_url( $header_image ); ?>)">
    <div class="es-site-container">
        <div class="es-section-title">
            <span class="boxed-title"><?php esc_html_e( $title_boxed ); ?></span>
            <?php if ( $is_coming_soon ) : ?>
                <span class="es-boxed-title-white"><?php esc_html_e( 'Coming soon', 'engispace' ) ?></span>
            <?php endif; ?>
            <h3><?php esc_html_e( $header_title ); ?></h3>
            <p><?php esc_html_e( $header_description ); ?></p>
        </div>
        <div class="es-fq-section-image">
            <?php printf('<img src="%s"/>', esc_url( $section_image )); ?>
        </div>
    </div>
</div>