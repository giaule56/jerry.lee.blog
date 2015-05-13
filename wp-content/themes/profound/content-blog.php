<?php
/**
 * The Blog Content (mostly used on archive pages).
 * 
 * @todo Here sidebar is called in a different way then other archive files. Modify either this or others.
 * @package Profound
 */
global $profound_options;
?>

<div id="content-section" class="content-section grid-col-16 clearfix">
    
    <?php if(! $profound_options['disable_blog_heading']): ?>
    <!-- <div class="blog-heading-section grid-col-16 clearfix">
        <h2><?php echo apply_filters('profound_blog_heading_title', __('Our Daily News', 'profound')) ?></h2>
        <h6><?php echo apply_filters('profound_blog_heading_content', __('Putting special characters in the title should have no adverse effect on the layout or functionality.', 'profound')) ?></h6>
    </div> -->
    <?php endif; ?>

    <div class="inner-content-section grid-pct-65 grid-float-left">
        
            <?php if( have_posts() ) : ?>
        
                <div class="loop-container-section clearfix">

                <?php
                    // Here starts the loop
                    while( have_posts() ): the_post();
                        get_template_part( 'loop', 'home' );
                    endwhile;
                ?>
                </div>

                <?php profound_archive_nav(); // Calls the 'Previous' and 'Next' Post Links. ?>

            <?php else : ?>

                    <?php profound_404_show(); // Function dedicated for handling empty queries. ?>

            <?php endif;?>

        
    </div><!-- inner-content-section ends -->

<?php get_sidebar() ?>

</div><!-- Content-section ends here -->
