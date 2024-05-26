<?php
/**
 * Course Learn More Context
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-course-learn-context-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-course-learn-context';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$heading = get_field( 'heading' );
$information_row = get_field( 'information_row' );

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <h3><?php esc_html_e( $heading ); ?></h3>
    <ul>
        <?php 
            foreach( $information_row as $info ) {
                if ( !empty( $info['info'] ) ) {
                    printf(
                        '<li>%s</li>', 
                        es_get_svg_icon( '/assets/img/success' ) . $info['info']
                    );
                }
            }
        ?>
    </ul>
</div>