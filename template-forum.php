<?php
/**
 * Template Name: Forum
 */

get_header();
?>

<div class="es-forum-page">
    <?php
        $page = isset( $_GET['fpage'] ) ? $_GET['fpage'] : 'archive';

        if ( $page === 'archive' ) {
            // Include forum page template
            get_template_part( 'template-parts/forum/index' );
        } else if ( $page === 'single' ) {
            get_template_part( 'single-forum' );
        }
    ?>
</div>

<?php
get_footer();