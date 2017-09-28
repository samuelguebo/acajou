<?php
/**
 * Template part for displaying 404 error message
 *
 * @link https://codex.wordpress.org/The_Loop
 *
 * @package Acajou
 */

?>

<div class="post-list not-found columns">
    <h4><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'acajou' ); ?></h4>

</div>

<div class="post-list not-found columns">
    <ol>
    <?php $lostposts = get_posts("numberposts=50&suppress_filters=0");
        if ( $lostposts ): ?>
            <?php foreach($lostposts as $lostpost):
                echo '<li class="large-4 columns"><a href="'.$lostpost->guid.'">'.$lostpost->post_title.'</a></li>';
            endforeach;
        endif;
    ?>
    </ol>
</div>