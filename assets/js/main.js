(function($) {
	'use strict';

    function course_details_hover_box() {
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
                let certainMinusPos = ( windowWidth < 1200 ) ? 120 : 95;
                
                if ( documentWidth - elementTrueOffset <= 340 ) {
                    $this.addClass('left-pseudo-element');
                    courseDetailsBox.addClass('left-pseudo-element');
                    setElementPosition = elementOffset.left - elementWidth - certainMinusPos;
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
    }

    function hide_mobile_menu() {
        let windowWidth = $(window).width();
        if ( (windowWidth + 15) < 1025 ) {
            return;
        }

        $('.es-header-mobile-navigation-wrapper').hide();
    }

    window.engispace = {
        /**
         * Init header functions
         */
        initHeaderFunctions: function() {
            // Toggle the header user profile menu on click
            $('.es-user-profile-button button').on('click', function() {
                $('.es-user-profile-dropdown').toggleClass('active');
            });

            $('.es-site-mobile-menu-btn').on('click', function() {
                $('.es-header-mobile-navigation-wrapper').slideToggle();
            })
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
                    768:{
                        items: 5
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
            course_details_hover_box();
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
                        // on successful sign in, redirect to the profile page
                        setTimeout(function() {
                            window.location.href = engisapce_obj.siteurl + '/profile';
                        }, 100);
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
                                window.location.href = engisapce_obj.siteurl + '/profile';
                            }, 100);
                        }
                    })
                }
            });
        },

        initForgetPassword: function() {
            const forgetPasswordHandler = (e, thisForm) => {
                e.preventDefault();
                let formMessageBox = thisForm.find('.es-form-message');

                formMessageBox
                    .html("")
                    .removeClass('form-error form-success');

                const emailField = thisForm.find('#forget_email').val();

                // return form submit if one of the field is empty
                if ( !emailField ) {
                    formMessageBox
                        .html("Please enter email")
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
                                .html( "There's something wrong with your request" )
                                .addClass('form-error')
                                .removeClass('form-success');
                        } else {
                            thisForm.find('.es-form-message')
                                .html( "Please check your email for reset link" )
                                .addClass('form-success')
                                .removeClass('form-error');

                            $('#ees-forget-password-form')[0].reset();
                        }
                        return;
                    }
                })
            }
            
            /**
             * Forget password form handle submit event
             */
            $('#es-forget-password-form').on('submit', function(e) {
                forgetPasswordHandler(e, $(this));
            } );
        },

        /**
         * Init authentication modal on button clicks
         */
        initAuthModal: function() {
            // Open signin modal
            $(document).on('click', '#es-open-signin-modal', function() {
                $('#site-auth-modal').addClass('display-modal').attr('modal-type', 'signin-modal');
            });
            // Open signup modal
            $('#es-open-signup-modal, .es-home-cta-signup').on('click', function() {
                $('#site-auth-modal').addClass('display-modal').attr('modal-type', 'signup-modal');
            });
            // Close modal 
            $(document).on('click', '.close-modal', function() {
                if ($('.es-modal-wrapper[modal-type="auth-require-modal"]')) {
                    $('.es-modal-wrapper[modal-type="auth-require-modal"]').remove();
                }
                $('.es-modal-wrapper').removeClass('display-modal')
            });

            // Open sign in modal from auth modal
            $(document).on('click', '#es-open-signin-modal-from-auth', function() {
                // Close the auth required modal first
                if ($('.es-modal-wrapper[modal-type="auth-require-modal"]')) {
                    $('.es-modal-wrapper[modal-type="auth-require-modal"]').remove();
                }
                // open the signin modal
                $('#site-auth-modal').addClass('display-modal').attr('modal-type', 'signin-modal');
            });
            
            // Open sign up modal from auth modal
            $(document).on('click', '#es-open-signup-modal-from-auth', function() {
                // Close the auth required modal first
                if ($('.es-modal-wrapper[modal-type="auth-require-modal"]')) {
                    $('.es-modal-wrapper[modal-type="auth-require-modal"]').remove();
                }
                // open the signin modal
                $('#site-auth-modal').addClass('display-modal').attr('modal-type', 'signup-modal');
            });

            // Open forget password modal from auth modal
            $(document).on('click', '#es-open-forget-password-form', function() {
                // Close the auth required modal first
                if ($('.es-modal-wrapper[modal-type="auth-require-modal"]')) {
                    $('.es-modal-wrapper[modal-type="auth-require-modal"]').remove();
                }
                // open the forgot password modal
                $('#site-auth-modal').addClass('display-modal').attr('modal-type', 'forget-password-modal');
            });

            // Swith modal content from signin form to signup form
            $('.es-btn-switch-to-login').on('click', function() {
                $('#site-auth-modal').attr('modal-type', 'signin-modal')
            });
            
            // Swith modal content from signup form to signin form
            $('.es-btn-switch-to-signup').on('click', function() {
                $('#site-auth-modal').attr('modal-type', 'signup-modal')
            });

            $('.password-field-toggle').on('click', function(e) {
                e.preventDefault();
                let field = $( this ).closest( '.es-form-control' ).find('input');
                if ( $(this).hasClass('password-displayed') ) {
                    field.attr('type', 'password');
                } else {
                    field.attr('type', 'text');
                }
                $(this).toggleClass( 'password-displayed' );
            });

            // Close the popup by clicking outside the modal
            $(document).on('click', '.es-modal-wrapper', function(e) {
                if ( e.target.classList.contains('es-modal-wrapper') ) {
                    // Close the auth required modal first
                    if ($('.es-modal-wrapper[modal-type="auth-require-modal"]')) {
                        $('.es-modal-wrapper[modal-type="auth-require-modal"]').remove();
                    }
                    
                    $('.es-modal-wrapper').removeClass('display-modal');
                }
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

        initSocialShare: function() {
            $('.es-sc-share-btn').on('click', function() {
                $('#social-share-modal').addClass('display-modal');
            });

        },

        initStartSelling: function() {
            $('#es-start-selling').on('click', function(e) {
                e.preventDefault();
                
                if ( $(this).hasClass('es-creator-user') ) {
                    window.location.href = $(this).attr('href');
                } else {
                    $('#upgrade-subscription-modal').addClass('display-modal');
                }
                return;
            });
        },

        initSmoothScrolling: function() {
            // Select all links with hashes
            $('a[href*="#"]')
                // Remove links that don't actually link to anything
                .not('[href="#"]')
                .not('[href="#0"]')
                .click(function(event) {
                    // On-page links
                    if ( 
                        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && 
                        location.hostname == this.hostname 
                    ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                    }
                });
        },

        initUpdateUserPassword: function() {
            // Validate the signup form inputs 
            $("#es-update-user-password").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    old_password: "required",
                    new_password: "required",
                    confirm_password: "required",
                    new_password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo : "#new_password"
                    }
                },
                // Specify validation error messages
                messages: {
                    old_password: {
                        required: "Please enter your old password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    new_password: {
                        required: "Please enter a new password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    password_confirm: {
                        required: "Please enter a new password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                },
                submitHandler: function( form ) {
                    const thisForm = $(form);
                    const formMessageBox = thisForm.find('.es-form-message');
                    const formData = thisForm.serialize();

                    // clear out the fields and messages
                    formMessageBox
                        .html("")
                        .removeClass('form-error form-success');
                    thisForm.find('.es-submit-btn button').addClass('btn-loading');

                    // AJAX submit the form
                    $.ajax({
                        url: engisapce_obj.ajaxurl,
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            console.log(response);
                            thisForm.find('.es-submit-btn button').removeClass('btn-loading');
                            // if input validation failed from back end
                            if ( !response.success ) {
                                formMessageBox
                                    .html( "There's something wrong updating your password" )
                                    .addClass('form-error')
                                    .removeClass('form-success');
                                return;
                            } else {
                                formMessageBox
                                    .html( "Password updated successfully" )
                                    .addClass('form-success')
                                    .removeClass('form-error');
                            }

                            // On successful form signup request
                            // reset the form 
                            $('#es-update-user-password')[0].reset();
                        }
                    })
                }
            });
        },

        initUpdateCourseMetadata: function() {
            // Validate the signup form inputs 
            $("#creator-update-course-metadata").validate({
                // Specify validation rules
                rules: {
                    es_course_short_description: "required",
                    es_course_difficulty_level: "required",
                    es_course_duration: "required",
                    es_course_original_price: "required",
                },
                // Specify validation error messages
                messages: {
                    es_course_short_description: {
                        required: "You must enter a value",
                    },
                    es_course_difficulty_level: {
                        required: "You must enter a value",
                    },
                    es_course_duration: {
                        required: "You must enter a value",
                    },
                    es_course_original_price: {
                        required: "You must enter a value",
                    },
                },
                submitHandler: function( form ) {
                    const thisForm = $(form);
                    thisForm.find('.es-submit-btn button').addClass('btn-loading');
                    const formMessageBox = thisForm.find('.es-form-message');
                    const formData = thisForm.serialize();

                    // clear out the fields and messages
                    formMessageBox
                        .html("")
                        .removeClass('form-error form-success');

                    // AJAX submit the form
                    $.ajax({
                        url: engisapce_obj.ajaxurl,
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            thisForm.find('.es-submit-btn button').removeClass('btn-loading');
                            // if input validation failed from back end
                            if ( response.success ) {
                                formMessageBox
                                    .html( "Successfully updated course metadata" )
                                    .addClass('form-success')
                                    .removeClass('form-error');
                            }
                        }
                    })
                }
            });
        },

        initUserProfileModals: function() {
            $('#es-user-profile-details').on('click', function() {
                $('#user-proifle-details-modal').addClass('display-modal').attr('modal-type', 'es-user-profile-details');
            });
            $('#es-user-contact-details').on('click', function() {
                $('#user-contact-details-modal').addClass('display-modal').attr('modal-type', 'es-user-contact-details');
            });
        },

        initUpdateUserProfileDetails: function() {
            // Validate the signup form inputs 
            $("#es-update-user-details-form").validate({
                // Specify validation rules
                rules: {
                    es_person_first_name: "required",
                    es_person_last_name: "required",
                    es_person_description: "required"
                },
                // Specify validation error messages
                messages: {
                    es_person_first_name: {
                        required: "You must enter a value",
                    },
                    es_person_last_name: {
                        required: "You must enter a value",
                    },
                    es_person_description: {
                        required: "You must enter a value",
                    }
                },
                submitHandler: function( form ) {
                    $( '#es-update-user-details-form' ).on('submit', function( e ) {
                        e.preventDefault();
                        const thisForm = $( this );
                        thisForm.find('.es-submit-btn button').addClass('btn-loading');
                        const formMessageBox = thisForm.find('.es-form-message');
                        var formData = new FormData( this );
        
                        // clear out the fields and messages
                        formMessageBox
                            .html("")
                            .removeClass('form-error form-success');
        
                        // AJAX submit the form
                        $.ajax({
                            url: engisapce_obj.ajaxurl,
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                thisForm.find('.es-submit-btn button').removeClass('btn-loading');
                                // if input validation failed from back end
                                if ( response.success ) {
                                    formMessageBox
                                        .html( "Successfully updated personal details" )
                                        .addClass('form-success')
                                        .removeClass('form-error');
                                }
                            }
                        })
                    }); 
                }
            });
        },

        initUpdateUserContactDetails: function() {
            // Validate the signup form inputs 
            $("#es-update-user-contact-details-form").validate({
                // Specify validation rules
                rules: {
                    es_person_phone_number: "required",
                    es_person_email: "required",
                    es_person_url: "required"
                },
                // Specify validation error messages
                messages: {
                    es_person_phone_number: {
                        required: "You must enter a value",
                    },
                    es_person_email: {
                        required: "You must enter a value",
                    },
                    es_person_url: {
                        required: "You must enter a value",
                    }
                },
                submitHandler: function( form ) {
                    const thisForm = $( form );
                    thisForm.find('.es-submit-btn button').addClass('btn-loading');
                    const formMessageBox = thisForm.find('.es-form-message');
                    var formData = thisForm.serialize();
    
                    // clear out the fields and messages
                    formMessageBox
                        .html("")
                        .removeClass('form-error form-success');
    
                    // AJAX submit the form
                    $.ajax({
                        url: engisapce_obj.ajaxurl,
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            thisForm.find('.es-submit-btn button').removeClass('btn-loading');
                            // if input validation failed from back end
                            if ( response.success ) {
                                formMessageBox
                                    .html( "Successfully updated personal details" )
                                    .addClass('form-success')
                                    .removeClass('form-error');
                            }
                        }
                    })
                }
            });
        },

        initProfileMembershipUpgrade: function() {
            $('.es-membership-plan').on('click', function() {
                const self = $(this),
                    downloadId = self.attr('data-download-id'),
                    priceId = self.attr('data-price-id');
                    
                // Build the checkout URL
                let checkoutUrl = engisapce_obj.siteurl + '/checkout?edd_action=add_to_cart&download_id='+ downloadId +'&edd_options[price_id]=' + priceId;

                self.siblings().attr( 'data-current-plan', false );
                self.attr( 'data-current-plan', true );

                // remove attribute and set checkout url
                $('.es-upgrade-membership').removeAttr( 'data-button-disabled' );
                $('.es-upgrade-membership a').attr( 'href', checkoutUrl );
            });

            $(document).on('click', '.es-upgrade-membership[data-button-disabled="true"] a', function(e) {
                e.preventDefault();
            })
        },

        initCreatorStripeForm: function() {
            // Validate the form inputs 
            $("#creator-stripe-api-form").validate({
                // Specify validation rules
                rules: {
                    es_creator_stripe_api_field: "required",
                },
                // Specify validation error messages
                messages: {
                    es_creator_stripe_api_field: {
                        required: "You must enter a value",
                    },
                },
                submitHandler: function( form ) {
                    const thisForm = $(form);
                    thisForm.find('.es-submit-btn button').addClass('btn-loading');
                    const formMessageBox = thisForm.find('.es-form-message');
                    const formData = thisForm.serialize();

                    // clear out the fields and messages
                    formMessageBox
                        .html("")
                        .removeClass('form-error form-success');

                    // AJAX submit the form
                    $.ajax({
                        url: engisapce_obj.ajaxurl,
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            console.log(response);
                            thisForm.find('.es-submit-btn button').removeClass('btn-loading');
                            // if input validation failed from back end
                            if ( !response.success ) {
                                formMessageBox
                                    .html( "There's something wrong updating the form" )
                                    .addClass('form-error');
                            }
                            if ( response.success ) {
                                formMessageBox
                                    .html( "Successfully updated course metadata" )
                                    .addClass('form-success');
                            }
                        }
                    })
                }
            });
        },

        initCouseSidebarExpandableMenu: function() {
            $('#es-course-categories-menu > li').each(function( index, el ) {
                if($(el).children( 'ul.children' ).length) {
                    $(el).addClass('es-has-children').append('<span class="es-expand-menu" id="es-sidebar-expand-menu"><svg width="8px" height="13px" viewBox="0 0 8 13" version="1.1" style="transition: all 0.2s ease 0s; transform: initial;"><title></title><desc></desc><defs></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="courses_view_all" transform="translate(-417.000000, -404.000000)" fill="#C2C7CA"><g id="related" transform="translate(133.000000, 144.000000)"><g id="icons/dropdown" transform="translate(277.000000, 256.000000)"><path d="M10.4285714,12.4285714 L10.4285714,7.28571429 C10.4285714,6.57563389 11.0042053,6 11.7142857,6 C12.4243661,6 13,6.57563389 13,7.28571429 L13,13.7142857 C13,14.4243661 12.4243661,15 11.7142857,15 L5.28571429,15 C4.57563389,15 4,14.4243661 4,13.7142857 C4,13.0042053 4.57563389,12.4285714 5.28571429,12.4285714 L10.4285714,12.4285714 Z" id="cross/white" transform="translate(8.500000, 10.500000) rotate(-45.000000) translate(-8.500000, -10.500000) "></path></g></g></g></g></svg></span>');
                }
            });

            $( document ).on( 'click', '#es-sidebar-expand-menu', function() {
                let thisEl = $( this );
                thisEl.closest( 'li' ).toggleClass('menu-expanded').find('ul.children').slideToggle();
            } );
        },

        miscEvents: function() {
            $( document ).on('click', '.es-faq-selected-page', function() {
                $(this).closest('.es-faq-pages-menu').toggleClass('active');
            });
            
            $( document ).on('click', '.es-faq-question, .es-faq-group .down-arrow', function() {
                $(this).closest('.es-faq-group').toggleClass('active');
            });
        },

        init: function() {
            window.engispace.initHeaderFunctions();
            window.engispace.initCourseSliders();
            window.engispace.initCourseItemHover();
            window.engispace.initSignIn();
            window.engispace.initSignUp();
            window.engispace.initForgetPassword();
            window.engispace.initAuthModal();
            window.engispace.initCoursePurchase();
            window.engispace.initSocialShare();
            window.engispace.initStartSelling();
            window.engispace.initSmoothScrolling();
            window.engispace.initUpdateUserPassword();
            window.engispace.initUpdateCourseMetadata();
            window.engispace.initUserProfileModals();
            window.engispace.initUpdateUserProfileDetails();
            window.engispace.initUpdateUserContactDetails();
            window.engispace.initProfileMembershipUpgrade();
            window.engispace.initCreatorStripeForm();
            window.engispace.initCouseSidebarExpandableMenu();
            window.engispace.miscEvents();

            jQuery(window).on('resize', function() {
                course_details_hover_box();
                hide_mobile_menu();
            });
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
