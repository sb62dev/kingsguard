<?php 

function handle_jobseekers_profile() {
    $errors = array();
    global $wpdb;
    $table_name = jobseekers_users_table();

    if (isset($_POST['jobseekers_profile_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['jobseekers_profile_form_save_nonce_field']), 'jobseekers_profile_form_save_action')) {

        $captcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
        $captcha_valid = jobseeks_google_recaptcha($captcha_response);
        if (!$captcha_valid) {
            $errors['captcha_error'] = 'Captcha validation failed.';
        } 

        // Password validation
        $password = sanitize_text_field($_POST['jobseek_profile_password']);
        $confirm_password = sanitize_text_field($_POST['jobseek_profile_confirm_password']);
        if ($password !== $confirm_password) {
            $errors['jobseek_profile_confirm_password'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            wp_send_json_error($errors);
        } else {
 
            $email = sanitize_email($_POST['jobseek_profile_email']);
            $password = wp_hash_password($_POST['jobseek_profile_password']);
            $firstname = sanitize_text_field($_POST['jobseek_profile_fname']);
            $lastname = sanitize_text_field($_POST['jobseek_profile_lname']);
            $phone = sanitize_text_field($_POST['jobseek_profile_phone']);
            $license = sanitize_text_field($_POST['jobseek_profile_license']);
            $licenseExpiryDate = sanitize_text_field($_POST['jobseek_profile_license_expiry_date']); 

            $upload_dir = wp_upload_dir();
            $custom_upload_dir = $upload_dir['basedir'] . '/jobseekers-assets'; 

            // Handle file uploads
            $profilepic = handle_file_upload('jobseek_profile_pic_copy', $custom_upload_dir, "profile_pic_{$firstname}");

            // Check if the user already exists
            $email_exists = $wpdb->get_var($wpdb->prepare("SELECT email FROM {$table_name} WHERE email = %s", $email));

            if($email_exists){ 
                
                $current_userinfo = maybe_unserialize($user->user_info);
                if (!is_array($current_userinfo)) {
                    $current_userinfo = array();
                }

                $datetime = new DateTime('now', new DateTimeZone('America/Toronto'));

                // Add the new application data
                $updated_userinfo = array(
                    'phone' => $phone, 
                    'license' => $license,
                    'license_expiry_date' => $licenseExpiryDate,
                    'profile_pic' => $profilepic['filename'], 
                    'updated_date' => $datetime->format('Y-m-d H:i:s'),
                ); 

                // Merge new data with existing user info
                $current_userinfo = array_merge($current_userinfo, $updated_userinfo);

                // Serialize the updated user info
                $serialized_userinfo = maybe_serialize($current_userinfo);

                // Update the job_applications column
                $result = $wpdb->update(
                    $table_name,
                    array( 
                        'first_name' => $firstname,
                        'last_name' => $lastname, 
                        'password' => $hashed_password, 
                        'user_info' => $serialized_userinfo
                    ),
                    array('email' => $email)
                );

                if($result !== false) { 
                    $json_response = array('status' => 'success', "code" => 200, "message" => __("Profile has been updated successfully.", 'jobseekers'));
                    wp_send_json_success($json_response);
                } else {
                    wp_send_json_error(array('error' => 'Failed to update application.'));
                }
            } else {
                wp_send_json_error(array('error' => 'Email not found.'));
            } 

        }
    } else {
        wp_send_json_error(array('error' => 'Nonce verification failed.'));
    }
    wp_die();
}

add_action('wp_ajax_handle_jobseekers_profile', 'handle_jobseekers_profile');
add_action('wp_ajax_nopriv_handle_jobseekers_profile', 'handle_jobseekers_profile');  

?>