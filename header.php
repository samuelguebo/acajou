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
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php 
    if( false === get_option( 'site_icon', false ) ) {
    // Show favicon
        wp_site_icon(); 
    }
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
    if ( is_front_page() && is_home() ) : ?>
        <header <?php acajou_header_background();?>>
            <div class="overlay">
                <div class="row clearfix">
                        <?php if(has_custom_logo()):?>
                        <div class="small-2 large-2 columns logo">
                            <a href="<?php echo site_url(); ?>">  
                                <?php the_custom_logo();?>
                            </a>
                        </div>
                        <?php else:?>
                        <div class="small-2 large-2 columns">
                            <h2 class="site-title">
                                <a href="<?php echo site_url(); ?>"><?php bloginfo('title'); ?></a>
                            </h2>
                        </div>
                        <?php endif;?>
                    <?php get_template_part('menu'); ?>
                </div>
            <div class="row slogan">
                <?php if(has_custom_logo()):?>
                    <h1 class="title reveal"><?php bloginfo('title'); ?></h1>
                <?php endif;?>
                <h2 class="typed-strings" align="center">
                    <span id="typed" class="description"></span>
                </h2> 
                <div class="strings">
                    <p><?php bloginfo('description'); ?></p>
                </div> 
            </div><!--slogan/-->
            <div class="row socials">
                <ul class="large-3 large-centered medium-4 medium-centered small-centered small-7 columns ">
                    <?php get_template_part('menu', 'social'); ?>
                </ul>
            </div><!--socials/-->
        </div>
        </header>
    <?php else:?>
        <header <?php acajou_header_background();?>>
            <div class="overlay">
                <div class="row clearfix">
                        <?php if(has_custom_logo()):?>
                        <div class="small-2 large-2 columns logo">
                            <a href="<?php echo site_url(); ?>">  
                                <?php the_custom_logo();?>
                            </a>
                        </div>
                        <?php else:?>
                        <div class="small-2 large-2 columns">
                            <h2 class="site-title">
                                <a href="<?php echo site_url(); ?>"><?php bloginfo('title'); ?></a>
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