<?php
/**
 * FAQ Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-faq-accordion-section';
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-faq-accordion-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$faqs = get_field( 'faqs' );
ray($faqs);
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-faq-accordion-inner">
            <?php 
                if ( $faqs ) :
                    foreach( $faqs as $faq ) :
                ?>
                <div class="es-faq-group">
                    <h3 class="es-faq-question"><?php echo esc_html( $faq['question'] ); ?></h3>
                    <p class="es-faq-answer"><?php echo esc_html( $faq['answer'] ); ?></p>

                    <span class="down-arrow"><?php echo es_get_svg_icon( '/assets/img/chevron-down' ); ?></span>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>