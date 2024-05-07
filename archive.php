<?php
get_header();

global $post;

if ( $post->post_type === 'sfwd-courses' ) {
    get_template_part( 'archive-courses' );
} else {
    echo '<h2>Archive page</h2>';
}
?>

<?php
get_footer();
?>
