<?php

function handle_newsletter_form() {
    $errors = array();

    if (isset($_POST['kg_newsletter_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['kg_newsletter_form_save_nonce_field']), 'kg_newsletter_form_save_action')) {

        if (!empty($_POST['kg_newsletter_honeypot']) || (time() - (int)$_POST['kg_newsletter_start_time']) < 5) {
            wp_send_json_error(array('error' => 'There is something wrong with form submission.'));
        } 
        if (!empty($errors)) {
            wp_send_json_error($errors);
        } else {

            global $wpdb; 
            $email = sanitize_email($_POST['kg_newsletter_email']);  

            // Check if the Email already exists
            $email_exists = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}newsletter_users WHERE email = %s",
                $email
            ));

            if ($email_exists) {
                wp_send_json_error(array('error' => 'Email already exists!'));
            } else {

                $datetime = new DateTime('now', new DateTimeZone('America/Toronto'));

                // Insert new user
                $wpdb->insert(
                    $wpdb->prefix . 'newsletter_users',
                    array( 
                        'email' => $email,   
                        'submission_date' => $datetime->format('Y-m-d H:i:s'),
                    )
                );   

                // Usage example
                $userData = array(
                    'lead_source' => 'Newsletter',
                    'email' => $email, 
                    'last_name' => '-',   
                );   

                send_newsletter_user_email($email);
                send_newsletter_admin_email($email);
                sendDataToZohoLeads($userData);
                wp_send_json_success(array('message' => 'Form submitted successfully.'));
            }
        }
    } else {
        wp_send_json_error(array('error' => 'Nonce verification failed.'));
    }
    wp_die();
}

add_action('wp_ajax_handle_newsletter_form', 'handle_newsletter_form');
add_action('wp_ajax_nopriv_handle_newsletter_form', 'handle_newsletter_form');   

?>