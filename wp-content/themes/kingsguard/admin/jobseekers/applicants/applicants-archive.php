<?php

function jobseekers_admin_page() {
    global $wpdb;
    $table_name = jobseekers_users_table();
    $users_per_page = 10;

    // Check if 'submitted_jobs_only' is set in the URL; if not set, show only users who have submitted jobs
    $submitted_jobs_only = isset($_GET['submitted_jobs_only']) ? intval($_GET['submitted_jobs_only']) : 1;

    // Get the selected job title from the filter
    $selected_job_title = isset($_GET['job_title']) ? sanitize_text_field($_GET['job_title']) : '';

    // Build the base SQL query
    $total_users_query = "SELECT * FROM {$table_name}";

    // Apply filtering based on job title and whether the user has submitted jobs
    $where_clauses = [];
    if ($submitted_jobs_only === 1) {
        $where_clauses[] = "job_applications IS NOT NULL AND job_applications != ''";
    }
    if (!empty($selected_job_title)) {
        $where_clauses[] = $wpdb->prepare("job_applications LIKE %s", '%' . $wpdb->esc_like($selected_job_title) . '%');
    }
    if (!empty($where_clauses)) {
        $total_users_query .= " WHERE " . implode(' AND ', $where_clauses);
    }

    // Get the total number of users
    $total_users = count($wpdb->get_results($total_users_query));
    $total_pages = ceil($total_users / $users_per_page);

    // Determine the current page
    $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $offset = ($current_page - 1) * $users_per_page;

    // Get the filtered users for the current page 
    $users_query = $total_users_query . $wpdb->prepare(" ORDER BY id DESC LIMIT %d OFFSET %d", $users_per_page, $offset);
    $users = $wpdb->get_results($users_query);

    // Handle bulk delete action
    if (isset($_POST['bulk_delete'])) {
        if (isset($_POST['user_ids']) && !empty($_POST['user_ids'])) {
            $user_ids = array_map('intval', $_POST['user_ids']);
            foreach ($user_ids as $user_id) {
                $wpdb->delete($table_name, array('id' => $user_id));
            }
            echo '<div class="updated"><p>Selected users have been deleted.</p></div>';
        }
    }

    // Retrieve all distinct job titles for the dropdown filter
    $distinct_job_titles = $wpdb->get_col("SELECT DISTINCT job_applications FROM {$table_name} WHERE job_applications IS NOT NULL");
    $job_titles = [];
    foreach ($distinct_job_titles as $serialized_jobs) {
        $jobs = unserialize($serialized_jobs);
        if (is_array($jobs)) {
            foreach ($jobs as $job) {
                if (isset($job['job_title']) && !in_array($job['job_title'], $job_titles)) {
                    $job_titles[] = $job['job_title'];
                }
            }
        }
    }

    // Start rendering the page
    echo '<div class="wrap">';
    echo '<h1>Job Applications</h1>';

    // Form for the filter
    echo '<form method="get" action="" class="jobFilter_wrap">';
    echo '<input type="hidden" name="page" value="jobseekers-job-applications">';
    echo '<div class="jobFilter_col jobFilter_col_1"><label><input type="checkbox" name="submitted_jobs_only" value="0"' . checked(0, $submitted_jobs_only, false) . '> Show all users</label></div>';
    
    // Job title dropdown 
    echo '<div class="jobFilter_col jobFilter_col_2"><label for="job_title">Filter by Job Title:</label>';
    echo '<select name="job_title" id="job_title">';
    echo '<option value="">Select Job Title</option>';
    foreach ($job_titles as $job_title) {
        echo '<option value="' . esc_attr($job_title) . '"' . selected($selected_job_title, $job_title, false) . '>' . esc_html($job_title) . '</option>';
    }
    echo '</select></div>';

    echo '<input type="hidden" name="paged" id="paged" value="1">'; // Set pagination to page 1 on filter change
    echo '<input type="submit" class="button" value="Filter">';
    echo '</form>';

    // Form for bulk actions
    echo '<form method="post" action="">';
    echo '<input type="submit" name="bulk_delete" value="Delete Selected" class="button button-danger" onclick="return confirm(\'Are you sure you want to delete the selected users?\');">';
    echo '<div class="table_responsive_wrap"><table class="widefat fixed" cellspacing="0">';
    echo '<thead><tr><th style="width: 50px"><input type="checkbox" id="select-all">ID</th><th style="width: 90px">Applicant ID</th><th>Name</th><th>Email</th><th>Job Count</th><th>Date/time</th><th>Action</th></tr></thead>';
    echo '<tbody>';

    $counter = 1 + $offset;
    foreach ($users as $user) {
        $job_applications = unserialize($user->job_applications);
        $job_count = is_array($job_applications) ? count($job_applications) : 0;
        echo '<tr>';
        echo '<td><input type="checkbox" name="user_ids[]" value="' . esc_attr($user->id) . '">' . esc_html($counter) . '</td>';
        echo '<td>' . esc_html($user->id) . '</td>';
        echo '<td>' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '</td>';
        echo '<td>' . esc_html($user->email) . '</td>';
        echo '<td>' . esc_html($job_count) . '</td>';
        echo '<td>' . esc_html($user->submission_date) . '</td>';
        echo '<td><a href="' . admin_url('admin.php?page=view-jobseeker&user_id=' . $user->id) . '" class="button button-primary">View Details</a></td>';
        echo '</tr>';
        $counter++;
    }

    if (empty($users)) {
        echo '<tr><td colspan="7">No users found.</td></tr>';
    }

    echo '</tbody></table></div>';

    // Pagination with filter state
    echo common_pagination($current_page, $total_users, $total_pages, admin_url('admin.php?page=jobseekers-job-applications&submitted_jobs_only=' . esc_attr($submitted_jobs_only) . '&job_title=' . urlencode($selected_job_title)));

    echo '</form></div>';

    // JavaScript to handle "select all" functionality
    echo '<script type="text/javascript">
    document.getElementById("select-all").addEventListener("change", function(event) {
        var checkboxes = document.querySelectorAll(\'input[name="user_ids[]"]\');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = event.target.checked;
        }
    });
    </script>';
}

?>
