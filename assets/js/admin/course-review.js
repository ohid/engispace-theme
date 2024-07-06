(function($) {
	'use strict';

    $( document ).on('submit', '#admin-course-review-form', function(e) {
        e.preventDefault();

        const course_review_field = $( this ).find( '#course_review_field' ).val();
        // return if review is empty
        if ( !course_review_field.length ) {
            return;
        }
        // Add button loading icon
        $( this ).find( '.es-form-submit' ).addClass( 'btn-loading' );

        // Get the form input data
        const formData = $( this ).serialize();

        // AJAX review submit request
        $.ajax({
            url: ajaxurl,
            method: 'POST',
            data: formData,
            success: function( response ) {
               if (response.success) {
                    window.location.reload();
               }
            }
        })

    });
    
})(jQuery);