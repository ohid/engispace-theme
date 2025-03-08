<?php
/**
 * Template Name: Profile Page
 */

get_header();

?>

<div class="es-profile-page">
    <?php

        $username = get_query_var('profile_username');
        $user = get_user_by('login', $username);
        if (!$user && is_user_logged_in()) {
            $user = get_current_user();
        }

        if ($user || is_user_logged_in()) {
            // Include profile page template
            get_template_part( 'template-parts/profile/index' );
        }
    ?>
</div>

<?php
get_footer();