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
		$classes[] = 'post-item large-4 medium-6 columns';
	}elseif(is_singular()) {
        $classes[] = 'post-item';
        
    }elseif(!is_front_page() && !is_home() && !is_singular()) {
        $classes[] = 'post-item large-6 medium-6 columns';
        
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
        $pagingString .= "<a href=\"" . get_pagenum_link($firstPage) . "\">&laquo;</a>";
        $pagingString .= "</li>\n";
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
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
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
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, '');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
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
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . __('Articles posted by ','acajou') . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before .__('Error 404','acajou')  . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','acajou') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
 
  }
}
    
/**
 * Acajou Custom Title prints a title on archive pages : category, tag, author, etc.
 * Its logic is similar to the breadcrumbs.
 */

function acajou_custom_title() {        
    
  if (is_home() || is_front_page()) {
  
    echo 'From the blog';
  
  } else {
  
     if ( is_category() ) {
        echo single_cat_title('', false);
  
    } elseif ( is_search() ) {
      echo $before . __('Results for ','acajou'). get_search_query() . '"' . $after;
  
    } elseif ( is_day() ) {
      echo get_the_time('d').' '.get_the_time('F');
  
    } elseif ( is_month() ) {
      echo get_the_time('F').' '.get_the_time('Y');
  
    } elseif ( is_year() ) {
      echo get_the_time('Y');
  
    } elseif ( is_tag() ) {
      echo single_tag_title('', false);
  
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo __('Articles written by ','acajou') . $userdata->display_name;
  
    } elseif ( is_404() ) {
      echo __('Sorry, not found','acajou');
    }
  
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','acajou') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  
 
  }
} 
  /*
   * Print social links
   *
   */
    function acajou_social_links() {
        $socials = array('facebook','twitter','youtube','github');
        
        foreach($socials as $social){
            $id = $social.'_url';
            if(""!=get_theme_mod($id)){
                echo '<li class="reveal" id="'.$id.'"><a href="'.esc_url(get_theme_mod($id)).'"><i class="fa fa-'.$social.'"></i></a></li>';  
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
        if(has_custom_logo()) {
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            return $image[0];
        }else {
            return get_template_directory_uri().'/img/acajou_logo.png';
        }
    }
    add_filter( 'the_custom_logo', 'acajou_body_classes' );
    
    /*
     * Do the typing machine thing
     *
     */
     function acajou_typing_machine(){
         $text = "a minimalist woodstyle theme/ it looks like wood/ and tastes like soup.";
         if(get_theme_mod( 'typing_text' ) && ""!=get_theme_mod( 'typing_text' )) {
            $text = get_theme_mod( 'typing_text' );
         }
         $lines = explode('/', $text);
         foreach($lines as $line){
             echo '<p>';
                echo $line;
             echo '</p>';
         }
     }
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
    /*
     * Override the default post_thumbnail() content
     *
     */
    function acajou_get_attachment_id_from_src( $image_src ) {
        global $wpdb;
        $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
        $id = $wpdb->get_var($query);
        return $id;
    }
    function acajou_get_first_image($post_id) {
        $post = get_post($post_id);
        $post_content = $post->post_content;
        preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
        return $matches[1][0];
    }

    function acajou_modify_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
        if( '' == $html ) {
            $attr['class'] = 'default';
            global $post, $posts;
            ob_start();
            ob_end_clean();
            
            acajou_get_first_image($post_id);
            $first_img = acajou_get_first_image($post_id);
            if ( empty( $first_img ) ){
                $image_id = 129; // default image ID
            }
            else {
                //$image_id = get_attachment_id_from_src($first_img);
                $html = '<img src="' . $first_img . '" alt="' . $alt . '" class="' . $attr['class'] . '" />';
                
            }
        }
        return $html;
    }
    add_filter('post_thumbnail_html', 'acajou_modify_post_thumbnail_html', 10, 5);