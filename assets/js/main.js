(function($) {
	'use strict';
    $(document).on('ready', function() {
        $("#courses-header-slider").owlCarousel({
            center: false,
            items:1,
            loop:true,
            margin:30,
            responsive:{
                1000:{
                    items:1
                },
                600:{
                    items:1
                }
            }
        });
    });
})(jQuery);
