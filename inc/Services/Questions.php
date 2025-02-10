<?php 

namespace Engispace\Services;

use WP_Query;

class Questions {

    public function get_questions() {
        $args = array(
            'post_type' => 'question',
            'posts_per_page' => 10,
            'orderby' => 'comment_count',
            'order' => 'DESC'
        );

        $query = new WP_Query( $args );

        return $query;
    }

    public function print_categories( $post_id ) {
        $categories = get_the_terms( $post_id, 'categories');
        ray($categories);
        if (!empty($categories)) : ?>
            <div class="es-fce-entry-categories">
                <?php foreach ($categories as $category) : ?>
                    <span>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif;
    }

    public function print_author( $id ) {
        $author_posts_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
        $author_name = get_the_author();

        printf(
            '<a href="%1$s" title="%2$s">%3$s</a>',
            $author_posts_url,
            esc_attr( $author_name ),
            esc_html( $author_name )
        );
    }

    public function get_related_questions($post_id, $limit = 8) {
        // Get current post's categories
        $categories = get_the_terms($post_id, 'categories');
        $cat_ids = array();
        
        if ($categories) {
            foreach ($categories as $cat) {
                $cat_ids[] = $cat->term_id;
            }
        }
    
        // Query args for related posts
        $args = array(
            'post_type' => 'question',
            'posts_per_page' => $limit,
            'post__not_in' => array($post_id),
            'orderby' => 'rand'
        );
    
        // Add category filter if we have categories
        if (!empty($cat_ids)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'categories',
                    'field' => 'term_id',
                    'terms' => $cat_ids
                )
            );
        }
    
        return new WP_Query($args);
    }
}