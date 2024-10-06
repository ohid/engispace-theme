<?php
/**
 * Template Name: Forum
 */

get_header();
?>

<div class="es-forum-page">
    <?php
        // Include forum page template
        get_template_part( 'template-parts/forum/index' );
    ?>
</div>

<?php
get_footer();