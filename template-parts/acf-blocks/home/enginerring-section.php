<?php
/**
 * Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-engineering-section';
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-engineering-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title_top = get_field( 'title_top' );
$title = get_field( 'title' );
$images = get_field( 'images' );

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-es-inner">
            <span><?php esc_html_e( $title_top ); ?></span>
            <h3><?php esc_html_e( $title ); ?></h3>

            <div class="es-es-images">
                <?php 
                    foreach( $images as $image ) :
                        printf('<img src="%s"/>', $image);
                    endforeach; 
                ?>
            </div>
        </div>
    </div>
</div>