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
function acajou_header_background(){
    if ( get_header_image() ) {
        echo 'style="background-image:url('.esc_url(get_header_image()).');"';
    }
}
