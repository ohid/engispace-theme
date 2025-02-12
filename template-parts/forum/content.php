<?php
$filter_tabs = array(
    'recent' => 'Recent',
    'active' => 'Active',
    'popular' => 'Popular'
);

$current_sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'recent';
?>
            <div class="es-forum-content">
                <div class="es-forum-content-filter-navigation">
                    <div class="es-filter-label">Questions</div>
                    <div class="es-filter-tabs">
                        <?php
                        foreach ($filter_tabs as $sort_key => $sort_label) :
                            $sort_url = add_query_arg('sort', $sort_key);
                            $active_class = ($current_sort === $sort_key) ? 'active' : '';
                        ?>
                            <a href="<?php echo esc_url($sort_url); ?>" class="<?php echo esc_attr($active_class); ?>"><span class="es-icon"></span> <?php echo esc_html($sort_label); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="es-forum-content-wrap">
                    <?php
                        // Include forum content entry
                        get_template_part( 'template-parts/forum/questions' );
                    ?>
                    <!-- <div class="es-load-more-content">
                        <a href="" class="es-load-more-btn">Load more questions</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
