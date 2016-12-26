<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Acajou
 */

get_header(); ?>
    <section class="row" id="breadcrumbs">
        <ol class="breadcrumbs row">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="archive.php">Technology & culture</a></li>
            <li>We Should All Be Feminists</li>
        </ol>
    </section>
    <section class="row single-row">
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

