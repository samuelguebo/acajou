<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acajou
 */

?>
    <footer>
        <div class="footer-bar parallax">
            <div class="row back-to-top-wrapper">
                <a href="#0" class="back-to-top" id="back-to-top"><i class="fa fa-angle-up"></i></a><!-- back to top-->
                <div class="large-4 small-up-4 columns widget left widget-search">
                    <h5 class="widget-title">Search on this website</h5> 
                    <div class="row">
                        <div class="large-12 columns">
                          <div class="row collapse">
                            <div class="small-10 columns">
                              <input type="text">
                            </div>
                            <div class="small-2 columns">
                              <a href="#" class="button postfix"><i class="fa fa-search"></i></a>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .footer-bar -->
        <div class="row">
                <div class="small-6 large-6 columns">
                    <p class="copyright">&copy; 2016 | Copyright 2016 Samuel Guébo.<br><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'acajou' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'acajou' ), 'WordPress' ); ?></a> and available on <a href="https://github.com/samuelguebo/acajou"><i class="fa fa-login"></i>Github</a></p>
                </div>
                
                <div class="small-2 large-2 columns socials right">
                    <ul>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    </ul>
                </div>
        </div><!-- copyright-->
    
    </footer>
    <?php get_footer();?>
</body>

</html>