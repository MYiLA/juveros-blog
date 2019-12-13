/*
JavaScript for Widgets
 */

/*
Initialize Dynamically Added Widgets for WordPress Sidebar Editor
 */
(function ($) {
	"use strict";

	// init for widgets editor
	function initDynamicWidgetControls(widget) {

		widget.find('.at-datepicker').datepicker({
			dateFormat: 'yy/mm/dd'
		});

		widget.find('.at-color-iris').wpColorPicker({
			change: _.throttle(function () { // For Customizer
				$(this).trigger('change');
			}, 3000)
		});

		widget.find('.at-sortable').sortable({
			'placeholder': "ui-state-highlight"
		});

		widget.find('.widget-groups').each(function () {
			var group = $(this).data('group-first');
			widget.find('.group').hide();
			widget.find('.group-' + group).show();
		});

		widget.find('.group-selector').each(function () {
			var group_name = ($(this).attr('id'));
			$('.group-' + group_name).hide();
			$(this).on('change', function (e) {
				e.preventDefault();
				if ($(this).is(':checkbox')) {
					var group_val = $(this).attr('checked');
				} else {
					var group_val = $(this).find('option:selected').val();
				}
				$('.group-' + group_name).hide().each(function () {
					var group_val_options = $(this).data('group-value');
					if (group_val_options.indexOf(group_val) != -1) {
						$(this).show();
					}
				});

			}).change();
		});

		widget.find('.group-tab-link').on("click", function (e) {
			var group = $(this).data('group-target');
			widget.find('.widget-groups li').removeClass('tabs');
			$(this).closest('li').addClass('tabs');
			widget.find('.group').hide();
			widget.find('.group-' + group).show();
			widget.find('.group-selector').each(function () {
				$(this).change();
			});
		});
	}

	function onWidgetFormUpdate(event, widget) {
		initDynamicWidgetControls(widget);
	}

	$(document).on('widget-added widget-updated', onWidgetFormUpdate);

	$(document).ready(function () {
		$('#widgets-right .widget').each(function () {
			initDynamicWidgetControls($(this));
		});

	});

	// init for page builder
	$(document).on('panelsopen', function (e) {
		var dialog = $(e.target);
		initDynamicWidgetControls(dialog);
	});

}(jQuery));


/*
 Image selector for built-in widgets
 */
var file_frame;
jQuery(function ($) {
	"use strict";

	// clear previously selected image
	$(document).on('click', 'input.clear-img-widget', function (event) {
		event.preventDefault();
		var image_field_id = $(this).data('target');
		$('#input-' + image_field_id).attr('value', '').trigger('change');
		$('#preview-' + image_field_id).attr('src', $(this).data('preview')).addClass('empty');
	});


	// select or upload image
	$(document).on('click', 'input.select-img-widget', function (event) {
		event.preventDefault();

		var image_field_id = $(this).data('target');

		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery(this).data('uploader_title'),
			button: {
				text: jQuery(this).data('uploader_button_text')
			},
			multiple: false,
			library: {type: 'image'}
		});

		file_frame.on('select', function () {

			var attachment = file_frame.state().get('selection').first().toJSON();

			var url = '';
			if (!!attachment.sizes && !!attachment.sizes.thumbnail) {
				url = attachment.sizes.thumbnail.url;
			} else {
				url = attachment.url;
			}

			if ( url ) {
				$('#preview-' + image_field_id).attr('src', url ).removeClass('empty');
			}

			$('#input-' + image_field_id).attr('value', attachment.id ).trigger('change');
		});
		file_frame.open();
	});
});




