<?php
/**
 * Template Name: Profile Page
 */

get_header();
?>

<div class="es-profile-page">
    <?php
        // Include profile page template
        get_template_part( 'template-parts/profile/index' );
    ?>
</div>

<?php
get_footer();