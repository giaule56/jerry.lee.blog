/**
 * Initialize the slider.
 */
( function() {
jQuery(window).load(function() {
	jQuery('.flexslider').flexslider({
		slideshowSpeed: +sliderOptions.slideshowspeed,
		animationSpeed: +sliderOptions.animationspeed,
		pauseOnHover: true,
		useCSS: true,
		touch: true,
		animation: "slide", 
		smoothHeight: true,
		controlNav: false,
		start: function(slider) {
			slider.removeClass('loading');
		}
	});
});
} )();

