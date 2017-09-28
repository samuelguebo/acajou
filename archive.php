<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acajou
 */

get_header(); ?>

            <section class="category-row row">
                <section id="breadcrumbs">
                    <div class="breadcrumbs row">
                        <?php if (function_exists('acajou_custom_breadcrumbs')) acajou_custom_breadcrumbs(); ?>
                    </div>
                </section>
                
                <!-- post list-->
                <section class="large-9 columns main-column">
                    <h1 class="category-title"><?php the_archive_title(); ?></h1>
                    <div class="category-title-line large-2 large-centered columns"></div>
                    <div class="post-list clearfix">
                        <?php
                            if ( have_posts() ) :
                                /* Start the Loop */
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // for pagination purpose
                                while ( have_posts() ) : the_post();

                                   if(has_post_thumbnail()){
                                    get_template_part( 'template-parts/content', 'article' );
                                    }else {
                                        get_template_part( 'template-parts/content', 'article-without-thumb' );
                                    }

                                endwhile;

                            else :

                                get_template_part( 'template-parts/content', '404' );

                            endif; ?>
                    </div>
                    <div class="pagination-wrapper columns large-4 large-centered" >
                        <?php the_posts_pagination( array(
                            'mid_size' => 2,
                            'prev_text' => __( '&laquo;', 'acajou' ),
                            'next_text' => __( '&raquo;', 'acajou' ),
                            'screen_reader_text' => ' '
                        ) ); ?>
                    </div>
                </section>
                <?php get_sidebar();?>
            </section>
<?php
get_footer();
