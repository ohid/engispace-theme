<?php
/**
 * Page Sections Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-home-courses-section';
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-home-courses-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field( 'title' );
$description = get_field( 'description' );
$title_boxed = get_field( 'title_boxed' );

$first_two_course_selector = get_field( 'first_two_course_selector' );
$second_row_course_selector = get_field( 'second_row_course_selector' );

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-site-container">
        <div class="es-hc-inner-top">
            <div class="es-section-title">
                <span><?php esc_html_e( $title_boxed ); ?></span>
                <h3><?php esc_html_e( $title ); ?></h3>
                <p><?php esc_html_e( $description ); ?></p>
            </div>
            <div>
                <div class="es-home-course-boxes">
                    <?php
                        foreach( $first_two_course_selector as $post ) :
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
        <div class="es-hc-inner-bottom">
            <div class="es-home-course-boxes">
                <?php
                    foreach( $second_row_course_selector as $post ) :
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