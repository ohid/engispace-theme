<?php
/**
 * FAQ Pages Grid
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-faq-pages-grid';
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-faq-pages-grid';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$pages = get_field( 'pages' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-faq-pages-grid-inner">
            <?php foreach( $pages as $page ) : ?>
                <div>
                    <?php
                        echo '<div class="es-faq-pages-grid-img">';
                            es_img_with_srcset( $page['icon'] );
                        echo '</div>';

                        printf(
                            '<a href="%s"><h3>%s</h3></a>',
                            esc_url( $page['page_url'] ),
                            esc_html( $page['page_name'] )
                        );

                        printf('<p>%s</p>', esc_html( $page['page_description'] ));
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>