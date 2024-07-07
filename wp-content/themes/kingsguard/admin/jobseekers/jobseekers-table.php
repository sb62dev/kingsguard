<?php  

function create_custom_jobseeker_role() {
    add_role(
        'jobseeker',
        __( 'Job Seeker' ),
        array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
        )
    );
}

add_action('after_setup_theme', 'create_custom_jobseeker_role');

function create_jobseekers_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_jobseekers';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        username varchar(50) NOT NULL,
        email varchar(100) NOT NULL,
        password varchar(255) NOT NULL,
        role varchar(50) NOT NULL,
        first_name varchar(100) DEFAULT '',
        last_name varchar(100) DEFAULT '',
        profile_pic varchar(255) DEFAULT '',
        resume varchar(255) DEFAULT '',
        education_qualification text DEFAULT '',
        past_experience text DEFAULT '',
        current_company varchar(255) DEFAULT '',
        email_verified tinyint(1) DEFAULT 0,
        verification_token varchar(255) DEFAULT '',
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action('after_setup_theme', 'create_jobseekers_table');

function create_job_applications_table() {
    global $wpdb;
    $jobseekers_table = $wpdb->prefix . 'custom_jobseekers';
    $applications_table = $wpdb->prefix . 'custom_job_applications';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $applications_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        jobseeker_id mediumint(9) NOT NULL,
        job_id mediumint(9) NOT NULL,
        application_data text NOT NULL,
        submission_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        FOREIGN KEY (jobseeker_id) REFERENCES $jobseekers_table(id) ON DELETE CASCADE,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action('after_setup_theme', 'create_job_applications_table');

?>