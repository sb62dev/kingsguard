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
    $table_name = $wpdb->prefix . 'jobseekers_users';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        username varchar(50) NOT NULL,
        email varchar(100) NOT NULL,
        password varchar(255) NOT NULL,
        role varchar(50) NOT NULL,
        first_name varchar(100) DEFAULT '',
        last_name varchar(100) DEFAULT '', 
        email_verified tinyint(1) DEFAULT 0,
        verification_token varchar(255) DEFAULT '',
        reset_key varchar(255) DEFAULT NULL,
        reset_requested_at datetime DEFAULT NULL,
        user_info longtext DEFAULT NULL,
        job_applications longtext DEFAULT NULL,
        submission_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql); 

} 

add_action('after_setup_theme', 'create_jobseekers_table');

function create_newsletter_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_users';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT, 
        email varchar(100) NOT NULL, 
        submission_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql); 
}

add_action('after_setup_theme', 'create_newsletter_table');


?>