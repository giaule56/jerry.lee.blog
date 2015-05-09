<?php
/**
 * Solon functions and definitions
 *
 * @package Solon
 */


if ( ! function_exists( 'solon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function solon_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Solon, use a find and replace
	 * to change 'solon' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'solon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}	
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'solon-home', 700, 400, true );
	add_image_size( 'slider-image', 700, 500, true );
	add_image_size( 'single-thumb', 700 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'solon' ),
		'social' => __( 'Social', 'solon' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'solon_custom_background_args', array(
		'default-color' => 'f2f2f2',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // solon_setup
add_action( 'after_setup_theme', 'solon_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function solon_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'solon' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer A', 'solon' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer B', 'solon' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer C', 'solon' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	
	//Register the custom widgets
	register_widget( 'Solon_Recent_Posts' );
	register_widget( 'Solon_Recent_Comments' );
	register_widget( 'Solon_Social_Profile' );
	register_widget( 'Solon_Video_Widget' );
}
add_action( 'widgets_init', 'solon_widgets_init' );
/**
 * Load the custom widgets.
 */
require get_template_directory() . "/widgets/recent-posts.php";
require get_template_directory() . "/widgets/recent-comments.php";
require get_template_directory() . "/widgets/social-profile.php";
require get_template_directory() . "/widgets/video-widget.php";
/**
 * Enqueue scripts and styles.
 */
function solon_scripts() {
	
	wp_enqueue_style( 'solon-bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), true );
	
	wp_enqueue_style( 'solon-style', get_stylesheet_uri() );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts'));
	if( $headings_font ) {
		wp_enqueue_style( 'solon-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );	
	} else {
		wp_enqueue_style( 'solon-headings-fonts', '//fonts.googleapis.com/css?family=Oswald:700');
	}	
	if( $body_font ) {
		wp_enqueue_style( 'solon-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );	
	} else {
		wp_enqueue_style( 'solon-body-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700');
	}
	
	wp_enqueue_style( 'solon-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );
	
	wp_enqueue_script( 'solon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'solon-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'solon-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), true );
	
	wp_enqueue_script( 'solon-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), true );

	if ( get_theme_mod('solon_scroller') != 1 )  {
		
		wp_enqueue_script( 'solon-nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array('jquery'), true );

		wp_enqueue_script( 'solon-nicescroll-init', get_template_directory_uri() . '/js/nicescroll-init.js', array('jquery'), true );

	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( get_theme_mod('solon_layout') == 'sidebar-content' )  {
		wp_enqueue_style( 'solon-left-sidebar', get_template_directory_uri() . '/layouts/sidebar-content.css' );
	}	
}
add_action( 'wp_enqueue_scripts', 'solon_scripts' );

/**
 * Adds more contact methods in the User profile screen (links used for the author bio).
 */
function solon_contactmethods( $contactmethods ) {
	
	$contactmethods['solon_facebook'] = __( 'Author Bio: Facebook', 'solon' );
	$contactmethods['solon_twitter'] = __( 'Author Bio: Twitter', 'solon' );	
	$contactmethods['solon_googleplus'] = __( 'Author Bio: Google Plus', 'solon' );
	$contactmethods['solon_linkedin'] = __( 'Author Bio: Linkedin', 'solon' );
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'solon_contactmethods', 10, 1);

/**
 * Display password form on excerpts
 */
function solon_password_form( $form ) {
	if ( post_password_required() )
		$form = get_the_password_form();
	return $form;
}
add_filter( 'the_excerpt', 'solon_password_form' );
/**
 * Load html5shiv
 */
function solon_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'solon_html5shiv' ); 
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load the slider.
 */
require get_template_directory() . '/inc/slider/slider.php';

/**
 * Dynamic styles
 */
require get_template_directory() . '/styles.php';
