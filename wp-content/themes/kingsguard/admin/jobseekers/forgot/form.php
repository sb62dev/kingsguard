<?php
function jobseekers_forgot_password_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-forgot-password-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-forgot-password.js', array('jquery'), null, true);
    wp_localize_script('custom-forgot-password-script', 'jobseeks_forgot_password_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jobseekers_forgot_password_form_save_action')
    ));

    $site_key = GOOGLE_RECAPTCHA_SITE_KEY;

    ob_start(); ?> 
    <div class="jobseekers_forgot_password_formWrap">
        <form class="jobseekers_forgot_password_form" id="jobseekers_forgot_password_form" method="POST">
            <input type="hidden" name="action" id="action" value="jobseekers_forgot_password_form_save" />
            <?php wp_nonce_field('jobseekers_forgot_password_form_save_action', 'jobseekers_forgot_password_form_save_nonce_field'); ?> 
            <div class="jobseek_forgot_password_wrap">
                <div class="jobseek_loader" style="display: none;"><div class="jobLoader"></div></div>
                <div class="jobseek_forgot_password_cmnError" style="display: none;"><div class="jobseek_forgot_password_cmnError_in"></div></div>
                <div class="jobseek_forgot_password_row row">
                    <div class="jobseek_forgot_password_col col-md-12"> 
                        <div class="jobseek_forgot_password_inputWrap">
                            <label class="jobseek_forgot_label">Email Address*</label>
                            <input type="email" class="inputField" id="jobseek_forgot_password_email" name="jobseek_forgot_password_email" placeholder="Email Address">
                            <div class="jobseek_error"></div>
                        </div>
                    </div>
                    <div class="jobseek_forgot_password_col col-md-12">
                        <div class="jobseek_forgot_password_captcha_Wrap" id="g-recaptcha-response-wrap">
                            <div class="g-recaptcha" data-callback="jobseek_forgot_password_recaptchaCallback" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                            <div class="jobseek_error"></div>
                        </div>
                    </div>
                    <div class="jobseek_forgot_password_col col-md-12">
                        <div class="jobseek_forgot_password_inputWrap">
                            <button type="submit" name="submit" class="btn-style gradientBtn">Reset Password</button>
                        </div>
                    </div>
                    <div class="jobseek_login_col col-12">
                        <div class="jobseek_forgot_password_btmWrap text-center">
                            <a href="/jobseekers-login/">Back to Login</a> 
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="jobseekers_forgot_password_thankWrap" id="jobseekers_forgot_password_thankWrap"> 
            <p> A reset password link has been sent to your email address. Please check your inbox to complete the password reset process.  </p>
        </div> 
    </div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    return ob_get_clean();
}

add_shortcode('jobseekers_forgot_password_form', 'jobseekers_forgot_password_form');


function jobseekers_reset_password_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-reset-password-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-forgot-password.js', array('jquery'), null, true);
    wp_localize_script('custom-reset-password-script', 'jobseeks_reset_password_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jobseekers_reset_password_form_save_action')
    )); 

    ob_start(); ?>

    <div class="jobseekers_forgot_password_formWrap">
        <form class="jobseekers_reset_password_form" id="jobseekers_reset_password_form" method="POST">
            <input type="hidden" name="action" id="action" value="jobseekers_reset_password_form_save" />
            <?php wp_nonce_field('jobseekers_reset_password_form_save_action', 'jobseekers_reset_password_form_save_nonce_field'); ?> 
            <input type="hidden" name="reset_key" value="<?php echo esc_attr($_GET['key']); ?>" />
            <input type="hidden" name="reset_email" value="<?php echo esc_attr($_GET['email']); ?>" />
            <div class="jobseek_reset_password_wrap">
                <div class="jobseek_loader" style="display: none;"><div class="jobLoader"></div></div>
                <div class="jobseek_reset_password_cmnError" style="display: none;"><div class="jobseek_reset_password_cmnError_in"></div></div>
                <div class="jobseek_reset_password_row row">
                    <div class="jobseek_reset_password_col col-md-12">
                        <div class="jobseek_reset_password_inputWrap">
                            <label class="jobseek_register_label">New Password*</label>
                            <input type="password" class="inputField" id="jobseek_new_password" name="jobseek_new_password" placeholder="New Password">
                            <div class="jobseek_error"></div>
                        </div>
                    </div>
                    <div class="jobseek_reset_password_col col-md-12">
                        <div class="jobseek_reset_password_inputWrap">
                            <label class="jobseek_register_label">Confirm Password*</label>
                            <input type="password" class="inputField" id="jobseek_confirm_password" name="jobseek_confirm_password" placeholder="Confirm Password">
                            <div class="jobseek_error"></div>
                        </div>
                    </div>
                    <div class="jobseek_reset_password_col col-md-12">
                        <div class="jobseek_reset_password_inputWrap">
                            <button type="submit" name="submit" class="btn-style gradientBtn">Reset Password</button>
                        </div>
                    </div>
                    <div class="jobseek_login_col col-12">
                        <div class="jobseek_forgot_password_btmWrap text-center">
                            <a href="/jobseekers-login/">Back to Login</a> 
                        </div>
                    </div>
                </div>
            </div>
        </form> 
        <div class="jobseekers_reset_password_thankWrap" id="jobseekers_reset_password_thankWrap"> 
            <p> Password is reset successfully. Go to login page for login. </p>
            <div class="jobseek_forgot_password_btmWrap text-center">
                <a href="/jobseekers-login/">Login</a> 
            </div>
        </div> 
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('jobseekers_reset_password_form', 'jobseekers_reset_password_form');

?>