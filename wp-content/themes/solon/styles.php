<?php

function solon_custom_styles($custom) {
	//Primary color
	$primary_color = esc_html(get_theme_mod( 'primary_color' ));
	if ( $primary_color != '#e86f67' ) {
		$custom = ".wp-pagenavi .pages,  .wp-pagenavi .page, .wp-pagenavi .last, .wp-pagenavi .previouspostslink, .wp-pagenavi .nextpostslink, .site-header, .social-navigation, .main-navigation ul ul li:hover, .page-header, .slide .entry-title, .post-navigation .nav-previous, .post-navigation .nav-next, .paging-navigation .nav-previous, .paging-navigation .nav-next, .comment-respond input[type=\"submit\"], .site-info, #today { background-color: {$primary_color} !important; }"."\n";
		$custom .= ".entry-title a:hover, .main-navigation a:hover, .entry-meta, .entry-meta a, .entry-footer, .entry-footer a, .author-social a, .comment-meta a, .comment-form-author:before, .comment-form-email:before, .comment-form-url:before, .comment-form-comment:before, .widget-title, .widget li:before, .error404 .widgettitle, .main-navigation ul ul a, .flex-direction-nav a, .social-widget li a::before { color: {$primary_color}; }"."\n";
		$custom .= ".author-bio .col-md-3, .main-navigation li, .read-more { border-right-color: {$primary_color}; }"."\n";
		$custom .= ".author-bio .col-md-9 { border-left-color: {$primary_color}; }"."\n";
		$custom .= ".widget-title, .main-navigation ul ul li, .hentry .entry-meta, .entry-footer, .error404 .widgettitle { border-bottom-color: {$primary_color}; }"."\n";
		$custom .= ".footer-widget-area, .hentry .entry-meta, .entry-footer { border-top-color: {$primary_color}; }"."\n";
	}
	//Secondary color
	$secondary_color = esc_html(get_theme_mod( 'secondary_color' ));
	if ( $secondary_color != '#2A363B' ) {
		$custom .= ".main-navigation, .widget, .footer-widget-area, .site-footer, .slide .entry-meta, .post-navigation .nav-previous:hover, .post-navigation .nav-next:hover, .paging-navigation .nav-previous:hover, .paging-navigation .nav-next:hover, .comment-respond input[type=\"submit\"]:hover { background-color: {$secondary_color}; }"."\n";
		$custom .= ".social-navigation li a, .main-navigation ul ul { color: {$secondary_color}; }"."\n";
		$custom .= ".main-navigation ul ul { border-top-color: {$secondary_color}; }"."\n";
		$custom .= ".social-navigation { border-bottom-color: {$secondary_color}; }"."\n";
		$custom .= ".read-more:hover { border-right-color: {$secondary_color}; }"."\n";
	}
	//Site title
	$site_title = esc_html(get_theme_mod( 'site_title_color' ));
	if ( $site_title != '#2A363B' ) {
		$custom .= ".site-title a { color: {$site_title}; }"."\n";
	}
	//Site description
	$site_desc = esc_html(get_theme_mod( 'site_desc_color' ));
	if ( $site_desc != '#fff' ) {
		$custom .= ".site-description { color: {$site_desc}; }"."\n";
	}	
	//Entry title
	$entry_title = esc_html(get_theme_mod( 'entry_title_color' ));
	if ( $entry_title != '#2A363B' ) {
		$custom .= ".entry-title, .entry-title a { color: {$entry_title}; }"."\n";
	}
	//Body text
	$body_text = esc_html(get_theme_mod( 'body_text_color' ));
	if ( $body_text != '#7B848F' ) {
		$custom .= "body { color: {$body_text}; }"."\n";
	}
	
	//Fonts
	$headings_font = esc_html(get_theme_mod('headings_fonts'));	
	$body_font = esc_html(get_theme_mod('body_fonts'));	
	
	if ( $headings_font ) {
		$font_pieces = explode(":", $headings_font);
		$custom .= "h1, h2, h3, h4, h5, h6 { font-family: {$font_pieces[0]}; }"."\n";
	}
	if ( $body_font ) {
		$font_pieces = explode(":", $body_font);
		$custom .= "body { font-family: {$font_pieces[0]}; }"."\n";
	}	
	
	//Output all the styles
	wp_add_inline_style( 'solon-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'solon_custom_styles' );