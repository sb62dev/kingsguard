<?php 

function jobseekers_register_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-register-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-register.js', array('jquery'), null, true);
    wp_localize_script('custom-register-script', 'jobseeks_register_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jobseekers_register_form_save_action')
    ));

    ob_start(); ?>
    <div class="jobseekers_register_wrapper">
        <div class="jobseekers_register_formWrap">
            <form class="jobseekers_register_form" id="jobseekers_register_form" method="POST">
                <input type="hidden" name="action" id="action" value="jobseekers_register_form_save" />
                <?php wp_nonce_field('jobseekers_register_form_save_action', 'jobseekers_register_form_save_nonce_field'); ?>
                <div class="jobseek_register_header">
                    <h2>Please Register to Apply</h2>
                </div>
                <div class="jobseek_register_wrap">
                    <div class="jobseek_loader" style="display: none;">Loading...</div>
                    <div class="jobseek_register_cmnError" style="display: none;"><div class="jobseek_register_cmnError_in"></div></div>
                    <div class="jobseek_register_row">
                        <div class="jobseek_register_col">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> User Name* </label>
                                <input type="text" id="jobseek_register_user" name="jobseek_register_user" placeholder="Username*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> First Name* </label>
                                <input type="text" id="jobseek_register_fname" name="jobseek_register_fname" placeholder="First Name*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col">
                            <div class="jobseek_register_inputWrap">
                            <label class="jobseek_register_label"> Last Name* </label>
                                <input type="text" id="jobseek_register_lname" name="jobseek_register_lname" placeholder="Last Name*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col">
                            <div class="jobseek_register_inputWrap">
                            <label class="jobseek_register_label"> Email Address* </label>
                                <input type="text" id="jobseek_register_email" name="jobseek_register_email" placeholder="Email*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div> 
                        <div class="jobseek_register_col">
                            <div class="jobseek_register_inputWrap">
                            <label class="jobseek_register_label"> Password* </label>
                                <input type="password" id="jobseek_register_password" name="jobseek_register_password" placeholder="Password*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col">
                            <div class="jobseek_register_inputWrap">
                            <label class="jobseek_register_label"> Confirm Password* </label>
                                <input type="password" id="jobseek_register_confirm_password" name="jobseek_register_confirm_password" placeholder="Confirm Password*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col">
                            <div class="jobseek_register_captcha_Wrap">
                                <div class="g-recaptcha" data-callback="jobseek_register_recaptchaCallback" data-sitekey="6LePvL4kAAAAAIWhaIlwjo7bK1K5boP4bUET-WAd"></div>
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col">
                            <div class="jobseek_register_inputWrap">
                                <button type="submit" name="submit" class="btn-style gradientBtn">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="jobseekers_register_thankWrap">
                <h2> Thank you for registering!  </h2>
                <p> An email verification link has been sent to your email address. Please check your inbox to complete the registration process. </p>
            </div>
        </div> 
        <div class="jobseekers_register_email_verify_success">
            <h2> Email verified successfully. Please click <a href="/signin"> here </a> for login. </h2>
        </div>
        <div class="jobseekers_register_email_verify_failure">
            <h2> Email verification link is incorrect or already verified. Please click <a href="/signin"> here </a> for login. </h2>
        </div>
    </div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    return ob_get_clean();
}

add_shortcode('jobseekers_register_form', 'jobseekers_register_form');

?>