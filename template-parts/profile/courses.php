<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-courses-by-user">
    <?php
        Engispace\Components\Courses::get_creator_courses_html();
    ?>
</div>