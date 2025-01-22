<?php
/**
 * Single Forum Template
 */

get_header();
?>

<div class="es-single-forum-wrapper">
    <div class="es-site-container">
        <?php get_template_part( 'template-parts/forum/top-nav' ); ?>
        <?php get_template_part( 'template-parts/forum/single/content' ); ?>
        <?php get_template_part( 'template-parts/forum/single/answers' ); ?>
    </div>
</div>


<?php
get_footer();