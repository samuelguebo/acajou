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
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
    if ( is_front_page() && is_home() ) : ?>
        <header <?php acajou_header_background();?>>
        <div class="overlay">
            <div class="row clearfix">
                <div class="small-3 large-2 columns logo">
                    <a href="<?php echo site_url('/'); ?>"> <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/acajou_logo.png"> </a>
                </div><!--logo/-->
                <?php get_template_part('menu'); ?>
            </div>
            <div class="row slogan">
                <h1 class="title reveal">Acajou</h1>
                <h2 class="typed-strings" align="center">
                    <span id="typed" class="description"></span>
                </h2> 
                <div class="strings">
                    <p>a minimalist woodstyle theme</p> 
                    <p>it <em>looks</em> like wood</p>
                    <p>and <em>tastes</em> like soup.</p>
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
                        <a href="<?php echo site_home_url(); ?>"> <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/acajou_logo.png"> </a>
                    </div>
                    <?php get_template_part('menu'); ?>
                </div>
            </div>
        </header>
    <?php endif;?>