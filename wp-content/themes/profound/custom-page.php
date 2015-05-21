<?php /* Template Name: custom-page */ ?>

<?php get_header() ?>

<div id="content-section" class="content-section blog-page grid-col-16">
    <div class="inner-content-section">
        
            <?php if( have_posts() ) : ?>

                    <div class="custom-page loop-container-section grid-pct-65 grid-float-left clearfix custom-content">
                    
                        <?php
                        // Here starts the loop
                        query_posts('cat=3');
                        while (have_posts()) : the_post();
                        ?> 
                            <!-- <div class="title-page"><?php the_title() ?></div> -->
                        <?php
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