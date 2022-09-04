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
		$.ajax({
			url: tjg_ajax_object.ajax_url,
			type: 'POST',
			data: {
				action: 'tjg_confirm_hire',
				nonce: tjg_ajax_object.nonce,
				uid: uid,
				field_id: field_id,
				form_id: form_id
			},
			success: function (response) {
				Object.keys(response).forEach(function (key) {
					console.log(key, response[key])
				});
			},
			error: function (response) {
				console.log(response);
			}
		});
	});

})(jQuery);