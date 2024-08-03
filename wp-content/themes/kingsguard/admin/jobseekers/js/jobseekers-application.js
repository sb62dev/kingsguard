jQuery(document).ready(function($) {

    var formId = "#jobseekers_application_form"; 
    var phoneId = "#jobseek_application_phone";  
    var licensId = "#jobseek_application_license";  
    var expiryDateId = "#jobseek_application_date";  
    var resumeId = "#jobseek_application_resume";
    var licenseCopyId = "#jobseek_application_licnese_copy";
    var cprCopyId = "#jobseek_application_cpr_copy";
    var smartserveCopyId = "#jobseek_application_smartserve_copy";
    var forceTrainingCopyId = "#jobseek_application_force_training_copy";
    var captchaId = "#g-recaptcha-response";  
    var resumeBoxWrapId = "#resumeBoxwrap";  
    var licenseBoxwrapId = "#licenseBoxwrap";  
    var cprBoxwrapId = "#cprBoxwrap";  
    var smartserveBoxwrapId = "#smartserveBoxwrap";  
    var forceBoxwrapId = "#forceBoxwrap";
    var captchaWrapId = "#g-recaptcha-response-wrap";
    var thankWrapColClass = ".jobseekers_application_thankWrap"; 
    var captchaWrapClass = ".jobseek_application_captcha_Wrap";
 
    $(thankWrapColClass).hide();    

    $(formId).on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = new FormData(this);
        formData.append('jobseekers_application_form_save_nonce_field', jobseeks_application_ajax_object.nonce);
        formData.append('action', 'handle_job_application_submission'); 
 
        var scrollId = '';  
        var phone = $(phoneId);  
        var license = $(licensId); 
        var resume = $(resumeId)[0].files[0]; 
        var expiryDate = $(expiryDateId);  
        var licenseCopy = $(licenseCopyId)[0].files[0];
        var cprCopy = $(cprCopyId)[0].files[0];
        var smartserveCopy = $(smartserveCopyId)[0].files[0];
        var forceTrainingCopy = $(forceTrainingCopyId)[0].files[0];
        var captcha = $(captchaId);
        var response = grecaptcha.getResponse();
        var go_ahead = true; 

        // Clear previous errors
        $(errorClass).html(''); 

        // Phone validation
        if ('' == phone.val().trim()) {
            phone.next(errorClass).html(phone_empty_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else if (!validate_input('phone', phone.val().trim())) {
            phone.next(errorClass).html(phone_invalid_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else if (phone.val().length < 10 || phone.val().length > 10) {
            phone.next(errorClass).html(phone_invalid_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else if (!validate_input('numeric', phone.val().trim())) {
            phone.next(errorClass).html(numeric_err_msg).show();
            scrollId = scrollId == '' ? phone : scrollId;
            go_ahead = false;
        } else {
            phone.next(errorClass).html('').hide();
        } 

        // Resume validation
        if (!resume) {
            $(resumeBoxWrapId).find(errorClass).html(resume_empty_err_msg).show();
            scrollId = scrollId == '' ? resume : scrollId;
            go_ahead = false;
        } else {
            var fileCopyValidation = validate_file(resume);
            if (!fileCopyValidation.valid) {
                $(resumeBoxWrapId).find(errorClass).html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? resume : scrollId;
                go_ahead = false;
            } else {
                $(resumeBoxWrapId).find(errorClass).html('').hide();
            }
        }

        // License validation
        if ('' == license.val().trim()) {
            license.next(errorClass).html(license_empty_err_msg).show();
            scrollId = scrollId == '' ? license : scrollId;
            go_ahead = false;
        } else if (license.val().length < 7 ) {
            license.next(errorClass).html(min_7_length_err_msg).show();
            scrollId = scrollId == '' ? license : scrollId;
            go_ahead = false;
        } else if (license.val().length > 8) {
            license.next(errorClass).html(max_8_length_err_msg).show();
            scrollId = scrollId == '' ? license : scrollId;
            go_ahead = false;
        } else if (!validate_input('numeric', license.val().trim())) {
            license.next(errorClass).html(numeric_err_msg).show();
            scrollId = scrollId == '' ? license : scrollId;
            go_ahead = false;
        } else {
            license.next(errorClass).html('').hide();
        } 

        // Date validation
        if ('' == expiryDate.val().trim()) {
            expiryDate.parent('.cmn_inputIcon_date').next(errorClass).html(date_empty_err_msg).show();
            scrollId = scrollId == '' ? expiryDate : scrollId;
            go_ahead = false;
        } else {
            license.next(errorClass).html('').hide();
        } 

        // License Copy validation
        if (!licenseCopy) {
            $(licenseBoxwrapId).find(errorClass).html(license_copy_empty_err_msg).show();
            scrollId = scrollId == '' ? licenseCopy : scrollId;
            go_ahead = false;
        } else {
            var fileCopyValidation = validate_file(licenseCopy);
            if (!fileCopyValidation.valid) {
                $(licenseBoxwrapId).find(errorClass).html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? licenseCopy : scrollId;
                go_ahead = false;
            } else {
                $(licenseBoxwrapId).find(errorClass).html('').hide();
            }
        }

        // CPR and First Aid validation
        if (!cprCopy) {
            $(cprBoxwrapId).find(errorClass).html(cpr_empty_err_msg).show();
            scrollId = scrollId == '' ? cprCopy : scrollId;
            go_ahead = false;
        } else {
            var fileCopyValidation = validate_file(cprCopy);
            if (!fileCopyValidation.valid) {
                $(cprBoxwrapId).find(errorClass).html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? cprCopy : scrollId;
                go_ahead = false;
            } else {
                $(cprBoxwrapId).find(errorClass).html('').hide();
            }
        }

        // Smart Serve License validation 
        if (smartserveCopy) {
            var fileCopyValidation = validate_file(smartserveCopy);
            if (!fileCopyValidation.valid) {
                $(smartserveBoxwrapId).find(errorClass).html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? smartserveCopy : scrollId;
                go_ahead = false;
            } else {
                $(smartserveBoxwrapId).find(errorClass).html('').hide();
            } 
        }

        // Force Training License validation 
        if (forceTrainingCopy) {
            var fileCopyValidation = validate_file(forceTrainingCopy);
            if (!fileCopyValidation.valid) {
                $(forceBoxwrapId).find(errorClass).html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? smartserveCopy : scrollId;
                go_ahead = false;
            } else {
                $(forceBoxwrapId).find(errorClass).html('').hide();
            } 
        }

        // Captcha validation
        if (response.length == 0) {
            captcha.closest(captchaWrapClass).find(errorClass).html(captcha_empty_err_msg).show();
            scrollId = scrollId == '' ? captchaWrapId : scrollId;
            go_ahead = false;
        } else {
            captcha.closest(captchaWrapClass).find(errorClass).hide();
        }

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: jobseeks_application_ajax_object.ajax_url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(loaderClass).css('display', 'flex');
                },
                success: function(res) {
                    $(loaderClass).hide(); 
                    if (res.success) { 
                        $(formId)[0].reset();
                        $(formId).hide();
                        $(thankWrapColClass).show();
                        form_id_scroll(thankWrapColClass);
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

    $(expiryDateId).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true, 
        changeYear: true, 
        yearRange: '2023:2100', 
        minDate: 0  
    });

    // Hide errors on focus
    hideErrorOnFocus(phoneId);
    hideErrorOnFocus(licensId);
    hideErrorOnFocus(resumeId);
    hideErrorOnFocus(licenseCopyId);
    hideErrorOnFocus(cprCopyId);
    hideErrorOnFocus(smartserveCopyId);
    hideErrorOnFocus(forceTrainingCopyId);
    hideErrorOnFocus(expiryDateId);

});

function jobseek_application_recaptchaCallback() { 
    jQuery('.jobseek_application_captcha_Wrap').find(errorClass).hide();
}  