jQuery(document).ready(function($) {

    var formId = "#kg_newsletter_form";
    var emailId = "#kg_newsletter_email";  
    var emailWrapClass = ".getstarted_input_mainWrap";  
    var thankWrapColClass = ".kg_newsletter_thankWrap";  

    $(thankWrapColClass).hide();  

    // form submission
    $(formId).on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&kg_newsletter_form_save_nonce_field=' + kg_newsletter_ajax_object.nonce;

        var scrollId = ''; 
        var email = $(emailId);   
        var go_ahead = true;

        // Clear previous errors
        $(errorClass).html(''); 

        // Email validation
        if ('' == email.val().trim()) {
            email.closest(emailWrapClass).next(errorClass).html(email_empty_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('email', email.val().trim())) {
            email.closest(emailWrapClass).next(errorClass).html(email_invalid_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', email.val().trim())) {
            email.closest(emailWrapClass).next(errorClass).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else {
            email.closest(emailWrapClass).next(errorClass).html('').hide();
        }  

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: kg_newsletter_ajax_object.ajax_url,
                data: formData + '&action=handle_newsletter_form',
                beforeSend: function() {
                    $(loaderClass).css('display', 'flex');
                },
                success: function(res) {
                    $(loaderClass).hide(); 
                    if (res.success) { 
                        $(formId)[0].reset();
                        $(formId).hide();
                        $(thankWrapColClass).show();
                        form_id_scroll(thankWrapColClass);
                    } else { 
                        $('.kg_newsletter_cmnError').show().find('.kg_newsletter_cmnError_in').html(res.data.error); 
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        } else {
            form_id_scroll(scrollId);
        }
    }); 

    // Hide errors on focus 
    hideErrorOnFocus(emailId); 
    
    // Clean inputs on focus paste  
    cleanInputField(emailId, emailPattern, true);  

});

function jobseek_register_recaptchaCallback() {
    jQuery('.jobseek_register_captcha_Wrap').find(errorClass).hide();
}    