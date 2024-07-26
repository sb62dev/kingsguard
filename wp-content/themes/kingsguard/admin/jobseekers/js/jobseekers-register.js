jQuery(document).ready(function($) {

    var formId = "#jobseekers_register_form";
    var fnameId = "#jobseek_register_fname";
    var lnameId = "#jobseek_register_lname"; 
    var userId = "#jobseek_register_user"; 
    var emailId = "#jobseek_register_email"; 
    var passwordId = "#jobseek_register_password";
    var confirmPasswordId = "#jobseek_register_confirm_password"; 
    var captchaId = "#g-recaptcha-response"; 
    var captchaWrapId = "#g-recaptcha-response-wrap"; 
    var formWrapColClass = ".jobseekers_register_formWrap"; 
    var thankWrapColClass = ".jobseekers_register_thankWrap"; 
    var captchaWrapClass = ".jobseek_register_captcha_Wrap";
    var successColClass = ".jobseekers_register_email_verify_success"; 
    var failueColClass = ".jobseekers_register_email_verify_failure"; 

    $(successColClass).hide(); 
    $(failueColClass).hide();
    $(thankWrapColClass).hide(); 
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('email-verification-success')) {
        $(successColClass).show(); 
        $(failueColClass).remove();
        $(formWrapColClass).remove(); 
    } else if (urlParams.has('email-verification-failed')) {
        $(failueColClass).show();
        $(successColClass).remove();
        $(formWrapColClass).remove();  
    }

    // Register form submission
    $(formId).on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&jobseekers_register_form_save_nonce_field=' + jobseeks_register_ajax_object.nonce;

        var scrollId = '';
        var user = $(userId);
        var fname = $(fnameId);
        var lname = $(lnameId);
        var email = $(emailId);
        var password = $(passwordId);
        var confirmPassword = $(confirmPasswordId);
        var captcha = $(captchaId);
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $(errorClass).html('');

        // Username validation
        if ('' == user.val().trim()) {
            user.next(errorClass).html(user_empty_err_msg).show();
            scrollId = scrollId == '' ? user : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', user.val().trim())) {
            user.next(errorClass).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? user : scrollId;
            go_ahead = false;
        } else if (user.val().length > 25) {
            user.next(errorClass).html(max_25_length_err_msg).show();
            scrollId = scrollId == '' ? user : scrollId;
            go_ahead = false;
        } else if (user.val().length <= 3 ) {
            user.next(errorClass).html(min_4_length_err_msg).show();
            scrollId = scrollId == '' ? user : scrollId;
            go_ahead = false;
        } else {
            user.next(errorClass).html('').hide();
        }

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

        // First name validation
        if ('' == fname.val().trim()) {
            fname.next(errorClass).html(fname_empty_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else if (fname.val().length > 30) {
            fname.next(errorClass).html(max_30_length_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else if (!validate_input('fname', fname.val().trim())) {
            fname.next(errorClass).html(name_invalid_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', fname.val())) {
            fname.next(errorClass).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else {
            fname.next(errorClass).html('').hide();
        }

        // Last name validation
        if ('' == lname.val().trim()) {
            lname.next(errorClass).html(lname_empty_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else if (lname.val().length > 30) {
            lname.next(errorClass).html(max_30_length_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else if (!validate_input('fname', lname.val().trim())) {
            lname.next(errorClass).html(name_invalid_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', lname.val())) {
            lname.next(errorClass).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else {
            lname.next(errorClass).html('').hide();
        }

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
                url: jobseeks_register_ajax_object.ajax_url,
                data: formData + '&action=handle_jobseekers_registration',
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
                        grecaptcha.reset();
                        $('.jobseek_register_cmnError').show().find('.jobseek_register_cmnError_in').html(res.data.error); 
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
    hideErrorOnFocus(fnameId);
    hideErrorOnFocus(lnameId); 
    hideErrorOnFocus(userId); 
    hideErrorOnFocus(emailId);
    hideErrorOnFocus(passwordId); 
    hideErrorOnFocus(confirmPasswordId); 
    
    // Clean inputs on focus paste 
    cleanInputField(fnameId, namePattern); 
    cleanInputField(lnameId, namePattern); 
    cleanInputField(userId, passPattern);
    cleanInputField(emailId, emailPattern, true); 
    cleanInputField(passwordId, passPattern); 
    cleanInputField(confirmPasswordId, passPattern);   

});

function jobseek_register_recaptchaCallback() {
    jQuery('.jobseek_register_captcha_Wrap').find(errorClass).hide();
}    