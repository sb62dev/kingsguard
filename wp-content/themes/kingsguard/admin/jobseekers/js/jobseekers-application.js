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
			scrollTop: jQuery(id).offset().top - 170
		}, 500);
	}
} 

var phone_empty_err_msg = "Phone number is required.";
var phone_invalid_err_msg = "Phone number format is invalid.(10 digit number)";
var resume_empty_err_msg = "Resume is required."; 
var captcha_empty_err_msg = "Captcha is required.";

jQuery(document).ready(function($) {

    $('.jobseekers_application_thankWrap').hide(); 

    $('#jobseekers_application_form').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = new FormData(this);
        formData.append('jobseekers_application_form_save_nonce_field', jobseeks_application_ajax_object.nonce);
        formData.append('action', 'handle_job_application_submission'); 
 
        var scrollId = '';
        var resumeID = $("#jobseek_application_resume"); 
        var resume = resumeID[0].files[0];
        var phone = $("#jobseek_application_phone"); 
        var captcha = $("#g-recaptcha-response");
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $('.jobseek_error').html(''); 

        // Phone validation
        if ('' == phone.val().trim()) {
            phone.next('.jobseek_error').html(phone_empty_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else if (!validate_input('phone', phone.val().trim())) {
            phone.next('.jobseek_error').html(phone_invalid_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else if (phone.val().length < 10 || phone.val().length > 10) {
            phone.next('.jobseek_error').html(phone_invalid_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else {
            phone.next('.jobseek_error').html('').hide();
        } 

        // Resume validation
        if (!resume) {
            $("#resumeBoxwrap").find('.jobseek_error').html(resume_empty_err_msg).show();
            scrollId = scrollId == '' ? resume : scrollId;
            go_ahead = false;
        } else {
            $("#resumeBoxwrap").find('.jobseek_error').html('').hide();
        }

        // Captcha validation
        if (response.length == 0) {
            captcha.closest('.jobseek_application_captcha_Wrap').find('.jobseek_error').html(captcha_empty_err_msg).show();
            scrollId = scrollId == '' ? "#g-recaptcha-response-wrap" : scrollId;
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
                        $("#jobseekers_application_form")[0].reset();
                        $('.jobseekers_application_form').hide();
                        $('.jobseekers_application_thankWrap').show();
                        form_id_scroll("#jobseekers_application_thankWrap");
                    } else {
                        grecaptcha.reset();
                        $('.jobseek_application_cmnError').show().find('.jobseek_application_cmnError_in').html(res.data.error); 
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

    $('#jobseek_application_resume').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $('#file-name').text(fileName || 'No file chosen');
    });

});

function jobseek_application_recaptchaCallback() {
    jQuery('.jobseek_application_captcha_Wrap').find('.jobseek_error').hide();
}

jQuery(document).on("focus", "#jobseek_application_resume, #jobseek_application_phone", function () {
	jQuery(this).next('.jobseek_error').hide();
}); 