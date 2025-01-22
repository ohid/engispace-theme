<?php 

$header_banner = get_field('header_banner', 'option');

?>

<div class="es-forum-header-banner">
    <div class="es-site-container">
        <div class="es-fhb-inner">
            <?php 
                if ( $header_banner ) {
                    foreach(  $header_banner as $banner ) {
                        ?>
                        <div class="es-fhb-item">
                            <img src="<?php echo $banner['banner_image'] ?>" alt="">
                            <h4><?php echo $banner['banner_title'] ?></h4>
                            <p><?php echo $banner['banner_description'] ?></p>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</div>