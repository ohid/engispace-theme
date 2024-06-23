<?php
/**
 * Pricing Courses Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-pricing-courses-wrapper-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-pricing-courses-wrapper';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title_boxed = get_field( 'boxed_title' );
$title = get_field( 'title' );
$description = get_field( 'description' );
$info_texts = get_field( 'info_texts' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-pc-inner">
            <div class="es-section-title">
                <span class="boxed-title"><?php esc_html_e( $title_boxed ); ?></span>
                <h3><?php esc_html_e( $title ); ?></h3>
                <p><?php esc_html_e( $description ); ?></p>
            </div>
        </div>

        <div class="es-pc-info-list">
            <?php 
                foreach( $info_texts as $text ) :
                    $icon_url = THEME_URI . '/assets/img/es-star-icon.png';
                    $icon = sprintf('<span><img src="%s"></span>', $icon_url);
                    printf('<div class="">%s %s</div>', $icon, esc_html( $text['text'] ));
                endforeach;
            ?>
        </div>
    </div>
</div>