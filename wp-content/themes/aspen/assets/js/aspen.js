(function ($, window, undefined) {
	"use strict";

	/* Mini jquery plug-in to get list of classes */

	$.fn.classList = function () {
		return this[0].className.split(/\s+/);
	};

	/* Find intersections between two arrays */

	var findOne = function (haystack, arr) {
		return arr.some(function (v) {
			return haystack.indexOf(v) >= 0;
		});
	};

	/* Masonry Init */

	if (jQuery().masonry) {
		var $container = $('.blog-post-items');
		$container.imagesLoaded(function () {
		});
	}

	var $bodyContainer = $(document.body);

	/* Lightbox */

	if (jQuery().simpleLightbox) {
		$('.gallery-item a[href*=".jpg"], .gallery-item a[href*="jpeg"], .gallery-item a[href*=".png"], .gallery-item a[href*=".gif"]').simpleLightbox();
	}

	// Stretch all the full width rows

	var stretchFullWidthRows = function () {

		$('.aspen-full-width').each(function () {
			var $$ = $(this);
			$$.css({
				'margin-left': 0,
				'margin-right': 0,
				'padding-left': 0,
				'padding-right': 0
			});

			var leftSpace = $$.offset().left - $bodyContainer.offset().left;
			var rightSpace = $bodyContainer.outerWidth() - leftSpace - $$.parent().outerWidth();

			$$.css({
				'margin-left': -leftSpace,
				'margin-right': -rightSpace,
				'padding-left': 0,
				'padding-right': 0
			});

		});
	};
	if (!$('body').hasClass('design-boxed')) {
		$(window).resize(stretchFullWidthRows);
		stretchFullWidthRows();
	}


	/* Header Styles */

	function getCurrentScroll() {
		return window.pageYOffset || document.documentElement.scrollTop;
	}

	var elementsWithDynamicNav = ["header-style-one", "header-style-two", "header-style-three", "header-style-five", "header-style-six", "header-style-seven", "header-style-eight"];

	if (findOne($bodyContainer.classList(), elementsWithDynamicNav) && $bodyContainer.hasClass('header-sticky')) {
		var positionHeader = 180;
		$(window).scroll(function () {
			var scroll = getCurrentScroll();
			if (scroll >= positionHeader) {
				$('.navigation-elements').addClass('shrink-sticky');
			}
			else {
				$('.navigation-elements').removeClass('shrink-sticky');
			}
		});

		var shrinkHeader = 280;
		$(window).scroll(function () {
			var scroll = getCurrentScroll();
			if (scroll >= shrinkHeader) {
				$('.navigation-elements').addClass('shrink');
			}
			else {
				$('.navigation-elements').removeClass('shrink');
			}
		});
	}

	/* Mobile Menu - Standard */

	$('#mobile-navigation').smartmenus();

	$('#show-mobile').on('click', function (event) {
		event.preventDefault();
		$('#mobile-navigation-container').toggleClass('hidden');
	});

	$('#site-wrapper').on("click", function (event) {
		var $trigger = $("#mobile-navigation-container");

		if ( ! $trigger.hasClass('hidden') && ! $(event.target).is('#mobile-navigation-container *, #mobile-navigation-container') ) {
			$trigger.toggleClass('hidden');
			$('.nav-button').toggleClass('open');
		}
	});

	/* Push menu - Left */

	if ($bodyContainer.hasClass('header-style-five')) {
		var menuLeft = $('#header-sidebar-push'),
				navleftpush = $('#navleftpush');

		navleftpush.on('click', function () {
			$(this).toggleClass('active');
			$bodyContainer.toggleClass('sidebar-menu-push-toright');
			menuLeft.toggleClass('cbp-spmenu-open');
			$(this).toggleClass('disabled');
		});
	}

	/* Full Screen */

	if ($bodyContainer.hasClass('header-style-six')) {
		var menuTop = $('#header-fullscreen'),
				showTop = $('#show-top');

		showTop.on('click', function () {
			$(this).toggleClass('active');
			$bodyContainer.toggleClass('fullscreen-menu-open');
			menuTop.toggleClass('cbp-spmenu-open');
			$(this).toggleClass('disabled');
		});
	}


	/* Navigation Button */

	$('.nav-button').on("click", function (event) {
		event.stopImmediatePropagation();
		$(this).toggleClass('open');
	});


	/* Search */

	$('a[href="#search-header"]').on('click', function ( event ) {
		event.preventDefault();
		$('#search-header').addClass('open');
		$bodyContainer.toggleClass('search-open');

		setTimeout(function () {
			$('#search-overlay-input').focus();
		}, 500);
	});

	$('#search-header, #search-header button.close').on('click keyup', function (event) {
		if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
			$(this).removeClass('open');
			$bodyContainer.toggleClass('search-open');
		}
	});

	/* Feature Slider */

	$('.banner-slider').each(function () {
		var slider_delay = $(this).data('slider-autoplay-delay');
		var slider_effect = $(this).data('slider-transition');
		var slider_slides_per_view = $(this).data('slider-slides-per-view');
		var slider_spacing = $(this).data('slider-spacing');
		if (!slider_spacing) {
			slider_spacing = 0;
		}

		if ($(this).data('slider-autoplay')) {
			var slider_autoplay = {delay: slider_delay};
		} else {
			var slider_autoplay = false;
		}

		if ($(this).data('slider-style')) {

			var slider_style = $(this).data('slider-style');

			if (slider_style == 'two-columns-full' || slider_style == 'two-columns-normal') {

				var slider_breakpoints = {
					640: {
						slidesPerView: 1,
						spaceBetween: 0
					}
				}

			} else if (slider_style == 'three-columns-full' || slider_style == 'three-columns-normal') {

				var slider_breakpoints = {
					640: {
						slidesPerView: 1,
						spaceBetween: 0
					},

					767: {
						slidesPerView: 2,
						spaceBetween: 0
					}
				}
			} else if (slider_style == 'four-columns-full' || slider_style == 'four-columns-normal') {

				var slider_breakpoints = {
					640: {
						slidesPerView: 1,
						spaceBetween: 0
					},

					767: {
						slidesPerView: 2,
						spaceBetween: 0
					},

					960: {
						slidesPerView: 3,
						spaceBetween: 0
					}
				}

			} else {

				var slider_breakpoints = {
					640: {
						slidesPerView: 1,
						spaceBetween: 0
					}
				}

			}

		} else {
			var slider_breakpoints = {};
		}

		var mySwiper = new Swiper($(this), {
			effect: slider_effect,
			autoplay: slider_autoplay,
			spaceBetween: slider_spacing,
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			slidesPerView: slider_slides_per_view,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev'
			},
			breakpoints: slider_breakpoints
		});

	});

	/* Gallery Slider */

	$('.gallery-slider').each(function () {
		var gallerySwiper = new Swiper($(this), {
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			slidesPerView: 1,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev'
			}
		});
	});


	/* WooCommerce */

	function aspen_added_to_cart(e) {
		aspen_show_notification();
		setTimeout(aspen_hide_notification, 2000);
	}

	function aspen_hide_notification() {
		$('#header-cart-notification').addClass('collapsed');
	}

	function aspen_show_notification() {
		$('#header-cart-notification').removeClass('collapsed');
	}


	$('#header-cart')
			.mouseenter(function () {
				$(this).removeClass('collapsed');
				$("#header-search").addClass('collapsed');
			})
			.mouseleave(function () {
				$(this).addClass('collapsed');
			});


	$('body').bind('added_to_cart', aspen_added_to_cart);


	/* Maps */

	if (jQuery().initMap) {
		$(".map-widget-canvas").each(function () {
			var id = $(this).attr('id');
			var address = $(this).data('location');
			var type = $(this).data('type');
			var zoom = $(this).data('zoom');
			$('#' + id).initMap({
						type: type,
						controls: {
							map_type: {
								type: ['roadmap', 'satellite', 'hybrid'],
								position: 'top_right',
								style: 'dropdown_menu'
							},
							overview: {opened: false},
							pan: false,
							rotate: false,
							scale: false,
							street_view: {position: 'top_center'},
							zoom: {
								position: 'top_left',
								style: 'small'
							}
						},
						center: address,
						markers: {
							marker1: {
								position: address,
								info_window: {
									content: address,
									showOn: 'mouseover',
									hideOn: 'mouseout',
									maxWidth: 150,
									zIndex: 2
								}
							}
						},
						options:
								{
									zoom: zoom
								}
					}
			);
		});
	}

	/* Scroll Up Arrow */
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.scroll-up').fadeIn();
		} else {
			$('.scroll-up').fadeOut();
		}
	});
	$('.scroll-up').on("click", function (e) {
		$("html, body").animate({scrollTop: 0}, 600);
		return false;
	});


})(jQuery, this);



