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

var name_empty_err_msg = "Name is required.";
var title_empty_err_msg = "Title is required."; 
var email_empty_err_msg = "Email is required.";
var phone_empty_err_msg = "Phone Number is required.";
var service_err_msg = "Select Service is required.";
var parking_service_err_msg = "Parking Enforcement is required.";
var security_service_err_msg = "Security Systems is required.";
var sitetype_err_msg = "Type of Site is required.";
var captcha_empty_err_msg = "Captcha is required.";
var email_invalid_err_msg = "Email format is invalid.";
var phone_invalid_err_msg = "Phone number format is invalid.";
var title_invalid_length_err_msg = "Maximum characters limit is 100.";
var name_invalid_length_err_msg = "Maximum characters limit is 80.";

function form_id_scroll(id) {
	if (id != '') {
		jQuery('html, body').animate({
			scrollTop: jQuery(id).offset().top - 170
		}, 500);
	}
} 

jQuery(document).ready(function($) {  

    // Form Submission
    $('#kg_contact_form').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&contact_form_save_nonce_field=' + kg_contact_ajax_object.nonce;
 
        var scrollId = '';
        var name = $("#kg_contact_name");
        var title = $("#kg_contact_title");
        var email = $("#kg_contact_email");
        var phone = $("#kg_contact_phone");
        var services = $("#selected_services");
        var servicesSelect = $("#kg_contact_services"); 
        var sitetypes = $("#kg_contact_site_types");  
        var add_info = $("#kg_contact_add_info");
        var captcha = $("#g-recaptcha-response");
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $('.contact_error').html('');

        // Name validation
        if ('' == name.val().trim()) {
            name.next('.contact_error').html(name_empty_err_msg).show(); 
            scrollId = scrollId == '' ? name : scrollId;
            go_ahead = false;
        } else if (name.val().length > 80) {
            name.next('.contact_error').html(name_invalid_length_err_msg).show();
            scrollId = scrollId == '' ? name : scrollId;
            go_ahead = false;
        } else {
            title.next('.contact_error').html('').hide();
        }

        // Title validation
        if ('' == title.val().trim()) {
            title.next('.contact_error').html(title_empty_err_msg).show();
            go_ahead = false;
        } else if (title.val().length > 100) {
            title.next('.contact_error').html(title_invalid_length_err_msg).show();
            scrollId = scrollId == '' ? title : scrollId;
            go_ahead = false;
        } else {
            title.next('.contact_error').html('').hide();
        }

        // Email validation
        if ('' == email.val().trim()) {
            email.next('.contact_error').html(email_empty_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('email', email.val().trim())) {
            email.next('.contact_error').html(email_invalid_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', email.val().trim())) {
            email.next('.contact_error').html(email_invalid_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else {
            email.next('.contact_error').html('').hide();
        }

        // Phone validation
        if ('' == phone.val().trim()) {
            phone.next('.contact_error').html(phone_empty_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else if (!validate_input('phone', phone.val().trim())) {
            phone.next('.contact_error').html(phone_invalid_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else if (phone.val().length < 10 || phone.val().length > 10) {
            phone.next('.contact_error').html(phone_invalid_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else {
            phone.next('.contact_error').html('').hide();
        }

        // Services validation
        if ('' == services.val().trim()) { 
            servicesSelect.next('.contact_error').html(service_err_msg).show();
            scrollId = scrollId == '' ? servicesSelect : scrollId;
            go_ahead = false;
        } else {
            servicesSelect.next('.contact_error').html('').hide();
        }

        // Conditional validation for parkingServices
        if ($('#kg_contact_parking_service_col').is(':visible')) {
            var parkingChecked = false;
            $('#kg_contact_parking_service_col input[type="checkbox"]').each(function() {
                if ($(this).is(':checked')) {
                    parkingChecked = true;
                }
            });
            if (!parkingChecked) {
                $('#kg_contact_parking_service_col .contact_error').html(parking_service_err_msg).show();
                scrollId = scrollId == '' ? "#kg_contact_parking_service_col" : scrollId;
                go_ahead = false;
            } else {
                $('#kg_contact_parking_service_col .contact_error').hide();
            }
        } else {
            $('#kg_contact_parking_service_col .contact_error').hide();
        }

        // Conditional validation for securityServices
        if ($('#kg_contact_security_service_col').is(':visible')) {
            var securityChecked = false;
            $('#kg_contact_security_service_col input[type="checkbox"]').each(function() {
                if ($(this).is(':checked')) {
                    securityChecked = true;
                }
            });
            if (!securityChecked) {
                $('#kg_contact_security_service_col .contact_error').html(security_service_err_msg).show();
                scrollId = scrollId == '' ? "#kg_contact_security_service_col" : scrollId;
                go_ahead = false;
            } else {
                $('#kg_contact_security_service_col .contact_error').hide();
            }
        } else {
            $('#kg_contact_security_service_col .contact_error').hide();
        }

        // Site types validation
        if (sitetypes.val() === null || sitetypes.val() === '') {
            sitetypes.next('.contact_error').html(sitetype_err_msg).show();
            scrollId = scrollId == '' ? sitetypes : scrollId;
            go_ahead = false;
        } else {
            sitetypes.next('.contact_error').html('').hide();
        }

        // Captcha validation
        if (response.length == 0) {
            captcha.closest('.kg_contact_captcha_Wrap').find('.contact_error').html(captcha_empty_err_msg).show();
            scrollId = scrollId == '' ? "#g-recaptcha-response-wrap" : scrollId;
            go_ahead = false;
        } else {
            captcha.closest('.kg_contact_captcha_Wrap').find('.contact_error').hide(); 
        }   

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: kg_contact_ajax_object.ajax_url,
                data: formData + '&action=handle_contact_form',
                beforeSend: function() {
                    $('.jobseek_loader').css('display', 'flex');
                },
                success: function(res) {
                    $('.jobseek_loader').hide(); 
                    if (res.success) {
                        form_id_scroll("#kg_contact_thankWrap"); 
                        $("#kg_contact_form")[0].reset();
                        services.val('');
                        $('.kg_contact_form').hide();
                        $('.kg_contact_thankWrap').show();
                    } else {
                        grecaptcha.reset();
                        $('.kg_contact_cmnError').show().find('.kg_contact_cmnError_in').html(res.data.error); 
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

    $('.kg_contact_thankWrap, #kg_contact_parking_service_col, #kg_contact_security_service_col').hide();   

    // Event listener for change in select field
    $('.kg_contact_multi_services').each(function() {
        var $multiselect = $(this);
        var $selectElement = $multiselect.find('select');
        var $placeholder = $selectElement.find('.placeholder');
        var $options = $selectElement.find('option').slice(1);
        var $selectBox = $('<div class="selectBox"><span class="placeholder">' + $placeholder.text() + '</span></div>');
        var $optionsContainer = $('<div class="options"></div>');

        $options.each(function() {
            var $option = $(this);
            var $optionDiv = $('<div>' + $option.text() + '</div>');
            $optionDiv.on('click', function() {
                if (!$option.data('added')) {
                    var $selectedItem = $('<div class="selectedItem">' + $option.text() + '<span class="close">x</span></div>');
                    
                    $selectedItem.find('.close').on('click', function() {
                        $selectedItem.remove();
                        $option.prop('selected', false).removeData('added').removeAttr('data-select');;
                        
                        if ($selectBox.find('.selectedItem').length === 0) {
                            $selectBox.find('.placeholder').css('display', 'block');
                        }

                        $selectElement.trigger('change');
                    });

                    $selectBox.find('.placeholder').css('display', 'none');
                    $selectBox.prepend($selectedItem);
                    $option.data('added', true).prop('selected', true).attr('data-select', 'true');;
                    $selectElement.trigger('change');
                }
            });

            $optionsContainer.append($optionDiv);
        });

        $selectBox.on('click', function() {
            $optionsContainer.toggleClass('open');
        });

        $(document).on('click', function(event) {
            if (!$multiselect.is(event.target) && !$(event.target).closest($multiselect).length) {
                $optionsContainer.removeClass('open');
            }
        });

        $multiselect.append($selectBox).append($optionsContainer);
    });

    // Event listener for change in select field
    $('#kg_contact_services').on('change', function() { 
        $("#kg_contact_services").next('.contact_error').hide();

        var selectedValues = $(this).find('option:selected').map(function() {
            return $(this).val();
        }).get();  

        $('#selected_services').val(selectedValues.join(', '));

        // Show the conditional fields based on the selected values
        selectedValues.forEach(function(value) {
            if (value === 'Parking Enforcement') {
                $('#kg_contact_parking_service_col').show();
            }
            if (value === 'Security Systems') {
                $('#kg_contact_security_service_col').show();
            }
        });  

        // Hide fields if the corresponding service is not selected
        if (!selectedValues.includes('Parking Enforcement')) {
            $('#kg_contact_parking_service_col').hide();
            $('#kg_contact_parking_service_col input[type="checkbox"]').prop('checked', false);
        }
        if (!selectedValues.includes('Security Systems')) {
            $('#kg_contact_security_service_col').hide();
            $('#kg_contact_security_service_col input[type="checkbox"]').prop('checked', false);
        }

    });

    // Checkbox change event listener to hide error messages
    $('#kg_contact_parking_service_col input[type="checkbox"]').on('change', function() {
        if ($(this).is(':checked')) {
            $('#kg_contact_parking_service_col .contact_error').hide();
        }
    });

    $('#kg_contact_security_service_col input[type="checkbox"]').on('change', function() {
        if ($(this).is(':checked')) {
            $('#kg_contact_security_service_col .contact_error').hide();
        }
    });

});

function kg_contact_recaptchaCallback() {
    jQuery('.kg_contact_captcha_Wrap').find('.contact_error').hide();
}

jQuery(document).on("focus", "#kg_contact_name, #kg_contact_title, #kg_contact_email, #kg_contact_phone", function () {
	jQuery(this).next('.contact_error').hide();
});

jQuery(document).on('paste keyup input', '#kg_contact_email', function (e) {
	window.setTimeout(function () {
		var withoutSpaces = jQuery.trim(jQuery("#kg_contact_email").val());
		withoutSpaces = withoutSpaces.replace(/\s+/g, '');
		jQuery("#kg_contact_email").val(withoutSpaces);
	}, 1);
});    