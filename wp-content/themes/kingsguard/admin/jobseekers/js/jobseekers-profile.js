jQuery(document).ready(function($) {
 
    var formId = "#jobseekers_profile_form";
    var fnameId = "#jobseek_profile_fname";
    var lnameId = "#jobseek_profile_lname"; 
    var phoneId = "#jobseek_profile_phone"; 
    var passwordId = "#jobseek_profile_password";
    var confirmPasswordId = "#jobseek_profile_confirm_password";
    var profilePicId = "#jobseek_profile_pic_copy";
    var licensId = "#jobseek_profile_license";  
    var expiryDateId = "#jobseek_profile_license_expiry_date";  
    var captchaId = "#g-recaptcha-response"; 
    var passwordToggleId = "#jobseek_profile_toggle_password"; 
    var thankWrapId = "#jobseekers_profile_thankWrap";  
    var prfileWrapId = "#prfilePicBoxWrap";  
    var passwordColClass = ".jobseek_profile_password_col"; 
    var thankWrapColClass = ".jobseekers_profile_thankWrap"; 
    var captchaWrapClass = ".jobseek_profile_captcha_Wrap";
 
    $(thankWrapId).hide();  
    $(passwordColClass).hide();  

    // profile form submission
    $(formId).on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        var formData = new FormData(this);
        formData.append('jobseekers_profile_form_save_nonce_field', jobseeks_profile_ajax_object.nonce);
        formData.append('action', 'handle_jobseekers_profile');   
        var scrollId = ''; 
        var fname = $(fnameId);
        var lname = $(lnameId); 
        var phone = $(phoneId); 
        var password = $(passwordId);
        var confirmPassword = $(confirmPasswordId);
        var profilePic = $(profilePicId)[0].files[0];
        var license = $(licensId);  
        var expiryDate = $(expiryDateId);  
        var captcha = $(captchaId);
        var response = grecaptcha.getResponse();
        var go_ahead = true;

        // Clear previous errors
        $(errorClass).html(''); 

        // First name validation
        if ('' == fname.val().trim()) {
            fname.next(errorClass).html(fname_empty_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else if (fname.val().length > 30) {
            fname.next(errorClass).html(max_30_length_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else if (!validate_input('fname', fname.val().trim())) {
            fname.next(errorClass).html(name_invalid_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', fname.val())) {
            fname.next(errorClass).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? fname : scrollId;
            go_ahead = false;
        } else {
            fname.next(errorClass).html('').hide();
        }

        // Last name validation
        if ('' == lname.val().trim()) {
            lname.next(errorClass).html(lname_empty_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else if (lname.val().length > 30) {
            lname.next(errorClass).html(max_30_length_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else if (!validate_input('fname', lname.val().trim())) {
            lname.next(errorClass).html(name_invalid_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else if (!validate_input('nospace', lname.val())) {
            lname.next(errorClass).html(nospace_err_msg).show();
            scrollId = scrollId == '' ? lname : scrollId;
            go_ahead = false;
        } else {
            lname.next(errorClass).html('').hide();
        }

        // Phone validation
        if (phone.val().trim() !== '') {
            if (!validate_input('phone', phone.val().trim())) {
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
        }
        
        // Profile Pic validation
        if (profilePic) {
            var fileCopyValidation = validate_profilepic_file(profilePic);
            if (!fileCopyValidation.valid) {
                $(prfileWrapId).find(errorClass).html(fileCopyValidation.message).show();
                scrollId = scrollId == '' ? profilePic : scrollId;
                go_ahead = false;
            } else {
                $(prfileWrapId).find(errorClass).html('').hide();
            } 
        } 

        if ($(passwordToggleId).is(':checked')) { 
            // Password validation
            if ('' == password.val().trim()) {
                password.next(errorClass).html(password_empty_err_msg).show();
                scrollId = scrollId == '' ? password : scrollId;
                go_ahead = false;
            } else if (!validate_input('nospace', password.val())) {
                password.next(errorClass).html(nospace_err_msg).show();
                scrollId = scrollId == '' ? password : scrollId;
                go_ahead = false;
            } else if (password.val().length <= 5 ) {
                password.next(errorClass).html(min_4_length_err_msg).show();
                scrollId = scrollId == '' ? password : scrollId;
                go_ahead = false;
            } else {
                password.next(errorClass).html('').hide();
            }

            // Confirm password validation
            if ('' == confirmPassword.val().trim()) {
                confirmPassword.next(errorClass).html(password_empty_err_msg).show();
                scrollId = scrollId == '' ? confirmPassword : scrollId;
                go_ahead = false;
            } else if (password.val() !== confirmPassword.val()) {
                confirmPassword.next(errorClass).html(confirm_password_err_msg).show();
                scrollId = scrollId == '' ? confirmPassword : scrollId;
                go_ahead = false;
            } else if (!validate_input('nospace', confirmPassword.val())) {
                confirmPassword.next(errorClass).html(nospace_err_msg).show();
                scrollId = scrollId == '' ? confirmPassword : scrollId;
                go_ahead = false;
            } else if (confirmPassword.val().length <= 5 ) {
                confirmPassword.next(errorClass).html(min_4_length_err_msg).show();
                scrollId = scrollId == '' ? confirmPassword : scrollId;
                go_ahead = false;
            } else {
                confirmPassword.next(errorClass).html('').hide();
            }
        } 

        // License validation
        if (license.val().trim() !== '') { 
            if (license.val().length <= 6 ) {
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
            } else if ('' == expiryDate.val().trim()) {
                expiryDate.parent('.cmn_inputIcon_date').next(errorClass).html(date_empty_err_msg).show();
                scrollId = scrollId == '' ? expiryDate : scrollId;
                go_ahead = false;
            } else {
                license.next(errorClass).html('').hide();
                expiryDate.next(errorClass).html('').hide();
            } 
        } 

        // Captcha validation
        if (response.length == 0) {
            captcha.closest(captchaWrapClass).find(errorClass).html(captcha_empty_err_msg).show();
            scrollId = scrollId == '' ? captchaWrapClass : scrollId;
            go_ahead = false;
        } else {
            captcha.closest(captchaWrapClass).find(errorClass).hide();
        }

        if (go_ahead) {
            $.ajax({
                type: 'POST',
                url: jobseeks_profile_ajax_object.ajax_url,
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
                        form_id_scroll(thankWrapId);
                    } else {
                        grecaptcha.reset();
                        $('.jobseek_profile_cmnError').show().find('.jobseek_profile_cmnError_in').html(res.data.error); 
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

    // Toogle Password
    $(passwordToggleId).on('change', function() {
        if ($(this).is(':checked')) {
            $(passwordColClass).slideDown();
        } else {
            $(passwordColClass).slideUp();
            $(passwordId).val('');
            $(confirmPasswordId).val('');
            $(passwordColClass).find(errorClass).html('').hide();
        }
    });

    // Hide errors on focus
    hideErrorOnFocus(fnameId);
    hideErrorOnFocus(lnameId);
    hideErrorOnFocus(phoneId); 
    hideErrorOnFocus(passwordId);
    hideErrorOnFocus(confirmPasswordId);
    hideErrorOnFocus(licensId); 
    hideErrorOnFocus(expiryDateId);  
    
    // Clean inputs on focus paste 
    cleanInputField(fnameId, namePattern);
    cleanInputField(lnameId, namePattern); 
    cleanInputField(passwordId, passPattern); 
    cleanInputField(confirmPasswordId, passPattern);   
    
    $(expiryDateId).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true, 
        changeYear: true, 
        yearRange: '2023:2100', 
        minDate: 0  
    });

}); 

function jobseek_profile_recaptchaCallback() { 
    jQuery('.jobseek_profile_captcha_Wrap').find(errorClass).hide();
}  