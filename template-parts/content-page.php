<?php
/**
 * Template part for displaying static pages
 *
 * @link https://codex.wordpress.org/Pages
 *
 * @package Acajou
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
    <!--post/-->
    <h1 class="category-title"><?php the_title();?></h1>
    <div class="category-title-line large-4 columns"></div>
    <br>
    <div class="post-item-caption">
        <?php if ( has_post_thumbnail() ):?>
            <div class="post-item-image"> 
                <?php the_post_thumbnail( 'single-thumb',array('class' =>'delay placeholder') );?>
            </div>        
        <?php endif;?>
        <?php if(is_single()): global $numpages; ?>
            <div class="panel">
                <div class="post-content">
                    <?php the_content();?> 
                </div>
                <div class="pagination-wrapper columns large-4 large-centered clearfix" >
                    <?php the_posts_pagination( array(
                        'mid_size' => 2,
                        'prev_text' => __( '&laquo;', 'acajou' ),
                        'next_text' => __( '&raquo;', 'acajou' ),
                        'screen_reader_text' => ' '
                    ) ); ?>
                </div>
            </div>
        <?php endif;?>
    </div>
</article>
<?php 
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :?>
    <article class="post-item comment-wrapper">
        <div class="panel">
            <?php comments_template();?>
        </div>
    </article>
<?php endif;?>