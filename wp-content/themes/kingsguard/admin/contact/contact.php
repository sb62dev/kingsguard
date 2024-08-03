<?php
 
function create_contact_form_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form_users';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        contact_fname varchar(100) DEFAULT '',
        contact_lname varchar(100) DEFAULT '',
        contact_title varchar(255) DEFAULT '',
        phone_number varchar(20) DEFAULT '',  
        contact_services varchar(255) DEFAULT '', 
        contact_security_services text DEFAULT NULL,
        contact_parking_services text DEFAULT NULL,
        contact_site_types varchar(100) DEFAULT '', 
        contact_length_cover varchar(100) DEFAULT '',
        contact_add_info longtext DEFAULT NULL,
        contact_consent varchar(10) DEFAULT 'No',
        submission_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql); 
}

add_action('after_setup_theme', 'create_contact_form_table');

function contact_users_table(){
    global $wpdb;
    return $wpdb->prefix . 'contact_form_users';
}

// Register Form File
include('form.php');

// Register Form Handler File
include('form-handler.php');

// Register Email File
include('email.php');

?>