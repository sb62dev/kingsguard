<?php

function handle_contact_form() {
    $errors = array();

    if (isset($_POST['contact_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['contact_form_save_nonce_field']), 'contact_form_save_action')) {

        $captcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
        $captcha_valid = jobseeks_google_recaptcha($captcha_response);
        if (!$captcha_valid) {
            $errors['captcha_error'] = 'Captcha validation failed.';
        }  

        if (!empty($errors)) {
            wp_send_json_error($errors);
        } else { 
            global $wpdb; 
            $email = sanitize_email($_POST['kg_contact_email']); 
            $fname = sanitize_text_field($_POST['kg_contact_fname']);  
            $lname = sanitize_text_field($_POST['kg_contact_lname']);  
            $title = sanitize_text_field($_POST['kg_contact_title']);
            $phone = sanitize_text_field($_POST['kg_contact_phone']); 
            $services_data = isset($_POST['selected_services']) ? sanitize_text_field($_POST['selected_services']) : ''; 
            $security_services = isset($_POST['kg_contact_security_services']) ? implode(', ', $_POST['kg_contact_security_services']) : '';
            $parking_services = isset($_POST['kg_contact_parking_services']) ? implode(', ', $_POST['kg_contact_parking_services']) : '';
            $site_types = sanitize_text_field($_POST['kg_contact_site_types']);
            $length_cover = sanitize_text_field($_POST['kg_contact_length_cover']);
            $add_info = sanitize_textarea_field($_POST['kg_contact_add_info']);

            $name = $fname . ' ' . $lname; 
            $form_type = 'Quote';
            $list_id = MAILCHIMP_QUOTE_LIST_KEY;

            // Check if the user already exists
            $email_exists = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}contact_form_users WHERE email = %s",
                $email
            ));

            if ($email_exists) {
                wp_send_json_error(array('error' => 'Email already exists!'));
            } else {

                $datetime = new DateTime('now', new DateTimeZone('America/Toronto'));

                // Insert new user
                $wpdb->insert(
                    $wpdb->prefix . 'contact_form_users',
                    array( 
                        'email' => $email, 
                        'contact_fname' => $fname,  
                        'contact_lname' => $lname,
                        'contact_title' => $title,  
                        'phone_number' => $phone,   
                        'contact_services' => $services_data,
                        'contact_security_services' => $security_services,
                        'contact_parking_services' => $parking_services,
                        'contact_site_types' => $site_types,
                        'contact_length_cover' => $length_cover,
                        'contact_add_info' => $add_info,
                        'submission_date' => $datetime->format('Y-m-d H:i:s'),
                    ),
                    array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
                );  

                send_contact_user_email($email, $name);  
                send_contact_admin_email($name,$email,$title,$phone,$services_data,$parking_services,$security_services,$site_types,$length_cover,$add_info);
                add_subscriber_to_mailchimp($list_id, $email, $fname, $lname, $phone, $form_type);

                wp_send_json_success(array(
                    'message' => 'Submitted successful!'
                ));
            }
        }
    } else {
        wp_send_json_error(array('error' => 'Nonce verification failed.'));
    }
    wp_die();
}

add_action('wp_ajax_handle_contact_form', 'handle_contact_form');
add_action('wp_ajax_nopriv_handle_contact_form', 'handle_contact_form');  

?>