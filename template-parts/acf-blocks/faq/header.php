<?php
/**
 * FAQ Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-faq-header';
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-faq-header';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field( 'title' );
$description = get_field( 'description' );
$faq_page = get_field( 'faq_page' );
$faq_page_link = get_field( 'faq_page_link' );
$faq_pages = get_field( 'faq_pages' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-faq-header-inner">
            <a href="<?php echo esc_url( $faq_page_link ); ?>" class="es-faq-header-faqs-link">
                <p><?php esc_html_e( $faq_page ); ?></p>
            </a>
            <h2 class="es-faq-header-title"><?php esc_html_e( $title ); ?></h2>
            <p class="es-faq-header-description"><?php esc_html_e( $description ); ?></p>
            <?php if ( $faq_pages ) : ?>
                <div class="es-faq-pages-menu">
                    <span class="es-faq-selected-page">
                        <?php
                            foreach( $faq_pages as $page ) {
                                if ( $page['is_active_page'] ) {
                                    esc_html_e( $page['name'] );
                                }
                            }
                        ?>
                        <?php echo es_get_svg_icon( '/assets/img/chevron-down' ); ?>
                    </span>
                    <ul class="es-faq-all-pages">
                        <?php
                            foreach( $faq_pages as $page ) {
                                if ( !$page['is_active_page'] ) {
                                    printf(
                                        '<li><a href="%s">%s</a></li>', 
                                        esc_url( $page['url'] ), 
                                        esc_html( $page['name'] ) 
                                    );
                                }
                            }
                        ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>