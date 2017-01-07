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
    <link rel="icon" type="image/png" href="<?php echo acajou_get_custom_logo(); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
    if ( is_front_page() && is_home() ) : ?>
        <header <?php acajou_header_background();?>>
        <div class="overlay">
            <div class="row clearfix">
                <div class="small-3 large-2 columns logo">
                    <a href="<?php echo home_url(); ?>"> <img src="<?php echo acajou_get_custom_logo(); ?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>"> </a>
                </div><!--logo/-->
                <?php get_template_part('menu'); ?>
            </div>
            <div class="row slogan">
                <h1 class="title reveal"><?php bloginfo('title'); ?></h1>
                <h2 class="typed-strings" align="center">
                    <span id="typed" class="description"></span>
                </h2> 
                <div class="strings">
                    <?php acajou_typing_machine();?>
                </div> 
            </div><!--slogan/-->
            <div class="row socials">
                <ul class="large-3 large-centered medium-4 medium-centered small-centered small-7 columns ">
                    <?php acajou_social_links();?>
                </ul>
            </div><!--socials/-->
        </div>
        </header>
    <?php else:?>
        <header>
            <div class="overlay">
                <div class="row">
                    <div class="small-2 large-2 columns logo">
                        <a href="<?php echo home_url(); ?>"> <img src="<?php echo acajou_get_custom_logo(); ?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>"> </a>
                    </div>
                    <?php get_template_part('menu'); ?>
                </div>
            </div>
        </header>
    <?php endif;?>