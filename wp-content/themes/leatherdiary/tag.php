<?php
/**
 * The tag archive template file.
 * @package LeatherDiary
 * @since LeatherDiary 1.0.0
*/
get_header(); ?>
  
  <div id="main-content">
    <div class="breadcrumb-navigation-wrapper"><?php leatherdiary_get_breadcrumb(); ?></div>
    <div id="content"> 
<?php if ( have_posts() ) : ?>     
      <h1 class="entry-headline"><?php printf( __( 'Tag Archive: %s', 'leatherdiary' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
<?php if ( tag_description() ) : ?><div class="archive-meta"><?php echo tag_description(); ?></div><?php endif; ?>
<?php while (have_posts()) : the_post(); ?>      
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?>
<?php leatherdiary_content_nav( 'nav-below' ); ?> 
    </div> <!-- end of content -->
<?php if ($leatherdiary_options_db['leatherdiary_display_sidebar_archive'] == 'Display'){ ?> 
<?php get_sidebar(); ?>
<?php } ?>
  </div> <!-- end of main-content -->
<?php get_footer(); ?>