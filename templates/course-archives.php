<div class="es-all-courses-archive">
    <div class="es-site-container">
        <div class="es-aca-inner">
            <div class="es-course-categories">
                <h3><?php esc_html_e( 'Categories', 'engispace' ) ?></h3>
                <?php
                    echo '<ul>';
                        wp_list_categories( array(
                            'taxonomy'   => 'ld_course_category',
                            'title_li' => ''
                        ) );
                    echo '</ul>';
                ?>
                </ul>
            </div>
            <div class="es-course-archives">
                <div class="es-ca-title">
                    <?php es_all_courses_page_title(); ?>
                </div>
                <div class="es-ca-course-list">
                    <?php
                        Engispace\Components\Courses::get_courses_list();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>