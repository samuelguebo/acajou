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
                <div class="post-pagination clearfix">
                    <?php
                    if ( is_singular() && $numpages > 1 ):?>
                        <div class="pagination-wrapper" >
                            <?php wp_link_pages();?> 
                        </div>
                        <?php 
                    endif;?>
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