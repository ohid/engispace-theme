(function($) {
	'use strict';

    window.engispace = {
        /**
         * Init header functions
         */
        initHeaderFunctions: function() {
            // Toggle the header user profile menu on click
            $('.es-user-profile-button button').on('click', function() {
                $('.es-user-profile-dropdown').toggleClass('active');
            });
        },

        /**
         * Function to create the sliders on the courses pages
         */
        initCourseSliders: function() {
            // Header slider on the courses page
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
            
            // Courses slider on the courses page
            $(".courses_slider").owlCarousel({
                center: false,
                items: 1,
                loop: false,
                dots: false,
                nav: true,
                margin: 20,
                responsive:{
                    1024:{
                        items: 5
                    },
                    768:{
                        items: 3
                    },
                    480:{
                        items: 2
                    }
                }
            });
        },

        /**
         * Init hover functionality on course carouosel items
         * 
         */
        initCourseItemHover: function() {
            let windowWidth = $(window).width();
            if ( windowWidth < 1025 ) {
                return;
            }
            let courseDetailsBox;
            $( '.es-course-item' )
                .on('mouseover', function() {
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
                })
                .on('mouseleave', function(data) {
                    let $this = $(this);
                    if ( data.relatedTarget && data.relatedTarget.className !== 'es-course-details' ) {
                        courseDetailsBox.removeClass('display').html('');
                    }
                    $this.removeClass('left-pseudo-element')
                    courseDetailsBox.removeClass('left-pseudo-element')
                }
            );
    
            $('.es-single-course-details-box').on('mouseleave', function() {
                $('.es-single-course-details-box').removeClass('display').html('');
            });
        },

        /**
         * Authentication sign in form
         */
        initSignIn: function() {
            const signInHandler = (e, thisForm) => {
                e.preventDefault();
                let formMessageBox = thisForm.find('.es-form-message');

                formMessageBox
                    .html("")
                    .removeClass('form-error form-success');

                const emailField = thisForm.find('#login_email').val();
                const passwordField = thisForm.find('#login_password').val();

                // return form submit if one of the field is empty
                if ( !emailField || !passwordField ) {
                    formMessageBox
                        .html("Please enter email or password")
                        .removeClass('form-success')
                        .addClass('form-error');

                    return;
                }

                // Get the form input data
                const formData = thisForm.serialize();

                // Make AJAX sign in request
                $.ajax({
                    url: engisapce_obj.ajaxurl,
                    method: 'POST',
                    data: formData,
                    success: function( response ) {
                        // handle sign in error response
                        if ( ! response.success ) {
                            thisForm.find('.es-form-message')
                                .html( "Email or password did not match" )
                                .addClass('form-error')
                                .removeClass('form-success');
                            return;
                        }
                        // on successful sign in, reload the page
                        window.location.reload(); 
                    }
                })
            }
            
            /**
             * Sigm in form handle submit event
             */
            $('#es-signin-form').on('submit', function(e) {
                signInHandler(e, $(this));
            } );
        },

        /**
         * Authentication Signup Form
         */
        initSignUp: function() {
            // Validate the signup form inputs 
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
                    const formMessageBox = $(form).find('.es-form-message');
                    const formData = $(form).serialize();

                    // clear out the fields and messages
                    formMessageBox
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
                                formMessageBox
                                    .html( "There's something wrong with form validation" )
                                    .addClass('form-error')
                                    .removeClass('form-success');
                                return;
                            }
                            if ( ! response.success && response.data === 'user_exists' ) {
                                formMessageBox
                                    .html( "User already exists" )
                                    .addClass('form-error')
                                    .removeClass('form-success');
                                return;
                            }
                            if ( response.success && response.data === 'user_created' ) {
                                formMessageBox
                                    .html( "Your account has been created" )
                                    .addClass('form-success')
                                    .removeClass('form-error');
                            }

                            // On successful form signup request
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
        },

        /**
         * Init authentication modal on button clicks
         */
        initAuthModal: function() {
            // Open signin modal
            $(document).on('click', '#es-open-signin-modal', function() {
                $('.es-modal-wrapper').addClass('display-modal').attr('modal-type', 'signin-modal')
            });
            // Open signup modal
            $('#es-open-signup-modal').on('click', function() {
                $('.es-modal-wrapper').addClass('display-modal').attr('modal-type', 'signup-modal')
            });
            // Close modal 
            $(document).on('click', '.close-modal', function() {
                if ($('.es-modal-wrapper[modal-type="auth-require-modal"]')) {
                    $('.es-modal-wrapper[modal-type="auth-require-modal"]').remove();
                }
                    $('.es-modal-wrapper')
                        .removeClass('display-modal signin-modal signup-modal')
                        .attr('modal-type', '');
            });

            // Open sign in modal from auth modal
            $(document).on('click', '#es-open-signin-modal-from-auth', function() {
                // Close the auth required modal first
                if ($('.es-modal-wrapper[modal-type="auth-require-modal"]')) {
                    $('.es-modal-wrapper[modal-type="auth-require-modal"]').remove();
                }
                // open the signin modal
                $('.es-modal-wrapper').addClass('display-modal').attr('modal-type', 'signin-modal');
            });
            
            // Open sign up modal from auth modal
            $(document).on('click', '#es-open-signup-modal-from-auth', function() {
                // Close the auth required modal first
                if ($('.es-modal-wrapper[modal-type="auth-require-modal"]')) {
                    $('.es-modal-wrapper[modal-type="auth-require-modal"]').remove();
                }
                // open the signin modal
                $('.es-modal-wrapper').addClass('display-modal').attr('modal-type', 'signup-modal');
            });

            // Swith modal content from signin form to signup form
            $('.es-btn-switch-to-login').on('click', function() {
                $('.es-modal-wrapper').attr('modal-type', 'signin-modal')
            });
            
            // Swith modal content from signup form to signin form
            $('.es-btn-switch-to-signup').on('click', function() {
                $('.es-modal-wrapper').attr('modal-type', 'signup-modal')
            });
        },

        /**
         * Create Stripe checkout session and get the URL via AJAX
         */
        initCoursePurchase: function() {
            // Get the stripe checkout URL
            const redirectToStripeCheckoutPage = (thisBtn, courseData) => {
                $.ajax({
                    url: engisapce_obj.ajaxurl,
                    method: "POST",
                    data: {
                        action: 'es_course_purchase_url',
                        nonce: engisapce_obj.nonce,
                        course_id: courseData.id
                    },
                    success: function( response ) {
                        if ( ! response.success ) {
                            // disable button load
                            thisBtn.removeClass('loading');
                        }
                        // redirect to the Stripe checkout page
                        window.location.href = response.data;
                    }
                })
            }

            const redirectToSuccessPage = (thisBtn, courseData) => {
                console.log(courseData);
                $.ajax({
                    url: engisapce_obj.ajaxurl,
                    method: "POST",
                    data: {
                        action: 'es_free_course_purchase',
                        nonce: engisapce_obj.nonce,
                        course_id: courseData.id
                    },
                    success: function( response ) {
                        if ( ! response.success ) {
                            // disable button load
                            thisBtn.removeClass('loading');
                        }
                        // redirect to the Stripe checkout page
                        window.location.href = response.data;
                    }
                });
            }

            /**
             * Open the authentication modal when required
             * @param {object} thisBtn 
             */
            const openAuthRequiredModal = ( thisBtn ) => {
                $.ajax({
                    url: engisapce_obj.ajaxurl,
                    method: "POST",
                    data: {
                        action: 'es_auth_required_modal',
                        nonce: engisapce_obj.nonce
                    },
                    success: function( response ) {
                        thisBtn.removeClass('loading');
                        $('body').append( response.data )
                    }
                })
            }

            // Handle course purchase button event click
            $('#course-purchase-btn').on('click', function() {
                const thisBtn = $(this),
                    courseData = thisBtn.data('course-info'),
                    isFree = thisBtn.data('is-free-course');
                // bail out if the purchase button already made an AJAX request
                if ( ! thisBtn.hasClass( 'loading' ) ) {
                    // turn the button loader on
                    thisBtn.addClass('loading');

                    // Check user authentication status
                    // Display auth require popup
                    if ( !engisapce_obj.user_logged_in ) {
                        $('.es-modal-wrapper.es-auth-require-modal').addClass('display-modal').attr('modal-type', 'auth-require-modal');
                        openAuthRequiredModal( thisBtn );
                        return;
                    }

                    if ( isFree ) {
                        // redirect to course success page once purchase
                        redirectToSuccessPage(thisBtn, courseData);
                    } else {
                        // redirect to stripe checkout page
                        redirectToStripeCheckoutPage(thisBtn, courseData);
                    }
                }
            })
        },

        init: function() {
            window.engispace.initHeaderFunctions();
            window.engispace.initCourseSliders();
            window.engispace.initCourseItemHover();
            window.engispace.initSignIn();
            window.engispace.initSignUp();
            window.engispace.initAuthModal();
            window.engispace.initCoursePurchase();
        }
    }

    if ( 'loading' === document.readyState ) {
		// The DOM has not yet been loaded.
		document.addEventListener( 'DOMContentLoaded', window.engispace.init );
	} else {
		// The DOM has already been loaded.
		window.engispace.init();
	}
})(jQuery);
