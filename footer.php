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
                    <p class="copyright">&copy; 2016 | Copyright 2016 Samuel Guebo.<br><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'acajou' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'acajou' ), 'WordPress' ); ?></a> and available on <a href="https://github.com/samuelguebo/acajou"><i class="fa fa-github"></i> Github</a></p>
                </div>

                <div class="small-2 large-2 columns socials right">
                    <ul>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    </ul>
                </div>
        </div><!-- copyright-->

    </footer>
    <?php wp_footer(); ?>
</body>

</html>