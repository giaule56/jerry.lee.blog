<?php
/*
 * Footer box (sidebar) section of Profound theme
 * 
 * @package Profound
 */
?>

<div id="sidebar-right-section" class="sidebar-right-section grid-pct-35 grid-float-left">
    
    <?php if ( !dynamic_sidebar( 'right_sidebar' ) ): ?>

        <div class="widget widget_recent_entries">
            <h4 class="widget-title"><?php _e( 'Recent Posts', 'profound' ); ?></h4>
            <ul><?php wp_get_archives( array( 'type' => 'postbypost', 'limit' => 5, 'format' => 'html' ) ); ?></ul>
        </div>
    
        <div class="widget widget_search">
            <h4 class="widget-title"><?php _e( 'Search', 'profound' ); ?></h4>
            <?php get_search_form(); ?>
        </div>

    <?php endif ?>
</div>