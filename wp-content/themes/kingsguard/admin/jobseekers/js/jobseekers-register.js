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

var fname_empty_err_msg = "First name is required.";
var lname_empty_err_msg = "Last name is required.";
var user_empty_err_msg = "Username is required.";
var email_empty_err_msg = "Email is required.";
var password_empty_err_msg = "Password is required.";
var confirm_password_err_msg = "Passwords do not match.";
var captcha_empty_err_msg = "Captcha is required.";

function form_id_scroll(id) {
	if (id != '') {
		jQuery('html, body').animate({
			scrollTop: jQuery(id).offset().top - 100
		}, 500);
	}
}

jQuery(document).ready(function($) {
    $('.jobseekers_register_email_verify_success').hide(); 
    $('.jobseekers_register_email_verify_failure').hide();
    $('.jobseekers_register_thankWrap').hide(); 
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('email-verification-success')) {
        $('.jobseekers_register_email_verify_success').show(); 
        $('.jobseekers_register_email_verify_failure').remove();
        $('.jobseekers_register_formWrap').remove(); 
    } else if (urlParams.has('email-verification-failed')) {
        $('.jobseekers_register_email_verify_failure').show();
        $('.jobseekers_register_email_verify_success').remove();
        $('.jobseekers_register_formWrap').remove();  
    }
});

jQuery(document).ready(function($) {

    $('#jobseekers_register_form').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&jobseekers_register_form_save_nonce_field=' + jobseeks_register_ajax_object.nonce;

        var user = $("#jobseek_register_user");
        var fname = $("#jobseek_register_fname");
        var lname = $("#jobseek_register_lname");
        var email = $("#jobseek_register_email");
        var password = $("#jobseek_register_password");
        var confirmPassword = $("#jobseek_register_confirm_password");
        var captcha = $("#g-recaptcha-response");
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $('.jobseek_error').html('');

        // Username validation
        if ('' == user.val().trim()) {
            user.next('.jobseek_error').html(user_empty_err_msg).show();
            go_ahead = false;
        }

        // Email validation
        if ('' == email.val().trim()) {
            email.next('.jobseek_error').html(email_empty_err_msg).show();
            go_ahead = false;
        }

        // First name validation
        if ('' == fname.val().trim()) {
            fname.next('.jobseek_error').html(fname_empty_err_msg).show();
            go_ahead = false;
        }

        // Last name validation
        if ('' == lname.val().trim()) {
            lname.next('.jobseek_error').html(lname_empty_err_msg).show();
            go_ahead = false;
        }

        // Password validation
        if ('' == password.val().trim()) {
            password.next('.jobseek_error').html(password_empty_err_msg).show();
            go_ahead = false;
        }

         // Confirm password validation
         if (password.val() !== confirmPassword.val()) {
            confirmPassword.next('.jobseek_error').html(confirm_password_err_msg).show();
            go_ahead = false;
        }

        // Captcha validation
        if (response.length == 0) {
            captcha.closest('.jobseek_register_captcha_Wrap').find('.jobseek_error').html(captcha_empty_err_msg).show();
            go_ahead = false;
        } else {
            captcha.closest('.jobseek_register_captcha_Wrap').find('.jobseek_error').hide();
        }

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: jobseeks_register_ajax_object.ajax_url,
                data: formData + '&action=handle_jobseekers_registration',
                beforeSend: function() {
                    $('.jobseek_loader').css('display', 'flex');
                },
                success: function(res) {
                    $('.jobseek_loader').hide();
                    
                    if (res.success) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $("#jobseekers_register_form")[0].reset();
                        $('.jobseekers_register_form').hide();
                        $('.jobseekers_register_thankWrap').show();
                    } else {
                        grecaptcha.reset();
                        $('.jobseek_register_cmnError').show().find('.jobseek_register_cmnError_in').html(res.data.error); 
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    }); 

});

function jobseek_register_recaptchaCallback() {
    jQuery('.jobseek_register_captcha_Wrap').find('.jobseek_error').hide();
}

jQuery(document).on("focus", "#jobseek_register_user, #jobseek_register_email, #jobseek_register_password, #jobseek_register_confirm_password, #jobseek_register_fname, #jobseek_register_lname", function () {
	jQuery(this).next('.jobseek_error').hide();
});

jQuery(document).on('paste  keyup input', '#jobseek_register_email', function (e) {
	window.setTimeout(function () {
		var withoutSpaces = jQuery.trim(jQuery("#jobseek_register_email").val());
		withoutSpaces = withoutSpaces.replace(/\s+/g, '');
		jQuery("#jobseek_register_email").val(withoutSpaces);
	}, 1);
}); 