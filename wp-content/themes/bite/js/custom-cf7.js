/**
 * Custom CF7 functions
 *
 * IMPORTANT: This needs to be loaded after jquery-textarea-autosize.js
 */

( function( $ ) {

	$( document ).ready( function() {

		// Initialize auto resize on all custom form textareas
		$('.custom-cf7 textarea').each(function(){
			autosize(this);
		}).on('autosize:resized', function(){

		});

        // Adding Custom AJAX loader, hidden by default
        $('img.ajax-loader').after('<div class="custom-ajax-loader" style="visibility: hidden"></div>');

        // Show new loader on Send button click
        $('.wpcf7-submit').on('click', function () {
            $('.custom-ajax-loader').css({ visibility: 'visible' });
        });

        // Hide new loader on result
        $('div.wpcf7').on('wpcf7:invalid wpcf7:spam wpcf7:mailsent wpcf7:mailfailed', function () {
            $('.custom-ajax-loader').css({ visibility: 'hidden' });
        });

	});

} )( jQuery );
