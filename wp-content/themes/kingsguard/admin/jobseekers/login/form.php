<?php     

function jobseekers_login_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-login-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-login.js', array('jquery'), null, true);
    wp_localize_script('custom-login-script', 'jobseeks_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jobseekers_login_form_save_action')
    ));

    $site_key = GOOGLE_RECAPTCHA_SITE_KEY;

    ob_start(); ?>
    <form class="jobseekers_login_form" id="jobseekers_login_form" method="POST">
        <input type="hidden" name="action" id="action" value="jobseekers_login_form_save" />
        <?php wp_nonce_field('jobseekers_login_form_save_action', 'jobseekers_login_form_save_nonce_field'); ?> 
        <div class="jobseek_login_wrap">
            <div class="jobseek_loader" style="display: none;"><div class="jobLoader"></div></div>
            <div class="jobseek_login_cmnError" style="display: none;"><div class="jobseek_login_cmnError_in"></div></div>
            <div class="jobseek_login_row">
                <div class="jobseek_login_col"> 
                    <div class="jobseek_login_inputWrap">
                        <label class="jobseek_register_label"> User Name* </label>
                        <input type="text" class="inputField" id="jobseek_user" name="jobseek_user" placeholder="Username">
                        <div class="jobseek_error"></div>
                    </div>
                </div>
                <div class="jobseek_login_col">
                    <div class="jobseek_login_inputWrap">
                        <label class="jobseek_register_label"> Password* </label>
                        <input type="password" class="inputField" id="jobseek_password" name="jobseek_password" placeholder="Password">
                        <div class="jobseek_error"></div>
                    </div>
                </div>
                <div class="jobseek_login_col">
                    <div class="jobseek_login_captcha_Wrap">
                        <div class="g-recaptcha" data-callback="jobseek_login_recaptchaCallback" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                        <div class="jobseek_error"></div>
                    </div>
                </div>
                <div class="jobseek_login_col">
                    <div class="jobseek_login_inputWrap">
                        <button type="submit" name="login" class="btn-style gradientBtn">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    return ob_get_clean();
}

add_shortcode('jobseekers_login_form', 'jobseekers_login_form'); 

?>