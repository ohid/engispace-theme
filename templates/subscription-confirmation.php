<?php
/**
 * Template Name: Subscription Confirmation
 */

get_header();

?>
    <div class="es-course-notification-page es-course-success">
        <div class="es-site-container">
            <a href="<?php echo home_url(); ?>" class="es-close-page">
                <?php echo es_get_svg_icon( '/assets/img/x-close' ); ?>
            </a>
            <div class="es-flex es-justify-center">
                <?php
                    es_img_with_srcset(
                        THEME_URI . '/assets/img/success-icon.png'
                    );
                ?>
            </div>
            <h3><?php esc_html_e( 'Thank you for subscribing.', 'engispace' ); ?></h3>
            <div class="es-flex es-justify-center es-gap-2.5 es-mt-16">
                <a class="es-btn-default">
                    <?php esc_html_e( 'Go to MarketPlace', 'engispace' ); ?>
                </a>
                <a href="<?php echo home_url( '/creator-dashboard' ); ?>" class="es-btn-orange">
                    <?php esc_html_e( 'Create a Course Now', 'engispace' ); ?>
                </a>
            </div>
        </div>
    </div>
<?php
get_footer();
