<?php   

function jobseekers_admin_menu() {
    add_menu_page(
        'Job Applications',
        'Job Applications',
        'manage_options',
        'jobseekers-job-applications',
        'jobseekers_admin_page',
        'dashicons-welcome-learn-more',
        20
    );
    
    add_submenu_page(
        null,
        'View Applicant',
        'View Applicant',
        'manage_options',
        'view-jobseeker',
        'view_jobseeker_page'
    );
}

add_action('admin_menu', 'jobseekers_admin_menu');

function jobseekers_admin_page() {
    global $wpdb;
    $table_name = jobseekers_users_table();
    $users = $wpdb->get_results("SELECT * FROM {$table_name}");

    echo '<div class="wrap">';
    echo '<h1>Job Applications</h1>';
    echo '<table class="widefat fixed" cellspacing="0">';
    echo '<thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr></thead>';
    echo '<tbody>';

    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . esc_html($user->id) . '</td>';
        echo '<td>' . esc_html($user->username) . '</td>';
        echo '<td>' . esc_html($user->email) . '</td>';
        echo '<td><a href="' . admin_url('admin.php?page=view-jobseeker&user_id=' . $user->id) . '" class="button">View Details</a></td>';
        echo '</tr>';
    } 

    echo '</tbody></table></div>';
}

function view_jobseeker_page() {
    if (!isset($_GET['user_id'])) {
        return;
    }

    $user_id = intval($_GET['user_id']);
    global $wpdb;
    $table_name = jobseekers_users_table();
    $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table_name} WHERE id = %d", $user_id));

    if (!$user) {
        echo '<div class="wrap"><h1>User not found</h1></div>';
        return;
    }

    // Handle form submission for updating application status
    if (isset($_POST['update_application_status'])) {
        $application_index = intval($_POST['application_index']);
        $new_status = sanitize_text_field($_POST['status']);
        $job_applications = unserialize($user->job_applications) ?: [];
        $job_applications[$application_index]['status'] = $new_status;
        $wpdb->update(
            $table_name,
            array('job_applications' => serialize($job_applications)),
            array('id' => $user_id)
        );
        $user->job_applications = serialize($job_applications); // Update user object to reflect changes
    }

    $job_applications = unserialize($user->job_applications) ?: [];

    echo '<div class="wrap">';
    echo '<h1>Job Seeker Details</h1>';
    echo '<h2>' . esc_html($user->username) . '</h2>';
    echo '<p>Email: ' . esc_html($user->email) . '</p>';

    if (!empty($job_applications)) {
        echo '<h3>Job Applications</h3>';
        echo '<table class="widefat fixed" cellspacing="0">';
        echo '<thead><tr><th>Job ID</th><th>Job Title</th><th>Status</th><th>Action</th></tr></thead>';
        echo '<tbody>';

        foreach ($job_applications as $index => $application) {
            echo '<tr>';
            echo '<td>' . esc_html(isset($application['job_id']) ? $application['job_id'] : 'N/A') . '</td>';
            echo '<td>' . esc_html(isset($application['job_title']) ? $application['job_title'] : 'N/A') . '</td>';
            echo '<td>' . esc_html(isset($application['status']) ? $application['status'] : 'N/A') . '</td>';
            echo '<td>';
            echo '<form method="post">';
            echo '<input type="hidden" name="application_index" value="' . esc_attr($index) . '">';
            echo '<select name="status">'; 
            echo '<option value="New"' . selected(isset($application['status']) ? $application['status'] : '', 'New', false) . '>New</option>';
            echo '<option value="Rejected"' . selected(isset($application['status']) ? $application['status'] : '', 'Rejected', false) . '>Rejected</option>';
            echo '<option value="Approved"' . selected(isset($application['status']) ? $application['status'] : '', 'Approved', false) . '>Approved</option>';
            echo '</select>';
            echo '<input type="submit" name="update_application_status" value="Update Status" class="button">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No job applications found for this user.</p>';
    }

    echo '</div>';
}

?>