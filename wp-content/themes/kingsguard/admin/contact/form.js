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

function form_id_scroll(id) {
	if (id != '') {
		jQuery('html, body').animate({
			scrollTop: jQuery(id).offset().top - 100
		}, 500);
	}
} 

jQuery(document).ready(function($) {  

    // Form Submission
    $('#kg_contact_form').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&contact_form_save_nonce_field=' + kg_contact_ajax_object.nonce;
 
        var name = $("#kg_contact_name");
        var title = $("#kg_contact_title");
        var email = $("#kg_contact_email");
        var phone = $("#kg_contact_phone");
        var services = $("#kg_contact_services");
        var securityServices = $("#kg_contact_security_services");
        var parkingServices = $("#kg_contact_parking_services");
        var sitetypes = $("#kg_contact_site_types"); 
        var length_cover = $("#kg_contact_length_cover");
        var add_info = $("#kg_contact_add_info");
        var captcha = $("#g-recaptcha-response");
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $('.contact_error').html('');

        // Name validation
        if ('' == name.val().trim()) {
            name.next('.contact_error').html(name_empty_err_msg).show();
            go_ahead = false;
        }

         // Title validation
         if ('' == title.val().trim()) {
            title.next('.contact_error').html(title_empty_err_msg).show();
            go_ahead = false;
        }

        // Email validation
        if ('' == email.val().trim()) {
            email.next('.contact_error').html(email_empty_err_msg).show();
            go_ahead = false;
        } 

        // Phone validation
        if ('' == phone.val().trim()) {
            phone.next('.contact_error').html(phone_empty_err_msg).show();
            go_ahead = false;
        }

        // Services validation
        if (services.val() === null || services.val() === '') {
            services.next('.contact_error').html(service_err_msg).show();
            go_ahead = false;
        }  

        // Site types validation
        if (sitetypes.val() === null || sitetypes.val() === '') {
            sitetypes.next('.contact_error').html(sitetype_err_msg).show();
            go_ahead = false;
        }  

        // Captcha validation
        if (response.length == 0) {
            captcha.closest('.kg_contact_captcha_Wrap').find('.contact_error').html(captcha_empty_err_msg).show();
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
                    $('.kg_loader').css('display', 'flex');
                },
                success: function(res) {
                    $('.kg_loader').hide(); 
                    if (res.success) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $("#kg_contact_form")[0].reset();
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
        var selectedValues = $(this).find('option:selected').map(function() {
            return $(this).val();
        }).get();  

        $('#selected_services').val(selectedValues.join(','));

        // Show the conditional fields based on the selected values
        selectedValues.forEach(function(value) {
            if (value === 'Parking Enforcement') {
                $('#kg_contact_parking_service_col').show();
            }
            if (value === 'Security Systems') {
                $('#kg_contact_security_service_col').show();
            }
        });  

    });

});

function kg_contact_recaptchaCallback() {
    jQuery('.kg_contact_captcha_Wrap').find('.contact_error').hide();
}

jQuery(document).on("focus", "#kg_contact_name, #kg_contact_title, #kg_contact_email, #kg_contact_phone, #kg_contact_services, #kg_contact_site_types", function () {
	jQuery(this).next('.contact_error').hide();
});

jQuery(document).on('paste  keyup input', '#kg_contact_email', function (e) {
	window.setTimeout(function () {
		var withoutSpaces = jQuery.trim(jQuery("#kg_contact_email").val());
		withoutSpaces = withoutSpaces.replace(/\s+/g, '');
		jQuery("#kg_contact_email").val(withoutSpaces);
	}, 1);
});  

