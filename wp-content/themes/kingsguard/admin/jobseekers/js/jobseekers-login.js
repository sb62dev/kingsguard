jQuery(document).ready(function($) {

    var formId = "#jobseekers_login_form"; 
    var userId = "#jobseek_user";  
    var passId = "#jobseek_password";  
    var captchaId = "#g-recaptcha-response";  
    var captchaWrapId = "#g-recaptcha-response-wrap";
    var captchaWrapClass = ".jobseek_login_captcha_Wrap";

    $(formId).on('submit', function(e) {
        e.preventDefault();
 
        var scrollId = '';
        var user = $(userId);
        var password = $(passId);
        var captcha = $(captchaId);
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        $(errorClass).html('');

        // User or email validation
        if ('' == user.val().trim()) {
            user.next(errorClass).html(user_empty_err_msg).show();
            scrollId = scrollId == '' ? user : scrollId;
            go_ahead = false;
        } else {
            user.next(errorClass).html('').hide();
        } 

        // Password validation
        if ('' == password.val().trim()) {
            password.next(errorClass).html(password_empty_err_msg).show();
            scrollId = scrollId == '' ? password : scrollId;
            go_ahead = false;
        } else {
            password.next(errorClass).html('').hide();
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
            var formData = $(this).serialize() + '&jobseekers_login_form_save_nonce_field=' + jobseeks_ajax_object.nonce;
            $.ajax({
                type: 'POST',
                url: jobseeks_ajax_object.ajax_url,
                data: formData + '&action=handle_jobseekers_login',
                beforeSend: function() {
                    $(loaderClass).css('display', 'flex');
                },
                success: function(res) { 
                    $(loaderClass).hide(); 
                    if (res.success) { 
                        $(formId)[0].reset();
                        window.location.href = '/jobseekers-dashboard';
                    } else { 
                        grecaptcha.reset(); 
                        $('.jobseek_login_cmnError').show().find('.jobseek_login_cmnError_in').html(res.data.error); 
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
    hideErrorOnFocus(userId);
    hideErrorOnFocus(passId);

    // Clean inputs on focus paste 
    cleanInputField(userId, emailPattern, true); 
    
});

function jobseek_login_recaptchaCallback() {
    jQuery('.jobseek_login_captcha_Wrap').find(errorClass).hide();
}   