<?php
/**
 * Page Sections Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-home-testimonaials-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-home-testimonaials';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$first_testimonial = get_field( 'first_testimonial' );
$second_testimonial = get_field( 'second_testimonial' );
$third_testimonial = get_field( 'third_testimonial' );

$section_images = get_field( 'section_images' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-ht-top">
            <div class="es-ht-testimonial-item">
                <?php
                    printf(
                        '<blockquote>%s <cite>%s</cite></blockquote>', 
                        $first_testimonial['review_text'],
                        $first_testimonial['author_name']
                    );
                ?>
            </div>
            <?php
                printf('<img src="%s" class="es-ht-section-first-image"/>', $section_images['first_section_image']);
            ?>
        </div>
    </div>
</div>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-ht-bottom">
            <div class="es-ht-testimonial-item es-text-color-gray">
                <?php
                    printf(
                        '<blockquote>%s <cite>%s</cite></blockquote>', 
                        $second_testimonial['review_text'],
                        $second_testimonial['author_name']
                    );
                ?>
            </div>
            <div class="es-ht-testimonial-item es-text-color-light">
                <?php
                    printf(
                        '<blockquote>%s <cite>%s</cite></blockquote>', 
                        $third_testimonial['review_text'],
                        $third_testimonial['author_name']
                    );
                ?>
            </div>
        </div>

        <?php
            printf('<img src="%s" class="es-ht-section-second-image"/>', $section_images['second_section_image']);
        ?>
        <div class="es-ht-section-left-img-overlay"></div>
        <div class="es-ht-section-right-boc-color"></div>
    </div>
</div>