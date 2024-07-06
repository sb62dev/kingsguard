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
  
var user_empty_err_msg = "Username or Email is required."; 
var password_empty_err_msg = "Password is required."; 
var captcha_empty_err_msg = "Captcha is required.";

function form_id_scroll(id) {
	if (id != '') {
		jQuery('html, body').animate({
			scrollTop: jQuery(id).offset().top - 100
		}, 500);
	}
}

jQuery(document).ready(function($) {

    $('#jobseekers_login_form').on('submit', function(e) {
        e.preventDefault();
 
        var user = $("#jobseek_user");
        var password = $("#jobseek_password");
        var captcha = $("#g-recaptcha-response");
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        $('.jobseek_error').html('');

        // User or email validation
        if ('' == user.val().trim()) {
            user.next('.jobseek_error').html(user_empty_err_msg).show();
            go_ahead = false;
        }

        // Password validation
        if ('' == password.val().trim()) {
            password.next('.jobseek_error').html(password_empty_err_msg).show();
            go_ahead = false;
        }

        // Captcha validation
        if (response.length == 0) {
            captcha.closest('.jobseek_login_captcha_Wrap').find('.jobseek_error').html(captcha_empty_err_msg).show(); 
            go_ahead = false;
        } else {
            captcha.closest('.jobseek_login_captcha_Wrap').find('.jobseek_error').hide();  
        } 

        if (go_ahead) {
            var formData = $(this).serialize() + '&jobseekers_login_form_save_nonce_field=' + jobseeks_ajax_object.nonce;
            $.ajax({
                type: 'POST',
                url: jobseeks_ajax_object.ajax_url,
                data: formData + '&action=handle_jobseekers_login',
                beforeSend: function() {
                    $('.jobseek_loader').css('display', 'flex');
                },
                success: function(res) {
                    console.log("Server Response: ", res);
                    $('.jobseek_loader').hide();
                    
                    if (res.success) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $("#jobseekers_login_form")[0].reset();
                        window.location.href = '/dashboard';
                    } else { 
                        grecaptcha.reset(); 
                        $('.jobseek_login_cmnError').show().find('.jobseek_login_cmnError_in').html(res.data.error); 
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    }); 
    
});

function jobseek_login_recaptchaCallback() {
    jQuery('.jobseek_login_captcha_Wrap').find('.jobseek_error').hide();
}

jQuery(document).on("focus", "#jobseek_user, #jobseek_password", function () {
	jQuery(this).next('.jobseek_error').hide();
});

jQuery(document).on('paste  keyup input', '#EmailAddress', function (e) {
	window.setTimeout(function () {
		var withoutSpaces = jQuery.trim(jQuery("#EmailAddress").val());
		withoutSpaces = withoutSpaces.replace(/\s+/g, '');
		jQuery("#EmailAddress").val(withoutSpaces);
	}, 1);
}); 