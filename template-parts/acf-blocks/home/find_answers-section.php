<?php
/**
 * Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-find-answer';
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-find-answers-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$boxed_title = get_field( 'boxed_title' );
$title = get_field( 'title' );
$section_image = get_field( 'section_image' );
$info_list = get_field( 'info_list' );
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-find-answer-inner">
            <div class="es-left">
                <?php   
                    printf('<img src="%s"/>', $section_image);
                ?>
            </div>
            <div class="es-right">
                <span class="es-section-top-title"><?php esc_html_e( $boxed_title ); ?></span>
                <h3><?php esc_html_e( $title ); ?></h3>
                <span class="es-line-style"></span>
                <ul>
                    <?php   
                        $counter = 1;
                        foreach( $info_list as $info ) {
                            printf('<li><span>%s</span> %s</li>', $counter, $info['text']);
                            $counter++;
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>