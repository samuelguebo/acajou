<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acajou
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<!-- #secondary -->
<aside id="sidebar" class="large-3 columns">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>