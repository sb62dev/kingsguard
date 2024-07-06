<?php    

/* Function to access google recaptcha response */
function jobseeks_google_recaptcha($captcha_response) {
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LePvL4kAAAAAPr-QIFAiU07xFGHymqDNsBqbIqn&response=' . $captcha_response;
    $response = wp_remote_get($url);
    $responseBody = wp_remote_retrieve_body($response);
    $result = json_decode($responseBody);
    return $result->success == true && !is_wp_error($result);
}

// Include registration form
require get_template_directory() . '/admin/jobseekers/jobseekers-table.php';

// Include registration form
require get_template_directory() . '/admin/jobseekers/register/jobseekers-register.php';

// Include login form
require get_template_directory() . '/admin/jobseekers/login/jobseekers-login.php';

// Include user list
require get_template_directory() . '/admin/jobseekers/jobseekers-user-list.php';

// Include Menu
require get_template_directory() . '/admin/jobseekers/jobseekers-user-menu.php';

?>