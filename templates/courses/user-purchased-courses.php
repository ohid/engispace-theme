<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-site-container">
    <div class="es-purchased-bar">
        <span class="purchased-label"><?php esc_html_e( 'Purchased', 'engispace' ); ?></span>
        <a href="/creator-dashboard" id="es-start-selling" <?php echo es_is_creator_user() ? ' class="es-creator-user"' : ''; ?>>
            <?php esc_html_e( 'Start Selling', 'engispace' ); ?>
        </a>
    </div>
</div>

<?php 
    // Check whether user purchased courses or not
    $purchased_courses = Engispace\Components\Courses::user_have_purchased_courses();
    if ( $purchased_courses ) :
?>
<div class="es-user-purchased-courses-area">
    <div class="es-site-container">
        <div class="es-site-courses-grid">
            <div id="es-single-course-details-box" class="es-single-course-details-box"></div>
            <?php Engispace\Components\Courses::user_purchased_courses(); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php

    if ( !es_is_creator_user() ) {
        get_template_part( 'templates/modal/upgrade-subscription-creator' ); 
    }
?>