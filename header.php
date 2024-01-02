<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acajou
 */

?><!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php 
    if( false === get_option( 'site_icon', false ) ) {
    // Show favicon
        wp_site_icon(); 
    }
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

        <section class="nav-wrapper">
            <nav>
                <header class="home-menu">
                    <section class="top-bar-section">
                        <?php if(has_custom_logo()):?>
                            <section class="logo">
                                <a href="<?php echo esc_url(home_url()); ?>">
                                    <?php the_custom_logo();?>
                                </a>
                            </section>
                        <?php endif;?>
                        <?php
                            get_template_part('menu', 'main');
                        ?>
                    </section>
                    <section class="socials">
                        <ul class="columns ">
                            <?php get_template_part('menu', 'social'); ?>
                        </ul>
                    </section>

                </header>
            </nav>
        </section>
        <?php
            if(is_home() && is_front_page()):
                get_template_part('template-parts/content', 'slider');
            else:
                get_template_part('header-overlay');?>
                <?php if(!is_singular()):?>
                <section>
                    <h1 class="category-title"><?php the_archive_title();?></h1>
                    <div class="category-title-line large-2 large-centered columns"></div>
                </section>
                <?php endif;?>
        <?php endif;?>
