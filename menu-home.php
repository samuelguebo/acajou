

        <?php
        /* Primary menu */
        if(function_exists('wp_nav_menu')
        ) {
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => '',
                'container_class' => '',
                'container_id' => '',
                'menu_id' => 'main-menu',
                'menu_class' => 'main-nav',
                'fallback_cb' => 'wp_page_menu',
                'walker' => new Multilevel_Menu()
            ));
        }
        ?>