<?php 

function job_application_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-application-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-application.js', array('jquery'), null, true);
    wp_localize_script('custom-application-script', 'jobseeks_application_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jobseekers_application_form_save_action')
    ));

    $site_key = GOOGLE_RECAPTCHA_SITE_KEY;
    
    ob_start(); ?>
    <div class="jobseekers_application_wrapper">
        <div class="jobseekers_application_formWrap">
            <form class="jobseekers_application_form" id="jobseekers_application_form" method="POST">
                <input type="hidden" name="job_id" value="<?php echo get_the_ID(); ?>">
                <input type="hidden" name="action" id="action" value="jobseekers_application_form_save" />
                <?php wp_nonce_field('jobseekers_application_form_save_action', 'jobseekers_application_form_save_nonce_field'); ?> 
                <div class="jobseek_application_wrap">
                    <div class="jobseek_loader" style="display: none;">Loading...</div>
                    <div class="jobseek_application_cmnError" style="display: none;"><div class="jobseek_application_cmnError_in"></div></div>
                    <div class="jobseek_application_row row"> 
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> First Name* </label>
                                <input type="text" id="jobseek_application_fname" name="jobseek_application_fname" value="<?php echo esc_attr( $user_info['fname'] ); ?>">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> Last Name* </label>
                                <input type="text" id="jobseek_application_lname" name="jobseek_application_lname" value="<?php echo esc_attr( $user_info['lname'] ); ?>">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> Email Address* </label>
                                <input type="text" id="jobseek_application_email" name="jobseek_application_email" value="<?php echo esc_attr( $user_info['email'] ); ?>">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>  
                        <div class="jobseek_register_col col-md-6">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> Phone Number* </label>
                                <input type="text" class="inputField" id="jobseek_application_phone" name="jobseek_application_phone" placeholder="Phone Number*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_register_col col-md-12">
                            <div class="jobseek_register_inputWrap">
                                <label class="jobseek_register_label"> Cover Letter </label>
                                <textarea class="inputField" id="jobseek_application_coverletter" name="jobseek_application_coverletter" placeholder="Cover Letter"></textarea> 
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> Resume* </label>
                                <input type="file" id="jobseek_application_resume" name="jobseek_application_resume">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>  
                        <div class="jobseek_application_col">
                            <div class="jobseek_application_captcha_Wrap">
                                <div class="g-recaptcha" data-callback="jobseek_application_recaptchaCallback" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col">
                            <div class="jobseek_application_inputWrap">
                                <button type="submit" name="submit" class="btn-style gradientBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="jobseekers_application_thankWrap">
                <h2> Thank you for apply the job!  </h2>
                <p> Please check the job application status. </p>
            </div>
        </div>  
    </div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    return ob_get_clean();
}

add_shortcode('job_application_form', 'job_application_form');

?>