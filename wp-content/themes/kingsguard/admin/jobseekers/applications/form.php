<?php 

function job_application_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-application-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-application.js', array('jquery'), null, true);
    wp_localize_script('custom-application-script', 'jobseeks_application_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jobseekers_application_form_save_action')
    ));

    // Enqueue jQuery UI CSS
    wp_enqueue_style('custom-datepicker-style', get_template_directory_uri() . '/admin/assets/css/datepicker.css');
    wp_enqueue_script('custom-datepicker-script', get_template_directory_uri() . '/admin/assets/css/datepicker.js', array('jquery', 'jquery-ui-datepicker'), null, true);

    $site_key = GOOGLE_RECAPTCHA_SITE_KEY;

    $user_info = array(
        'fname' => '',
        'lname' => '',
        'email' => ''
    );

    if ( isset($_COOKIE['jobseeker_logged_in']) && $_COOKIE['jobseeker_logged_in'] === 'true' ) {
        global $wpdb;
        $username = isset($_COOKIE['jobseeker_username']) ? esc_html($_COOKIE['jobseeker_username']) : '';
        if ( $username ) {
            $user = $wpdb->get_row($wpdb->prepare(
                "SELECT first_name, last_name, email FROM {$wpdb->prefix}jobseekers_users WHERE username = %s",
                $username
            ));
            if ($user) {
                $user_info = array(
                    'fname' => $user->first_name,
                    'lname' => $user->last_name,
                    'email' => $user->email
                );
            }
        }
    }
    
    ob_start(); ?>
    <div class="jobseekers_application_wrapper">
        <div class="jobseekers_application_formWrap">
            <form class="jobseekers_application_form" id="jobseekers_application_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="job_id" value="<?php echo get_the_ID(); ?>">
                <input type="hidden" name="job_title" value="<?php echo get_the_title(); ?>">
                <input type="hidden" name="action" id="action" value="jobseekers_application_form_save" />
                <?php wp_nonce_field('jobseekers_application_form_save_action', 'jobseekers_application_form_save_nonce_field'); ?> 
                <div class="jobseek_application_wrap">
                    <div class="jobseek_loader" style="display: none;"><div class="jobLoader"></div></div>
                    <div class="jobseek_application_cmnError" style="display: none;"><div class="jobseek_application_cmnError_in"></div></div>
                    <div class="jobseek_application_row row"> 
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> First Name* </label>
                                <input type="text" class="inputField inputField_disabled" id="jobseek_application_fname" name="jobseek_application_fname" value="<?php echo esc_attr( $user_info['fname'] ); ?>" readonly>
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> Last Name* </label>
                                <input type="text" class="inputField inputField_disabled" id="jobseek_application_lname" name="jobseek_application_lname" value="<?php echo esc_attr( $user_info['lname'] ); ?>" readonly>
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> Email Address* </label>
                                <input type="text" class="inputField inputField_disabled" id="jobseek_application_email" name="jobseek_application_email" value="<?php echo esc_attr( $user_info['email'] ); ?>" readonly>
                                <div class="jobseek_error"></div>
                            </div>
                        </div>  
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> Phone Number* </label>
                                <input type="text" class="inputField numberonly" id="jobseek_application_phone" name="jobseek_application_phone" placeholder="Phone Number*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div> 
                        <div class="jobseek_application_col col-md-12">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> Cover Letter </label>
                                <textarea class="inputField" id="jobseek_application_coverletter" name="jobseek_application_coverletter" placeholder="Cover Letter"></textarea> 
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col col-md-12">
                            <div class="jobseek_application_inputWrap" id="resumeBoxwrap">
                                <label class="jobseek_application_label"> Resume* </label>
                                <div class="jobseek_application_resume_box">
                                    <div class="jobseek_application_resume_boxIn">
                                        <label for="jobseek_application_resume">
                                            <div class="jobseek_application_resume_boxIn_img">
                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/resume_icon.svg" alt="Resume Icon">
                                            </div>
                                            <div class="jobseek_application_resume_boxIn_txt"> Upload Resume </div>
                                        </label>
                                    </div>
                                    <input type="file" class="jobseek_file_input" id="jobseek_application_resume" name="jobseek_application_resume">
                                    <div class="file-name" id="resume-file-name">No file chosen</div>
                                </div> 
                                <div class="jobseek_error"></div>
                            </div>
                        </div>   
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> Security Guard License* </label>
                                <input type="text" class="inputField numberonly" id="jobseek_application_license" name="jobseek_application_license" placeholder="Security Guard License*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap">
                                <label class="jobseek_application_label"> Expiry Date* </label>
                                <div class="cmn_inputIcon cmn_inputIcon_date">
                                    <input type="text" class="inputField" id="jobseek_application_date" name="jobseek_application_date" placeholder="Expiry Date*">
                                </div> 
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap" id="licenseBoxwrap">
                                <label class="jobseek_application_label"> License* </label>
                                <div class="jobseek_application_resume_box">
                                    <div class="jobseek_application_resume_boxIn">
                                        <label for="jobseek_application_licnese_copy">
                                            <div class="jobseek_application_resume_boxIn_img">
                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/resume_icon.svg" alt="Resume Icon">
                                            </div>
                                            <div class="jobseek_application_resume_boxIn_txt"> Upload License* </div>
                                        </label>
                                    </div>
                                    <input type="file" class="jobseek_file_input" id="jobseek_application_licnese_copy" name="jobseek_application_licnese_copy">
                                    <div class="file-name" id="license-file-name">No file chosen</div>
                                </div> 
                                <div class="jobseek_error"></div>
                            </div>
                        </div>   
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap" id="cprBoxwrap">
                                <label class="jobseek_application_label"> CPR and First Aid* </label>
                                <div class="jobseek_application_resume_box">
                                    <div class="jobseek_application_resume_boxIn">
                                        <label for="jobseek_application_cpr_copy">
                                            <div class="jobseek_application_resume_boxIn_img">
                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/resume_icon.svg" alt="Resume Icon">
                                            </div>
                                            <div class="jobseek_application_resume_boxIn_txt"> Upload CPR and First Aid* </div>
                                        </label>
                                    </div>
                                    <input type="file" class="jobseek_file_input" id="jobseek_application_cpr_copy" name="jobseek_application_cpr_copy">
                                    <div class="file-name" id="cpr-file-name">No file chosen</div>
                                </div> 
                                <div class="jobseek_error"></div>
                            </div>
                        </div>  
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap" id="smartserveBoxwrap">
                                <label class="jobseek_application_label"> Smart Serve License </label>
                                <div class="jobseek_application_resume_box">
                                    <div class="jobseek_application_resume_boxIn">
                                        <label for="jobseek_application_smartserve_copy">
                                            <div class="jobseek_application_resume_boxIn_img">
                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/resume_icon.svg" alt="Resume Icon">
                                            </div>
                                            <div class="jobseek_application_resume_boxIn_txt"> Upload Smart Serve License </div>
                                        </label>
                                    </div>
                                    <input type="file" class="jobseek_file_input" id="jobseek_application_smartserve_copy" name="jobseek_application_smartserve_copy">
                                    <div class="file-name" id="smartserver-file-name">No file chosen</div>
                                </div> 
                                <div class="jobseek_error"></div>
                            </div>
                        </div>  
                        <div class="jobseek_application_col col-md-6">
                            <div class="jobseek_application_inputWrap" id="forceBoxwrap">
                                <label class="jobseek_application_label"> Use of Force Training Certification </label>
                                <div class="jobseek_application_resume_box">
                                    <div class="jobseek_application_resume_boxIn">
                                        <label for="jobseek_application_force_training_copy">
                                            <div class="jobseek_application_resume_boxIn_img">
                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/resume_icon.svg" alt="Resume Icon">
                                            </div>
                                            <div class="jobseek_application_resume_boxIn_txt"> Upload Use of Force Training Certification </div>
                                        </label>
                                    </div>
                                    <input type="file" class="jobseek_file_input" id="jobseek_application_force_training_copy" name="jobseek_application_force_training_copy">
                                    <div class="file-name" id="force-training-file-name">No file chosen</div>
                                </div> 
                                <div class="jobseek_error"></div>
                            </div>
                        </div>  
                        <div class="jobseek_application_col col-md-12">
                            <div class="jobseek_application_captcha_Wrap" id="g-recaptcha-response-wrap">
                                <div class="g-recaptcha" data-callback="jobseek_application_recaptchaCallback" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_application_col col-md-12">
                            <div class="jobseek_application_inputWrap">
                                <button type="submit" name="submit" class="btn-style gradientBtn">Submit</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="jobseekers_application_thankWrap" id="jobseekers_application_thankWrap">
                <h2 class="h2"> Thank you for apply the job!  </h2>
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