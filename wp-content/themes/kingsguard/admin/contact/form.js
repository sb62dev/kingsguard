 
var contact_error = ".contact_error";
var contact_loader = ".jobseek_loader";
var contact_captcha_wrap = ".kg_contact_captcha_Wrap";   
var title_empty_err_msg = "Title is required.";   
var service_err_msg = "Select Service is required.";
var parking_service_err_msg = "Parking Enforcement is required.";
var security_service_err_msg = "Security Systems is required.";
var sitetype_err_msg = "Type of Site is required.";   

jQuery(document).ready(function($) {  

    var formId = "#kg_contact_form";
    var fnameId = "#kg_contact_fname";
    var lnameId = "#kg_contact_lname"; 
    var titleId = "#kg_contact_title"; 
    var emailId = "#kg_contact_email"; 
    var phoneId = "#kg_contact_phone";  
    var servicesId = "#selected_services"; 
    var servicesSelectId = "#kg_contact_services"; 
    var sitetypesId = "#kg_contact_site_types";   
    var captchaId = "#g-recaptcha-response"; 
    var captchaWrapId = "#g-recaptcha-response-wrap"; 
    var parkingColId = "#kg_contact_parking_service_col"; 
    var securityColId = "#kg_contact_security_service_col";  
    var thankWrapColClass = ".kg_contact_thankWrap";  
    var multiServicesClass = ".kg_contact_multi_services";

    $(thankWrapColClass).hide();   
    $(parkingColId).hide();   
    $(securityColId).hide();   

    // Form Submission
    $(formId).on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = $(this).serialize() + '&contact_form_save_nonce_field=' + kg_contact_ajax_object.nonce;
 
        var scrollId = '';
        var fname = $(fnameId);
        var lname = $(lnameId);
        var title = $(titleId);
        var email = $(emailId);
        var phone = $(phoneId);
        var services = $(servicesId);
        var servicesSelect = $(servicesSelectId); 
        var sitetypes = $(sitetypesId);   
        var captcha = $(captchaId);
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $(contact_error).html(''); 

        // First name validation
        if ('' == fname.val().trim()) {
            fname.next(contact_error).html(fname_empty_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else if (fname.val().length > 30) {
            fname.next(contact_error).html(max_30_length_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else if (!validate_input('fname', fname.val().trim())) {
            fname.next(contact_error).html(name_invalid_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', fname.val())) {
            fname.next(contact_error).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else {
            fname.next(contact_error).html('').hide();
        }

        // Last name validation
        if ('' == lname.val().trim()) {
            lname.next(contact_error).html(lname_empty_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else if (lname.val().length > 30) {
            lname.next(contact_error).html(max_30_length_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else if (!validate_input('fname', lname.val().trim())) {
            lname.next(contact_error).html(name_invalid_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', lname.val())) {
            lname.next(contact_error).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else {
            lname.next(contact_error).html('').hide();
        }

        // Title validation
        if ('' == title.val().trim()) {
            title.next(contact_error).html(title_empty_err_msg).show();
            go_ahead = false;
        } else if (title.val().length > 100) {
            title.next(contact_error).html(max_100_length_err_msg).show();
            scrollId = scrollId == '' ? title : scrollId;
            go_ahead = false;
        } else {
            title.next(contact_error).html('').hide();
        }

        // Email validation
        if ('' == email.val().trim()) {
            email.next(contact_error).html(email_empty_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('email', email.val().trim())) {
            email.next(contact_error).html(email_invalid_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', email.val().trim())) {
            email.next(contact_error).html(email_invalid_err_msg).show();
            scrollId = scrollId == '' ? email : scrollId;
            go_ahead = false;
        } else {
            email.next(contact_error).html('').hide();
        }

        // Phone validation
        if ('' == phone.val().trim()) {
            phone.next(contact_error).html(phone_empty_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else if (!validate_input('phone', phone.val().trim())) {
            phone.next(contact_error).html(phone_invalid_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else if (phone.val().length < 10 || phone.val().length > 10) {
            phone.next(contact_error).html(phone_invalid_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else {
            phone.next(contact_error).html('').hide();
        }

        // Services validation
        if ('' == services.val().trim()) { 
            servicesSelect.next(contact_error).html(service_err_msg).show();
            scrollId = scrollId == '' ? servicesSelect : scrollId;
            go_ahead = false;
        } else {
            servicesSelect.next(contact_error).html('').hide();
        }

        // Conditional validation for parkingServices
        if ($(parkingColId).is(':visible')) {
            var parkingChecked = false;
            $(parkingColId + ' input[type="checkbox"]').each(function() {
                if ($(this).is(':checked')) {
                    parkingChecked = true;
                }
            });
            if (!parkingChecked) {
                $(parkingColId + contact_error).html(parking_service_err_msg).show();
                scrollId = scrollId == '' ? parkingColId : scrollId;
                go_ahead = false;
            } else {
                $(parkingColId + contact_error).hide();
            }
        } else {
            $(parkingColId + contact_error).hide();
        }

        // Conditional validation for securityServices
        if ($(securityColId).is(':visible')) {
            var securityChecked = false;
            $(securityColId + ' input[type="checkbox"]').each(function() {
                if ($(this).is(':checked')) {
                    securityChecked = true;
                }
            });
            if (!securityChecked) {
                $(securityColId + contact_error).html(security_service_err_msg).show();
                scrollId = scrollId == '' ? securityColId : scrollId;
                go_ahead = false;
            } else {
                $(securityColId + contact_error).hide();
            }
        } else {
            $(securityColId + contact_error).hide();
        }

        // Site types validation
        if (sitetypes.val() === null || sitetypes.val() === '') {
            sitetypes.next(contact_error).html(sitetype_err_msg).show();
            scrollId = scrollId == '' ? sitetypes : scrollId;
            go_ahead = false;
        } else {
            sitetypes.next(contact_error).html('').hide();
        }

        // Captcha validation
        if (response.length == 0) {
            captcha.closest(contact_captcha_wrap).find(contact_error).html(captcha_empty_err_msg).show();
            scrollId = scrollId == '' ? captchaWrapId : scrollId;
            go_ahead = false;
        } else {
            captcha.closest(contact_captcha_wrap).find(contact_error).hide(); 
        }   

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: kg_contact_ajax_object.ajax_url,
                data: formData + '&action=handle_contact_form',
                beforeSend: function() {
                    $(contact_loader).css('display', 'flex');
                },
                success: function(res) {
                    $(contact_loader).hide(); 
                    if (res.success) { 
                        $(formId)[0].reset();
                        services.val('');
                        $(formId).hide();
                        $(thankWrapColClass).show();
                        form_id_scroll(thankWrapColClass); 
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

    // Event listener for change in select field
    $(multiServicesClass).each(function() {
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
    $(servicesSelectId).on('change', function() { 
        $(servicesSelectId).next(contact_error).hide();

        var selectedValues = $(this).find('option:selected').map(function() {
            return $(this).val();
        }).get();  

        $(servicesId).val(selectedValues.join(', '));

        // Show the conditional fields based on the selected values
        selectedValues.forEach(function(value) {
            if (value === 'Parking Enforcement') {
                $(parkingColId).show();
            }
            if (value === 'Security Systems') {
                $(securityColId).show();
            }
        });  

        // Hide fields if the corresponding service is not selected
        if (!selectedValues.includes('Parking Enforcement')) {
            $(parkingColId).hide();
            $(parkingColId + ' input[type="checkbox"]').prop('checked', false);
        }
        if (!selectedValues.includes('Security Systems')) {
            $(securityColId).hide();
            $(securityColId + ' input[type="checkbox"]').prop('checked', false);
        }

    });

    // Checkbox change event listener to hide error messages
    $(parkingColId + ' input[type="checkbox"]').on('change', function() {
        if ($(this).is(':checked')) {
            $(parkingColId + contact_error).hide();
        }
    });

    $(securityColId + ' input[type="checkbox"]').on('change', function() {
        if ($(this).is(':checked')) {
            $(securityColId + contact_error).hide();
        }
    });

    // Hide errors on focus
    hideErrorOnFocus(fnameId);
    hideErrorOnFocus(lnameId); 
    hideErrorOnFocus(titleId); 
    hideErrorOnFocus(emailId); 
    hideErrorOnFocus(phoneId);
    
    // Clean inputs on focus paste 
    cleanInputField(fnameId, namePattern); 
    cleanInputField(lnameId, namePattern);  
    cleanInputField(emailId, emailPattern, true);   

});

function kg_contact_recaptchaCallback() {
    jQuery(contact_captcha_wrap).find(contact_error).hide();
}  