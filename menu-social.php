
<?php
$is_menu_active = wp_nav_menu( array( 'theme_location' => 'social', 'echo' => false ));
if ( has_nav_menu( 'social' )  &&
    count(wp_get_nav_menus()) > 1
    && ($is_menu_active  !== false)) {

	wp_nav_menu(
		array(
			'theme_location'  => 'social',
			'container'       => 'div',
			'container_id'    => 'menu-social',
			'container_class' => 'menu',
			'menu_id'         => 'menu-social-items',
			'menu_class'      => 'menu-items',
			'depth'           => 1,
			'link_before'     => '<span class="screen-reader-text">',
			'link_after'      => '</span>',
			'fallback_cb'     => '',
		)
	);

}