<?php
/**
 * Acajou Theme Customizer
 *
 * @package Acajou
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function acajou_customize_register( $wp_customize ) {
	
    // Create sections for socials links
    $wp_customize->add_section("social_links", array(
		"title" => __("Social links", "acajou"),
		"priority" => 30,
	));
    
    // Facebook link
    $wp_customize->add_setting("facebook_url", array(
		"default" => "",
		"transport" => "refresh",
	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"facebook_url",
		array(
			"label" => __("Enter Facebook url", "acajou"),
			"section" => "social_links",
			"settings" => "facebook_url",
			"type" => "text",
		)
	));
    
    // Twitter link
    $wp_customize->add_setting("twitter_url", array(
		"default" => "",
		"transport" => "refresh",
	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"twitter_url",
		array(
			"label" => __("Enter Twitter url", "acajou"),
			"section" => "social_links",
			"settings" => "twitter_url",
			"type" => "text",
		)
	));
    
    // Youtube link
    $wp_customize->add_setting("youtube_url", array(
		"default" => "",
		"transport" => "refresh",
	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"youtube_url",
		array(
			"label" => __("Enter Youtube url", "acajou"),
			"section" => "social_links",
			"settings" => "youtube_url",
			"type" => "text",
		)
	));
    
    // Github link
    $wp_customize->add_setting("github_url", array(
		"default" => "",
		"transport" => "refresh",
	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"github_url",
		array(
			"label" => __("Enter Github url", "acajou"),
			"section" => "social_links",
			"settings" => "github_url",
			"type" => "text",
		)
	));
    
    
    /*
     * Theme colors
     *
     */
    

    
}
add_action( 'customize_register', 'acajou_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function acajou_customize_preview_js() {
	wp_enqueue_script( 'acajou_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
