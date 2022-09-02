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
		$.ajax({
			url: tjg_ajax_object.ajax_url,
			type: 'POST',
			data: {
				action: 'tjg_confirm_hire',
				nonce: tjg_ajax_object.nonce,
				uid: uid
			},
			success: function (response) {
				console.log(response);
			},
			error: function (error) {
				console.log(error);
			}});
	});

})(jQuery);

// jQuery( "#confirm-hire" ).on( "click", function() {
// 	alert( "Thanks for your interest in hiring me. I will get back to you soon." );
// } );