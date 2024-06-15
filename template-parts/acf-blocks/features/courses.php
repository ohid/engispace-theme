<?php
/**
 * Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-features-courses-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-features-courses';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$boxed_title = get_field( 'boxed_title' );
$title = get_field( 'title' );
$description = get_field( 'description' );
$select_courses = get_field( 'select_courses' );
$features_list = get_field( 'features_list' );

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background-image:url(<?php echo esc_url( $header_image ); ?>)">
    <div class="es-site-container">
        <div class="es-fc-inner">
            <div class="es-left">
            </div>
            <div class="es-right">
                <div class="es-section-title">
                    <span><?php esc_html_e( $boxed_title ); ?></span>
                    <h3><?php esc_html_e( $title ); ?></h3>
                    <p><?php esc_html_e( $description ); ?></p>
                </div>
                <ul>
                    <?php   
                        $counter = 1;
                        foreach( $features_list as $info ) {
                            printf('<li><span>%s</span> %s</li>', $counter, $info['text']);
                            $counter++;
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="es-features-courses">
                <div class="es-home-course-boxes">
                    <?php
                        foreach( $select_courses as $post ) :
                        setup_postdata( $post );

                        $es_currency = '$';
                        $price_args = learndash_get_course_price( $post->ID );
                    ?>
                    <div class="es-home-course-box">
                        <?php echo get_the_post_thumbnail( $post, 'es-course-carousel-item-thumbnail' ); ?>
                        <a href="<?php echo get_the_permalink( $post ); ?>">
                            <h5><?php echo get_the_title( $post ); ?></h5>
                        </a>
                        <div class="es-hcb-price-box">
                            <?php if ( isset( $price_args['type'] ) && $price_args['type'] === 'free' ): ?>
                                <ins>Free</ins>
                            <?php endif; ?>
                            <?php if ( isset( $price_args['type'] ) && $price_args['type'] === 'paynow' ): ?>
                                <ins><?php echo $es_currency . esc_html( $price_args['price'] ); ?></ins>
                            <?php endif; ?>
                            <span>[rating content]</span>
                        </div>
                    </div>
                    <?php 
                        endforeach; 
                        wp_reset_postdata();
                    ?>
                </div>
        </div>
    </div>
</div>