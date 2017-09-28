<?php
/**
 * The template for displaying the menu
 *
 * Contains the menu items
 *
 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
 * @link https://codex.wordpress.org/Class_Reference/Walker
 * @package Acajou
 */

?>
<div class="nav-wrapper large-10 small-9 columns">
    <nav class="top-bar" data-topbar >
        <ul class="title-area">
            <li class="name">
                 </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span><?php esc_html_e( 'Menu', 'acajou' );?></span></a></li>
        </ul>
        <section class="top-bar-section">
            <?php
                /* Primary menu */
                if(function_exists('wp_nav_menu')) {
                    wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => '',
                    'container_class' => '',
                    'container_id' => '',
                    'menu_id' => 'main-menu',
                    'menu_class' => 'right main-nav',
                    'fallback_cb' => 'wp_page_menu',
                    'walker' => new Multilevel_Menu()
                    )); 
                }
            ?>
        </section><!--/top-bar-section-->
    </nav><!--/top-bar-->
</div><!--/nav-wrapper-->   
<div class="clearfix"></div>