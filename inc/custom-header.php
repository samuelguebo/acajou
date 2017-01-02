<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Acajou
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses acajou_header_back()
 */

$args = array(
		'flex-height'            => true,
		'width'                  => 1350,
		'height'                 => 310,
		'default-image'          => get_template_directory_uri() . '/img/back.jpg',
	);
add_theme_support( 'custom-header', $args );

/**
 * Set up the default content width
 *
 */
if ( ! isset( $content_width ) ) $content_width = 900;

/**
 *  Taking advantage of the Custom Logo API
 *  @link https://codex.wordpress.org/Theme_Logo
 *  @link https://www.sitepoint.com/wordpress-custom-logo-api/
 */
add_theme_support('custom-logo');
add_image_size('acajou-logo', 150, 150);
add_theme_support('custom-logo', array(
    'size' => 'acajou-logo'
));
