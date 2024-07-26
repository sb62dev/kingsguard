var fname_empty_err_msg = "First name is required.";
var lname_empty_err_msg = "Last name is required.";
var user_empty_err_msg = "Username is required.";
var email_empty_err_msg = "Email is required.";
var password_empty_err_msg = "Password is required.";
var confirm_password_err_msg = "Passwords do not match.";
var captcha_empty_err_msg = "Captcha is required."; 
var phone_empty_err_msg = "Phone number is required.";
var license_empty_err_msg = "License is required.";
var date_empty_err_msg = "Date field is required.";
var resume_empty_err_msg = "Resume is required."; 
var cpr_empty_err_msg = "CPR and First Aid is required.";
var license_copy_empty_err_msg = "License copy is required.";   
var user_email_empty_err_msg = "Username or Email is required.";  

var email_invalid_err_msg = "Email format is invalid.";
var name_invalid_err_msg = "Name format is invalid."; 
var phone_invalid_err_msg = "Phone number format is invalid.(10 digit number)";  
var nospace_err_msg = "Space is not allowed."; 
var numeric_err_msg = "Only numeric values are allowed.";  

var max_8_length_err_msg = "Maximum characters limit is 8."; 
var max_25_length_err_msg = "Maximum characters limit is 25."; 
var max_30_length_err_msg = "Maximum characters limit is 30.";  
var max_100_length_err_msg = "Maximum characters limit is 100.";  
var min_4_length_err_msg = "Minimum characters limit is 4.";  
var min_6_length_err_msg = "Minimum characters limit is 6.";  
var min_7_length_err_msg = "Minimum characters limit is 7."; 

var namePattern = /[^a-zA-Z ]/g;
var passPattern = /[^a-zA-Z0-9 ]/g;
var emailPattern = /[^a-zA-Z0-9@._-]/g; 

var errorClass = ".jobseek_error"; 
var loaderClass = ".jobseek_loader";

var pattern = {
	"email": /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
	"phone": /^((\+\d{1,3}(-|.| )?\(?\d\)?(-| |.)?\d{1,5})|(\(?\d{2,6}\)?))(-|.| )?(\d{3,4})(-|.| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/,
	"fname": /^[a-zA-Z àâäèéêëîïôœùûüÿçÀÂÄÈÉÊËÎÏÔŒÙÛÜŸÇ'\-]+$/,
	"lname": /^[a-zA-Z àâäèéêëîïôœùûüÿçÀÂÄÈÉÊËÎÏÔŒÙÛÜŸÇ'\-]+$/,
	"email_emoji": /\p{Extended_Pictographic}/ug,
	'nospace': /^\S*$/,
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
			scrollTop: jQuery(id).offset().top - 130
		}, 500);
	}
} 

function isNumeric(value) {
    return /^-?\d+$/.test(value);
}

var allowedExtensions = ["png", "PNG", "jpg", "jpeg", "pdf", "doc", "docx"];
var maxFileSize = 1 * 1024 * 1024; 
var profilePicAllowedExtensions = ["png", "PNG", "jpg", "jpeg"];
var profilePicMaxFileSize = 0.3 * 1024 * 1024; 

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
 
function validate_profilepic_file(file) {
    var fileExtension = file.name.split('.').pop().toLowerCase();
    var isValidExtension = profilePicAllowedExtensions.includes(fileExtension);
    var isValidSize = file.size <= profilePicMaxFileSize;
    if (!isValidExtension) {
        return { valid: false, message: "Invalid file format. Allowed formats are: " + profilePicAllowedExtensions.join(', ') };
    }
    if (!isValidSize) {
        return { valid: false, message: "File size exceeds the maximum limit of 300 KB." };
    }
    return { valid: true, message: "" };
} 

// Common function to clean input fields
function cleanInputField(selector, allowedCharsRegex, removeSpaces = true, delay = 1) {
    jQuery(document).on('paste keyup input', selector, function (e) {
        window.setTimeout(function () {
            var inputValue = jQuery(selector).val();
            inputValue = inputValue.replace(allowedCharsRegex, '');
            if (removeSpaces) {
                inputValue = inputValue.replace(/\s+/g, '');
            }
            jQuery(selector).val(inputValue);
        }, delay);
    });
}

// Hide errors on focus
function hideErrorOnFocus(selector) {
    $(document).on("focus", selector, function () {
        $(this).closest('.jobseek_application_inputWrap').find('.jobseek_error').hide();
    });
}

jQuery(document).on('keyup paste', '.numberonly', function(event) {
    var v = this.value;
    if (!isNumeric(v) && v !== '') {
        this.value = this.value.slice(0, -1);
    }
}); 

jQuery(document).ready(function($) {
    $('.jobseek_file_input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.file-name').text(fileName || 'No file chosen'); 
    });
});