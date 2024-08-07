<?php  

ob_start();

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
        if (isset($job_applications[$application_index])) {
            $job_applications[$application_index]['status'] = $new_status;
            $wpdb->update(
                $table_name,
                array('job_applications' => serialize($job_applications)),
                array('id' => $user_id)
            );
            $user->job_applications = serialize($job_applications); // Update user object to reflect changes

            // Send email notification based on the new status
            if ($new_status === 'Approved') {
                send_applicant_approved_email($user->email, $user->first_name, $user->last_name, $job_applications[$application_index]['job_title']);
            } elseif ($new_status === 'Rejected') {
                send_applicant_rejected_email($user->email, $user->first_name, $user->last_name, $job_applications[$application_index]['job_title']);
            } 
        }
    }

    $job_applications = unserialize($user->job_applications) ?: [];
    $applications_per_page = 10;
    $total_applications = count($job_applications);
    $total_pages = ceil($total_applications / $applications_per_page); 

    // Determine the current page
    $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $offset = ($current_page - 1) * $applications_per_page;

    // Limit job applications for the current page
    $paged_job_applications = array_slice($job_applications, $offset, $applications_per_page);

    echo '<div class="wrap">';
    echo '<div class="userWrap">';
    echo '<h1>Applicant ID - '. esc_html($user_id) . '</h1>';
    echo '<div class="userWrap_info">';
    echo '<h2>Applicant Details</h2>';
    echo '<div class="userWrapBoxWrap">';
    echo '<div class="userInfobox"><div class="userInfoboxInner"><div class="userInfoboxIcon"><i class="fa fa-id-card" aria-hidden="true"></i></div><div class="userInfoCont"><div class="userInfobox_lft"><strong>Name</strong></div><div class="userInfobox_rght">' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '</div></div></div></div>';
    echo '<div class="userInfobox"><div class="userInfoboxInner"><div class="userInfoboxIcon"><i class="fa fa-user" aria-hidden="true"></i></div><div class="userInfoCont"><div class="userInfobox_lft"><strong>UserName</strong></div><div class="userInfobox_rght">' . esc_html($user->username) . '</div></div></div></div>';
    echo '<div class="userInfobox"><div class="userInfoboxInner"><div class="userInfoboxIcon"><i class="fa fa-envelope" aria-hidden="true"></i></div><div class="userInfoCont"><div class="userInfobox_lft"><strong>Email</strong></div><div class="userInfobox_rght">' . esc_html($user->email) . '</div></div></div></div>'; 
    echo '</div>'; 
    echo '</div>';
    echo '</div>';

    if (!empty($paged_job_applications)) {
        echo '<h3>Job Applications</h3>';
        echo '<table class="widefat fixed" cellspacing="0">';
        echo '<thead><tr><th style="width: 25px">ID</th><th>Job Title</th><th>Job Location</th><th>Status</th><th>Resume</th><th>Date/time</th><th>Action</th></tr></thead>';
        echo '<tbody>';

        $counter = 1 + $offset;
        foreach ($paged_job_applications as $index => $application) {
            $job_id = isset($application['job_id']) ? $application['job_id'] : 'N/A'; 
            $job_title = isset($application['job_title']) ? $application['job_title'] : 'N/A';
            $job_date = isset($application['submission_date']) ? $application['submission_date'] : 'N/A';

            $job_location = 'N/A';
            if ($job_id !== 'N/A') {
                $job_locations = get_the_terms($job_id, 'jobs_job_locations');
                if ($job_locations && !is_wp_error($job_locations)) {
                    $job_location = join(', ', wp_list_pluck($job_locations, 'name'));
                }
            }

            echo '<tr>';
            echo '<td style="width: 25px">' . esc_html($counter) . '</td>';
            echo '<td>' . esc_html($job_title) . '</td>';
            echo '<td>' . esc_html($job_location) . '</td>';
            echo '<td>' . esc_html(isset($application['status']) ? $application['status'] : 'N/A') . '</td>';
            echo '<td>';
            if (isset($application['resume_url'])) {  
                $upload_dir = wp_upload_dir();
                $full_resume_url = $upload_dir['baseurl'] . '/jobseekers-assets' . '/' . $application['resume_url'];
                echo '<a href="' . esc_url($full_resume_url) . '" target="_blank">View Resume</a>';
            } else {
                echo 'N/A';
            }
            echo '</td>'; 
            echo '<td>' . esc_html($job_date) . '</td>';
            echo '<td><a href="' . admin_url('admin.php?page=jobseekers-detailed&user_id=' . $user_id . '&application_index=' . $index) . '" class="button button-primary">View Details</a></td>'; 
            echo '</tr>';
            $counter++; 
        }

        echo '</tbody></table>';

        echo common_pagination($current_page, $total_applications, $total_pages, admin_url('admin.php?page=view-jobseeker&user_id=' . $user_id));
    } else {
        echo '<p>No job applications found for this user.</p>';
    }

    echo '</div>';

    ?>
    <!-- Bootstrap Modal -->
    <div id="statusModal" class="statusModal" style="display:none;">
        <div class="statusModal_table">
            <div class="statusModal_tableCell">
                <div class="statusModal_containerWrap">
                    <div class="statusModal_container">
                        <div class="statusModal_close">
                            <a href="javascript:void(0)" class="statusModalClose">X</a>
                        </div>
                        <div class="statusModal_heading">
                            <h2> Update Application Status </h2>
                        </div>
                        <form method="post" id="statusForm">
                            <input type="hidden" name="application_index" id="modal_application_index">
                            <label for="status">Status</label>
                            <select name="status" id="modal_status"> 
                                <option value="Applied">Applied</option>
                                <option value="Being Reviewed">Being Reviewed</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Approved">Approved</option>
                            </select>
                            <input type="submit" name="update_application_status" value="Update Status" class="button">
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>  

<?php ob_end_flush(); }