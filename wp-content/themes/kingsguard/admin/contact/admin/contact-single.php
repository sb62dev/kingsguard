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
    echo '<div class="userWrap_colRow">'; 

    // Name
    if (isset($user->contact_name) && !empty($user->contact_name)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Name:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->contact_name) . '</div>';
        echo '</div>';
    }

    // Email
    if (isset($user->email) && !empty($user->email)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Email:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->email) . '</div>';
        echo '</div>';
    }

    // Title
    if (isset($user->contact_title) && !empty($user->contact_title)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Title:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->contact_title) . '</div>';
        echo '</div>';
    }

    // Phone Number
    if (isset($user->phone_number) && !empty($user->phone_number)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Phone:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->phone_number) . '</div>';
        echo '</div>';
    }

    // Services
    if (isset($user->contact_services) && !empty($user->contact_services)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Services:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->contact_services) . '</div>';
        echo '</div>';
    }

    // Security Systems Services
    if (isset($user->contact_security_services) && !empty($user->contact_security_services)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Security Systems Services:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->contact_security_services) . '</div>';
        echo '</div>';
    }

    // Parking Enforcement Services
    if (isset($user->contact_parking_services) && !empty($user->contact_parking_services)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Parking Enforcement Services:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->contact_parking_services) . '</div>';
        echo '</div>';
    }

    // Type of Site
    if (isset($user->contact_site_types) && !empty($user->contact_site_types)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Type of Site:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->contact_site_types) . '</div>';
        echo '</div>';
    }

    // Length of Cover
    if (isset($user->contact_length_cover) && !empty($user->contact_length_cover)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Length of Cover:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->contact_length_cover) . '</div>';
        echo '</div>';
    }

    // Additional Information
    if (isset($user->contact_add_info) && !empty($user->contact_add_info)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Additional Information:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->contact_add_info) . '</div>';
        echo '</div>';
    }

    // Form Submission Date
    if (isset($user->submission_date) && !empty($user->submission_date)) {
        echo '<div class="row">';
        echo '<div class="col-md-4"><strong>Submission Date/Time:</strong></div>';
        echo '<div class="col-md-8">' . esc_html($user->submission_date) . '</div>';
        echo '</div>';
    }

    echo '</div>'; // Close userWrap_colRow 
    echo '</div>'; // Close userWrap_info
    echo '</div>'; // Close userWrap 

    echo '</div>'; // Close wrap
}

?>
