<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the body all content after and containing the bottom widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acajou
 */
?>
    <footer id="footer">
        <div class="footer-bar parallax">
            <div class="row back-to-top-wrapper">
                <a href="#0" class="back-to-top" id="back-to-top"><i class="fa fa-angle-up"></i></a><!-- back to top-->
                <?php dynamic_sidebar( 'footer-1' );?>
            </div>
        </div><!-- .footer-bar -->
        <div class="row">
                <div class="small-6 large-6 columns">
                    <p class="copyright"><?php bloginfo('title');?> | <?php _e('Developed by ','acajou')?>Samuel Guebo.<br><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'acajou' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'acajou' ), 'WordPress' ); ?></a> <?php _e('and available on','acajou')?> <a href="https://github.com/samuelguebo/acajou"><i class="fa fa-github"></i> Github</a></p>
                </div>

                <div class="small-3 large-3 columns socials right">
                    <ul>
                        <?php get_template_part('menu', 'social'); ?>
                    </ul>
                </div>
        </div><!-- copyright-->

    </footer>
    <?php wp_footer(); ?>
</body>

</html>