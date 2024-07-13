<?php    

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

/* Function to get Jobseeker table info */
function get_jobseeker_info($email) {
    global $wpdb;
    $table_name = jobseekers_users_table();
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
} 

// Include registration form
require get_template_directory() . '/admin/jobseekers/jobseekers-table.php';

// Include registration form
require get_template_directory() . '/admin/jobseekers/register/jobseekers-register.php';

// Include login form
require get_template_directory() . '/admin/jobseekers/login/jobseekers-login.php';

// Include application form
require get_template_directory() . '/admin/jobseekers/applications/jobseekers-applications.php';

// Include user list
require get_template_directory() . '/admin/jobseekers/jobseekers-user-list.php';

// Include user admin page
require get_template_directory() . '/admin/jobseekers/applicants/jobseekers-user-admin-page.php'; 

// Include Menu
require get_template_directory() . '/admin/jobseekers/jobseekers-user-menu.php';

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


?>