<?php 

function jobseekers_register_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-register-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-register.js', array('jquery'), null, true);
    wp_localize_script('custom-register-script', 'jobseeks_register_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jobseekers_register_form_save_action')
    ));

    $site_key = GOOGLE_RECAPTCHA_SITE_KEY;
    
    ob_start(); ?>
    <div class="jobseekers_register_wrapper">
        <div class="jobseekers_register_formWrap">
            <form class="jobseekers_register_form" id="jobseekers_register_form" method="POST">
                <input type="hidden" name="action" id="action" value="jobseekers_register_form_save" />
                <?php wp_nonce_field('jobseekers_register_form_save_action', 'jobseekers_register_form_save_nonce_field'); ?> 
                <div class="jobseek_register_wrap">
                    <div class="jobseek_loader" style="display: none;"><div class="jobLoader"></div></div>
                    <div class="jobseek_register_cmnError" style="display: none;"><div class="jobseek_register_cmnError_in"></div></div>
                    <div class="jobseek_register_row row">
                        <div class="jobseek_register_col col-md-12">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> User Name* </label>
                                <input type="text" class="inputField" id="jobseek_register_user" name="jobseek_register_user" placeholder="Username*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col col-md-6">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> First Name* </label>
                                <input type="text" class="inputField" id="jobseek_register_fname" name="jobseek_register_fname" placeholder="First Name*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col col-md-6">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> Last Name* </label>
                                <input type="text" class="inputField" id="jobseek_register_lname" name="jobseek_register_lname" placeholder="Last Name*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col col-md-12">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> Email Address* </label>
                                <input type="text" class="inputField" id="jobseek_register_email" name="jobseek_register_email" placeholder="Email*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div> 
                        <div class="jobseek_register_col col-md-6">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> Password* </label>
                                <input type="password" class="inputField" id="jobseek_register_password" name="jobseek_register_password" placeholder="Password*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col col-md-6">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> Confirm Password* </label>
                                <input type="password" class="inputField" id="jobseek_register_confirm_password" name="jobseek_register_confirm_password" placeholder="Confirm Password*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col col-md-12">
                            <div class="jobseek_register_captcha_Wrap" id="g-recaptcha-response-wrap">
                                <div class="g-recaptcha" data-callback="jobseek_register_recaptchaCallback" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col col-md-12">
                            <div class="jobseek_register_inputWrap">
                                <button type="submit" name="submit" class="btn-style gradientBtn">Register</button>
                            </div>
                        </div>
                        <div class="jobseek_login_col col-md-12">
                            <div class="jobseek_register_btmWrap">
                                <p class="mb-0">Already have an account yet? <a href="/jobseekers-login/">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="jobseekers_register_thankWrap" id="jobseekers_register_thankWrap">
                <h4> Thank you for registering!  </h4>
                <p> An email verification link has been sent to your email address. Please check your inbox to complete the registration process. </p>
            </div>
        </div> 
        <div class="jobseekers_register_email_verify_success">
            <h4> Email verified successfully. Please click below to login. </h4>
            <div class="btnWrap">
                <a href="/jobseekers-login/" class="btn-style gradientBtn"> Login </a>
            </div>
        </div>
        <div class="jobseekers_register_email_verify_failure">
            <h4> Email verification link is incorrect or already verified. </h4>
            <div class="btnWrap">
                <a href="/" class="btn-style gradientBtn"> Back to Home </a>
            </div>
        </div>
    </div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    return ob_get_clean();
}

add_shortcode('jobseekers_register_form', 'jobseekers_register_form');

?>