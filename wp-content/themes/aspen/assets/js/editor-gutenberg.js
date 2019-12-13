jQuery(document).ready(function ($) {
	"use strict";

	$(window).load(function () {

		aspen_hide_postformat_options();
		var this_id = 'post-format-' + $("#post-format-selector-0").val();
		aspen_switch_postformat_options(this_id);

		$("#post-format-selector-0").change(function () {
			aspen_hide_postformat_options();
			var this_id = 'post-format-' + $(this).val();
			aspen_switch_postformat_options(this_id);
		});

	});

	function aspen_hide_postformat_options() {
		$("#post_format_quote_options, #post_format_link_options, #post_format_video_options, #post_format_gallery_options").hide();
	}

	function aspen_switch_postformat_options(this_id) {

		switch (this_id) {
			case 'post-format-quote':
				$("#post_format_quote_options").show();
				break;
			case 'post-format-link':
				$("#post_format_link_options").show();
				break;
			case 'post-format-video':
				$("#post_format_video_options").show();
				break;
			case 'post-format-gallery':
				$("#post_format_gallery_options").show();
				break;
		}
	}

});
