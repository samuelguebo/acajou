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
		echo 'large-4 medium-6 columns';
	}elseif(is_singular()) {
        echo '';
        
    }elseif(!is_front_page() && !is_home() && !is_singular()) {
        echo 'large-6 medium-6 columns';
        
    }
}
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
add_filter( 'wp_nav_menu_items', 'add_home_menu_item', 10, 2 );
function add_home_menu_item ( $items, $args ) {
    if ($args->theme_location == 'primary') {
        
            $items = '<li id="home-link" $class_names><a href="'.site_url().'" title="'.esc_html__( 'Home', 'acajou' ).'"><i class="fa fa-home"></i></a></li>'.$items;
        
    }
    return $items;
}

/**
 * Dealig with submenu items
 */
class Multilevel_Menu extends Walker_Nav_Menu
{
   function start_lvl(&$output, $depth)
   {
       $indent = str_repeat("\t", $depth);
       $output .= "\n$indent<ul class=\"dropdown\">\n";
   }
   function end_lvl(&$output, $depth)
   {
       $indent = str_repeat("\t", $depth);
       $output .= "$indent</ul>\n";
   }
    // adding arrow to top-menu
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

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
 * This functions prints a group of button for browsing through the other pages
 * The pagination logic is inspired from WP Page Numbers plugin and and article of * Codular.
 * 
 * @link https://wordpress.org/plugins/wp-page-numbers
 * @link http://codular.com/implementing-pagination
 */

function acajou_pagination($custom_query, $paged)
{
	$pagingString   = "<ul class=\"pagination\">\n";
    $postsPerPage   = get_option('posts_per_page');
    $pagesToShow    = ceil(($custom_query->found_posts)/ ($postsPerPage));
    
    $firstPage      = 1;
    $lastPage   = $pagesToShow;
    if($pagesToShow>10) $pagesToShow = 10;
    
    if($paged > $firstPage): // make sure previous page exists
        $pagingString .="<li class=\"arrow unavailable\">";
        $pagingString .= "<a href=\"" . get_pagenum_link($firstPage) . "\">&raquo;</a>";
        $pagingString .= "</li>\n";
        $pagingString .= '</ul>';
    endif;
    
    for($i=1;$i<=$pagesToShow;$i++):
        if($i== $paged): //highlight the current page
            $pagingString .= "<li class=\"current\">";
            $pagingString .= "<a href=\"" . get_pagenum_link($i) . "\">" . $i . "</a>";
            $pagingString .= "</li>\n";
        else:
            $pagingString .= "<li>";
            $pagingString .= "<a href=\"" . get_pagenum_link($i) . "\">" . $i . "</a>";
            $pagingString .= "</li>\n";
        endif;
    endfor;
    
    if($paged < $pagesToShow): // make sure next page exists
        $pagingString .="<li class=\"arrow unavailable\">";
        $pagingString .= "<a href=\"" . get_pagenum_link(($paged+$postsPerPage)+1) . "\">&raquo;</a>";
        $pagingString .= "</li>\n";
        $pagingString .= '</ul>';
    endif;
	
    echo $pagingString;

}