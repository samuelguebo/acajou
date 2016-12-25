<?php
/**
 * The template for displaying search forms
 *
 *
 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
 * @link https://codex.wordpress.org/Class_Reference/Walker
 * @package Acajou
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="row collapse">
            <div class="small-10 columns">
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'acajou' ); ?>" value="<?php echo get_search_query(); ?>" name="s" /> 
            </div>
            <div class="small-2 columns"> 
            <button type="submit" class="search-submit button small"><span class="screen-reader-text"><i class="fa fa-search"></i></span></button>
            </div>
        </div>
</form>
