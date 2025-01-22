            <div class="es-forum-content">
                <div class="es-forum-content-filter-navigation">
                    <div class="es-filter-label">Questions</div>
                    <div class="es-filter-tabs">
                        <a href=""><span class="es-icon"></span> Favorite</a>
                        <a href=""><span class="es-icon"></span> Recent</a>
                        <a href=""><span class="es-icon"></span> Active</a>
                        <a href="" class="active"><span class="es-icon"></span> Popular</a>
                    </div>
                </div>

                <div class="es-forum-content-wrap">
                    <?php
                        // Include forum content entry
                        get_template_part( 'template-parts/forum/questions' );
                    ?>
                    <div class="es-load-more-content">
                        <a href="" class="es-load-more-btn">Load more questions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
