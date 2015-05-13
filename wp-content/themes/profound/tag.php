<?php
/**
 * Template for displaying tag archive posts.
 * 
 * @package Profound
 */
?>
<?php get_header() ?>

<div id="content-section" class="content-section grid-col-16">
    <div class="inner-content-section">

              <?php if( have_posts() ) : ?>

                    <div class="archive-meta-container">
                         <div class="archive-head">
                              <h1><?php _e( 'Tag Archives', 'profound' ) ?></h1>
                         </div>
                         <div class="archive-description">
                                <?php
                                $profound_tag_description = term_description();
                                    if ( ! empty( $profound_tag_description ) ) {
                                        echo $profound_tag_description;
                                    } else {
                                        printf(__('Archive of posts published in the category: %s', 'profound'), single_term_title( '', false ) );
                                    }
                                ?>
                         </div>
                       
                    </div><!-- Archive Meta Container ends -->
                    

                    <?php if( have_posts() ) : ?>

                    <div class="loop-container-section grid-pct-65 grid-float-left clearfix">

                        <?php
                            // Here starts the loop
                            while (have_posts()): the_post();
                                get_template_part('loop', get_post_format());
                            endwhile;
                        ?>                

                    </div><!-- loop-container-section ends -->
                    
                    <?php get_sidebar() ?>

                    <?php endif; ?>
                    
                    
                    <?php profound_archive_nav() // Calls the 'Previous' and 'Next' Post Links  ?>

              <?php else : ?>

                    <?php profound_404_show() // Function dedicated for handling empty queries. ?>

              <?php endif ?>

    </div><!-- inner-content-section ends -->
</div><!-- Content-section ends here -->

<?php get_footer() ?>