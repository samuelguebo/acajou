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
        <section class="row main-row">
            <div class="category-row">
                <h1 class="category-title"><?php acajou_from_blog_title();?></h1>
                <div class="category-title-line large-2 large-centered columns"></div>
                <!-- post list-->
                <div class="post-list clearfix">
                    <?php
                        if ( have_posts() ) :
                            /* Start the Loop */
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // for pagination purpose
                            while ( have_posts() ) : the_post();

                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                    
                                //get_template_part( 'template-parts/content', get_post_format() );
                                get_template_part( 'template-parts/content', 'article' );

                            endwhile;

                        else :

                            get_template_part( 'template-parts/content', 'article' );

                        endif; ?>
                </div>
                <div class="pagination-wrapper" >
                    <?php if(function_exists('acajou_pagination')) { 
                        acajou_pagination($wp_query, $paged); 
                    }else {
                        posts_nav_link();
                    } ?>
                </div>
            </div>
        </section>
<?php
get_footer();
