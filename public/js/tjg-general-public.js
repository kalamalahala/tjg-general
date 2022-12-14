(function ($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(".tjg-confirm-hire-button").on("click", function (e) {
		e.preventDefault();
		var uid = $(this).data("uid");
		var field_id = $(this).data("field-id");
		var form_id = $(this).data("form-id");

		// select table row
		var $row = $(this).closest("tr");

		// fade row out
		$row.fadeOut();

		$.ajax({
			url: tjg_ajax_object.ajax_url,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'tjg_confirm_hire',
				nonce: tjg_ajax_object.nonce,
				uid: uid,
				field_id: field_id,
				form_id: form_id
			},
			success: function (response) {
				// console log each key in the response object
				$.each(response, function (key, value) {
					console.log(key + ': ' + value);
				});

				// if the response is true, remove the row
				if (response.success) {
					// add success message in new row below
					$row.after('<tr><td colspan="5" class="tjg-success-message">' + response.data + '</td></tr>');
					$row.remove();
				}

			},
			error: function (response) {
				console.log('error');
			}
		});
	});

})(jQuery);