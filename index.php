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
                                if(has_post_thumbnail()){
                                    get_template_part( 'template-parts/content', 'article' );
                                }else {
                                    get_template_part( 'template-parts/content', 'article-without-thumb' );
                                }

                            endwhile;

                        else :

                            get_template_part( 'template-parts/content', 'article' );

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
            </div>
        </section>
<?php
get_footer();
