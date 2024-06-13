<?php
/**
 * Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-home-features-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-home-features';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title_top = get_field( 'title_top' );
$title = get_field( 'title' );
$features_list = get_field( 'features_list' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-features-section-title">
            <span><?php esc_html_e( $title_top ); ?></span>
            <h4><?php esc_html_e( $title ); ?></h4>
        </div>
        <div class="es-fs-features">
            <?php foreach( $features_list as $list ) :
                printf( '<span>%s</span>', $list['name'] );
            endforeach; ?>
        </div>
    </div>
</div>