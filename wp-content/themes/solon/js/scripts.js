
//Menu dropdown animation
jQuery(function($) {
	$('.sub-menu').hide();
	$('.main-navigation .children').hide();
	$('.menu-item').hover( 
		function() {
			$(this).children('.sub-menu').slideDown();
		}, 
		function() {
			$(this).children('.sub-menu').hide();
		}
	);
	$('.main-navigation li').hover( 
		function() {
			$(this).children('.main-navigation .children').slideDown();
		}, 
		function() {
			$(this).children('.main-navigation .children').hide();
		}
	);	
});

//Fit Vids
jQuery(function($) {
  
  $(document).ready(function(){
    $("body").fitVids();
  });
  
});

//Comments clearfix
jQuery(function($) {
	$(".comment-body").addClass('clearfix');
});

//Social links in new window
jQuery(function($) {
     $( '.social-navigation li a' ).attr( 'target','_blank' );
});

jQuery(function($) {
	$('.scrollup').click(function(){
		$('html, body').animate({scrollTop : 0}, 500);
		return false;
	});
});