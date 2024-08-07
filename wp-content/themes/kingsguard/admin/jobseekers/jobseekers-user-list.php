<?php    

function show_user_submitted_jobs($atts) {  
    global $wpdb;
    $table_name = jobseekers_users_table(); 

    $atts = shortcode_atts(array('count' => -1), $atts, 'user_submitted_jobs');
    $count = intval($atts['count']);

    if ( isset( $_COOKIE['jobseeker_logged_in'] ) && $_COOKIE['jobseeker_logged_in'] === 'true' ) {
        $username = isset($_COOKIE['jobseeker_username']) ? sanitize_text_field($_COOKIE['jobseeker_username']) : ''; 

        // Fetch job applications for the logged-in user
        $user_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table_name} WHERE username = %s", $username));

        if (empty($user_data)) {
            return '<p>You have not submitted any job applications.</p>';
        }

        $job_applications = unserialize($user_data->job_applications);

        if (empty($job_applications)) {
            return '<p>You have not submitted any job applications.</p>';
        }

        if ($count > 0) {
            $job_applications = array_slice($job_applications, 0, $count);
        }

        $output = '<table class="job-applications-table">'; 
        $output .= '<thead><tr><th>Job ID</th><th>Job Title</th><th>Job Type</th><th>Job Location</th><th>Status</th></tr></thead>';
        $output .= '<tbody>';

        // Status to class mapping
        $status_class_mapping = array(
            'Applied' => 'status-applied',
            'Being Reviewed' => 'status-being-reviewed',
            'Rejected' => 'status-rejected',
            'Approved' => 'status-approved'
        );

        foreach ($job_applications as $application) {
            $job_id = intval($application['job_id']);
            $job_title = esc_html($application['job_title']);  
            $job_post = get_post($job_id);

            if ($job_post) { 
                $job_types = wp_get_post_terms($job_id, 'jobs_job_types', array('fields' => 'names'));
                $job_locations = wp_get_post_terms($job_id, 'jobs_job_locations', array('fields' => 'names'));
                $job_types_list = !empty($job_types) ? esc_html(implode(', ', $job_types)) : 'N/A';
                $job_locations_list = !empty($job_locations) ? esc_html(implode(', ', $job_locations)) : 'N/A';
                $status = isset($application['status']) ? esc_html($application['status']) : 'N/A';
                // Determine the CSS class based on status
                $status_class = isset($status_class_mapping[$status]) ? $status_class_mapping[$status] : ' '; 
                $output .= '<tr>';
                $output .= '<td>' . esc_html($job_id) . '</td>';
                $output .= '<td>' . $job_title . '</td>';
                $output .= '<td>' . $job_types_list . '</td>';
                $output .= '<td>' . $job_locations_list . '</td>'; 
                $output .= '<td><span class="status-btn-style ' . esc_attr($status_class) . '">' . $status . '</span></td>'; 
                $output .= '</tr>';
            }
        }  

        $output .= '</tbody>';
        $output .= '</table>';

        return $output; 
    } else {
        return '<p>Please log in to view your job applications.</p>';
    } 
} 

add_shortcode('user_submitted_jobs', 'show_user_submitted_jobs');  