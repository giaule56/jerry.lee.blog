/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
	//Primary color
	wp.customize('primary_color',function( value ) {
		value.bind( function( newval ) {
			$('::selection, .site-header, .social-navigation, .main-navigation ul ul li:hover, .page-header, .slide .entry-title, .post-navigation .nav-previous, .post-navigation .nav-next, .paging-navigation .nav-previous, .paging-navigation .nav-next, .comment-respond input[type="submit"], .site-info, #today').css('background-color', newval );
			$('.main-navigation ul ul li').hover(
			  function() {
				$( this ).css('background-color', newval );
			  }, function() {
				$( this ).css('background-color', '#fff' );
			  });
			$('.main-navigation ul ul li a').hover(
			  function() {
				$( this ).css('color', '#fff' );
			  }, function() {
				$( this ).css('color', newval );
			  });
			$('.post-navigation .nav-previous, .post-navigation .nav-next, .paging-navigation .nav-previous, .paging-navigation .nav-next').hover(
			  function() {
				$( this ).css('background-color', '#2A363B' );
			  }, function() {
				$( this ).css('background-color', newval );
			  });
			$('.read-more').hover(
			  function() {
				$( this ).css('border-right-color', '#2A363B' );
			  }, function() {
				$( this ).css('border-right-color', newval );
			  });
			$('.comment-respond input[type="submit"]').hover(
			  function() {
				$( this ).css('background-color', '#2A363B' );
			  }, function() {
				$( this ).css('background-color', newval );
			  });			  
			$('.entry-meta, .entry-meta a, .entry-footer, .entry-footer a, .author-social a, .comment-meta a, .comment-form-author:before, .comment-form-email:before, .comment-form-url:before, .comment-form-comment:before, .widget-title, .widget li:before, .error404 .widgettitle, .main-navigation ul ul a, .flex-direction-nav a').css('color', newval );
			$('.author-bio .col-md-3, .main-navigation li, .read-more').css('border-right-color', newval );
			$('.author-bio .col-md-9').css('border-left-color', newval );
			$('.widget-title, .main-navigation ul ul li, .hentry .entry-meta, .entry-footer, .error404 .widgettitle').css('border-bottom-color', newval );
			$('.footer-widget-area, .hentry .entry-meta, .entry-footer').css('border-top-color', newval );
		} );
	});
	//Secondary color
	wp.customize('secondary_color',function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation, .widget, .footer-widget-area, .site-footer, .slide .entry-meta').css('background-color', newval );
			$('.social-navigation li a, .main-navigation ul ul').css('color', newval );
			$('.main-navigation ul ul').css('border-top-color', newval );
			$('.social-navigation').css('border-bottom-color', newval );
		} );
	});
	// Site title
	wp.customize('site_title_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-title a').css('color', newval );
		} );
	});	
	// Site description
	wp.customize('site_desc_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-description').css('color', newval );
		} );
	});
	// Entry title
	wp.customize('entry_title_color',function( value ) {
		value.bind( function( newval ) {
			$('.entry-title, .entry-title a').css('color', newval );
		} );
	});
	// Body text color
	wp.customize('body_text_color',function( value ) {
		value.bind( function( newval ) {
			$('body').css('color', newval );
		} );
	});		
} )( jQuery );
