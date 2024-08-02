<?php
get_header();
?>

<?php
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post(); 
            // Get header jumbo
            get_template_part( 'template-parts/header-jumbo' );

            echo '<div class="es-page-wrapper">';
                echo '<div class="es-site-container">';
                    the_content();
                echo '</div>';
            echo '</div>';
        } // end while
    } // end if
?>

<?php
get_footer();
?>
