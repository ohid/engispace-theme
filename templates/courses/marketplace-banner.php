<div class="es-courses-marketplace-banner">
    <div class="es-site-container">
        <div class="es-cmb-inner">
            <?php
                printf(
                    '<h5>%s</h5>',
                    esc_html( get_field( 'courses__marketplace_cta_subtitle', 'option' ) ) 
                );
                
                printf(
                    '<h3>%s</h3>',
                    esc_html( get_field( 'courses__marketplace_cta_title', 'option' ) ) 
                );
                
                printf(
                    '<p>%s</p>',
                    esc_html( get_field( 'courses__marketplace_cta_description', 'option' ) ) 
                );
                
                printf(
                    '<a href="%s" class="es-btn">%s</a>',
                    esc_url( get_field( 'courses__marketplace_cta_btn_url', 'option' ) ),
                    esc_html( get_field( 'courses__marketplace_cta_btn_label', 'option' ) ),
                );
            ?>
        </div>
    </div>
</div>