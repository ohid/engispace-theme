<?php
/**
 * Template Name: Subscription Confirmation
 */

get_header();

?>
    <div class="es-course-notification-page es-course-success">
        <div class="es-site-container">
            <div class="es-flex es-justify-center">
                <?php
                    es_img_with_srcset(
                        THEME_URI . '/assets/img/success-icon.png'
                    );
                ?>
            </div>
            <h3><?php esc_html_e( 'Thank you for subscribing.', 'engispace' ); ?></h3>
            <div class="es-flex es-justify-center es-gap-2.5 es-mt-16">
                <a href="<?php echo home_url( '/courses' ); ?>" class="es-btn-default">
                    <?php esc_html_e( 'View Course', 'engispace' ); ?>
                </a>
                <a href="<?php echo home_url( '/creator-dashboard' ); ?>" class="es-btn-orange">
                    <?php esc_html_e( 'Start Selling', 'engispace' ); ?>
                </a>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = engisapce_obj.siteurl + '/courses'
        }, 3000);
    </script>
<?php
get_footer();
