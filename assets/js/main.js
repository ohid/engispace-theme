(function($) {
	'use strict';

    var engispaceApp = function() {
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
        
        $("#courses_slider").owlCarousel({
            center: false,
            items: 5,
            loop: false,
            margin: 20,
            responsive:{
                1400:{
                    items: 5
                },
                1024:{
                    items: 3
                },
                580:{
                    items: 2
                }
            }
        });
        
        $("#courses_slider_2").owlCarousel({
            center: false,
            items: 5,
            loop: false,
            margin: 20,
            responsive:{
                1400:{
                    items: 5
                },
                1024:{
                    items: 3
                },
                580:{
                    items: 2
                }
            }
        });

        let courseDetailsBox;

        $( '.es-course-item' ).on('mouseover', function() {
            let $this = $(this),
                elementWidth = $this.width(),
                elementOffset = $this.offset(),
                documentWidth = $(document).width(),
                elementTrueOffset = elementOffset.left + elementWidth,
                setElementPosition = elementOffset.left + elementWidth + 10;

            courseDetailsBox = $this.closest('.es-site-courses-grid').find('#es-single-course-details-box'),

            $this.removeClass('left-pseudo-element');

            if ( documentWidth - elementTrueOffset <= 340 ) {
                $this.addClass('left-pseudo-element');
                courseDetailsBox.addClass('left-pseudo-element');
                setElementPosition = elementOffset.left - elementWidth - 90;
            }
            
            // show the course details box
            courseDetailsBox.html('');
            // close the course details and append to the couses details box
            $this.find('.es-course-details').clone().appendTo(courseDetailsBox);
            // set box position            
            courseDetailsBox.css('left', setElementPosition);
            courseDetailsBox.addClass('display');
        }).on('mouseleave', function(data) {
            let $this = $(this);
            if ( data.relatedTarget && data.relatedTarget.className !== 'es-course-details' ) {
                courseDetailsBox.removeClass('display').html('');
            }
            $this.removeClass('left-pseudo-element')
            courseDetailsBox.removeClass('left-pseudo-element')
        });

        $('.es-single-course-details-box').on('mouseleave', function() {
            $('.es-single-course-details-box').removeClass('display').html('');
        });
    };
    
    $( document ).on( 'ready', engispaceApp );
})(jQuery);
