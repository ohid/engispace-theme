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

        /**
         * Authentication sign in form
         */
        $('#es-signin-form').on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            
            thisForm.find('.es-form-message')
                .html("")
                .removeClass('form-error form-success');

            const formData = thisForm.serialize();

            $.ajax({
                url: engisapce_obj.ajaxurl,
                method: 'POST',
                data: formData,
                success: function( response ) {
                    if ( ! response.success ) {
                        thisForm.find('.es-form-message')
                            .html( "Email or password did not match" )
                            .addClass('form-error')
                            .removeClass('form-success');
                        return;
                    }
                    
                    window.location.reload(); 
                }
            })
        });

        /**
         * Authentication Signup Form
         */
        $("#es-signup-form").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                firstname: "required",
                lastname: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirm: {
                    required: true,
                    minlength: 8,
                    equalTo : "#password"
                }
            },
            // Specify validation error messages
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                password_confirm: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                email: "Please enter a valid email address"
            },
            submitHandler: function( form ) {
                // form.submit();
                const formData = $(form).serialize();

                // clear out the fields and messages
                $('#es-signup-form .es-form-message')
                    .html("")
                    .removeClass('form-error form-success');
                $('#es-signup-form button[type=submit]').addClass('display');

                // AJAX submit the form
                $.ajax({
                    url: engisapce_obj.ajaxurl,
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#es-signup-form button[type=submit]').removeClass('display');
                        // if input validation failed from back end
                        if ( ! response.success && (
                            response.data === 'form_validation_failed' || 
                            response.data === 'user_error'
                        ) ) {
                            $('#es-signup-form .es-form-message')
                                .html( "There's something wrong with form validation" )
                                .addClass('form-error')
                                .removeClass('form-success');
                            return;
                        }
                        if ( ! response.success && response.data === 'user_exists' ) {
                            $('#es-signup-form .es-form-message')
                                .html( "User already exists" )
                                .addClass('form-error')
                                .removeClass('form-success');
                            return;
                        }
                        if ( response.success && response.data === 'user_created' ) {
                            $('#es-signup-form .es-form-message')
                                .html( "Your account has been created" )
                                .addClass('form-success')
                                .removeClass('form-error');
                        }

                        // reset the form 
                        $('#es-signup-form')[0].reset();

                        // reload the page
                        setTimeout(function() {
                            window.location.reload(); 
                        }, 2000);
                    }
                })
            }
        });


        $('#es-open-signin-modal').on('click', function() {
            $('.es-modal-wrapper').addClass('display-modal').attr('modal-type', 'signin-modal')
        });

        $('#es-open-signup-modal').on('click', function() {
            $('.es-modal-wrapper').addClass('display-modal').attr('modal-type', 'signup-modal')
        });

        $('.close-modal').on('click', function() {
            $('.es-modal-wrapper')
                .removeClass('display-modal signin-modal signup-modal')
                .attr('modal-type', '')
        });

        $('.es-btn-switch-to-login').on('click', function() {
            $('.es-modal-wrapper').attr('modal-type', 'signin-modal')
        });
        $('.es-btn-switch-to-signup').on('click', function() {
            $('.es-modal-wrapper').attr('modal-type', 'signup-modal')
        });
    };

    
    
    $( document ).on( 'ready', engispaceApp );
})(jQuery);
