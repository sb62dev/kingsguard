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

var phone_empty_err_msg = "Phone number is required.";
var resume_empty_err_msg = "Resume is required."; 
var captcha_empty_err_msg = "Captcha is required.";

function form_id_scroll(id) {
	if (id != '') {
		jQuery('html, body').animate({
			scrollTop: jQuery(id).offset().top - 100
		}, 500);
	}
} 

jQuery(document).ready(function($) {

    $('.jobseekers_application_thankWrap').hide(); 

    $('#jobseekers_application_form').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = new FormData(this);
        formData.append('jobseekers_application_form_save_nonce_field', jobseeks_application_ajax_object.nonce);
        formData.append('action', 'handle_job_application_submission'); 
 
        var resume = $("#jobseek_application_resume"); 
        var resume = $("#jobseek_application_resume")[0].files[0];
        var phone = $("#jobseek_application_phone"); 
        var captcha = $("#g-recaptcha-response");
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $('.jobseek_error').html('');

        // Phone validation
        if ('' == phone.val().trim()) {
            phone.next('.jobseek_error').html(phone_empty_err_msg).show();
            go_ahead = false; 
        }

        // Resume validation
        if (!resume) {
            $("#jobseek_application_resume").next('.jobseek_error').html(resume_empty_err_msg).show();
            go_ahead = false;
        } 

        // Captcha validation
        if (response.length == 0) {
            captcha.closest('.jobseek_application_captcha_Wrap').find('.jobseek_error').html(captcha_empty_err_msg).show();
            go_ahead = false;
        } else {
            captcha.closest('.jobseek_application_captcha_Wrap').find('.jobseek_error').hide();
        }

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: jobseeks_application_ajax_object.ajax_url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.jobseek_loader').css('display', 'flex');
                },
                success: function(res) {
                    $('.jobseek_loader').hide();
                    
                    if (res.success) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $("#jobseekers_application_form")[0].reset();
                        $('.jobseekers_application_form').hide();
                        $('.jobseekers_application_thankWrap').show();
                    } else {
                        grecaptcha.reset();
                        $('.jobseek_application_cmnError').show().find('.jobseek_application_cmnError_in').html(res.data.error); 
                    }
                }, 
                error: function(data) {
                    console.log(data);
                }
            });
        }
    }); 

});

function jobseek_application_recaptchaCallback() {
    jQuery('.jobseek_application_captcha_Wrap').find('.jobseek_error').hide();
}

jQuery(document).on("focus", "#jobseek_application_resume, #jobseek_application_phone", function () {
	jQuery(this).next('.jobseek_error').hide();
}); 