<?php
/**
 * Template for displaying archive page.
 * 
 * @package Profound
 */
?>
<?php get_header() ?>

<div id="content-section" class="content-section grid-col-16">
    <div class="inner-content-section">
        
        <?php if (have_posts()) : ?>

            <div class="archive-meta-container">
                <div class="archive-head">
                    <h1><?php if (is_day()) : ?>
                            <?php printf(__('Daily Archives: %s', 'profound'), '<span>' . get_the_date() . '</span>'); ?>
                        <?php elseif (is_month()) : ?>
                            <?php printf(__('Monthly Archives: %s', 'profound'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'profound')) . '</span>'); ?>
                        <?php elseif (is_year()) : ?>
                            <?php printf(__('Yearly Archives: %s', 'profound'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'profound')) . '</span>'); ?>
                        <?php else : ?>
                            <?php _e('Blog Archives', 'profound'); ?>
                        <?php endif; ?></h1>
                </div>
                <div class="archive-description">
                    <?php printf(__('<p>Archive of posts published in the specified %s </p>', 'profound'), profound_date_text()) ?>
                </div>
            </div><!-- Archive Meta Container ends -->
            
            <div class="loop-container-section grid-pct-65 grid-float-left clearfix">

                <?php
                    // Here starts the loop
                    while (have_posts()): the_post();
                        get_template_part('loop', 'archive');
                    endwhile;
                ?>                
                
            </div><!-- loop-container-section ends -->
            
            <?php get_sidebar() ?>

            <?php profound_archive_nav() // Calls the 'Previous' and 'Next' Post Links.  ?>

        <?php else : ?>

            <?php profound_404_show() // Function dedicated for handling empty queries.  ?>

        <?php endif; ?>

    </div> <!-- inner-content-section ends here -->
</div><!-- Content-section ends here -->

<?php get_footer() ?>