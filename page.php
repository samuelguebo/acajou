<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
             get_template_part( 'template-parts/content', 'page' );

        endwhile; // End of the loop.
        ?>
    </section>
    <?php get_sidebar();?>
</section>
<?php get_footer();?>