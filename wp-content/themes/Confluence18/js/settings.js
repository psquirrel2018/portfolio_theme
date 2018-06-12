(function($) {
	"use strict";

	$(window).load(function() {
		$("#loader").fadeOut("slow");
	});

	$(window).load(function(){
		$(window).scroll(function() {
			var wintop = $(window).scrollTop(), docheight = $('article').height(), winheight = $(window).height();
			console.log(wintop);
			var totalScroll = (wintop/(docheight-winheight))*100;
			console.log("total scroll" + totalScroll);
			$(".KW_progressBar").css("width",totalScroll+"%");
		});
	});

	$(document).ready(function() {

		// ====================================================================
		// Header scroll function

		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			if (scroll > 20) {
				$("header").addClass("hide-header");
			} else {
				$("header").removeClass("hide-header");
			}
		});
		//=====================================================================
		// Superslides

		$('#slider').superslides({
			play: 6000,
			animation: 'fade',
			animation_speed: 2000,
			pagination: true
		});

		//=====================================================================

		/* On isotope v2 hidden class is not defined.
		 Add hidden class if item hidden, before initialising Isotope: */
		var itemReveal = Isotope.Item.prototype.reveal;
		Isotope.Item.prototype.reveal = function() {
			itemReveal.apply( this, arguments );
			$( this.element ).removeClass('isotope-hidden');
		};
		var itemHide = Isotope.Item.prototype.hide;
		Isotope.Item.prototype.hide = function() {
			itemHide.apply( this, arguments );
			$( this.element ).addClass('isotope-hidden'); };

		//=======================================

		// magnific popup

		$(document).ready(function() {


				$('.filter-btn').on('click', function(e){
					e.preventDefault();
					var groupID = $(this).data('groupid');
					if(groupID == -1){
						$('.galleryItem').magnificPopup({
							type: 'image',
							image: {
								titleSrc: function(item) {
									return item.el.attr('title') + '<small>'+ item.el.data('desc') +'</small>';
								}},
							closeOnContentClick: true,
							closeBtnInside: false,
							gallery: { enabled:true }
						});
					}
					else{
						$("a[data-group*='"+groupID+"']").magnificPopup({
							type: 'image',
							closeOnContentClick: true,
							closeBtnInside: false,
							gallery: { enabled:true },
							image: {
								titleSrc: function(item) {
									return item.el.attr('title') + '<small>'+ item.el.data('desc') +'</small>';
								}}
						});
					}
				});

			$('.projectGalleryItem').magnificPopup({
				delegate: 'a', // child items selector, by clicking on it popup will open
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: false,
				gallery: { enabled:true }
				// other options
			});

			$('.filter-all-btn').trigger('click');
			/*var groups = {};
			$('.galleryItem').each(function() {
				var id = parseInt($(this).attr('data-group'), 10);

				if(!groups[id]) {
					groups[id] = [];
				}

				groups[id].push( this );
			});

			$.each(groups, function() {

				$(this).magnificPopup({
					type: 'image',
					closeOnContentClick: true,
					closeBtnInside: false,
					gallery: { enabled:true }
				})

			});*/

		});

	})

})(jQuery);

jQuery(function ($) {
// initialize Isotope after all images have loaded
	var $container = $('#portfolio').imagesLoaded( function() { //The ID for the list with all the blog posts
		$container.isotope({ //Isotope options, 'item' matches the class in the PHP
			itemSelector : '.project-item',
			grid: {
				columnWidth: 200
			}
		});
	});


	//Add the class selected to the item that is clicked, and remove from the others
	var $optionSets = $('#filters'),
		$optionLinks = $optionSets.find('a');

	$optionLinks.click(function(){
		var $this = $(this);
		// don't proceed if already selected
		if ( $this.hasClass('selected') ) {
			return false;
		}
		var $optionSet = $this.parents('#filters');
		$optionSets.find('.selected').removeClass('selected');
		$this.addClass('selected');

		//When an item is clicked, sort the items.
		var selector = $(this).attr('data-filter');
		$container.isotope({ filter: selector });

		return false;
	});

});

jQuery(function ($) {
// initialize Isotope after all images have loaded
	var $container = $('#projects').imagesLoaded( function() { //The ID for the list with all the blog posts
		$container.isotope({ //Isotope options, 'item' matches the class in the PHP
			itemSelector : '.project-item',
			grid: {
				columnWidth: 200
			}
		});
	});


	//Add the class selected to the item that is clicked, and remove from the others
	var $optionSets = $('#project_filters'),
		$optionLinks = $optionSets.find('a');

	$optionLinks.click(function(){
		var $this = $(this);
		// don't proceed if already selected
		if ( $this.hasClass('selected') ) {
			return false;
		}
		var $optionSet = $this.parents('#project_filters');
		$optionSets.find('.selected').removeClass('selected');
		$this.addClass('selected');

		//When an item is clicked, sort the items.
		var selector = $(this).attr('data-filter');
		$container.isotope({ filter: selector });

		return false;
	});

});