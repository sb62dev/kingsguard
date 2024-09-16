<?php

function handle_contact_form() {
    $errors = array();

    if (isset($_POST['contact_form_save_nonce_field']) && wp_verify_nonce(sanitize_text_field($_POST['contact_form_save_nonce_field']), 'contact_form_save_action')) {

        $captcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
        $captcha_valid = jobseeks_google_recaptcha($captcha_response);
        if (!$captcha_valid) {
            $errors['captcha_error'] = 'Captcha validation failed.';
        }  

        $email = sanitize_email($_POST['kg_contact_email']); 
        $restricted_domains = array('yahoo.com', 'yahoo.ca', 'gmail.com', 'hotmail.com');
        $email_domain = substr(strrchr($email, "@"), 1);
        if (in_array($email_domain, $restricted_domains)) {
            $errors['email_error'] = 'Email domain is not allowed. Please use your work email address instead.';
        }

        if (!empty($errors)) {
            wp_send_json_error($errors);
        } else { 
            global $wpdb;  
            $fname = sanitize_text_field($_POST['kg_contact_fname']);  
            $lname = sanitize_text_field($_POST['kg_contact_lname']);  
            $phone = sanitize_text_field($_POST['kg_contact_phone']);  
            $services_list = isset($_POST['kg_contact_services_list']) ? implode(', ', $_POST['kg_contact_services_list']) : '';
            $security_services = isset($_POST['kg_contact_security_services']) ? implode(', ', $_POST['kg_contact_security_services']) : '';
            $parking_services = isset($_POST['kg_contact_parking_services']) ? implode(', ', $_POST['kg_contact_parking_services']) : '';
            $site_types = sanitize_text_field($_POST['kg_contact_site_types']);
            $length_cover = sanitize_text_field($_POST['kg_contact_length_cover']);
            $add_info = sanitize_textarea_field($_POST['kg_contact_add_info']);  
            $consent_checkbox = sanitize_text_field($_POST['kg_contact_consent_checkbox']); 

            $name = $fname . ' ' . $lname; 
            $form_type = 'Quote';
            $list_id = MAILCHIMP_QUOTE_LIST_KEY;

            $datetime = new DateTime('now', new DateTimeZone('America/Toronto'));

            // Insert new user
            $wpdb->insert(
                $wpdb->prefix . 'contact_form_users',
                array( 
                    'email' => $email, 
                    'contact_fname' => $fname,  
                    'contact_lname' => $lname, 
                    'phone_number' => $phone,   
                    'contact_services' => $services_list,
                    'contact_security_services' => $security_services,
                    'contact_parking_services' => $parking_services,
                    'contact_site_types' => $site_types,
                    'contact_length_cover' => $length_cover,
                    'contact_add_info' => $add_info,
                    'contact_consent' => $consent_checkbox,
                    'submission_date' => $datetime->format('Y-m-d H:i:s'),
                ),
                array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
            );  

            // Usage example
            $userData = array(
                'lead_source' => 'Quote',
                'email' => $email,
                'first_name' => $fname,
                'last_name' => $lname,
                'phone_number' => $phone,   
                'consent_checkbox' => $consent_checkbox, 
            ); 

            send_contact_user_email($email, $name);  
            send_contact_admin_email($name,$email,$phone,$services_list,$parking_services,$security_services,$site_types,$length_cover,$add_info); 
            if (!isEmailInZoho($email)) {
                sendDataToZohoLeads($userData);
            } 

            wp_send_json_success(array(
                'message' => 'Submitted successful!'
            ));
        }
    } else {
        wp_send_json_error(array('error' => 'Nonce verification failed.'));
    }
    wp_die();
}

add_action('wp_ajax_handle_contact_form', 'handle_contact_form');
add_action('wp_ajax_nopriv_handle_contact_form', 'handle_contact_form');  

?>