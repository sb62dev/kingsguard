var pattern = {
	"email": /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
	"phone": /^((\+\d{1,3}(-|.| )?\(?\d\)?(-| |.)?\d{1,5})|(\(?\d{2,6}\)?))(-|.| )?(\d{3,4})(-|.| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/,
	"fname": /^[a-zA-Z àâäèéêëîïôœùûüÿçÀÂÄÈÉÊËÎÏÔŒÙÛÜŸÇ'\-]+$/,
	"lname": /^[a-zA-Z àâäèéêëîïôœùûüÿçÀÂÄÈÉÊËÎÏÔŒÙÛÜŸÇ'\-]+$/,
	"email_emoji": /\p{Extended_Pictographic}/ug,
	"nospace": /^\S*$/,
    "numeric": /^[0-9]*$/
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
        case "numeric":
            match = pattern.numeric;
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

function isNumeric(value) {
    return /^-?\d+$/.test(value);
}

var allowedExtensions = ["png", "PNG", "jpg", "jpeg", "pdf", "doc", "docx"];
var maxFileSize = 1 * 1024 * 1024; 

function validate_file(file) {
    var fileExtension = file.name.split('.').pop().toLowerCase();
    var isValidExtension = allowedExtensions.includes(fileExtension);
    var isValidSize = file.size <= maxFileSize;
    if (!isValidExtension) {
        return { valid: false, message: "Invalid file format. Allowed formats are: " + allowedExtensions.join(', ') };
    }
    if (!isValidSize) {
        return { valid: false, message: "File size exceeds the maximum limit of 1 MB." };
    }
    return { valid: true, message: "" };
}

function hideErrorOnFocus(selector) {
    $(document).on("focus", selector, function () {
        $(this).closest('.jobseek_application_inputWrap').find('.jobseek_error').hide();
    });
}

var phone_empty_err_msg = "Phone number is required.";
var phone_invalid_err_msg = "Phone number format is invalid.(10 digit number)";
var resume_empty_err_msg = "Resume is required."; 
var license_empty_err_msg = "License is required.";
var cpr_empty_err_msg = "CPR and First Aid is required.";
var license_max_length_err_msg = "Maximum characters limit is 8."; 
var license_min_length_err_msg = "Minimum characters limit is 7."; 
var numeric_err_msg = "Only numeric values are allowed."; 
var license_copy_empty_err_msg = "License copy is required.";  
var expiry_date_empty_err_msg = "Date field is required.";
var captcha_empty_err_msg = "Captcha is required.";
var file_invalid_err_msg = "Invalid file format. Only pdf, doc, docx are allowed.";
var file_size_err_msg = "File size should not exceed 5 MB.";

jQuery(document).ready(function($) {

    $('.jobseekers_application_thankWrap').hide(); 

    $('#jobseekers_application_form').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = new FormData(this);
        formData.append('jobseekers_application_form_save_nonce_field', jobseeks_application_ajax_object.nonce);
        formData.append('action', 'handle_job_application_submission'); 
 
        var scrollId = ''; 
        var resume = $("#jobseek_application_resume")[0].files[0];
        var phone = $("#jobseek_application_phone"); 
        var license = $("#jobseek_application_license");  
        var expiryDate = $("#jobseek_application_date");  
        var licenseCopy = $("#jobseek_application_licnese_copy")[0].files[0];
        var cprCopy = $("#jobseek_application_cpr_copy")[0].files[0];
        var smartserveCopy = $("#jobseek_application_smartserve_copy")[0].files[0];
        var forceTrainingCopy = $("#jobseek_application_force_training_copy")[0].files[0];
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
        } else if (!validate_input('numeric', phone.val().trim())) {
            phone.next('.jobseek_error').html(numeric_err_msg).show();
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
            var fileCopyValidation = validate_file(resume);
            if (!fileCopyValidation.valid) {
                $("#resumeBoxwrap").find('.jobseek_error').html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? resume : scrollId;
                go_ahead = false;
            } else {
                $("#resumeBoxwrap").find('.jobseek_error').html('').hide();
            }
        }

        // License validation
        if ('' == license.val().trim()) {
            license.next('.jobseek_error').html(license_empty_err_msg).show();
            scrollId = scrollId == '' ? license : scrollId;
            go_ahead = false;
        } else if (license.val().length <= 6 ) {
            license.next('.jobseek_error').html(license_min_length_err_msg).show();
            scrollId = scrollId == '' ? license : scrollId;
            go_ahead = false;
        } else if (license.val().length > 8) {
            license.next('.jobseek_error').html(license_max_length_err_msg).show();
            scrollId = scrollId == '' ? license : scrollId;
            go_ahead = false;
        } else if (!validate_input('numeric', license.val().trim())) {
            license.next('.jobseek_error').html(numeric_err_msg).show();
            scrollId = scrollId == '' ? license : scrollId;
            go_ahead = false;
        } else {
            license.next('.jobseek_error').html('').hide();
        } 

        // Date validation
        if ('' == expiryDate.val().trim()) {
            expiryDate.parent('.cmn_inputIcon_date').next('.jobseek_error').html(expiry_date_empty_err_msg).show();
            scrollId = scrollId == '' ? expiryDate : scrollId;
            go_ahead = false;
        } else {
            license.next('.jobseek_error').html('').hide();
        } 

        // License Copy validation
        if (!licenseCopy) {
            $("#licenseBoxwrap").find('.jobseek_error').html(license_copy_empty_err_msg).show();
            scrollId = scrollId == '' ? licenseCopy : scrollId;
            go_ahead = false;
        } else {
            var fileCopyValidation = validate_file(licenseCopy);
            if (!fileCopyValidation.valid) {
                $("#licenseBoxwrap").find('.jobseek_error').html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? licenseCopy : scrollId;
                go_ahead = false;
            } else {
                $("#licenseBoxwrap").find('.jobseek_error').html('').hide();
            }
        }

        // CPR and First Aid validation
        if (!cprCopy) {
            $("#cprBoxwrap").find('.jobseek_error').html(cpr_empty_err_msg).show();
            scrollId = scrollId == '' ? cprCopy : scrollId;
            go_ahead = false;
        } else {
            var fileCopyValidation = validate_file(cprCopy);
            if (!fileCopyValidation.valid) {
                $("#cprBoxwrap").find('.jobseek_error').html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? cprCopy : scrollId;
                go_ahead = false;
            } else {
                $("#cprBoxwrap").find('.jobseek_error').html('').hide();
            }
        }

        // Smart Serve License validation 
        if (smartserveCopy) {
            var fileCopyValidation = validate_file(smartserveCopy);
            if (!fileCopyValidation.valid) {
                $("#smartserveBoxwrap").find('.jobseek_error').html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? smartserveCopy : scrollId;
                go_ahead = false;
            } else {
                $("#smartserveBoxwrap").find('.jobseek_error').html('').hide();
            } 
        }

        // Force Training License validation 
        if (forceTrainingCopy) {
            var fileCopyValidation = validate_file(forceTrainingCopy);
            if (!fileCopyValidation.valid) {
                $("#forceBoxwrap").find('.jobseek_error').html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? smartserveCopy : scrollId;
                go_ahead = false;
            } else {
                $("#forceBoxwrap").find('.jobseek_error').html('').hide();
            } 
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

    $('.jobseek_file_input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.file-name').text(fileName || 'No file chosen'); 
    });

    $("#jobseek_application_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true, 
        changeYear: true, 
        yearRange: '2023:2100', 
        minDate: 0  
    });

    hideErrorOnFocus("#jobseek_application_phone");
    hideErrorOnFocus("#jobseek_application_license");
    hideErrorOnFocus("#jobseek_application_resume");
    hideErrorOnFocus("#jobseek_application_licnese_copy");
    hideErrorOnFocus("#jobseek_application_cpr_copy");
    hideErrorOnFocus("#jobseek_application_smartserve_copy");
    hideErrorOnFocus("#jobseek_application_force_training_copy");
    hideErrorOnFocus("#jobseek_application_date");

});

function jobseek_application_recaptchaCallback() {
    jQuery('.jobseek_application_captcha_Wrap').find('.jobseek_error').hide();
}        

jQuery(document).on('keyup paste', '.numberonly', function(event) {
    var v = this.value;
    if (!isNumeric(v) && v !== '') {
        this.value = this.value.slice(0, -1);
    }
});