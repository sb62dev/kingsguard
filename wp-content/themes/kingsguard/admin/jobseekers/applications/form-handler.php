<?php

function jobseekers_users_table(){
    global $wpdb;
    return $wpdb->prefix . 'jobseekers_users';
}

function handle_job_application_submission() {
    $errors = array(); 
    global $wpdb;
    $table_name = jobseekers_users_table();

    if (isset($_POST['jobseekers_application_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['jobseekers_application_form_save_nonce_field']), 'jobseekers_application_form_save_action')) {

        $captcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
        $captcha_valid = jobseeks_google_recaptcha($captcha_response);
        if (!$captcha_valid) {
            $errors['captcha_error'] = 'Captcha validation failed.';
        }  

        if (!empty($errors)) {
            wp_send_json_error($errors);
        } else { 
            $email = sanitize_email($_POST['jobseek_application_email']);
            $phone = sanitize_text_field($_POST['jobseek_application_phone']);
            $coverletter = sanitize_textarea_field($_POST['jobseek_application_coverletter']);
            $job_id = intval($_POST['job_id']); 

            $email_exists = $wpdb->get_var($wpdb->prepare("SELECT email FROM {$table_name} WHERE email = %s", $email)); 

            if($email_exists){ 
                $current_applications = $wpdb->get_var($wpdb->prepare("SELECT job_applications FROM {$table_name} WHERE email = %s", $email));
                $job_applications = array();
                if (!empty($current_applications)) {
                    $job_applications = unserialize($current_applications);

                    // Check if an application for the given job ID already exists
                    foreach ($job_applications as $application) {
                        if ($application['job_id'] == $job_id) {
                            wp_send_json_error(array('error' => 'You have already applied for this job.'));
                        }
                    }
                }

                // Add the new application data
                $new_application = array(
                    'phone' => $phone,
                    'coverletter' => $coverletter,
                    'job_id' => $job_id,
                );
                $job_applications[] = $new_application;

                // Serialize the updated job applications
                $serialized_applications = serialize($job_applications);

                // Update the job_applications column
                $result = $wpdb->update(
                    $table_name,
                    array('job_applications' => $serialized_applications),
                    array('email' => $email)
                );

                if($result !== false) {
                    $json_response = array('status' => 'success', "code" => 200, "message" => __("Application has been updated successfully.", 'jobseekers'));
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

add_action('wp_ajax_handle_job_application_submission', 'handle_job_application_submission');
add_action('wp_ajax_nopriv_handle_job_application_submission', 'handle_job_application_submission');  

?>