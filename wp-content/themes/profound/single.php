<?php
/*
 * Template for displaying single posts.
 * 
 * @package Profound
 */
global $profound_options;
?>
<?php get_header() ?>

<div id="content-section" class="content-section grid-col-14">
    <div id="post-<?php the_ID() ?>" <?php post_class('inner-content-section') ?>>
        
              <?php if( have_posts() ) : while( have_posts() ): the_post() ?>

                    <div class="post-title">
                    <?php if ( is_front_page() ): ?>
                        <h1 class="front-page"><?php the_title() ?></h1>
                         <!-- <div class="under-line"></div> -->
                    <?php else: ?>
                        <h1 class="inner-page" style="color: rgb(65, 168, 255) !important;"><?php the_title() ?></h1>
                         <!-- <div class="under-line"></div> -->
                    <?php endif ?>
                    </div>

                    <?php if(!$profound_options['disable_post_meta']): ?>
                    <div class="post-meta">
                        <?php 
                        printf( __( '<span class="meta-date-url">Posted on</span> %1$s<span class="meta-author-url">, By %2$s </span>', 'profound' ),
                            sprintf( '<span class="entry-date">%1$s</span>',
                            get_the_date()
                        ),
                        sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                            get_author_posts_url( get_the_author_meta( 'ID' ) ),
                            esc_attr( sprintf( __( 'View all posts by %s', 'profound' ), get_the_author() ) ),
                            get_the_author()
                        )) ?>
                    </div>
                    <?php endif ?>

                    <div class="post-content">
                         <?php the_content() ?>
                         <?php wp_link_pages(array('before' => '<div class="post-nav-link"><span>' . __('Pages:', 'profound') . '</span>', 'after' => '</div>')) ?>
                    </div>

                    <div class="post-below-content">
                    	<?php edit_post_link( __( 'Edit', 'profound' ), '<div class="edit-link">', '</div>' ) ?>
                        <p class="tags-below-content"><?php the_tags( __( 'Tags: ', 'profound' ) , ' ', '') ?></p>
                    </div>

                    <?php profound_post_nav() ?>

                    <?php comments_template( '', true ) ?>

              <?php endwhile ?>

              <?php endif ?>

        
    </div><!-- inner-content-section ends -->
</div><!-- Content-section ends here -->

<?php get_footer() ?>