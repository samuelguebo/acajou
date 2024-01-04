<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Acajou
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acajou_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'acajou_body_classes' );


/**
 * Add the appropriate class to post-item in the loop
 */
function acajou_post_item_class() {
		
	if ( is_front_page() || is_home()) {
		$classes[] = 'post-item column-third';
	}elseif(is_singular()) {
				$classes[] = 'post-item';
				
		}elseif(!is_front_page() && !is_home() && !is_singular()) {
				$classes[] = 'post-item column-half';
				
		}
		return $classes;
}
add_filter( 'post_class', 'acajou_post_item_class' );
add_action( 'wp_head', 'acajou_pingback_header' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function acajou_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'acajou_pingback_header' );

/**
 * Override the default excerpt length
 * @link https://wordpress.org/support/topic/changing-excerpt-length/
 */
function new_excerpt_length($length) {
		return 25;
}
add_filter('excerpt_length', 'new_excerpt_length');

/**
 * Adding the Home button to main menu
 */
add_filter( 'wp_nav_menu_items', 'add_hamburgermenu', 10, 2 );

function add_hamburgermenu ( $items, $args ) {
        if ($args->theme_location == 'primary') {

            $hamburger = '<li class="icon">';
            $hamburger .= '<a href="javascript:void(0);" onclick="toggleHamburgerMenu()">';
            $hamburger .= '<i class="hamburger"></i>';
            $hamburger .= '</a>';
            $hamburger .= '</li>';

            $items = $hamburger . $items;
        }

    return $items;
}
/**
 * Dealig with submenu items
 */
class Multilevel_Menu extends Walker_Nav_Menu
{
	 function start_lvl(&$output, $depth = 0, $args = array())
	 {
			 $indent = str_repeat("\t", $depth);
			 $output .= "\n$indent<ul class=\"dropdown\">\n";
	 }
	 function end_lvl(&$output, $depth = 0, $args = array())
	 {
			 $indent = str_repeat("\t", $depth);
			 $output .= "$indent</ul>\n";
	 }
		// adding arrow to top-menu
		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

				if ( !$element )
								return;

				$id_field = $this->db_fields['id'];

				//display this element
				if ( is_array( $args[0] ) )
								$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );

				//Adds the 'parent' class to the current item if it has children               
				if( ! empty( $children_elements[$element->$id_field] ) ) {
								array_push($element->classes,'has-dropdown not-click');
								//$element->title .= ' <i class="fa fa-caret-down"></i>';
				}

				$cb_args = array_merge( array(&$output, $element, $depth), $args);

				call_user_func_array(array(&$this, 'start_el'), $cb_args);

				$id = $element->$id_field;

				// descend only when the depth is right and there are childrens for this element
				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

								foreach( $children_elements[ $id ] as $child ){

												if ( !isset($newlevel) ) {
																$newlevel = true;
																//start the child delimiter
																$cb_args = array_merge( array(&$output, $depth), $args);
																call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
												}
												$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
								}
								unset( $children_elements[ $id ] );
				}

				if ( isset($newlevel) && $newlevel ){
								//end the child delimiter
								$cb_args = array_merge( array(&$output, $depth), $args);
								call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
				}

				//end this element
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'end_el'), $cb_args);
		}
}

/**
 * This functions prints a breadcrumb
 * The script is inspired from a Quality Trust article
 *
 * @link http://www.qualitytuts.com/wordpress-custom-breadcrumbs-without-plugin/
 */
if(!function_exists('acajou_custom_breadcrumbs')) {
        function acajou_custom_breadcrumbs() {

    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '/'; // delimiter between crumbs
    $home = __('Home','acajou'); // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<span class="active">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb

    global $post;
    $homeLink = home_url();

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1) echo '<a href="' . $homeLink . '">' . $home . '</a>';

    } else {

        echo '<a href="' . $homeLink . '">' . $home . '</a>';

        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, '');
            echo $before . __('Archive by category ','acajou').'"' . single_cat_title('', false) . '"' . $after;

        } elseif ( is_search() ) {
            echo $before . '"' . get_search_query() . '"' . $after;

        } elseif ( is_day() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
            echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>';
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                if ($showCurrent == 1) echo '' . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                if(is_array($cat) && isset($cat[0])) {
                    $cat = $cat[0];
                    $cats = get_category_parents($cat->term_id, TRUE, '');
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo $cats;
                    if ($showCurrent == 1) echo $before . get_the_title() . $after;
                }

            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, '');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
            if ($showCurrent == 1) echo '' . $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo $before . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) echo '';
            }
            if ($showCurrent == 1) echo  $before . get_the_title() . $after;

        } elseif ( is_tag() ) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

        } elseif ( is_author() ) {
             global $author;
            $userdata = get_userdata($author);
            echo $before . __('Articles posted by ','acajou') . $userdata->display_name . $after;

        } elseif ( is_404() ) {
            echo $before .__('Error 404','acajou')  . $after;
        }

    }
}
}
/*
* Prints the header background image
*
*/
function acajou_header_background(){
        if ( get_header_image() ) {
                echo 'style="background-image:url('.esc_url(get_header_image()).');"';
        }
}

/*
 * Get content out of the_custom_logo()
 */

function acajou_get_custom_logo() {
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                return $image[0];
}
add_filter( 'the_custom_logo', 'acajou_body_classes' );

/*
 * "From the blog"
 *
 */
 function acajou_from_blog_title(){
         $text = __("From the blog", "acajou");
         if(get_theme_mod( 'from_text' ) && ""!=get_theme_mod( 'from_text' )) {
                $text = get_theme_mod( 'from_text' );
         }
         echo $text;
 }


add_action( 'init', 'acajou_register_nav_menus' );

function acajou_register_nav_menus() {
        register_nav_menu( 'social', __( 'Social', 'acajou' ) );
}