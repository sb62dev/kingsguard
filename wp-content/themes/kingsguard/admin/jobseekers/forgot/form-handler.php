<?php

// Forgot Password Form Handler
function handle_jobseekers_forgot_password() {
    $json_response = array();

    if (isset($_POST['jobseekers_forgot_password_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['jobseekers_forgot_password_form_save_nonce_field']), 'jobseekers_forgot_password_form_save_action')) {
        $errors = array();

        $captcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
        $captcha_valid = jobseeks_google_recaptcha($captcha_response);
        if (!$captcha_valid) {
            $errors['captcha_error'] = 'Captcha validation failed.';
        }

        if (!empty($errors)) {
            wp_send_json_error($errors);
        } else {
            global $wpdb;
            $email = sanitize_email($_POST['jobseek_forgot_password_email']);

            $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}jobseekers_users WHERE email = %s", $email));

            if ($user) {
                $reset_key = wp_generate_password(20, false);
                $datetime = new DateTime('now', new DateTimeZone('America/Toronto'));
                $reset_requested_at = $datetime->format('Y-m-d H:i:s');
                $wpdb->update(
                    $wpdb->prefix . 'jobseekers_users',
                    array(
                        'reset_key' => $reset_key, 
                        'reset_requested_at' => $reset_requested_at
                    ),
                    array('email' => $email)
                ); 

                $name = $user->first_name . ' ' . $user->last_name;

                $reset_url = add_query_arg(array(
                    'key' => urlencode($reset_key), 
                    'email' => urlencode($email)
                ), home_url('/jobseekers-reset-password/')); 

                send_forgot_verification_email($email, $name, $reset_url);  
                wp_send_json_success(array('message' => 'Password reset email sent.'));

            } else {
                wp_send_json_error(array('error' => 'No user found with that email address.'));
            }
        }
    } else {
        wp_send_json_error(array('error' => 'Nonce verification failed.'));
    }
    wp_die();
}

add_action('wp_ajax_handle_jobseekers_forgot_password', 'handle_jobseekers_forgot_password');
add_action('wp_ajax_nopriv_handle_jobseekers_forgot_password', 'handle_jobseekers_forgot_password');

// Reset Password Form Handler
function handle_jobseekers_reset_password() {
    if (isset($_POST['reset_key']) && isset($_POST['reset_email']) && isset($_POST['jobseek_new_password']) && isset($_POST['jobseekers_reset_password_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['jobseekers_reset_password_form_save_nonce_field']), 'jobseekers_reset_password_form_save_action')) {  
        $reset_key = sanitize_text_field($_POST['reset_key']);
        $email = sanitize_email($_POST['reset_email']);
        $new_password = sanitize_text_field($_POST['jobseek_new_password']);
        $confirm_password = sanitize_text_field($_POST['jobseek_confirm_password']); 

        $errors = array();

        if (empty($new_password) || empty($confirm_password)) {
            $errors['password_error'] = 'Password is required.';
        } elseif ($new_password !== $confirm_password) {
            $errors['password_mismatch'] = 'Passwords do not match.';
        } 

        if (!empty($errors)) {
            wp_send_json_error($errors);
        } else {
            global $wpdb;

            $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}jobseekers_users WHERE email = %s AND reset_key = %s", $email, $reset_key));

            if ($user) {
                $datetime = new DateTime('now', new DateTimeZone('America/Toronto'));
                $current_time = $datetime->format('Y-m-d H:i:s');

                // Calculate expiration time
                $reset_requested_at = new DateTime($user->reset_requested_at, new DateTimeZone('America/Toronto'));
                $expiration_time = $reset_requested_at->add(new DateInterval('PT30M'))->format('Y-m-d H:i:s');

                if ($current_time > $expiration_time) {
                    wp_send_json_error(array('error' => 'Reset link has expired.'));
                } else {
                    $hashed_password = wp_hash_password($new_password);
                    $wpdb->update(
                        $wpdb->prefix . 'jobseekers_users',
                        array('password' => $hashed_password, 'reset_key' => NULL),
                        array('email' => $email)
                    ); 

                    wp_send_json_success(array('message' => 'Password has been reset successfully.'));
                }
            } else {
                wp_send_json_error(array('error' => 'Invalid reset key or email.'));
            }
        }
    } else {
        wp_send_json_error(array('error' => 'Required fields are missing or nonce verification failed.')); 
    }
    wp_die();
}

add_action('wp_ajax_handle_jobseekers_reset_password', 'handle_jobseekers_reset_password');
add_action('wp_ajax_nopriv_handle_jobseekers_reset_password', 'handle_jobseekers_reset_password');

?>