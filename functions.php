<?php
/**
 * Acajou functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Acajou
 */

if ( ! function_exists( 'acajou_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function acajou_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Acajou, use a find and replace
	 * to change 'acajou' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'acajou', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    add_image_size( 'post-thumb', 370,210, array( 'left', 'top' ) );
    add_image_size( 'single-thumb', 770,330, array( 'left', 'top' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'acajou' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );



	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'acajou_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function acajou_widgets_init() {
    register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'acajou' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'acajou' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s widget">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'acajou' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'acajou' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s large-4 small-up-4 columns widget left">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'acajou_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function acajou_scripts() {
    // CSS
	wp_enqueue_style( 'normalize', get_template_directory_uri().'/css/normalize.min.css' );
	wp_enqueue_style( 'foundation-css', get_template_directory_uri().'/css/foundation.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );
    
    $style = "style";
    if(""!=get_theme_mod('acajou_theme_color')){
        
        $color = get_theme_mod('acajou_theme_color');
        $style = 'style-'.$color;
    } 
	wp_enqueue_style( 'acajou-style', get_template_directory_uri().'/css/'.$style.'.css' );
    
    // JS
	wp_enqueue_script( 'modernizer', get_template_directory_uri().'/js/modernizr.min.js');
	wp_enqueue_script( 'jquery', get_template_directory_uri().'/js/jquery.min.js');
	wp_enqueue_script( 'foundation-js', get_template_directory_uri().'/js/foundation.min.js');
	wp_enqueue_script( 'typed', get_template_directory_uri().'/js/typed.js');
	wp_enqueue_script( 'slippry-slider', get_template_directory_uri().'/js/slippry.min.js');
	wp_enqueue_script( 'scroll-reveal', get_template_directory_uri().'/js/scrollreveal.min.js');
	wp_enqueue_script( 'main-scripts', get_template_directory_uri().'/js/scripts.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
function acajou_admin_js($hook) {
    /*
    if ( 'customize.php' != $hook ) {
        return;
    }
    */
    wp_enqueue_script( 'acajou_admin_js', get_template_directory_uri() . '/js/admin.js' );

}
add_action( 'wp_enqueue_scripts', 'acajou_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
