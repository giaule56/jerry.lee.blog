<?php
/**
 * The homepage file.
 * 
 * @package Profound
 */
?>
<?php get_header() ?>

<div id="content-section" class="content-section blog-page grid-col-16">
    <div class="inner-content-section">
        
            <?php if( have_posts() ) : ?>
        
            <div class="archive-meta-container">
                <div class="archive-head">
                    <?php echo '<h1>'.__('Our Blog', 'profound').'</h1>' ?>
                </div>
                <div class="archive-description">
                </div>
            </div><!-- Archive Meta Container ends -->

                    <div class="loop-container-section grid-pct-65 grid-float-left clearfix">
                    
                    <?php
                    // Here starts the loop
                    while( have_posts() ): the_post();
                        get_template_part( 'loop', 'home' );
                    endwhile;
                    ?>
                        
                    </div><!-- loop-container-section ends -->
                    
                    <?php get_sidebar() ?>

                <?php profound_archive_nav(); // Calls the 'Previous' and 'Next' Post Links. ?>

            <?php else : ?>

                    <?php profound_404_show(); // Function dedicated for handling empty queries. ?>

            <?php endif;?>

        
    </div><!-- inner-content-section ends -->
</div><!-- Content-section ends here -->

<?php get_footer() ?>