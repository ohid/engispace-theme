<?php
/**
 * Template Name: Settings Page
 */

get_header();
?>

<div class="es-settings-page">
    <?php
        // Include settings page template
        get_template_part( 'template-parts/settings/index' );
    ?>
</div>

<?php
get_footer();