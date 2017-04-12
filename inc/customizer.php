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
    
    /*
     * Theme colors using Customizer Custom Controls, 
     * @link https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
     *
     */
    require_once dirname(__FILE__) . '/class-palette_custom_control.php';
    
    
    $wp_customize->remove_control('header_textcolor'); // remove existing Headline color setting
    $wp_customize->add_setting(
		'acajou_theme_color', array(
			'default' => '',
            'sanitize_callback'	=> 'acajou_sanitize_colors'

		)
	);
    
    $wp_customize->add_control(
            new Palette_Custom_Control(
                $wp_customize, 'acajou_theme_color', array(
                    'label' => __( 'Theme color', 'acajou' ),
                    'section' => 'colors',
                    'settings' => 'acajou_theme_color',
                )
            )
        );
    
     /*
     * From the blog text
     * 
     *
     */
    // Create sections for socials links
    $wp_customize->add_section('acajou_from_section', array(
		'title' => __('From the blog', 'acajou'),
		'priority' => 30,
	));
    
    // Typing lines
    $wp_customize->add_setting('from_text', array(
		'default' => 'From the blog',
		'transport' => 'refresh',
        'sanitize_callback'	=> 'acajou_sanitize_text'

	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'from_text',
		array(
			'label' => __('Replace the defaut &laquo; From the blog &raquo; text', 'acajou'),
			'section' => 'acajou_from_section',
			'settings' => 'from_text',
			'type' => 'textarea',
		)
	));
    
    /**
     *  Show home icon in menu 
     */
    // Create sections for socials links
    $wp_customize->add_section('acajou_home_icon_section', array(
		'title' => __('Home icon', 'acajou'),
		'priority' => 100,
	));
    
    // Typing lines
    $wp_customize->add_setting('home_icon', array(
		'default' => '1',
		'transport' => 'refresh',
        'sanitize_callback'	=> 'acajou_sanitize_checkbox'

	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'home_icon',
		array(
			'label' => __('Show home icon in menu?', 'acajou'),
			'section' => 'acajou_home_icon_section',
			'settings' => 'home_icon',
			'type' => 'checkbox',
		)
	));
    
}
add_action( 'customize_register', 'acajou_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function acajou_customize_preview_js() {
	wp_enqueue_script( 'acajou_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

/* Validate user input */
get_template_part('inc/customizer-sanitize'); 
