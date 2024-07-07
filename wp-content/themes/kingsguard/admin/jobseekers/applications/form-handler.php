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
            $firstname = sanitize_text_field($_POST['jobseek_application_fname']);
            $lastname = sanitize_text_field($_POST['jobseek_application_lname']);
            $phone = sanitize_text_field($_POST['jobseek_application_phone']);
            $coverletter = sanitize_textarea_field($_POST['jobseek_application_coverletter']);
            $job_id = intval($_POST['job_id']);
            $jobseeker_id = sanitize_text_field($_POST['jobseeker_id']);

            // Handle file upload (for resume)
            if (isset($_FILES['jobseek_application_resume']) && !empty($_FILES['jobseek_application_resume']['name'])) {
                $uploadedfile = $_FILES['jobseek_application_resume'];
                $upload_overrides = array('test_form' => false);
                $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
                if ($movefile && !isset($movefile['error'])) {
                    $resume_url = $movefile['url'];
                } else {
                    $resume_url = '';
                }
            } else {
                $resume_url = '';
            }

            $application_data = maybe_serialize(array(
                'phone' => $phone,
                'resume' => $resume_url,
                'cover_letter' => $coverletter
            ));

            // Check if the user already exists
            // $user_exists = $wpdb->get_var($wpdb->prepare(
            //     "SELECT COUNT(*) FROM {$wpdb->prefix}custom_jobseekers WHERE username = %s OR email = %s",
            //     $username, $email
            // ));

            // Insert application data
            $wpdb->insert(
                $wpdb->prefix . 'custom_job_applications',
                array(
                    'jobseeker_id' => $jobseeker_id,
                    'job_id' => $job_id,
                    'application_data' => $application_data
                )
            );

            wp_send_json_success(array('message' => 'Application applied successfully!'));

            // if ($user_exists) {
            //     wp_send_json_error(array('error' => 'Username or email already exists!'));
            // } else {
            //     // Insert new user
            //     $wpdb->insert(
            //         $wpdb->prefix . 'custom_job_applications',
            //         array(
            //             'jobseeker_id' => $jobseeker_id,
            //             'job_id' => $job_id,
            //             'application_data' => $application_data,
            //         )
            //     ); 

            //     //send_verification_email($email, $firstname, $lastname, $verification_link); 

            //     wp_send_json_success(array('message' => 'Application applied successfully!'));
            // }
        }
    } else {
        wp_send_json_error(array('error' => 'Nonce verification failed.'));
    }
    wp_die();
}

add_action('wp_ajax_handle_job_application_submission', 'handle_job_application_submission');
add_action('wp_ajax_nopriv_handle_job_application_submission', 'handle_job_application_submission');  

?>