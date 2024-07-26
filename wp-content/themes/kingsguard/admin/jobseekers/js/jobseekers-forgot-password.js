jQuery(document).ready(function($) { 

    var formId = "#jobseekers_forgot_password_form";
    var resetformId = "#jobseekers_reset_password_form";
    var emailId = "#jobseek_forgot_password_email"; 
    var passwordId = "#jobseek_new_password";
    var confirmPasswordId = "#jobseek_confirm_password"; 
    var captchaId = "#g-recaptcha-response";   
    var captchaWrapId = "#g-recaptcha-response-wrap";
    var thankWrapColClass = ".jobseekers_forgot_password_thankWrap"; 
    var resetthankWrapColClass = ".jobseekers_reset_password_thankWrap";
    var captchaWrapClass = ".jobseek_forgot_password_captcha_Wrap"; 
 
    $(thankWrapColClass).hide(); 
    $(resetthankWrapColClass).hide(); 

    // Forgot Password form submission
    $(formId).on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&jobseekers_forgot_password_form_save_nonce_field=' + jobseeks_forgot_password_ajax_object.nonce;

        var scrollId = ''; 
        var email = $(emailId); 
        var captcha = $(captchaId);
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $(errorClass).html(''); 

        // Email validation
        if ('' == email.val().trim()) {
            email.next(errorClass).html(email_empty_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('email', email.val().trim())) {
            email.next(errorClass).html(email_invalid_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', email.val().trim())) {
            email.next(errorClass).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else {
            email.next(errorClass).html('').hide();
        }  

        // Captcha validation
        if (response.length == 0) {
            captcha.closest(captchaWrapClass).find(errorClass).html(captcha_empty_err_msg).show();
            scrollId = scrollId == '' ? captchaWrapId : scrollId;
            go_ahead = false;
        } else {
            captcha.closest(captchaWrapClass).find(errorClass).hide();
        }

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: jobseeks_forgot_password_ajax_object.ajax_url,
                data: formData + '&action=handle_jobseekers_forgot_password',
                beforeSend: function() {
                    $(loaderClass).css('display', 'flex');
                },
                success: function(res) {
                    $(loaderClass).hide(); 
                    if (res.success) { 
                        $(formId)[0].reset();
                        $(formId).hide();
                        $(thankWrapColClass).show();
                        form_id_scroll(".registerInner");
                    } else {
                        grecaptcha.reset();
                        $('.jobseek_forgot_password_cmnError').show().find('.jobseek_forgot_password_cmnError_in').html(res.data.error); 
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

    // Reset Password form submission
    $(resetformId).on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&jobseekers_reset_password_form_save_nonce_field=' + jobseeks_reset_password_ajax_object.nonce;

        var scrollId = '';  
        var password = $(passwordId);
        var confirmPassword = $(confirmPasswordId); 
        var go_ahead = true;

        // Clear previous errors
        $(errorClass).html('');  

        // Password validation
        if ('' == password.val().trim()) {
            password.next(errorClass).html(password_empty_err_msg).show();
            scrollId = scrollId == '' ? password : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', password.val())) {
            password.next(errorClass).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? password : scrollId;
            go_ahead = false;
        } else if (password.val().length <= 5 ) {
            password.next(errorClass).html(min_6_length_err_msg).show();
            scrollId = scrollId == '' ? password : scrollId;
            go_ahead = false;
        } else {
            password.next(errorClass).html('').hide();
        }

        // Confirm password validation
        if ('' == confirmPassword.val().trim()) {
            confirmPassword.next(errorClass).html(password_empty_err_msg).show();
            scrollId = scrollId == '' ? confirmPassword : scrollId;
            go_ahead = false;
        } else if (password.val() !== confirmPassword.val()) {
            confirmPassword.next(errorClass).html(confirm_password_err_msg).show();
            scrollId = scrollId == '' ? confirmPassword : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', confirmPassword.val())) {
            confirmPassword.next(errorClass).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? confirmPassword : scrollId;
            go_ahead = false;
        } else if (confirmPassword.val().length <= 5 ) {
            confirmPassword.next(errorClass).html(min_6_length_err_msg).show();
            scrollId = scrollId == '' ? confirmPassword : scrollId;
            go_ahead = false;
        } else {
            confirmPassword.next(errorClass).html('').hide();
        } 

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: jobseeks_reset_password_ajax_object.ajax_url,
                data: formData + '&action=handle_jobseekers_reset_password',
                beforeSend: function() {
                    $(loaderClass).css('display', 'flex');
                },
                success: function(res) {
                    $(loaderClass).hide(); 
                    if (res.success) { 
                        $(resetformId)[0].reset();
                        $(resetformId).hide();
                        $(resetthankWrapColClass).show();
                        form_id_scroll(".registerInner");
                        window.location.href = '/jobseekers-login';
                    } else { 
                        $('.jobseek_reset_password_cmnError').show().find('.jobseek_reset_password_cmnError_in').html(res.data.error); 
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
    hideErrorOnFocus(passwordId); 
    hideErrorOnFocus(confirmPasswordId); 
    
    // Clean inputs on focus paste 
    cleanInputField(userId, emailPattern, true); 
    cleanInputField(passwordId, passPattern); 
    cleanInputField(confirmPasswordId, passPattern);   

});

function jobseek_forgot_password_recaptchaCallback() {
    jQuery('.jobseek_forgot_password_captcha_Wrap').find(errorClass).hide();
}  