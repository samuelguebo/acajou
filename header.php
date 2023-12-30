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
    <?php if ( is_front_page() && is_home() ) :?>
        <section class="nav-wrapper">
            <nav>
                <header class="home-menu">
                    <section class="top-bar-section">
                        <?php
                            get_template_part('menu-home');
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
        <?php get_template_part('template-parts/content', 'slider'); ?>
    <?php else:?>
        <header <?php acajou_header_background();?>>
            <div class="overlay">
                <div class="row clearfix">
                        <?php if(has_custom_logo()):?>
                        <div class="small-2 large-2 columns logo">
                            <a href="<?php echo esc_url(home_url()); ?>">
                                <?php the_custom_logo();?>
                            </a>
                        </div>
                        <?php else:?>
                        <div class="small-2 large-2 columns">
                            <h2 class="site-title">
                                <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('title'); ?></a>
                            </h2>
                            <p class="site-description">
                                <?php bloginfo('description'); ?>
                            </p>
                        </div>
                        <?php endif;?>
                    <?php get_template_part('menu'); ?>
                </div>
            </div>
        </header>
    <?php endif;?>