<?php
/**
 * Page Sections Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-home-page-sections-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-home-page-sections es-py-10';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$page_sections = get_field( 'page_sections' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-page-sections-inner">
            <?php foreach( $page_sections as $section ) : ?>
                <div class="es-hps-item">
                    <span class="es-hps-item-img">
                        <?php 
                            printf(
                                '<img src="%s" alt="%s">',
                                esc_url( $section['icon'] ),
                                esc_html( $section['section_title'] ) 
                            )
                        ?>
                    </span>
                    <span><?php echo esc_html( $section['section_title'] ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>