var pattern = {
	"email": /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
	"phone": /^((\+\d{1,3}(-|.| )?\(?\d\)?(-| |.)?\d{1,5})|(\(?\d{2,6}\)?))(-|.| )?(\d{3,4})(-|.| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/,
	"fname": /^[a-zA-Z àâäèéêëîïôœùûüÿçÀÂÄÈÉÊËÎÏÔŒÙÛÜŸÇ'\-]+$/,
	"lname": /^[a-zA-Z àâäèéêëîïôœùûüÿçÀÂÄÈÉÊËÎÏÔŒÙÛÜŸÇ'\-]+$/,
	"email_emoji": /\p{Extended_Pictographic}/ug,
	'nospace': /^\S*$/,
};

function validate_input(input_type, input_val) {
	var match = '';
	switch (input_type) {
		case "email":
			match = pattern.email;
			break;
		case "phone":
			match = pattern.phone;
			break;
		case "fname":
			match = pattern.fname;
			break;
		case "nospace":
			match = pattern.nospace;
			break;
		case "lname":
			match = pattern.lname;
			break; 
		case "email_emoji":
			match = pattern.email_emoji;
			break;

	}
	var check = match.test(input_val);
	if (check) {
		return true;
	} else {
		return false;
	}
}

function form_id_scroll(id) {
	if (id != '') {
		jQuery('html, body').animate({
			scrollTop: jQuery(id).offset().top - 100
		}, 500);
	}
} 
 
var email_empty_err_msg = "Email is required.";
var email_invalid_err_msg = "Email format is invalid.";
var password_empty_err_msg = "Password is required.";
var confirm_password_err_msg = "Passwords do not match.";
var captcha_empty_err_msg = "Captcha is required.";  
var name_nospace_err_msg = "Space is not allowed.";  
var password_min_length_err_msg = "Minimum characters limit is 6."; 

jQuery(document).ready(function($) { 
 
    $('.jobseekers_forgot_password_thankWrap').hide(); 
    $('.jobseekers_reset_password_thankWrap').hide(); 

    // Forgot Password form submission
    $('#jobseekers_forgot_password_form').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&jobseekers_forgot_password_form_save_nonce_field=' + jobseeks_forgot_password_ajax_object.nonce;

        var scrollId = ''; 
        var email = $("#jobseek_forgot_password_email"); 
        var captcha = $("#g-recaptcha-response");
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $('.jobseek_error').html(''); 

        // Email validation
        if ('' == email.val().trim()) {
            email.next('.jobseek_error').html(email_empty_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('email', email.val().trim())) {
            email.next('.jobseek_error').html(email_invalid_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', email.val().trim())) {
            email.next('.jobseek_error').html(name_nospace_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else {
            email.next('.jobseek_error').html('').hide();
        }  

        // Captcha validation
        if (response.length == 0) {
            captcha.closest('.jobseek_forgot_password_captcha_Wrap').find('.jobseek_error').html(captcha_empty_err_msg).show();
            scrollId = scrollId == '' ? "#g-recaptcha-response-wrap" : scrollId;
            go_ahead = false;
        } else {
            captcha.closest('.jobseek_forgot_password_captcha_Wrap').find('.jobseek_error').hide();
        }

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: jobseeks_forgot_password_ajax_object.ajax_url,
                data: formData + '&action=handle_jobseekers_forgot_password',
                beforeSend: function() {
                    $('.jobseek_loader').css('display', 'flex');
                },
                success: function(res) {
                    $('.jobseek_loader').hide();
                    
                    if (res.success) { 
                        $("#jobseekers_forgot_password_form")[0].reset();
                        $('.jobseekers_forgot_password_form').hide();
                        $('.jobseekers_forgot_password_thankWrap').show();
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
    $('#jobseekers_reset_password_form').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&jobseekers_reset_password_form_save_nonce_field=' + jobseeks_reset_password_ajax_object.nonce;

        var scrollId = '';  
        var password = $("#jobseek_new_password");
        var confirmPassword = $("#jobseek_confirm_password"); 
        var go_ahead = true;

        // Clear previous errors
        $('.jobseek_error').html('');  

        // Password validation
        if ('' == password.val().trim()) {
            password.next('.jobseek_error').html(password_empty_err_msg).show();
            scrollId = scrollId == '' ? password : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', password.val())) {
            password.next('.jobseek_error').html(name_nospace_err_msg).show();
            scrollId = scrollId == '' ? password : scrollId;
            go_ahead = false;
        } else if (password.val().length <= 5 ) {
            password.next('.jobseek_error').html(password_min_length_err_msg).show();
            scrollId = scrollId == '' ? password : scrollId;
            go_ahead = false;
        } else {
            password.next('.jobseek_error').html('').hide();
        }

        // Confirm password validation
        if ('' == confirmPassword.val().trim()) {
            confirmPassword.next('.jobseek_error').html(password_empty_err_msg).show();
            scrollId = scrollId == '' ? confirmPassword : scrollId;
            go_ahead = false;
        } else if (password.val() !== confirmPassword.val()) {
            confirmPassword.next('.jobseek_error').html(confirm_password_err_msg).show();
            scrollId = scrollId == '' ? confirmPassword : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', confirmPassword.val())) {
            confirmPassword.next('.jobseek_error').html(name_nospace_err_msg).show();
            scrollId = scrollId == '' ? confirmPassword : scrollId;
            go_ahead = false;
        } else if (confirmPassword.val().length <= 5 ) {
            confirmPassword.next('.jobseek_error').html(password_min_length_err_msg).show();
            scrollId = scrollId == '' ? confirmPassword : scrollId;
            go_ahead = false;
        } else {
            confirmPassword.next('.jobseek_error').html('').hide();
        } 

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: jobseeks_reset_password_ajax_object.ajax_url,
                data: formData + '&action=handle_jobseekers_reset_password',
                beforeSend: function() {
                    $('.jobseek_loader').css('display', 'flex');
                },
                success: function(res) {
                    $('.jobseek_loader').hide();
                    
                    if (res.success) { 
                        $("#jobseekers_reset_password_form")[0].reset();
                        $('.jobseekers_reset_password_form').hide();
                        $('.jobseekers_reset_password_thankWrap').show();
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

});

function jobseek_forgot_password_recaptchaCallback() {
    jQuery('.jobseek_forgot_password_captcha_Wrap').find('.jobseek_error').hide();
}

jQuery(document).on("focus", "#jobseek_forgot_password_email, #jobseek_new_password, #jobseek_confirm_password", function () {
	jQuery(this).next('.jobseek_error').hide();
});

jQuery(document).on('paste  keyup input', '#jobseek_forgot_password_email', function (e) {
	window.setTimeout(function () {
		var withoutSpaces = jQuery.trim(jQuery("#jobseek_forgot_password_email").val());
		withoutSpaces = withoutSpaces.replace(/\s+/g, '');
		jQuery("#jobseek_forgot_password_email").val(withoutSpaces);
	}, 1);
});  

jQuery(document).on('paste  keyup input', '#jobseek_new_password', function (e) {
	jQuery(this).val(jQuery(this).val().replace(/[^a-zA-Z0-9 ]/g, ''));
	window.setTimeout(function () {
		var withoutSpaces = jQuery.trim(jQuery("#jobseek_new_password").val());
		withoutSpaces = withoutSpaces.replace(/\s+/g, '');
		jQuery("#jobseek_new_password").val(withoutSpaces);
	}, 1);
});

jQuery(document).on('paste  keyup input', '#jobseek_confirm_password', function (e) {
	jQuery(this).val(jQuery(this).val().replace(/[^a-zA-Z0-9 ]/g, ''));
	window.setTimeout(function () {
		var withoutSpaces = jQuery.trim(jQuery("#jobseek_confirm_password").val());
		withoutSpaces = withoutSpaces.replace(/\s+/g, '');
		jQuery("#jobseek_confirm_password").val(withoutSpaces);
	}, 1);
});