<?php
/**
 * Profound Theme functions and definitions
 * 
 * @package Profound
 * @since 1.0
 */


/**
 * Profound Theme Constants
 * 
 * @since 1.0
 */
define('PROFOUND_PRO', FALSE );
define('PROFOUND_ASSETS_URL', get_template_directory_uri() . '/assets/');
define('PROFOUND_GLOBAL_URL', PROFOUND_ASSETS_URL . 'global/');
define('PROFOUND_GLOBAL_JS_URL', PROFOUND_ASSETS_URL . 'global/js/');
define('PROFOUND_GLOBAL_IMAGES_URL', PROFOUND_ASSETS_URL . 'global/images/');
define('PROFOUND_GLOBAL_CSS_URL', PROFOUND_ASSETS_URL . 'global/css/');
define('PROFOUND_ADMIN_URL', PROFOUND_ASSETS_URL . 'admin/');
define('PROFOUND_ADMIN_JS_URL', PROFOUND_ASSETS_URL . 'admin/js/');
define('PROFOUND_ADMIN_IMAGES_URL', PROFOUND_ASSETS_URL . 'admin/images/');
define('PROFOUND_ADMIN_CSS_URL', PROFOUND_ASSETS_URL . 'admin/css/');
define('PROFOUND_INCLUDES_DIR' , get_template_directory() . '/includes/' );



/**
 * Options panel call
 */
require_once PROFOUND_INCLUDES_DIR . 'options-panel.php';



/**
 * Sets up theme defaults and registers support for various theme features
 * 
 * @since 1.0
 */
function profound_setup() {
    
    global $content_width;
    
    /**
     * Primary content width according to the design and stylesheet.
     */
    if ( ! isset( $content_width ) ) { $content_width = 890; }
    
    /**
     * Makes profound Theme ready for translation.
     * Translations can be filed in the /languages/ directory
     */
    load_theme_textdomain('profound', get_template_directory() . '/languages');

    /**
     * Add default posts and comments RSS feed links to head.
     */
    add_theme_support('automatic-feed-links');
    
    /**
     * Add custom background.
     * @todo Put E7E7E7 in a variable and then change it according to the skin
     */
    add_theme_support('custom-background', array('default-color' => 'E7E7E7'));
    
    /**
     * Adds supports for Theme menu.
     * Profound uses wp_nav_menu() in a single location to diaplay one single menu.
     */
    register_nav_menu('primary', __('Primary Menu','profound'));

    /**
     * Add support for Post Thumbnails.
     * Defines a custom name and size for Thumbnails to be used in the theme.
     *
     * Note: In order to use the default theme thumbnail, add_image_size() must be removed
     * and 'profoundThumb' value must be removed from the_post_thumbnail in the loop file.
     */
    add_theme_support('post-thumbnails');
    add_image_size('profoundThumb', 190, 130, true);
}
add_action( 'after_setup_theme', 'profound_setup' );



/**
 * Defines menu values and call the menu itself.
 * The menu is registered using register_nav_menu function in the theme setup.
 * 
 * @since 1.0
 */
function profound_nav() {
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container_id' => 'menu',
        'menu_class' => 'sf-menu profound_menu',
        'menu_id' => 'profound_menu',
        'fallback_cb' => 'profound_nav_fallback' // Fallback function in case no menu item is defined.
    ));
}



/**
 * Displays a custom menu in case either no menu is selected or
 * menu does not contains any items or wp_nav_menu() is unavailable.
 * 
 * @since 1.0
 */
function profound_nav_fallback() {
?>
    <div id="menu">
    	<ul class="sf-menu" id="profound_menu">
			<?php
            	wp_list_pages( 'title_li=&sort_column=menu_order&depth=3');
            ?>
        </ul>
    </div>
<?php
}



/**
 * Register sidebars one at right and three footer sidebars in a box.
 * 
 * @since 1.0
 */
function profound_sidebars() {

    // Footerbox Sidebar #1
    register_sidebar(array(
        'name' => __('Right Sidebar', 'profound'),
        'id' => 'right_sidebar',
        'description' => __('Right Sidebar', 'profound'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Footerbox Sidebar #1
    register_sidebar(array(
        'name' => __('Footerbox Sidebar #1', 'profound'),
        'id' => 'footerbox_sidebar_1',
        'description' => __('Footerbox Sidebar #1', 'profound'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Footerbox Sidebar #2
    register_sidebar(array(
        'name' => __('Footerbox Sidebar #2', 'profound'),
        'id' => 'footerbox_sidebar_2',
        'description' => __('Footerbox Sidebar #2', 'profound'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Footerbox Sidebar #3
    register_sidebar(array(
        'name' => __('Footerbox Sidebar #3', 'profound'),
        'id' => 'footerbox_sidebar_3',
        'description' => __('Footerbox Sidebar #3', 'profound'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
}
add_action( 'widgets_init', 'profound_sidebars' );



/**
 * Enqueue CSS and JS files
 * 
 * @since 1.0
 */
function profound_enqueue() {
    global $profound_options, $profound_version;
    
    wp_enqueue_style('profound-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700,600italic,700italic,800,800italic');
    wp_enqueue_style('profound-lato', '//fonts.googleapis.com/css?family=Lato:400,100italic,100,300,300italic,700,700italic,900,900italic');
    wp_enqueue_style('profound-font-awesome', PROFOUND_ADMIN_CSS_URL . 'font-awesome.4.1.0.css');
    wp_enqueue_style('profound-stylesheet', get_stylesheet_uri(), false, $profound_version, 'all' );
    
    // Enqueue (comment-reply )Javascript in case of threaded comments.
    if (is_singular() && comments_open() && get_option('thread_comments')) :
        wp_enqueue_script('comment-reply');
    endif;
    
    wp_enqueue_script('profound-flexslider', PROFOUND_GLOBAL_JS_URL . 'jquery.flexslider-min.js', array( 'jquery' ), '2.1.0', true);
    wp_localize_script('profound-flexslider', 'profound_slide_vars', array(
                    'slideshowSpeed' => $profound_options['slide_speed'],
                    'animationSpeed' => $profound_options['slide_ani_speed'],
                    'directionNav' => (bool) $profound_options['disable_slide_nav'] ? '' : 'true',
                    'smoothHeight' => (bool) $profound_options['disable_smooth_height'] ? '' : 'true',
                    'animation' => $profound_options['slide_animation_type'],
                    'direction' => $profound_options['slide_dir'],
                    ));
    wp_enqueue_script('profound-superfish', PROFOUND_GLOBAL_JS_URL . 'superfish.min.js', array( 'jquery' ), '1.4.8', true);
    wp_enqueue_script('jquery-color');
    wp_enqueue_script('profound-custom', PROFOUND_GLOBAL_JS_URL . 'custom.min.js', array( 'jquery' ), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'profound_enqueue');



/**
 * Hooks respond.js for IE in the wp_head hook.
 * 
 * @since 1.0
 */
function profound_enqueue_ie_script() {
    echo "\n";
    ?><!--[if lt IE 9]><script type='text/javascript' src='<?php echo PROFOUND_GLOBAL_JS_URL ?>respond.js?ver=1.0'></script><![endif]--><?php
    echo "\n";
}
add_action('wp_head', 'profound_enqueue_ie_script');



/**
 * Defines the number of characters for post excerpts
 * and is added to excerpt_length filter.
 * 
 * @since 1.0
 */
function profound_excerpt_length( $length ) {
	return 43;
}
add_filter( 'excerpt_length', 'profound_excerpt_length' );



/**
 * Defines the text for the (read more) link for post excerpts
 * and is added to excerpt_more filter.
 * 
 * @since 1.0
 */
function profound_auto_excerpt_more( $more ) {
	return '&hellip;' ;
}
add_filter( 'excerpt_more', 'profound_auto_excerpt_more' );



/**
 * Modifies the default title of the blog and is hooked to wp_title filter.
 * 
 * @since 1.0
 */
function profound_modify_title( $title, $sep ) {
    
    global $page, $paged;

    if (is_feed())
        return $title;

    // Add the blog name
    $title .= get_bloginfo('name', 'display');

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title .= " $sep $site_description";

    // Add a page number if necessary:
    if ($paged >= 2 || $page >= 2)
        $title .= " $sep " . sprintf(__('Page %s', 'profound'), max($paged, $page));

    return $title;
}
add_filter( 'wp_title', 'profound_modify_title', 10, 2 );



/**
 * Used to return body classes
 * 
 * @param array $classes
 * @return array
 * @since 1.0
 */
function profound_body_class($classes) {
    
    global $profound_options;
    
    if(is_single()):
        
        $classes[] = 'single-template';
        $classes[] = 'post-template';
    
    elseif(is_page()):
        
        $classes[] = 'page-template';
        $classes[] = 'post-template';

    elseif(is_front_page()):
        
        $classes[] = 'home-template';
    
    elseif(is_home()):
        
        $classes[] = 'home-template';
        $classes[] = 'blog-template';
    
    elseif (is_archive()):
        
        $classes[] = 'archive-template';
    
    elseif(is_404()):
        
        $classes[] = 'archive-template';
        $classes[] = 'empty-template';
    
    elseif(is_search()):
        
        $classes[] = 'archive-template';
        $classes[] = 'search-template';
    
    endif;
    
        $classes[] = esc_attr($profound_options['skin']);
    
    return $classes;
}
add_filter('body_class', 'profound_body_class');



/**
 * Display slideshow only if any slideshow image exists.
 * 
 * @global array $profound_options
 * @since 1.0
 * @todo Check HTML structure and CSS classes.
 */
function profound_carousel_featured_slideshow_show(){
    global $profound_options;
    
    for($i = 1; $i <= 2; $i++){
        $slides[$i]['img'] = $profound_options['featured_slide_img_' . $i];
        $slides[$i]['head'] = $profound_options['featured_slide_head_' . $i];
    }
        
    $error = array_filter($slides); // Check if array is empty.
        
        if(!empty($error)): ?>
            <div id = "featured-container" class = "slider">
                <div class = "flexslider">
                    <ul class = "slides">
                        <?php
                            if(is_array($slides)):
                                foreach ($slides as $slides):
                                    if(!empty($slides['img'])):
                                        ?>
                                        <li>
                                            <img src="<?php echo esc_url( $slides['img'] ) ?>" />
                                            <?php if($slides['head']): ?>
                                            <div class="flex-caption">
                                                <div class="featured-heading">
                                                    <span><?php echo esc_html( $slides['head'] ) ?></span>
                                                </div>
                                            </div>
                                            <?php endif ?>
                                        </li>
                                            <?php
                                    endif;
                                endforeach;
                            endif;
                            ?>
                        </ul>
                </div>
            </div>
        <?php endif;
}



/**
 * Used to display CTA section
 * 
 * @since 1.0
 */
function profound_cta_section_show(){
    global $profound_options;
    ?>
    <?php if(!$profound_options['disable_featured_section']): ?>
        <div id="cta-bg-section" class="cta-bg-section grid-col-16 clearfix">
            <div id="cta-section" class="cta-section grid-col-16 clearfix">
                <div id="cta-content-section" class="cta-content-section grid-col-16">
                    <div class="cta-image-section"><?php profound_carousel_featured_slideshow_show() ?></div>
                </div>
            </div> <!-- cta section ends -->
        </div>
    <?php endif; ?>

<?php }



/**
 * Checks whether the all the content sections are disabled or not.
 * 
 * @todo Remove this function
 * @since 1.0
 */
function profound_is_home() {
    global $profound_options;
    
    if($profound_options['disable_featured_section'] && (get_option('show_on_front') == 'posts')){
        add_filter('profound_blog_template_heading_filter', 'profound_is_blog_heading_text', 20);
        return TRUE;
    } else {
        return FALSE;
    }
}



/**
 * Adds text to profound_blog_template_heading_filter used on home.php
 * 
 * @todo Remove this function
 * @return string
 */
function profound_is_blog_heading_text(){
    return '';
}



/**
 * Used to display social section
 * 
 * @since 1.0
 */
function profound_social_section_show() {
    
    global $profound_options;
    
    if(!$profound_options['disable_social_section']):

    $output = false;
    ?>            

                <?php if($profound_options['facebook']): ?>
                <?php $output .= '
                <div class="social-icons facebook-icon">
                    <a href="'.esc_url($profound_options['facebook']).'" title="Facebook"><i class="mdf mdf-facebook"></i></a>
                </div>' ?>
                <?php endif ?>
                
                <?php if($profound_options['twitter']): ?>
                <?php $output .= '
                <div class="social-icons twitter-icon">
                    <a href="'.esc_url($profound_options['twitter']).'" title="Twitter"><i class="mdf mdf-twitter"></i></a>
                </div>' ?>
                <?php endif ?>
                
                <?php if($profound_options['rss']): ?>
                <?php $output .= '
                <div class="social-icons rss-icon">
                    <a href="'.esc_url($profound_options['rss']).'" title="RSS Feed"><i class="mdf mdf-rss"></i></a>
                </div>' ?>
                <?php endif ?>
                
                <?php if($output !== false): ?>
                <div id="social-section" class="social-section">
                    <?php echo $output ?>
                </div>
                <?php endif ?>
            
            <div class="socialicons-mi"></div><div class="socialicons-mo"></div>

<?php
    endif;
}



/**
 * Displays the content in case of 404 page, empty search query
 * and any other query which does not output any result.
 * 
 * Both heading and content of the page will be displayed with a
 * search form. Any modification to this module will effect only
 * 404 error or related pages.
 * 
 * @since 1.0
 */
function profound_404_show(){
?>
        <div class="archive-meta-container">
            <div class="archive-head">
                <?php if (is_404()) : ?>
                    <h1><?php _e('Ooops! Nothing Found', 'profound'); ?></h1>
                <?php elseif (is_search()) : ?>
                    <h1><?php printf(__('Nothing found for: %s', 'profound'), get_search_query()); ?></h1>
                <?php else : ?>
                    <h1><?php printf(__('Nothing found for: %s', 'profound'), single_term_title('', false)); ?></h1>
                <?php endif; ?>
            </div>
        </div><!-- Archive Meta Container ends -->
        
        <div class="archive-loop-container archive-empty">
            <div class="archive-excerpt">
                <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'profound'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>
<?php }



/**
 * Decides and returns the accurate 'text' to be displayed.
 * 
 * @return string
 * @since 1.0
 */
function profound_date_text() {
    if (is_date()):
        if (is_day()):
            $date_text = __('Day', 'profound');
        elseif (is_month()):
            $date_text = __('Month', 'profound');
        elseif (is_year()):
            $date_text = __('Year', 'profound');
        else:
            $date_text = __('Period', 'profound');
        endif;

        return $date_text;

    endif;
}



/**
 * Displays the navigation links for the archive pages. Is only
 * applicable if the total number of pages is more than 'one'.
 * 
 * @since 1.0
 */
function profound_archive_nav() {
    
    global $wp_query, $profound_options;

    if ($wp_query->max_num_pages > 1 && !$profound_options['disable_blog_nav']): ?>
        
        <div class="archive-nav grid-col-16">
            <div class="nav-next"><?php previous_posts_link(__('<span class="meta-nav">&larr;</span> Newer posts', 'profound')); ?></div>
            <div class="nav-previous"><?php next_posts_link(__('Older posts <span class="meta-nav">&rarr;</span>', 'profound')); ?></div>
        </div>
        
<?php endif;
}



/**
 * Displays the navigation links for the posts and pages.
 * 
 * @since 1.0
 */
function profound_post_nav() {
?>
    <div class="post-nav">
        <div class="nav-previous"><?php previous_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Previous post link', 'profound' ) . '</span>' ) ?></div>
        <div class="nav-next"><?php next_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Next post link', 'profound' ) . '</span> %title' ) ?></div>
    </div>
<?php
}



/**
 * Display site title/description or logo
 * 
 * @global array $profound_options
 * @since 1.0
 */
function profound_logo() {
    
    global $profound_options;
            
        if( empty($profound_options['logo_img'] )): ?>
        
            <div id="site-title" class="site-title">
                <img src="http://127.0.0.1/jerry.lee.blog/wp-content/themes/profound/assets/global/images/jerry-logo.png">
            </div>
            <?php if(!$profound_options['disable_site_desc']): ?>
                <div id="site-description" class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ) ?></div>
            <?php endif; ?>
            
        <?php else: ?>
        
            <div id="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?>" rel="home"><img src="<?php echo esc_url( $profound_options['logo_img'] ) ?>"/></a>
                <div>Practice makes excellent</div>
            </div>

        <?php endif;
}



/**
 * Adds favicon icon link in the <head></head> section
 * of the theme.
 *
 * @since 1.0
 */
function profound_favicon() {
    global $profound_options;
    
    if ( !empty($profound_options['favicon']) ):
        echo '<link rel="shortcut icon" href="' . esc_url($profound_options['favicon']) . '" type="image/x-icon" />';
    endif;
}
add_action( 'wp_head', 'profound_favicon' );



/**
 * Outputs the Custom CSS code from $profound_options into HEAD section of theme.
 * 
 * @global array $profound_options
 * @since 1.0
 */
function profound_custom_css() {
    global $profound_options;
    
    if(!empty($profound_options['custom_css'])){
        $output = '<style type="text/css">';
        $output .= wp_filter_nohtml_kses($profound_options['custom_css']);
        $output .= '</style>';
        
        echo $output;
    }
}
add_action('wp_head', 'profound_custom_css');



/**
 * Template for comments and pingbacks.
 * 
 * @since 1.0
 */
function profound_comment_callback( $comment, $args, $depth ) {

  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ):

         case '' :
		 // Proceed with normal comments.
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <?php if ($comment->comment_approved == '0') : ?><div class="comment-awaiting"><em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'profound'); ?></em></div><?php endif; ?>
        <?php $profound_get_comment_ID = get_comment_ID() ?>
        <?php $profound_is_comment_reply = get_comment($profound_get_comment_ID)->comment_parent ?>
        <?php $profound_the_comment_author = get_comment_author(get_comment($profound_get_comment_ID)->comment_parent) ?>
        <?php if($profound_is_comment_reply != 0 ) printf('<div class="comment-parent-author"><span>Replied to %s</span></div>', $profound_the_comment_author ) ?>
      <div id="comment-<?php comment_ID(); ?>" class="comment-block-container grid-float-left grid-col-16">
          
          
                     <div class="comment-info-container grid-col-4 grid-float-left">
                          <div class="comment-author vcard">
                              <div class="comment-author-avatar-container"><?php echo get_avatar($comment, 100); ?></div>
                              <div class="comment-author-info-container">
                                  <div class="comment-author-name"><?php printf('%s <span class="says"></span>', sprintf('<cite class="fn">%s</cite>', get_comment_author_link())) ?></div>
                              </div>
                          </div><!-- .comment-author .vcard -->
                     </div>
          
                     <div class="comment-body-container grid-col-12 grid-float-left">
                        <div class="comment-body"><?php comment_text(); ?></div>
                        <div class="comment-meta commentmetadata"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s at %2$s', 'profound'), get_comment_date(), get_comment_time()); ?></a></div>
                        <div class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
                        <?php edit_comment_link(__('(Edit)', 'profound'), '<div class="comment-edit">', '</div>');?>
                     </div>

      </div><!-- #comment-##  -->

<?php
         break;

         case 'pingback' :
         case 'trackback' :
		 // Display trackbacks differently than normal comments.
  ?>

  <li class="post pingback">
      <p><?php _e( 'Pingback:', 'profound' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'profound' ), ' ' ); ?></p>

  <?php
         break;

  endswitch;
}



/**
 * Adds text to profound_blog_template_heading_filter used on home.php
 * 
 * @todo Remove this function
 * @return string
 * @since 1.0
 */
function profound_blog_template_heading_text() {
    return '<h1>' . get_bloginfo('name') . ' ' . __('Blog', 'profound') . '</h1>';
}
add_filter('profound_blog_template_heading_filter', 'profound_blog_template_heading_text', 10);



/**
 * Callback function for adding class to loop section.
 * 
 * @internal Uses profound_loop_section_col_class_filter
 * @global array $profound_options
 * @param type $input
 * @return string
 */
function profound_loop_section_col_class_cb($input) {
    global $profound_options;
    
    if($profound_options['float_thumb'] == 'right') {
        return 'thumbnail-right';
    } else {
        return 'thumbnail-left';
    }
}
add_filter('profound_loop_section_col_class_filter', 'profound_loop_section_col_class_cb');



/**
 * Outputs custom CSS code generated by Theme options
 * in the header of the theme.
 * 
 * @global array $profound_options
 * @global type $mdf_google_fonts
 */
function profound_attach_options_style(){
    global $profound_options, $mdf_google_fonts;
    $output = ''; $style = '';
    $skin = '.' . $profound_options['skin'];
    
    $elements_font = array(
        'font_site_title' => '.site-title a',
        'font_site_desc' => '.site-description',
        'font_body' => 'body',
        'font_featured' => '.flex-caption .featured-heading',
        'font_menu' => '.primarymenu-section a',
        'font_blog_p_title' => '.loop-post-title h1',
        'font_blog_p_meta' => '.loop-post-meta',
        'font_blog_p_content' => '.loop-post-excerpt p',
        'font_readmore' => '.read-more',
        'font_bc' => '.breadcrumbs',
        'font_p_title' => '.post-template .post-title h1',
        'font_p_meta' => '.post-template .post-meta',
        'font_p_content' => '.post-content',
        'font_sidebar_p_title' => '.sidebar-right-section h4.widget-title',
        'font_sidebar_p_body' => '.sidebar-right-section',
        'font_sidebar_f_title' => '.footerbox-section h4.widget-title',
        'font_sidebar_f_body' => '.footerbox-section, .footerbox-section .widget_text .textwidget',
        'font_footer' => '.copyright',
    );
    
    $elements_fontsize = array(
        'fsize_site_title' => '.site-title a',
        'fsize_site_desc' => '.site-description',
    );
    
    $elements_color = array(
        'color_site_title' => $skin . ' ' . '.site-title a',
        'color_site_desc' => $skin . ' ' . '.site-description',
        'color_blog_p_title' => $skin . ' ' . '.loop-post-title h1 a',
        'color_blog_p_meta' => $skin . ' ' . '.loop-post-meta',
        'color_blog_p_content' => $skin . ' ' . '.loop-post-excerpt p',
        'color_readmore' => $skin . ' ' . '.read-more a',
        'color_p_title' => $skin . '.post-template .post-title h1',
        'color_p_meta' => $skin . '.post-template .post-meta',
        'color_p_content' => $skin . '.post-template .post-content',
        'color_p_link' => $skin . '.post-template .post-content a:link, .comment-body a:link',
        'color_p_link_v' => $skin . '.post-template .post-content a:visited, .comment-body a:visited',
        'color_p_link_h' => $skin . '.post-template .post-content a:hover, .comment-body a:hover',
    );
    
    $elements_bg_color = array(
        'color_bg_blog_style_date' => $skin . ' ' . '.loop-stylish-date .loop-stylish-date-month',
        'color_bg_readmore' => $skin . ' ' . '.read-more a',
    );

    foreach ($elements_font as $key => $value) {
        if(array_key_exists($key, $profound_options)) {
            $style .= $value . '{font-family:';
            
            foreach ($mdf_google_fonts as $global_fonts) {
                if($global_fonts['shortname'] == $profound_options[$key]) {
                    $style .= wp_filter_nohtml_kses($global_fonts['name'] .','.$global_fonts['family']);
                }
            }
            $style .= ' !important;}';
        }
    }
    
    $style .= "\n";
    
    foreach ($elements_fontsize as $key => $value) {
        if(array_key_exists($key, $profound_options)) {
            $style .= wp_filter_nohtml_kses($value . '{font-size:'.$profound_options[$key].'!important;}');
        }
    }

    $style .= "\n";
    
    foreach ($elements_color as $key => $value) {
        if(array_key_exists($key, $profound_options)) {
            $style .= wp_filter_nohtml_kses($value . '{color:'.$profound_options[$key].'!important;}');
        }
    }

    $style .= "\n";

    foreach ($elements_bg_color as $key => $value) {
        if(array_key_exists($key, $profound_options)) {
            $style .= wp_filter_nohtml_kses($value . '{background-color:'.$profound_options[$key].'!important;}');
        }
    }
    
    $output .= '<style type="text/css">'. "\n" . wp_kses_stripslashes(wp_filter_nohtml_kses($style)) . "\n" . '</style>' . "\n";
    echo $output;
    
}
add_action('wp_head', 'profound_attach_options_style');