<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;


// Check if profile_username exists
$username = get_query_var('profile_username');
$user = get_user_by('login', $username);
$user_id = $user instanceof \WP_User ? $user->ID : 0;
?>

<div class="es-user-personal-details">
    <?php
        printf( '<img src="%s"/>', es_user_profile_avatar($user_id) );
    ?>
    <div class="es-person-name">
        <h3><?php echo es_get_current_user_display_name($user_id); ?></h3>
        <span class="es-icon" id="es-user-profile-details"><?php echo es_get_svg_icon( '/assets/img/pencil' ); ?></span>
    </div>
    <p><?php echo es_get_current_user_profile_bio($user_id); ?></p>
</div>

<div class="es-user-details-section">
    <div class="es-title">
        <h4>Contact</h4>
        <span class="es-icon" id="es-user-contact-details">
            <?php echo es_get_svg_icon( '/assets/img/pencil' ); ?>
        </span>
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