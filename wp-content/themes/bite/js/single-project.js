/**
 * Functions for single-project.php
 *
 */

( function( $ ) {

	// Gallery navigation
	function galleryNav(that, totalImages) {

		var currentImage = $('.gallery-item.current').data('item');

		if ( that.data('nav') === 'next' ) {
			// NEXT
			var newImage = ++currentImage;
		}else{
			// PREV
			var newImage = --currentImage;
		}

		if ( newImage > totalImages ) {
			newImage = 1;
		}else if ( newImage < 1 ) {
			newImage = totalImages;
		}

		$('.gallery-item.current').removeClass('current');
		$('#gallery-item-'+newImage).addClass('current');

	}

	$( document ).ready( function() {

		// Check how many images the project has and add click event if needed
		var totalImages = $('.gallery-item').length;

		if ( totalImages > 1 ) {
			$('.gallery-nav').on( "click", function() {
				galleryNav($(this), totalImages);
			});
		}

	});

} )( jQuery );
