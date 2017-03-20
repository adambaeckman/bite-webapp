/**
 * Theme functions file.
 *
 */

( function( $ ) {

	// PRIMARY MENU SHOW/HIDE SUBMENU ON HOVER
	function menuHover(){

		if($('#app-navigation').hasClass('mobile-menu')){
			// MOBILE
			// Clear all hover bindings.
			$('.menu-item-has-children').off( 'mouseenter mouseleave' );
		}else{
			// To avoid scenarios with multiple binds, lets remove all hover bindings before we start.
			$('.menu-item-has-children').off( 'mouseenter mouseleave' );

			// NORMAL
			$(".menu-item-has-children").hover(function(){

				// Vars
				var menuItemsWidth = 0;
				var submenuPadding = $(this).children('.sub-menu').outerWidth() - $(this).children('.sub-menu').width();
				var totalWidth = 0;
				var windowWidth = $(window).width();
				var parentLeft = $(this).offset().left;
				var parentLeftPercent = parentLeft / windowWidth * 100;
				var leftPercent = 0;

				// Get width of all sub menu items.
				$(this).children('.sub-menu').children('li').each(function(){
					menuItemsWidth += $(this).outerWidth(true);
				});

				// Add padding of submenu to total width.
				totalWidth = menuItemsWidth + submenuPadding;

				// Calculate left percentage.
				leftPercent = 100 - (totalWidth / windowWidth * 100);

				if (leftPercent > parentLeftPercent) {
					// If the sub menu would be more to the right than its parent, set it to the parent's offset.
					leftPercent = parentLeftPercent+'%';
				}else if (leftPercent < 0) {
					// If the sub menu is wider than the window, get the left border outside the window.
					leftPercent = '-'+$('ul.sub-menu').css('border-left-width');
				}else{
					// Otherwise just use the calculated value.
					leftPercent = leftPercent+'%';
				}

				// Animate it out.
				$(this).children('.sub-menu').stop().animate({left: leftPercent}, 500);

			}, function(){

				// Animate it back.
				$(this).children('.sub-menu').stop().animate({left: '100%'}, 500);

			});

		}

	}

    // PRIMARY MENU SWITCH BETWEEN MOBILE AND NORMAL MENU
    function menuModeSwitch() {

        // Vars
        var primaryNavItemsWidth = 0;
        var totalWidth = 0;
        var windowWidth = $(window).width();
        var menuPadding = $('#primary-nav-inner').outerWidth() - $('#primary-nav-inner').width();
        var menuLogoWidth = $('#nav-logo').outerWidth();
        var totalSpace = windowWidth - menuPadding - menuLogoWidth - 20;

        // Get width of all primary menu items.
        $('#primary-nav > div > ul > li > a').each(function(){
            primaryNavItemsWidth += $(this).outerWidth(true);
        });

        if (primaryNavItemsWidth > totalSpace && !$('#app-navigation').hasClass('mobile-menu')) {
            // Switch to MOBILE
            $('#app-navigation').addClass('mobile-menu');

        }else if (primaryNavItemsWidth < totalSpace && $('#app-navigation').hasClass('mobile-menu')) {
            // Switch to NORMAL
            $('#app-navigation').removeClass('mobile-menu');

            // Make sure mobile menu is closed if we switch to normal
            $('#mobile-nav-toggle').removeClass('open');
            $('#primary-nav').css('left', '100%');
            $('#primary-nav > div > ul > li').removeClass('closed');
            $('#primary-nav > div > ul > li').removeClass('open');

        }

    }

    // OPEN AND CLOSE PRIMARY MOBILE MENU
    function primaryNavMobileToggle(that) {

        if (!that.hasClass('open')) {
            // Open the sublist
            that.addClass('open');
            var primaryNavWidth = $('#primary-nav').outerWidth();
            var windowWidth = $(window).width();
            var targetLeft = primaryNavWidth / windowWidth;
            var targetLeftPercent = 100 - Math.round(targetLeft * 100) + 2;

            $('#primary-nav').stop().animate({left: targetLeftPercent+'%'});

        }else{
            // Close the sublist
            that.removeClass('open');
            $('#primary-nav').stop().animate({left: 100+'%'});
        }

    }


    // OPEN AND CLOSE PRIMARY MOBILE SUBMENU
    function primaryNavSubmenuMobileToggle(that) {

        if (!that.closest('li').hasClass('open')) {
            // Open the submenu
            $('.mobile-menu #primary-nav > div > ul > li').addClass('closed');
            $('.mobile-menu #primary-nav > div > ul > li').removeClass('open');
            that.closest('li').removeClass('closed');
            that.closest('li').addClass('open');
        }else{
            // Close the sublist
            $('.mobile-menu #primary-nav > div > ul > li').removeClass('closed');
            that.closest('li').removeClass('open');
        }

    }


    // ADD HOVER FOR TOUCH DEVICES
    function touchHover() {
        var touchItem = $('.touch-hover');

        touchItem.hover(function () {

            $(this).addClass('hover');

        }, function () {
            $(this).removeClass('hover');
        });

        //Touch support for work linkbox hover
        touchItem.bind('touchstart', function (e) {
            touchItem.removeClass('hover');
            $(this).addClass('hover');
        });
    }

	// SECTION SCROLL
	function sectionScroll(that) {

		var scrollTarget = that.parent().outerHeight() + that.parent().offset().top - $('#primary-nav-outer').outerHeight();

		$('html, body').animate({
			scrollTop: Math.round(scrollTarget)
		}, 1000);

	}

    // HEADER SUBLIST MOBILE CHECK
    function sublistMobile() {

        // Check if a header sub list exists
        if ( $('.page-header-sub').length ) {

            // Make sure it's always closed on load or on resize
            $('.header-sub-mobile-toggle').removeClass('open');
            // Make sure the sublist is closed on load or on resize
            $('.header-sublist').css('height', 0);

            // Vars
            var subItemsWidth = 0;
            var subListWidth = 0;
            var totalSpace = $(window).width() - 70;

            // Get width of all header sublist items.
            $('.sublist-item').each(function(){
                subItemsWidth += $(this).outerWidth(true);
            });

            var subListWidth = Math.round(subItemsWidth);

            if (subListWidth > totalSpace && !$('#page-header-top').hasClass('mobile-sublist')) {
                $('#page-header-top').addClass('mobile-sublist');

                // Make sure the sublist is closed if it's switched to normal
                $('.header-sublist').css('height', 0);
            }else if (subListWidth < totalSpace && $('#page-header-top').hasClass('mobile-sublist')) {
                $('#page-header-top').removeClass('mobile-sublist');
            }

        }

    }

    // OPEN AND CLOSE SUBLIST MOBILE MENU
    function sublistMobileToggle(that) {

        if (!that.hasClass('open')) {
            // Open the sublist
            that.addClass('open');
            var targetHeight = $('.header-sublist-inner').outerHeight();

            $('.header-sublist').stop().animate({height: targetHeight});

        }else{
            // Close the sublist
            that.removeClass('open');
            $('.header-sublist').stop().animate({height: 0});
        }

    }


	$( document ).ready( function() {

        // Trigger primary nav check for mobile or normal menu on page load
        menuModeSwitch();

		// Trigger menu hover behaviour on page load
		menuHover();

        // Trigger open and close primary mobile MENU on click
        $('#mobile-nav-toggle').on('click', function(){
            primaryNavMobileToggle($(this));
        })

        // Trigger open and close primary mobile SUBMENU on click
        $('#primary-nav > div > ul > li.menu-item-has-children > .sub-menu-toggle').on('click', function(e){
            e.preventDefault();
            primaryNavSubmenuMobileToggle($(this));
        })

        // Trigger sublist mobile check on page load
        sublistMobile();

        // Trigger touch hover
        touchHover();

        // Trigger open and close sublist mobile menu on click
        $('.header-sub-mobile-toggle').on('click', function(){
            sublistMobileToggle($(this));
        })

		// Trigger scroll to next section on click
		$('.section-scroll').on('click', function(){
			sectionScroll($(this));
		})

		// Split string and add span around the first word
		$('.split-weight').each(function() {
		    var word = $(this).html();

		    var index = word.indexOf(' ');
		    if(index == -1) {
		        index = word.length;
		    }
		    $(this).html('<span class="first-word">' + word.substring(0, index) + '</span>' + word.substring(index, word.length));
		});

	});


	$(window).on('resize', function(){

        // Trigger primary nav check for mobile or normal menu on resize
        menuModeSwitch();

        // Trigger menu hover on resize incase we go between the mobile menu trigger point
        menuHover();

        // Trigger sublist mobile check on resize
        sublistMobile();

	});


	// Page loader with minimum display time incase of very fast page load
	var minDisplayTime = 500,
		interval = 0,
		loaded = false,
		delayed = false,
		fadeLoader = function () {
			$('#page-loader').fadeOut(500);
		};

	timeout = setTimeout(function(){
		delayed = true;
		if(loaded){
			fadeLoader();
		}
	},minDisplayTime);

	$( window ).load(function(){

		loaded = true;

		if( delayed ){
			fadeLoader();
		}

	});

	/*
	$(window).bind('beforeunload',function(){

	     $('#page-loader').fadeIn(100);

	});
	*/

} )( jQuery );
