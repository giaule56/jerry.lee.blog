<?php
/*
 * Template for displaying footer.
 * 
 * @package Profound
 */
?>
<?php global $profound_options ?>
<?php get_sidebar('footer') ?>

            <?php if(!$profound_options['disable_footer']): ?>
            <div class="footer-bg-section grid-col-16 clearfix">
                <div id="footer-section" class="footer-section grid-col-16">
                    <?php if($profound_options['show_copyright']): ?>
                        <div id="copyright" class="copyright"><?php _e( 'Copyright', 'profound' ) ?> <?php echo date( 'Y' ) ?> <?php if( $profound_options['footer_name'] ) { echo esc_html( $profound_options['footer_name'] ); } ?> | <?php _e( 'Powered by', 'profound' ) ?> <a href="http://www.wordpress.org">WordPress</a> | <?php _e( 'Profound theme by', 'profound' ) ?> <a href="http://www.mudthemes.com/" target="_blank">mudThemes</a></div>
                    <?php endif ?>
                        <?php  profound_social_section_show() ?>
                </div>
            </div>
            <?php endif; ?>
        </div><!-- wrapper ends -->
    </div><!-- parent-wrapper ends -->
    <?php wp_footer(); ?>
</body>
</html>