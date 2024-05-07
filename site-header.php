<header>
    <div class="es-site-container">
        <div class="es-site-inner-container">
            <div class="es-site-header-left">
                <div class="site-logo">
                    <?php
                        es_img_with_srcset(
                            THEME_URI . '/assets/img/engispace-logo-white.png',
                            THEME_URI . '/assets/img/engispace-logo-white@2x.png',
                        );
                    ?>
                </div>
                <div class="site-search-form">
                    <form action="">
                        <div class="es-form-control">
                            <input type="text" placeholder="<?php esc_attr_e( 'Search engispace', 'engispace' ); ?>">
                        </div>
                    </form>
                </div>
            </div>
            <div class="es-site-header-right">
                <div class="site-menu">
                    <ul>
                        <li>
                            <a href="#">
                                <img src="<?php echo THEME_URI . '/assets/img/menu-book.png' ?>" alt="">
                                <span>Courses</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo THEME_URI . '/assets/img/forum-icon.png' ?>" alt="">
                                <span>Forum</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo THEME_URI . '/assets/img/directory-icon.png' ?>" alt="">
                                <span>Directory</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo THEME_URI . '/assets/img/library-icon.png' ?>" alt="">
                                <span>Library</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?php echo THEME_URI . '/assets/img/marketplace-icon.png' ?>" alt="">
                                <span>Marketplace</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="site-right-buttons">
                    <div class="es-logged-in-user">
                        <span class="es-user-name">Jason</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>