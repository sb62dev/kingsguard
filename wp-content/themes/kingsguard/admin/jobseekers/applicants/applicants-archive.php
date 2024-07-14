<?php   

function jobseekers_admin_page() {
    global $wpdb;
    $table_name = jobseekers_users_table();
    $users_per_page = 5;
    $total_users = $wpdb->get_var("SELECT COUNT(*) FROM {$table_name}");
    $total_pages = ceil($total_users / $users_per_page); 

    // Determine the current page
    $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $offset = ($current_page - 1) * $users_per_page;

    // Retrieve users for the current page
    $users = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_name} LIMIT %d OFFSET %d", $users_per_page, $offset));

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

    echo '<div class="wrap">';
    echo '<h1>Job Applications</h1>';
    echo '<form method="post" action="">';
    echo '<input type="submit" name="bulk_delete" value="Delete Selected" class="button button-danger" onclick="return confirm(\'Are you sure you want to delete the selected users?\');">';
    echo '<table class="widefat fixed" cellspacing="0">';
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

    echo '</tbody></table>';  

    echo common_pagination($current_page, $total_users, $total_pages, admin_url('admin.php?page=jobseekers-job-applications'));

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
