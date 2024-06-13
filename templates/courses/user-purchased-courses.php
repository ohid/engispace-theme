<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-site-container">
    <div class="es-purchased-bar">
        <span class="purchased-label">Purchased</span>
        <a href="#" id="es-start-selling">Start Selling</a>
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