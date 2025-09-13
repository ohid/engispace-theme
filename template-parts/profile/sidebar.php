<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

// Get profile username from URL and current user info
$profile_username = get_query_var('profile_username');
$current_user = wp_get_current_user();

// Determine which user profile to display
if ($profile_username) {
    // Viewing specific user profile (/profile/username)
    $user = get_user_by('login', $profile_username);
} else if (is_user_logged_in()) {
    // Viewing own profile (/profile)
    $user = $current_user;
} else {
    $user = null;
}

$user_id = $user instanceof \WP_User ? $user->ID : 0;

// Determine if edit buttons should be shown
$show_edit_buttons = is_user_logged_in() && (
    empty($profile_username) || 
    $profile_username === $current_user->user_login
);
?>

<div class="es-user-personal-details">
    <?php
        printf( '<img src="%s"/>', es_user_profile_avatar($user_id) );
    ?>
    <div class="es-person-name">
        <h3><?php echo es_get_current_user_display_name($user_id); ?></h3>
        <?php if ($show_edit_buttons) : ?>
        <span class="es-icon" id="es-user-profile-details"><?php echo es_get_svg_icon( '/assets/img/pencil' ); ?></span>
        <?php endif; ?>
    </div>
    <p><?php echo es_get_current_user_profile_bio($user_id); ?></p>
</div>

<div class="es-user-details-section">
    <div class="es-title">
        <h4>Contact</h4>
        <?php if ($show_edit_buttons) : ?>
        <span class="es-icon" id="es-user-contact-details">
            <?php echo es_get_svg_icon( '/assets/img/pencil' ); ?>
        </span>
        <?php endif; ?>
    </div>
    <div class="es-ups-content">
        <ul>
            <li>
                <span class="es-icon"><?php echo es_get_svg_icon( '/assets/img/phone' ); ?></span>
                <div>
                    <p><?php echo esc_html( es_get_current_user_phone($user_id) ); ?></p>
                </div>
            </li>
            <li>
                <span class="es-icon"><?php echo es_get_svg_icon( '/assets/img/email' ); ?></span>
                <div>
                    <p><?php echo esc_html( es_get_current_user_email($user_id) ); ?></p>
                </div>
            </li>
            <li>
                <span class="es-icon"><?php echo es_get_svg_icon( '/assets/img/link' ); ?></span>
                <div>
                    <p><a href="<?php echo esc_url( es_get_current_user_url($user_id) ); ?>"><?php echo esc_url( es_get_current_user_url($user_id) ); ?></a></p>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- 
<div class="es-user-details-section es-user-cv-section">
    <div class="es-title">
        <h4>CSV Resume</h4>
        <span class="es-icon">
            <?php // echo es_get_svg_icon( '/assets/img/pencil' ); ?>
        </span>
    </div>
    <div class="es-ups-content">
        <ul>
            <li>
                <?php // echo es_get_svg_icon( '/assets/img/filezip' ); ?>
                <div>
                    <p><a href="http://gstuffpro.com">filename.zip</a></p>
                </div>
            </li>
        </ul>
    </div>
</div> -->

<?php 
    get_template_part( 'template-parts/modals/user-profile-details' );
    get_template_part( 'template-parts/modals/user-contact-details' );
?>