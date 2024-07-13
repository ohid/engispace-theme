<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="es-user-personal-details">
    <?php
        es_img_with_srcset(
            THEME_URI . '/assets/img/profile-avatar.png'
        );
    ?>
    <div class="es-person-name">
        <h3>Jeffrey Gonzales</h3>
        <?php echo es_get_svg_icon( '/assets/img/pencil' ); ?>
    </div>
    <p>Co-founder at Rendevous & Project Managing other awesome projects.</p>
</div>

<div class="es-user-details-section">
    <div class="es-title">
        <h4>Contact</h4>
        <span class="es-icon">
            <?php echo es_get_svg_icon( '/assets/img/pencil' ); ?>
        </span>
    </div>
    <div class="es-ups-content">
        <ul>
            <li>
                <span class="es-icon"><?php echo es_get_svg_icon( '/assets/img/phone' ); ?></span>
                <div>
                    <p>9874597034580985</p>
                </div>
            </li>
            <li>
                <span class="es-icon"><?php echo es_get_svg_icon( '/assets/img/email' ); ?></span>
                <div>
                    <p>mail@engispace.com</p>
                </div>
            </li>
            <li>
                <span class="es-icon"><?php echo es_get_svg_icon( '/assets/img/link' ); ?></span>
                <div>
                    <p><a href="">http://gstuffpro.com</a></p>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- 
<div class="es-user-details-section es-user-cv-section">
    <div class="es-title">
        <h4>CSV Resume</h4>
        <span class="es-icon">
            <?php // echo es_get_svg_icon( '/assets/img/pencil' ); ?>
        </span>
    </div>
    <div class="es-ups-content">
        <ul>
            <li>
                <?php echo es_get_svg_icon( '/assets/img/filezip' ); ?>
                <div>
                    <p><a href="http://gstuffpro.com">filename.zip</a></p>
                </div>
            </li>
        </ul>
    </div>
</div> -->