<?php   

function jobseekers_admin_menu() {
    add_menu_page(
        'Job Applications',
        'Job Applications',
        'read',
        'jobseekers-job-applications',
        'jobseekers_admin_page',
        'dashicons-welcome-learn-more',
        20
    ); 
    add_submenu_page(
        null,
        'View Applicant',
        'View Applicant',
        'read',
        'view-jobseeker',
        'view_jobseeker_page'
    );
}

add_action('admin_menu', 'jobseekers_admin_menu');

// Applicants Archive File
include('applicants-archive.php');

// Applicants Single File
include('applicants-single.php'); 

// Applicants Email File
include('applicants-email.php'); 

?> 