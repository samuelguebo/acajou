<?php
/**
 * Template part for displaying articles in slider loop
 *
 * @link https://codex.wordpress.org/The_Loop
 *
 * @package Acajou
 */

?>
<div id="carouselControls" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        $args = [ 'posts_per_page' => 5,  'meta_query' => [ [ 'key' => 'featured', 'value' => 1 ] ] ];
        $slider_posts = new WP_Query($args);
        $i = 1;
        if ( $slider_posts->have_posts() ) :
            // custom params for my loop

            while ( $slider_posts->have_posts() ) : $slider_posts->the_post();?>

                <div class="carousel-item <?php echo $i ==1 ? 'active': '';?>">
                <?php $link = get_the_post_thumbnail_url(get_the_ID(), "slider-cover"); ?>
                    <div class="carousel-image">
                        <img src="<?= $link ?>" alt="..." />
                    </div>
                <div class="carousel-caption">
                    <div class="container">
                        <div class="section-title col-12">
                            <h2><?php the_title();?></h2>
                        </div>
                        <div class="excerpt">
                            <?php the_excerpt();?>
                        </div>
                        <a href="<?php the_permalink()?>" class="simple-btn">
                            <?php _e('Read more')?>
                        </a>
                    </div>
                </div>
            </div>
        <?php
                $i++;
            endwhile;

        endif; wp_reset_postdata();
        ?>
    </div>
    <a class="carousel-control-prev previous" href="#carouselControls" role="button" data-slide="prev" style="right: 0;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
    <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
</div>