<?php
/*
 * Template for displaying the loop
 * 
 * @package Profound
 */
global $profound_options;
?>

<div class="loop-section-col grid-col-16 grid-float-left <?php echo apply_filters('profound_loop_section_col_class_filter', '') ?>">
    <div class="loop-section">
        <div id="post-<?php the_ID() ?>" <?php post_class() ?>>
             <div class="loop-post-title">

                <?php // if(!$profound_options['disable_style_date']): ?>
                 <div class="loop-stylish-date">
                     <div class="loop-stylish-date-month">
                        <?php echo get_the_time('M') ?>
                     </div>
                     <div class="loop-stylish-date-num">
                        <?php echo get_the_time('j') ?>
                     </div>
                 </div>
                 <?php // endif ?>


                  <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo __('Permalink to', 'profound'). ' ' ?><?php the_title_attribute() ?>"><?php the_title() ?></a></h1>

                <?php if(!$profound_options['disable_blog_p_meta']): ?>
                <div class="loop-post-meta">
                     <span><?php _e('Written on', 'profound') ?> </span><span class="loop-meta-date"><?php echo get_the_time('M, d, Y') ?></span>
                     <span><?php _e('by', 'profound') ?> </span><span class="loop-meta-author"><?php the_author_posts_link() ?></span>
                     
                     <?php if(!$profound_options['disable_blog_p_meta_comments']): ?>
                     <span class="loop-meta-comments"> | <?php comments_popup_link( __('No comments yet', 'profound'), __('1 comment', 'profound'), '% ' . __('comments', 'profound'), 'comments-link', __('No Comments', 'profound')); ?></span>
                     <?php endif ?>
                     
                </div>
                <?php endif ?>

             </div>

             <div class="loop-post-excerpt clearfix">
                  <?php if ( has_post_thumbnail() && !$profound_options['disable_thumb']) { ?>
                    <div class="loop-post-text grid-col-16">
                        <div class="loop-thumbnail"><?php the_post_thumbnail( 'profoundThumb' ) ?></div>
                        <?php the_excerpt() ?></div>
                  <?php } else { ?>
                  <div class="loop-post-text grid-col-16"><?php the_excerpt() ?></div>
                  <?php } ?>
                  <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'profound') . '</span>', 'after' => '</div>')) ?>
             </div>

        </div>
    </div>
</div>