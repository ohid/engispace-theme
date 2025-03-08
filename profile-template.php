<?php
/**
 * Template Name: Profile Template
 */

get_header();

$username = get_query_var('profile_username');
$user = get_user_by('login', $username);

if ($user) {
    // User exists, show profile
    ?>
    <div class="profile-container">
        <h1><?php echo esc_html($user->display_name); ?>'s Profile</h1>
        <!-- Add your profile content here -->
    </div>
    <?php
} else {
    // User not found
    ?>
    <div class="profile-not-found">
        <h1>Profile not found</h1>
        <p>The requested profile does not exist.</p>
    </div>
    <?php
}

get_footer();