<?php 

function jobseekers_profile_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-profile-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-profile.js', array('jquery'), null, true);
    wp_localize_script('custom-profile-script', 'jobseeks_profile_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jobseekers_profile_form_save_action')
    ));

    // Enqueue jQuery UI CSS
    wp_enqueue_style('custom-datepicker-style', get_template_directory_uri() . '/admin/assets/css/datepicker.css');
    wp_enqueue_script('custom-datepicker-script', get_template_directory_uri() . '/admin/assets/js/datepicker.js', array('jquery', 'jquery-ui-datepicker'), null, true);

    $site_key = GOOGLE_RECAPTCHA_SITE_KEY;

    $user_info = array(
        'fname' => '',
        'lname' => '',
        'email' => '',
        'phone' => '',
        'license' => '',
        'expiry_date' => '',
        'profile_pic' => ''
    );

    if ( isset($_COOKIE['jobseeker_logged_in']) && $_COOKIE['jobseeker_logged_in'] === 'true' ) {
        global $wpdb;
        $username = isset($_COOKIE['jobseeker_username']) ? esc_html($_COOKIE['jobseeker_username']) : '';
        if ( $username ) {
            $user = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}jobseekers_users WHERE username = %s",
                $username
            ));
            if ($user) {
                $user_info = array(
                    'fname' => $user->first_name,
                    'lname' => $user->last_name,
                    'email' => $user->email
                );

                $user_info_data = maybe_unserialize($user->user_info);

                if (is_array($user_info_data)) {
                    $user_info = array_merge($user_info, $user_info_data);
                } 
            }
        }
    }

    $profile_pic = !empty($user_info['profile_pic']) ? esc_attr($user_info['profile_pic']) : '';

    if (!empty($profile_pic)) {
        $upload_dir = wp_upload_dir();
        $custom_upload_dir = $upload_dir['baseurl'] . '/jobseekers-assets';
        $profile_pic = $custom_upload_dir . '/' . ltrim($profile_pic, '/');
    } else {
        $profile_pic = get_template_directory_uri() . '/assets/images/user.png';
    }
    
    ob_start(); ?>
    <div class="jobseekers_profile_wrapper">
        <div class="jobseekers_profile_formWrap">
            <form class="jobseekers_profile_form" id="jobseekers_profile_form" method="POST">
                <input type="hidden" id="jobseek_profile_email" name="jobseek_profile_email" value="<?php echo esc_attr( $user_info['email'] ); ?>">
                <input type="hidden" name="action" id="action" value="jobseekers_profile_form_save" />
                <?php wp_nonce_field('jobseekers_profile_form_save_action', 'jobseekers_profile_form_save_nonce_field'); ?> 
                <div class="jobseek_profile_wrap">
                    <div class="jobseek_loader" style="display: none;"><div class="jobLoader"></div></div>
                    <div class="jobseek_profile_cmnError" style="display: none;"><div class="jobseek_profile_cmnError_in"></div></div>
                    <div class="jobseek_profile_row row"> 
                        <div class="jobseek_profile_col col-md-12"> 
                            <div class="jobseek_profile_picMainwrap"> 
                                <label class="jobseek_profile_label"> Profile Pic </label>
                                <div class="jobseek_application_profilepic_wrap"> 
                                    <div class="jobseek_application_profilepic_wrap_img">
                                        <img class="profile-pic-preview" src="<?php echo esc_url($profile_pic); ?>" alt="Profile Pic" style="<?php echo empty($profile_pic) ? 'display:none;' : ''; ?>">
                                        <a href="javascript:void(0);" class="edit-profile-pic-link"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </div>
                                    <input type="file" class="jobseek_file_input" id="jobseek_profile_pic_copy" name="jobseek_profile_pic_copy"> 
                                </div> 
                                <div class="jobseek_error"></div>
                            </div>   
                        </div>   
                        <div class="jobseek_profile_col col-md-6">
                            <div class="jobseek_profile_inputWrap">
                                <label class="jobseek_profile_label"> Your First Name <sup>*</sup> </label>
                                <input type="text" class="inputField" id="jobseek_profile_fname" name="jobseek_profile_fname" value="<?php echo esc_attr( $user_info['fname'] ); ?>">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_profile_col col-md-6">
                            <div class="jobseek_profile_inputWrap">
                                <label class="jobseek_profile_label"> Your Last Name <sup>*</sup> </label>
                                <input type="text" class="inputField" id="jobseek_profile_lname" name="jobseek_profile_lname" value="<?php echo esc_attr( $user_info['lname'] ); ?>">
                                <div class="jobseek_error"></div> 
                            </div>
                        </div>  
                        <div class="jobseek_profile_col col-md-12">
                            <div class="jobseek_profile_inputWrap">
                                <label class="jobseek_profile_label"> Your Phone Number </label>
                                <input type="text" class="inputField numberonly" id="jobseek_profile_phone" name="jobseek_profile_phone" value="<?php echo esc_attr( $user_info['phone'] ); ?>">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_profile_col col-md-6">
                            <div class="jobseek_profile_inputWrap">
                                <label class="jobseek_profile_label"> Your Security Guard License </label>
                                <input type="text" class="inputField numberonly" id="jobseek_profile_license" name="jobseek_profile_license" value="<?php echo esc_attr( $user_info['license'] ); ?>">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_profile_col col-md-6">
                            <div class="jobseek_profile_inputWrap">
                                <label class="jobseek_profile_label"> License Expiry Date </label>
                                <div class="cmn_inputIcon cmn_inputIcon_date">
                                    <input type="text" class="inputField" id="jobseek_profile_license_expiry_date" name="jobseek_profile_license_expiry_date" value="<?php echo esc_attr( $user_info['license_expiry_date'] ); ?>">
                                </div> 
                                <div class="jobseek_error"></div>
                            </div>
                        </div> 
                        <div class="jobseek_profile_col col-md-12">
                            <div class="jobseek_profile_inputWrap jobseek_check_input">
                                <input type="checkbox" id="jobseek_profile_toggle_password" name="jobseek_profile_toggle_password">
                                <label for="jobseek_profile_toggle_password">Do you want to change your password?</label>
                            </div>
                        </div>
                        <div class="jobseek_profile_col col-md-6 jobseek_profile_password_col">
                            <div class="jobseek_profile_inputWrap">
                                <label class="jobseek_profile_label"> Your Password <sup>*</sup> </label>
                                <input type="password" class="inputField" id="jobseek_profile_password" name="jobseek_profile_password" placeholder="Password*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_profile_col col-md-6 jobseek_profile_password_col">
                            <div class="jobseek_profile_inputWrap">
                                <label class="jobseek_profile_label"> Confirm Password <sup>*</sup> </label>
                                <input type="password" class="inputField" id="jobseek_profile_confirm_password" name="jobseek_profile_confirm_password" placeholder="Confirm Password*">
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_profile_col col-md-12">
                            <div class="jobseek_profile_captcha_Wrap">
                                <div class="g-recaptcha" data-callback="jobseek_profile_recaptchaCallback" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                                <div class="jobseek_error"></div>
                            </div>
                        </div>
                        <div class="jobseek_profile_col col-md-12">
                            <div class="jobseek_profile_inputWrap">
                                <button type="submit" name="submit" class="btn-style gradientBtn">Update Profile</button>
                            </div>
                        </div> 
                    </div>
                </div>
            </form>
            <div class="jobseekers_profile_thankWrap profilePicUpdated" id="jobseekers_profile_thankWrap">
                <div class="job_profile_update_success_icon">
                    <span>
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                </div>
                <h4> Profile updated successfully.  </h4> 
            </div>
        </div>  
    </div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    return ob_get_clean();
}

add_shortcode('jobseekers_profile_form', 'jobseekers_profile_form');

?>