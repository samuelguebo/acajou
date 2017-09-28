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
                <?php the_post_thumbnail( 'single-thumb', array(
                    'class' => 'delay placeholder',
                    'title' => get_the_title()) );?>
            </div>        
        <?php endif;?>
            <div class="panel">
                <div class="post-content">
                    <?php the_content();?> 
                </div>
            </div>
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