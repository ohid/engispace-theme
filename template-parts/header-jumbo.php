<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-page-header">
    <h2><?php the_title(); ?></h2>

    <?php 
        if (isset( $_GET['verified'] ) && $_GET['verified'] === '1') {
            echo '<p>Your email has been verified. You can now log in.</p>';
        }
    ?>
</div>