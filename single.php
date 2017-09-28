<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Acajou
 */

get_header(); ?>
    <section class="row single-row">
        <section id="breadcrumbs" class="clearfix">
            <div class="breadcrumbs row">
                <?php if (function_exists('acajou_custom_breadcrumbs')) acajou_custom_breadcrumbs(); ?>
            </div>
        </section>
        <section class="large-9 columns main-column">
            <?php
            while ( have_posts() ) : the_post();

                // Include the single post content template.
			     get_template_part( 'template-parts/content', 'single' );

            endwhile; // End of the loop.
            ?>
        </section>
        <?php get_sidebar();?>
    </section>
    <?php get_footer();?>