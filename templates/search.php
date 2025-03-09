<?php
$filter_tabs = array(
    'all' => 'All',
    'sfwd-courses' => 'Courses',
    'question' => 'Questions'
);

$sort_by_post_type = isset( $_GET['sort'] ) ? sanitize_text_field( $_GET['sort'] ) : 'all';
// $post_type_arg = array('sfwd-courses', 'question');
// if ($sort_by_post_type !== 'all') {
//     $post_type_arg = array($sort_by_post_type);
// }

// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// $search_query = new WP_Query(array(
//     'post_type' => $post_type_arg,
//     's' => get_search_query(),
//     'posts_per_page' => 1,
//     'paged' => $paged,
//     'orderby' => 'date',
//     'order' => 'DESC'
// ));

?>

<div class="es-search-wrapper">
    <div class="es-site-container">
        <div class="es-forum-content">
            <div class="es-forum-content-filter-navigation">
                <div class="es-filter-label">Search</div>
                <div class="es-filter-tabs">
                    <?php
                    foreach ($filter_tabs as $sort_key => $sort_label) :
                        $sort_url = add_query_arg('sort', $sort_key);
                        $active_class = ($sort_by_post_type === $sort_key) ? 'active' : '';
                    ?>
                        <a href="<?php echo esc_url($sort_url); ?>" class="<?php echo esc_attr($active_class); ?>"><span class="es-icon"></span> <?php echo esc_html($sort_label); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="es-forum-content-wrap es-search-page-content">
                <?php
                    if (have_posts() ) {
                        while (have_posts() ) {
                           the_post();
                            // Include forum content entry
                            $post_type = get_post_type();
                            if ($post_type === 'sfwd-courses') {
                                get_template_part( 'template-parts/search/item-course' );
                            } elseif ($post_type === 'question') {
                                get_template_part( 'template-parts/search/item-question' );
                            }
                        }
                    } else {
                        // No posts found
                        echo '<p>No results found.</p>';
                    }
                ?>
            </div>

            <div class="es-search-pagination">
                <?php
                    global $wp_query;
                    echo paginate_links(array(
                        'current' => max(1, get_query_var('paged')),
                        'total' => $wp_query->max_num_pages,
                        'prev_text' => '&laquo; Previous',
                        'next_text' => 'Next &raquo;',
                        'type' => 'list'
                    ));
                ?>
            </div>
        </div>
    </div>
</div>
