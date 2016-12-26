<?php
/**
 * Template part for displaying articles in loop
 *
 * @link https://codex.wordpress.org/The_Loop
 *
 * @package Acajou
 */

?>

<article id="post-<?php the_ID(); ?>" class="post-item  <?php acajou_post_item_class();?>">
    <!--post/-->
    <h1 class="category-title" class="large-6 columns"><?php the_title();?></h1>
    <div class="category-title-line large-4 columns"></div>
    <br>
    <div class="post-item-caption">
        <?php if ( has_post_thumbnail() ):?>
            <div class="post-item-image"> 
                <?php the_post_thumbnail( 'single-thumb' );?>
                <p class="post-item-date"> 
                    <span class="day"><?php echo get_the_date('d')?></span> <span class="month-year"><?php echo get_the_date('M. Y')?>
                    </span> 
                </p>
            </div>        
        <?php endif;?>

        <div class="panel">
            <?php the_content();?>
            <div class="post-categories breadcrumbs">
                <?php $categories = get_the_category();
                    if ( $categories ): ?>
                        <span><?php _e('categories');?></span>
                        <?php foreach($categories as $cat):
                            echo '<span><a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a></span>';
                        endforeach;
                    endif;
                ?>
            </div><!-- .post-categories -->
            <div class="post-tags breadcrumbs">
                <?php $tags = get_the_tags(get_the_ID());
                    if ( $tags ): ?>
                        <span><?php _e('tags');?></span>
                        <?php foreach($tags as $tag):
                            echo '<span><a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a></span>';
                        endforeach;
                    endif;
                ?>
            </div><!-- .post-tags -->
            <div class="panel post-item-author row reveal">
                <div class="small-3 large-3 columns"> <?php echo get_avatar( get_the_author_meta(  get_the_author_ID() ), 120 ); ?> </div>
                <div class="small-9 large-9 columns">
                    <h3><?php _e('About the author','acajou'); ?></h3>
                    <div><?php echo nl2br(get_the_author_meta('description')); ?></div>
                </div>
            </div>
        </div>
        
    </div>
</article>
<article class="post-item comment-wrapper">
    <div class="panel">
        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>
    </div>
</article>
