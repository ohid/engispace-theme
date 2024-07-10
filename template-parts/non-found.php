<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-not-found-wrapper">
    <div class="es-site-container">
        <div class="es-not-found-inner">
            <h1>404</h1>
            <h2><?php esc_html_e( 'Oops, The Page you are looking for can\'t be found!', 'engispace' ) ?></h2>
            <?php get_search_form(); ?>

            <?php printf( '<a href="%s">%s</a>', esc_url( get_home_url() ), esc_html__( 'or return to Homepage' ) ) ?>
        </div>
    </div>
</div>