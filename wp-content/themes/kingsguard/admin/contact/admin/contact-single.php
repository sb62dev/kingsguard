<?php

function view_quote_page() {
    if (!isset($_GET['user_id'])) {
        return;
    }

    $user_id = intval($_GET['user_id']);
    global $wpdb;
    $table_name = contact_users_table();
    $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table_name} WHERE id = %d", $user_id));

    if (!$user) {
        echo '<div class="wrap"><h1>User not found</h1></div>';
        return;
    }

    // Display user details in a structured format
    echo '<div class="wrap">';
    echo '<div class="userWrap">';
    echo '<h1>User ID - '. esc_html($user_id) . '</h1>';
    echo '<div class="userWrap_info">';
    echo '<h2>Enquiry Form Details</h2>';
    echo '<div class="row">'; 

    // Name
    if (isset($user->contact_fname) && !empty($user->contact_fname)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-id-card" aria-hidden="true"></i></div>';
        echo '<h6>Name:</h6>';
        echo '<p class="applicantData">' . esc_html($user->contact_fname) . ' ' . esc_html($user->contact_lname) . '</p>';
        echo '</div>';
    }

    // Email
    if (isset($user->email) && !empty($user->email)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-envelope" aria-hidden="true"></i></div>';
        echo '<h6>Email:</h6>';
        echo '<p class="applicantData">' . esc_html($user->email) . '</p>';
        echo '</div>';
    }

    // Title
    if (isset($user->contact_title) && !empty($user->contact_title)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-file-text" aria-hidden="true"></i></div>';
        echo '<h6>Title:</h6>';
        echo '<p class="applicantData">' . esc_html($user->contact_title) . '</p>';
        echo '</div>';
    }

    // Phone Number
    if (isset($user->phone_number) && !empty($user->phone_number)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-phone" aria-hidden="true"></i></div>';
        echo '<h6>Phone:</h6>';
        echo '<p class="applicantData">' . esc_html($user->phone_number) . '</p>';
        echo '</div>';
    }

    // Services
    if (isset($user->contact_services) && !empty($user->contact_services)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-pie-chart" aria-hidden="true"></i></div>';
        echo '<h6>Services:</h6>';
        echo '<p class="applicantData">' . esc_html($user->contact_services) . '</p>';
        echo '</div>';
    }

    // Security Systems Services
    if (isset($user->contact_security_services) && !empty($user->contact_security_services)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-shield" aria-hidden="true"></i></div>';
        echo '<h6>Security Systems Services:</h6>';
        echo '<p class="applicantData">' . esc_html($user->contact_security_services) . '</p>';
        echo '</div>';
    }

    // Parking Enforcement Services
    if (isset($user->contact_parking_services) && !empty($user->contact_parking_services)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-car" aria-hidden="true"></i></div>';
        echo '<h6>Parking Enforcement Services:</h6>';
        echo '<p class="applicantData">' . esc_html($user->contact_parking_services) . '</p>';
        echo '</div>';
    }

    // Type of Site
    if (isset($user->contact_site_types) && !empty($user->contact_site_types)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-map-signs" aria-hidden="true"></i></div>';
        echo '<h6>Type of Site:</h6>';
        echo '<p class="applicantData">' . esc_html($user->contact_site_types) . '</p>';
        echo '</div>';
    }

    // Length of Cover
    if (isset($user->contact_length_cover) && !empty($user->contact_length_cover)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-calendar" aria-hidden="true"></i></div>';
        echo '<h6>Length of Cover:</h6>';
        echo '<p class="applicantData">' . esc_html($user->contact_length_cover) . '</p>';
        echo '</div>';
    }

    // Additional Information
    if (isset($user->contact_add_info) && !empty($user->contact_add_info)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>';
        echo '<h6>Additional Information:</h6>';
        echo '<p class="applicantData">' . esc_html($user->contact_add_info) . '</p>';
        echo '</div>';
    }

    // Form Submission Date
    if (isset($user->submission_date) && !empty($user->submission_date)) {
        echo '<div class="col-xl-4 col-md-6 col-sm-4">';
        echo '<div class="applicantIcon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>';
        echo '<h6>Submission Date/Time:</h6>';
        echo '<p class="applicantData">' . esc_html($user->submission_date) . '</p>';
        echo '</div>';
    }

    echo '</div>'; // Close userWrap_colRow 
    echo '</div>'; // Close userWrap_info
    echo '</div>'; // Close userWrap 

    echo '</div>'; // Close wrap
}

?>
