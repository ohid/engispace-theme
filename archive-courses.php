<?php
get_header();
?>

<?php
    // Get Courses Header
    get_template_part( 'templates/courses/header-slider' );

    // Get User Purchased Courses
    get_template_part( 'templates/courses/user-purchased-courses' );

    // Get Courses Grid
    get_template_part( 'templates/courses/courses-grid' );
?>


<?php
get_footer();
?>
