<?php
/**
 * Template part for displaying articles in loop
 *
 * @link https://codex.wordpress.org/The_Loop
 *
 * @package Acajou
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
    <!--post/-->
    <div class="post-item-caption">
            <p class="post-item-date wrap"> <span class="day"><?php echo get_the_date('d')?></span> <span class="month-year"><?php echo get_the_date('M. Y')?></span> </p>
        <div class="panel">
            <h6 class="post-item-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h6>
            <p><?php the_excerpt();?></p> 
            <a href="<?php the_permalink();?>" class="small button post-item-buttom"><?php _e('Read more','acajou')?></a> 
            <?php if ( get_edit_post_link() ) : ?>
                <a href="<?php echo get_edit_post_link();?>" class="small button alert"><i class="fa fa-edit"></i> <?php _e('Edit','acajou')?></a> 
                    
            <?php endif; ?>
        </div>
    </div>
</article>
