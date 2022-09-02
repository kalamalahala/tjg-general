(function( $ ) {
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

	$("#confirm-hire").on("click", function(e) {
		e.preventDefault();
		// var $this = $(this);
		this.append('<div class="loading-spinner"></div>');
		this.append('<div class="loading-spinner-overlay"></div>');
		this.addClass("disabled");
		this.attr("disabled", "disabled");
		this.append('<p>Please wait...</p>');
	});

})( jQuery );

// jQuery( "#confirm-hire" ).on( "click", function() {
// 	alert( "Thanks for your interest in hiring me. I will get back to you soon." );
// } );