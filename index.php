<?php
get_header();
?>

<div class="es-site-container">
    <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); 
                the_content();
            } // end while
        } // end if
    ?>
</div>

<?php
get_footer();
?>
