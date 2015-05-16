<?php /* Template Name: custom-page */ ?>

<?php get_header() ?>

<div id="content-section" class="content-section blog-page grid-col-16">
    <div class="inner-content-section">
        
            <?php if( have_posts() ) : ?>

                    <div class="loop-container-section grid-pct-65 grid-float-left clearfix custom-content">
                    
                        <?php
                        // Here starts the loop
                        query_posts('cat=4');
                        while (have_posts()) : the_post();
                        ?> 
                            <div class="title-page"><?php the_title() ?></div>
                        <?php
                            preg_match("/(?:\w+(?:\W+|$)){0,10}/", the_content(), $matches);
                            $matches[0];
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