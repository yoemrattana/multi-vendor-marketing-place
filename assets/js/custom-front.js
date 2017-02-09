//MAGNIFIC POPUP
$(document).ready(function() {
  $('.images-block').magnificPopup({
    delegate: 'a', 
    type: 'image',
    gallery: {
      enabled: true
    }
  });
});

(function($) {

	"use strict";

	// TOOLTIP	
	$(".header-links .fa, .tool-tip").tooltip({
	placement: "bottom"
	});
	$(".btn-wishlist, .btn-compare, .display .fa").tooltip('hide');

	// Product Owl Carousel
	$("#owl-product").owlCarousel({
		autoPlay: false, //Set AutoPlay to 3 seconds
		items : 3,
		stopOnHover : true,
		navigation : true, // Show next and prev buttons
		pagination : false,
		navigationText : ["<span class='glyphicon glyphicon-chevron-left'></span>","<span class='glyphicon glyphicon-chevron-right'></span>"]
	});

	$(".owl-product").owlCarousel({
		autoPlay: false, //Set AutoPlay to 3 seconds
		items : 3,
		stopOnHover : true,
		navigation : true, // Show next and prev buttons
		pagination : false,
		navigationText : ["<span class='glyphicon glyphicon-chevron-left'></span>","<span class='glyphicon glyphicon-chevron-right'></span>"]
	});
  
	// TABS
	$('.nav-tabs a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
	});	
	
})(jQuery);

//search section

$(document).ready(function(e){
    $( document ).on( 'click', '.bs-dropdown-to-select-group .dropdown-menu li', function( event ) {
		var $target = $( event.currentTarget );
		$target.closest('.bs-dropdown-to-select-group')
			.find('[data-bind="bs-drp-sel-value"]').val($target.attr('data-value'))
			.end()
			.children('.dropdown-toggle').dropdown('toggle');
		$target.closest('.bs-dropdown-to-select-group')
    		.find('[data-bind="bs-drp-sel-label"]').text($target.context.textContent);
		return false;
	});
});