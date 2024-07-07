<?php

function handle_job_application_submission() {
    $errors = array();

    if (isset($_POST['jobseekers_application_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['jobseekers_application_form_save_nonce_field']), 'jobseekers_application_form_save_action')) {

        $captcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
        $captcha_valid = jobseeks_google_recaptcha($captcha_response);
        if (!$captcha_valid) {
            $errors['captcha_error'] = 'Captcha validation failed.';
        }  

        if (!empty($errors)) {
            wp_send_json_error($errors);
        } else {
            global $wpdb;
            $email = sanitize_email($_POST['jobseek_application_email']);
            $phone = sanitize_text_field($_POST['jobseek_application_phone']);
            $coverletter = sanitize_textarea_field($_POST['jobseek_application_coverletter']);
            $job_id = intval($_POST['job_id']);

            // Debug: Log email to check if it is being received correctly
            error_log('Email: ' . $email);

            $jobseeker_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$wpdb->prefix}jobseekers_users WHERE email = %s", $email));

            // Debug: Log jobseeker_id to check if it is being retrieved correctly
            error_log('Jobseeker ID: ' . $jobseeker_id);

            if ($jobseeker_id) {
                $application_data = array(
                    'phone' => $phone,
                    'coverletter' => $coverletter,
                    'job_id' => $job_id, 
                );

                // Debug: Output data to error log
                error_log('Application Data:');
                error_log(print_r($application_data, true));

                // Retrieve existing applications data or initialize as array
                $existing_applications = get_user_meta($jobseeker_id, 'job_applications', true);
                $updated_applications = is_array($existing_applications) ? $existing_applications : array(); 

                // Append new application data
                $updated_applications[] = $application_data;

                // Debug: Log updated applications data
                error_log('Updated Applications:');
                error_log(print_r($updated_applications, true));

                // Update job applications in user meta
                $update_result = update_user_meta($jobseeker_id, 'job_applications', $updated_applications);

                // Debug: Output update result
                error_log('Update Result:');
                error_log(print_r($update_result, true));

                if ($update_result) {
                    // Send application data and update result back to frontend
                    wp_send_json_success(array(
                        'existing_applications' => $existing_applications,
                        'updated_applications' => $updated_applications, 
                        'message' => 'Application applied successfully!',
                        'application_data' => $application_data,
                        'update_result' => $update_result,
                    ));
                } else {
                    wp_send_json_error(array('error' => 'Failed to update job applications.'));
                }
            } else {
                wp_send_json_error(array('error' => 'Jobseeker not found.'));
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