<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-site-container">
    <div class="es-profile-inner">
        <div class="es-sidebar">
            <?php
                // Include sidebar template
                get_template_part( 'template-parts/profile/sidebar' );
            ?>
        </div>
        <div class="es-content">
            <?php
                // Include content template
                get_template_part( 'template-parts/profile/content' );
            ?>
        </div>
    </div>
</div>