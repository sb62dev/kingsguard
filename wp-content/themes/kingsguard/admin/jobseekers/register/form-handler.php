<?php

function handle_jobseekers_registration() {
    $errors = array();

    if (isset($_POST['jobseekers_register_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['jobseekers_register_form_save_nonce_field']), 'jobseekers_register_form_save_action')) {

        $captcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
        $captcha_valid = jobseeks_google_recaptcha($captcha_response);
        if (!$captcha_valid) {
            $errors['captcha_error'] = 'Captcha validation failed.';
        } 

        // Password validation
        $password = sanitize_text_field($_POST['jobseek_register_password']);
        $confirm_password = sanitize_text_field($_POST['jobseek_register_confirm_password']);
        if ($password !== $confirm_password) {
            $errors['jobseek_register_confirm_password'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            wp_send_json_error($errors);
        } else {

            global $wpdb;
            $username = sanitize_text_field($_POST['jobseek_register_user']);
            $email = sanitize_email($_POST['jobseek_register_email']);
            $password = wp_hash_password($_POST['jobseek_register_password']);
            $firstname = sanitize_text_field($_POST['jobseek_register_fname']);
            $lastname = sanitize_text_field($_POST['jobseek_register_lname']);
            $verification_token = wp_generate_password(20, false);

            // Check if the user already exists
            $user_exists = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}jobseekers_users WHERE username = %s OR email = %s",
                $username, $email
            ));

            if ($user_exists) {
                wp_send_json_error(array('error' => 'Username or email already exists!'));
            } else {

                $datetime = new DateTime('now', new DateTimeZone('America/Toronto'));

                // Insert new user
                $wpdb->insert(
                    $wpdb->prefix . 'jobseekers_users',
                    array(
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'first_name' => $firstname,
                        'last_name' => $lastname,
                        'role' => 'jobseeker',
                        'verification_token' => $verification_token,
                        'submission_date' => $datetime->format('Y-m-d H:i:s'),
                    )
                );

                $verification_link = add_query_arg(array(
                    'verify' => urlencode($verification_token),
                    'email' => urlencode($email)
                ), home_url('/jobseekers-register'));  

                send_verification_email($email, $firstname, $lastname, $verification_link); 

                wp_send_json_success(array('message' => 'Registration successful! Please check your email for the verification link.'));
            }
        }
    } else {
        wp_send_json_error(array('error' => 'Nonce verification failed.'));
    }
    wp_die();
}

add_action('wp_ajax_handle_jobseekers_registration', 'handle_jobseekers_registration');
add_action('wp_ajax_nopriv_handle_jobseekers_registration', 'handle_jobseekers_registration');  

// Function to verify email
function verify_jobseekers_email() {
    if (isset($_GET['verify']) && isset($_GET['email'])) {
        global $wpdb;

        $verification_token = sanitize_text_field($_GET['verify']);  
        $email = sanitize_email(rawurldecode($_GET['email']));  

        if (!empty($verification_token) && !empty($email)) {
            $user = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}jobseekers_users WHERE email = %s AND verification_token = %s",
                $email, $verification_token
            ));

            if ($user) {
                $wpdb->update(
                    $wpdb->prefix . 'jobseekers_users',
                    array('email_verified' => 1, 'verification_token' => ''),
                    array('id' => $user->id)
                ); 

                // Usage example
                $zoho_data = array(
                    'lead_source' => 'Register Jobseekers',
                    'email' => $user->email,
                    'first_name' =>  $user->first_name,
                    'last_name' => $user->last_name, 
                ); 

                // Send data to Zoho Leads
                $zoho_response = sendDataToZohoLeads($zoho_data);

                wp_redirect(home_url('/jobseekers-register?email-verification-success'));
                exit;
            }
        }
        wp_redirect(home_url('/jobseekers-register?email-verification-failed'));
        exit;
    }
}

add_action('template_redirect', 'verify_jobseekers_email'); 

?>