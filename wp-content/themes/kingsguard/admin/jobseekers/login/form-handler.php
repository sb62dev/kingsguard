<?php      

function handle_jobseekers_login() {
    $json_response = array();

    if (isset($_POST['jobseekers_login_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['jobseekers_login_form_save_nonce_field']), 'jobseekers_login_form_save_action')) {
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
            $username = sanitize_text_field($_POST['jobseek_user']);
            $password = $_POST['jobseek_password']; 
            $query = $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}jobseekers_users WHERE username = %s",
                $username
            );  
            $user = $wpdb->get_row($query);  
            if ($user && wp_check_password($password, $user->password, $user->id)) {
                // Set cookie for logged-in user
                $cookie_name = 'jobseeker_logged_in';
                $cookie_value = 'true';
                $expiry = time() + 3600 * 24 * 7; // Expiry in 1 week (adjust as needed)
                setcookie($cookie_name, $cookie_value, $expiry, '/'); // '/' makes it accessible across the entire domain

                $cookie_username = 'jobseeker_username';
                setcookie($cookie_username, $username, $expiry, '/');  
                wp_send_json_success(array('message' => 'Login successful.'));
            } else { 
                wp_send_json_error(array('error' => 'Invalid username or password.'));
            }
        }
    } else {
        wp_send_json_error(array('error' => 'Nonce verification failed.'));
    }
    wp_die();
}

add_action('wp_ajax_handle_jobseekers_login', 'handle_jobseekers_login');
add_action('wp_ajax_nopriv_handle_jobseekers_login', 'handle_jobseekers_login');  

?>