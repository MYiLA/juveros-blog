/*
 Customizer
 */

(function ($) {
	"use strict";

	function deactivate_customizer_controls(controls) {
		if (jQuery.isArray(controls)) {
			$.each(controls, function (index, control) {
				$('#customize-control-' + control).hide();
			});
		} else {
			$('#customize-control-' + controls).hide();
		}
	}

	function activate_customizer_controls(controls) {
		if (jQuery.isArray(controls)) {
			$.each(controls, function (index, control) {
				$('#customize-control-' + control).show();
			});
		} else {
			$('#customize-control-' + controls).show();
		}
	}

	wp.customize.bind('ready', function () {

		var customize = this;


		/* Banner Content Controls */
		customize('aspen_frontpage_banner_content', function (value) {

			var controls_slider = [
				'aspen_frontpage_slider_style',
				'aspen_frontpage_slider_spacing',
				'aspen_frontpage_slider_posts',
				'aspen_frontpage_hide_duplicates',
				'aspen_frontpage_slider_arrows',
				'aspen_frontpage_slider_bullets',
				'aspen_frontpage_slider_transition',
				'aspen_frontpage_slider_autoplay',
				'aspen_frontpage_slider_autoplay_delay',
			];

			var controls_image = [
				'aspen_frontpage_banner_background_style',
				'aspen_frontpage_banner_background',
				'aspen_frontpage_banner_headline',
				'aspen_frontpage_banner_sub_headline',
			];

			var controls_html = [
				'aspen_frontpage_banner_html'
			];

			var controls_filters = [
				'aspen_frontpage_no_filters'
			];


			var toggle_banner_controls = function (to) {

				switch (to) {
					case 'image':
						activate_customizer_controls(controls_image);
						activate_customizer_controls(controls_filters);
						deactivate_customizer_controls(controls_slider);
						deactivate_customizer_controls(controls_html);
						break;
					case 'slider':
						activate_customizer_controls(controls_slider);
						activate_customizer_controls(controls_filters);
						deactivate_customizer_controls(controls_image);
						deactivate_customizer_controls(controls_html);
						break;
					case 'html':
						activate_customizer_controls(controls_html);
						deactivate_customizer_controls(controls_slider);
						deactivate_customizer_controls(controls_image);
						deactivate_customizer_controls(controls_filters);
						break;
					case 'none':
						deactivate_customizer_controls(controls_slider);
						deactivate_customizer_controls(controls_image);
						deactivate_customizer_controls(controls_html);
						deactivate_customizer_controls(controls_filters);
						break;
				}

			};

			toggle_banner_controls(value.get());
			value.bind(toggle_banner_controls);

		});


		/* Header Controls */
		customize('aspen_header_navigation_style', function (value) {

			var controls_header = [
				'aspen_header_full_width',
				'aspen_header_capitalized',
				'aspen_header_menu_alignment',
				'aspen_header_sticky',
				'aspen_header_transparent',
				'aspen_header_custom_html'
			];

			var toggle_header_controls = function (to) {

				switch (to) {
					case 'one':
						activate_customizer_controls(controls_header);
						deactivate_customizer_controls('aspen_header_custom_html');
						break;
					case 'two':
						activate_customizer_controls(controls_header);
						deactivate_customizer_controls('aspen_header_custom_html');
						break;
					case 'three':
						activate_customizer_controls(controls_header);
						deactivate_customizer_controls('aspen_header_custom_html');
						deactivate_customizer_controls('aspen_header_menu_alignment');
						break;
					case 'four':
						activate_customizer_controls(controls_header);
						deactivate_customizer_controls('aspen_header_full_width');
						deactivate_customizer_controls('aspen_header_sticky');
						deactivate_customizer_controls('aspen_header_transparent');
						deactivate_customizer_controls('aspen_header_menu_alignment');
						break;
					case 'five':
						activate_customizer_controls(controls_header);
						deactivate_customizer_controls('aspen_header_full_width');
						deactivate_customizer_controls('aspen_header_sticky');
						deactivate_customizer_controls('aspen_header_transparent');
						deactivate_customizer_controls('aspen_header_menu_alignment');
						break;
					case 'six':
						activate_customizer_controls(controls_header);
						deactivate_customizer_controls('aspen_header_custom_html');
						deactivate_customizer_controls('aspen_header_full_width');
						deactivate_customizer_controls('aspen_header_sticky');
						deactivate_customizer_controls('aspen_header_transparent');
						deactivate_customizer_controls('aspen_header_menu_alignment');
						break;
					case 'seven':
						activate_customizer_controls(controls_header);
						deactivate_customizer_controls('aspen_header_custom_html');
						deactivate_customizer_controls('aspen_header_menu_alignment');
						deactivate_customizer_controls('aspen_header_transparent');
						break;
					case 'eight':
						activate_customizer_controls(controls_header);
						deactivate_customizer_controls('aspen_header_custom_html');
						deactivate_customizer_controls('aspen_header_menu_alignment');
						deactivate_customizer_controls('aspen_header_transparent');
						break;
				}

			};

			toggle_header_controls(value.get());
			value.bind(toggle_header_controls);

		});


		/* Blog Controls */
		customize('aspen_blog_layout', function (value) {

			var controls_blog = [
				'aspen_blog_grid_columns',
				'aspen_blog_grid_spacing',
				'aspen_blog_layout_alignment',
				'aspen_blog_feature_first_post'
			];

			var toggle_blog_controls = function (to) {

				switch (to) {
					case 'standard':
						activate_customizer_controls(controls_blog);
						deactivate_customizer_controls('aspen_blog_grid_columns');
						deactivate_customizer_controls('aspen_blog_grid_spacing');
						deactivate_customizer_controls('aspen_blog_feature_first_post');
						break;
					case 'journal':
						activate_customizer_controls(controls_blog);
						deactivate_customizer_controls('aspen_blog_grid_columns');
						deactivate_customizer_controls('aspen_blog_grid_spacing');
						deactivate_customizer_controls('aspen_blog_feature_first_post');
						break;
					case 'grid':
						activate_customizer_controls(controls_blog);
						break;
					case 'masonry':
						activate_customizer_controls(controls_blog);
						break;
					case 'split':
						activate_customizer_controls(controls_blog);
						deactivate_customizer_controls('aspen_blog_grid_columns');
						deactivate_customizer_controls('aspen_blog_grid_spacing');
						deactivate_customizer_controls('aspen_blog_layout_alignment');
						deactivate_customizer_controls('aspen_blog_feature_first_post');
						break;
					case 'minimal':
						activate_customizer_controls(controls_blog);
						deactivate_customizer_controls('aspen_blog_grid_columns');
						deactivate_customizer_controls('aspen_blog_grid_spacing');
						deactivate_customizer_controls('aspen_blog_layout_alignment');
						deactivate_customizer_controls('aspen_blog_feature_first_post');
						break;
				}

			};

			toggle_blog_controls(value.get());
			value.bind(toggle_blog_controls);

		});


	});


})(jQuery);


/*
Generic
*/

(function ($) {
	"use strict";

	// Site title and description.
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.site-title a').text(to);
		});
	});
	wp.customize('blogdescription', function (value) {
		value.bind(function (to) {
			$('.site-description').text(to);
		});
	});
	// Header text color.
	wp.customize('header_textcolor', function (value) {
		value.bind(function (to) {
			if ('blank' === to) {
				$('.site-title a, .site-description').css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$('.site-title a, .site-description').css({
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				});
			}
		});
	});
})(jQuery);