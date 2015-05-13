jQuery(document).ready(function($){

	var mtop_medialib_upload;
	var mtop_medialib_selector;

	function mtop_medialib_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		mtop_medialib_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( mtop_medialib_upload ) {
			mtop_medialib_upload.open();
		} else {
			// Create the media frame.
			mtop_medialib_upload = wp.media.frames.mtop_medialib_upload =  wp.media({
				// Set the title of the modal.
				title: $el.data('choose'),

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: $el.data('update'),
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			mtop_medialib_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = mtop_medialib_upload.state().get('selection').first();
				mtop_medialib_upload.close();
				mtop_medialib_selector.find('.upload').val(attachment.attributes.url);
				if ( attachment.attributes.type == 'image' ) {
					mtop_medialib_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '"><a class="remove-image">Remove</a>').slideDown('fast');
				}
				mtop_medialib_selector.find('.upload-button').unbind().addClass('remove-file').removeClass('upload-button').val(mtop_medialib_localize.remove);
				mtop_medialib_selector.find('.mtop-background-properties').slideDown();
				mtop_medialib_selector.find('.remove-image, .remove-file').on('click', function() {
					mtop_medialib_remove_file( $(this).parents('.section') );
				});
			});

		}

		// Finally, open the modal.
		mtop_medialib_upload.open();
	}

	function mtop_medialib_remove_file(selector) {
		selector.find('.remove-image').hide();
		selector.find('.upload').val('');
		selector.find('.mtop-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind().addClass('upload-button').removeClass('remove-file').val(mtop_medialib_localize.upload);
		// We don't display the upload button if .upload-notice is present
		// This means the user doesn't have the WordPress 3.5 Media Library Support
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.upload-button').remove();
		}
		selector.find('.upload-button').on('click', function(event) {
			mtop_medialib_add_file(event, $(this).parents('.section'));
		});
	}

    $('.remove-image, .remove-file').on('click', function() {
        mtop_medialib_remove_file( $(this).parents('.section') );
    });

    $('.upload-button').click( function( event ) {
    	mtop_medialib_add_file(event, $(this).parents('.section'));
    });

});