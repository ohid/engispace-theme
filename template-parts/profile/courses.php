<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

// Check if profile_username exists
$username = get_query_var('profile_username');
$user = get_user_by('login', $username);
$user_id = $user instanceof \WP_User ? $user->ID : 0;

?>

<div class="es-courses-by-user">
    <?php
        Engispace\Components\Courses::get_creator_courses_html($user_id);
    ?>
</div>