<?php

define('ADMIN_EMAILS', 'sb62dev@gmail.com, operations@kingsguard.ca'); 
define('ADMIN_EMAILS_QUOTE', 'sb62dev@gmail.com, quotes@kingsguard.ca'); 

/* Function to add common JS for Jobseekers */
function enqueue_custom_jobseekers_scripts() {
    wp_enqueue_script('custom-jobseekers-common-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-common.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_jobseekers_scripts');

/* Function to access google recaptcha response */
function jobseeks_google_recaptcha($captcha_response) {
    $secret_key = GOOGLE_RECAPTCHA_SECRET_KEY;
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $captcha_response;
    $response = wp_remote_get($url);
    $responseBody = wp_remote_retrieve_body($response);
    $result = json_decode($responseBody);
    return $result->success == true && !is_wp_error($result);
}

function jobseekers_users_table(){
    global $wpdb;
    return $wpdb->prefix . 'jobseekers_users';
}

function newsletter_users_table(){
    global $wpdb;
    return $wpdb->prefix . 'newsletter_users';
}

/* Function to get Jobseeker table info */
function get_jobseeker_info($email) {
    global $wpdb;
    $table_name = jobseekers_users_table();
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
} 

// Pagination funciton for admin
function common_pagination($current_page, $per_page, $total_pages, $base_url) {
    $pagination_html = '<div class="customPagi"><div class="tablenav-pages"><span class="displaying-num">' . ($per_page) . ' items</span>';
    $pagination_html .= '<span class="pagination-links">';

    $big = 999999999; // need an unlikely integer
    $page_links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url($base_url . '&paged=%#%')),
        'format' => '?paged=%#%',
        'current' => max(1, $current_page),
        'total' => $total_pages,
        'prev_text' => __('«'),
        'next_text' => __('»'),
        'type' => 'array',
    ));

    if ($page_links) {
        if ($current_page > 1) {
            $pagination_html .= '<a class="first-page button" href="' . esc_url($base_url . '&paged=1') . '"><span class="screen-reader-text">First page</span><span aria-hidden="true">«</span></a>';
            $pagination_html .= '<a class="prev-page button" href="' . esc_url($base_url . '&paged=' . ($current_page - 1)) . '"><span class="screen-reader-text">Previous page</span><span aria-hidden="true">‹</span></a>';
        } else {
            $pagination_html .= '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">«</span>';
            $pagination_html .= '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">‹</span>';
        }

        $pagination_html .= '<span class="screen-reader-text">Current Page</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">' . $current_page . ' of <span class="total-pages">' . $total_pages . '</span></span></span>';

        if ($current_page < $total_pages) {
            $pagination_html .= '<a class="next-page button" href="' . esc_url($base_url . '&paged=' . ($current_page + 1)) . '"><span class="screen-reader-text">Next page</span><span aria-hidden="true">›</span></a>';
            $pagination_html .= '<a class="last-page button" href="' . esc_url($base_url . '&paged=' . $total_pages) . '"><span class="screen-reader-text">Last page</span><span aria-hidden="true">»</span></a>';
        } else {
            $pagination_html .= '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">›</span>';
            $pagination_html .= '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">»</span>';
        }
    }

    $pagination_html .= '</span></div></div>';

    return $pagination_html;
}   

function getZohoAccessToken() {  
    $payload = array(
        'refresh_token' => ZOHO_REFRESH_TOKEN,
        'client_id' => ZOHO_CLIENT_ID,
        'client_secret' => ZOHO_CLIENT_SECRET,
        'grant_type' => 'refresh_token'
    ); 
    $tokenurl = 'https://accounts.zoho.eu/oauth/v2/token';
    $result = wp_remote_post($tokenurl, array(
        'method' => 'POST',
        'headers' => array(),
        'body' => $payload,
    ));

    if (is_wp_error($result)) {
        $response = $result->get_error_message();
    } else {
        $result_entities = $result['body'];
        $response = json_decode($result_entities, true);
    }

    if (isset($response['access_token'])) {
        return $response['access_token'];
    } else {
        // Log or handle the error
        error_log('Error retrieving access token: ' . json_encode($response));
        return null;
    }
} 

function sendDataToZohoLeads($data) {
    $access_token = getZohoAccessToken();

    if (!$access_token) {
        echo 'Failed to retrieve access token. Cannot proceed with sending data.';
        return;
    } 

    $payload = json_encode(array(
        'data' => array(
            array(
                'Lead_Source' => isset($data['lead_source']) ? $data['lead_source'] : 'Website',
                'Email' => isset($data['email']) ? $data['email'] : '', 
                'First_Name' => isset($data['first_name']) ? $data['first_name'] : '',
                'Last_Name' => isset($data['last_name']) ? $data['last_name'] : '', 
                'Phone' => isset($data['phone_number']) ? $data['phone_number'] : '',  
                'Consent_Checkbox' => isset($data['consent_checkbox']) ? $data['consent_checkbox'] : '',  
            )
        )
    ));

    $apiurl = "https://www.zohoapis.eu/crm/v2/Leads";
    $result = wp_remote_post($apiurl, array(
        'method' => 'POST',
        'headers' => array(
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json'
        ),
        'body' => $payload,
    ));

    if (is_wp_error($result)) {
        $response = $result->get_error_message();
    } else {
        $result_entities = $result['body'];
        $response = json_decode($result_entities, true);
    }

    return $response;
} 

function isEmailInZoho($email) {
    $access_token = getZohoAccessToken();

    if (!$access_token) {
        error_log('Failed to retrieve access token for email check.');
        return false; // Default to false if access token can't be obtained
    }

    // Define the API URL for searching leads with the specified email
    $apiurl = "https://www.zohoapis.eu/crm/v2/Leads/search?criteria=(Email:equals:$email)";

    // Set up the request
    $response = wp_remote_get($apiurl, array(
        'headers' => array(
            'Authorization' => 'Zoho-oauthtoken ' . $access_token
        )
    ));

    if (is_wp_error($response)) {
        error_log('Error in API request: ' . $response->get_error_message());
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $responseData = json_decode($body, true);

    if (isset($responseData['data']) && !empty($responseData['data'])) {
        return true; // Email exists in Zoho
    } else {
        return false; // Email does not exist in Zoho
    }
}

// Function to handle file upload
function handle_file_upload($file_field_name, $custom_dir, $prefix) {
    if (isset($_FILES[$file_field_name]) && !empty($_FILES[$file_field_name]['name'])) {
        $uploadedfile = $_FILES[$file_field_name];
        
        // Ensure the custom directory exists
        if (!file_exists($custom_dir)) {
            wp_mkdir_p($custom_dir);
        }

        // Generate a unique filename based on prefix and original file extension
        $file_extension = pathinfo($uploadedfile['name'], PATHINFO_EXTENSION);
        $unique_filename = "{$prefix}.{$file_extension}";

        // Set the upload overrides
        $upload_overrides = array('test_form' => false, 'unique_filename_callback' => null);
        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            // Move the file to the custom directory
            $new_file_path = $custom_dir . '/' . $unique_filename;
            if (rename($movefile['file'], $new_file_path)) { 
                return array(
                    'filename' => $unique_filename,  // Filename only
                    'url' => $upload_dir['baseurl'] . '/jobseekers-assets/' . $unique_filename  // Full URL
                );
            } else {
                return array('error' => 'Failed to move the uploaded file.');
            }
        } else {
            return array('error' => 'Failed to upload the file.');
        }
    }
    return array('filename' => '', 'url' => '');
}

// Include Table
require get_template_directory() . '/admin/jobseekers/jobseekers-table.php';

// Include registration form
require get_template_directory() . '/admin/jobseekers/register/jobseekers-register.php';

// Include login form
require get_template_directory() . '/admin/jobseekers/login/jobseekers-login.php';

// Include application form
require get_template_directory() . '/admin/jobseekers/applications/jobseekers-applications.php';

// Include forgot form
require get_template_directory() . '/admin/jobseekers/forgot/forgot.php';

// Include user list
require get_template_directory() . '/admin/jobseekers/jobseekers-user-list.php';

// Include user admin page
require get_template_directory() . '/admin/jobseekers/applicants/jobseekers-user-admin-page.php'; 

// Include Menu
require get_template_directory() . '/admin/jobseekers/jobseekers-user-menu.php';

// Include user profile
require get_template_directory() . '/admin/jobseekers/profile/profile.php';

// Include newsletter
require get_template_directory() . '/admin/jobseekers/newsletter/newsletter.php';

// Add custom rewrite rules
function custom_jobseekers_dashboard_rewrite_rules() {
    add_rewrite_rule('^jobseekers-dashboard/([^/]+)/?$', 'index.php?post_type=careers&name=$matches[1]', 'top');
}
add_action('init', 'custom_jobseekers_dashboard_rewrite_rules'); 

// Make sure WordPress recognizes the new query vars
function add_custom_query_vars($vars) {
    $vars[] = 'jobseekers-dashboard';
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars');

// Flush rewrite rules on theme activation
function custom_flush_rewrite_rules() {
    custom_jobseekers_dashboard_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'custom_flush_rewrite_rules');

// Check if the user is logged in and redirect appropriately
function custom_jobseekers_dashboard_template_redirect() {
    if (is_singular('careers')) {
        global $wp_query;

        // Get the current post
        $post = $wp_query->get_queried_object();

        // Get the post slug
        $post_slug = $post->post_name;

        // Check if the URL is in the jobseekers-dashboard structure
        if (strpos($_SERVER['REQUEST_URI'], 'jobseekers-dashboard') !== false) {
            if (!isset($_COOKIE['jobseeker_logged_in']) || $_COOKIE['jobseeker_logged_in'] !== 'true') {
                // If the user is not logged in, redirect to the standard job post URL
                wp_redirect(get_permalink($post));
                exit;
            }
        } else {
            // If the user is logged in, redirect to the jobseekers-dashboard URL
            if (isset($_COOKIE['jobseeker_logged_in']) && $_COOKIE['jobseeker_logged_in'] === 'true') {
                $redirect_url = home_url('/jobseekers-dashboard/') . $post_slug;
                wp_redirect($redirect_url);
                exit;
            }
        }
    }
}
add_action('template_redirect', 'custom_jobseekers_dashboard_template_redirect'); 