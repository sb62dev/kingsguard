<?php   

function quote_admin_menu() {
    add_menu_page(
        'Quote Applications',
        'Quote Applications',
        'read',
        'quote-applications',
        'contact_admin_page',
        'dashicons-welcome-learn-more',
        20
    ); 
    add_submenu_page(
        null,
        'View Quote Applications',
        'View Quote Applications',
        'read',
        'view-quote-applications',
        'view_quote_page'
    );
}

add_action('admin_menu', 'quote_admin_menu');

// Applicants Archive File
include('contact-archive.php');

// Applicants Single File
include('contact-single.php'); 

// // Applicants Email File
// include('contact-email.php'); 