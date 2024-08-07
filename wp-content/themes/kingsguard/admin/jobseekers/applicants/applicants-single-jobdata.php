<?php  

function jobseekers_detailed_page() {
    if (!isset($_GET['user_id']) || !isset($_GET['application_index'])) {
        echo '<div class="wrap"><h1>No data found</h1></div>';
        return;
    }

    $user_id = intval($_GET['user_id']);
    $application_index = intval($_GET['application_index']);
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
    if (!isset($job_applications[$application_index])) {
        echo '<div class="wrap"><h1>Application not found</h1></div>';
        return;
    } 

    $application = $job_applications[$application_index]; 

    echo '<div class="wrap">';
    echo '<div class="userWrap">';
    echo '<h1>Applicant detailed view for Job Application - ' . esc_html($application['job_title']) .  '</h1>';
    echo '<div class="userWrap_info">';
    echo '<h2>Applicant Details</h2>';
    echo '<div class="userWrapBoxWrap">';
    echo '<div class="userInfobox"><div class="userInfoboxInner"><div class="userInfoboxIcon"><i class="fa fa-id-card" aria-hidden="true"></i></div><div class="userInfoCont"><div class="userInfobox_lft"><strong>Name</strong></div><div class="userInfobox_rght">' . esc_html($user->first_name) . ' ' . esc_html($user->last_name) . '</div></div></div></div>';
    echo '<div class="userInfobox"><div class="userInfoboxInner"><div class="userInfoboxIcon"><i class="fa fa-user" aria-hidden="true"></i></div><div class="userInfoCont"><div class="userInfobox_lft"><strong>UserName</strong></div><div class="userInfobox_rght">' . esc_html($user->username) . '</div></div></div></div>';
    echo '<div class="userInfobox"><div class="userInfoboxInner"><div class="userInfoboxIcon"><i class="fa fa-envelope" aria-hidden="true"></i></div><div class="userInfoCont"><div class="userInfobox_lft"><strong>Email</strong></div><div class="userInfobox_rght">' . esc_html($user->email) . '</div></div></div></div>'; 
    echo '</div>'; 
    echo '</div>';
    echo '</div>';

    echo '<div class="wrap">';
    echo '<h2>More Info:</h2>';
    echo '<table class="form-table">';
    echo '<tr><th>Job Title:</th><td>' . esc_html($application['job_title']) . '</td></tr>';
    echo '<tr><th>Job Location:</th><td>' . esc_html($application['job_location'] ?? 'N/A') . '</td></tr>';
    echo '<tr><th>Phone Number:</th><td>' . esc_html($application['phone']) . '</td></tr>'; 
    echo '<tr><th>Cover Letter:</th><td>' . esc_html($application['coverletter']) . '</td></tr>';
    echo '<tr><th>Security Guard License:</th><td>' . esc_html($application['license']) . '</td></tr>';
    echo '<tr><th>License Expiry Date:</th><td>' . esc_html($application['expiry_date']) . '</td></tr>';
    echo '<tr><th>Current Application Status:</th><td>' . esc_html($application['status']) . '</td></tr>';
    echo '<tr><th>Resume:</th><td>'; 
    if (isset($application['resume_url']) && !empty($application['resume_url'])) {
        $upload_dir = wp_upload_dir();
        $full_resume_url = $upload_dir['baseurl'] . '/jobseekers-assets/' . $application['resume_url'];
        echo '<a href="' . esc_url($full_resume_url) . '" target="_blank">View</a>';
    } else {
        echo 'N/A';
    }
    echo '</td></tr>';
    echo '<tr><th>License Copy:</th><td>';
    if (isset($application['license_url']) && !empty($application['license_url'])) { 
        $upload_dir = wp_upload_dir();
        $full_resume_url = $upload_dir['baseurl'] . '/jobseekers-assets/' . $application['license_url'];
        echo '<a href="' . esc_url($full_resume_url) . '" target="_blank">View</a>';
    } else {
        echo 'N/A';
    }
    echo '</td></tr>';
    echo '<tr><th>CPR and First Aid Copy:</th><td>';
    if (isset($application['cpr_url']) && !empty($application['cpr_url'])) {  
        $upload_dir = wp_upload_dir();
        $full_resume_url = $upload_dir['baseurl'] . '/jobseekers-assets/' . $application['cpr_url'];
        echo '<a href="' . esc_url($full_resume_url) . '" target="_blank">View</a>';
    } else {
        echo 'N/A';
    }
    echo '</td></tr>';
    echo '<tr><th>Smart Serve License Copy:</th><td>';
    if (isset($application['smartserve_url']) && !empty($application['smartserve_url'])) {   
        $upload_dir = wp_upload_dir();
        $full_resume_url = $upload_dir['baseurl'] . '/jobseekers-assets/' . $application['smartserve_url'];
        echo '<a href="' . esc_url($full_resume_url) . '" target="_blank">View</a>';
    } else {
        echo 'N/A';
    }
    echo '</td></tr>';
    echo '<tr><th>Use of Force Training Certification Copy:</th><td>';
    if (isset($application['force_training_url']) && !empty($application['force_training_url'])) {   
        $upload_dir = wp_upload_dir();
        $full_resume_url = $upload_dir['baseurl'] . '/jobseekers-assets/' . $application['force_training_url'];
        echo '<a href="' . esc_url($full_resume_url) . '" target="_blank">View</a>';
    } else {
        echo 'N/A';
    }
    echo '</td></tr>';
    echo '<tr><th>Submission Date:</th><td>' . esc_html($application['submission_date']) . '</td></tr>';
    echo '<tr><th>Update Application Status:</th><td>';
    echo '<button type="button" class="button open-modal" data-index="' . esc_attr($index) . '" data-status="' . esc_attr(isset($application['status']) ? $application['status'] : '') . '">Update Status</button>';
    echo '</td></tr>'; 
    echo '</table>';
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
    
<?php }  ?>  