/**
 * Functions for template-projects.php
 *
 */

( function( $ ) {

	$( document ).ready( function() {

		// FILTER FOR PROJECTS
		var $grid = $('#all-projects');

		$grid.shuffle({
			itemSelector: '.project-item' // the selector for the items in the grid
		});

		/* reshuffle when user clicks a filter item */
		$('.filter-item').click(function (e) {
			e.preventDefault();

			// set active class
			$('.filter-item').removeClass('current');
			$(this).addClass('current');

			// get group name from clicked item
			var groupName = $(this).attr('data-group');

			// reshuffle grid
			$grid.shuffle('shuffle', groupName );
		});

	});

} )( jQuery );
