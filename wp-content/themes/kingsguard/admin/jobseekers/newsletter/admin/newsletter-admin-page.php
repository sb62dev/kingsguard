<?php   

function newsletter_admin_menu() {
    add_menu_page(
        'Newsletter Entries',
        'Newsletter Entries',
        'read',
        'newsletter-entries',
        'newsletter_admin_page',
        'dashicons-welcome-learn-more',
        20
    );  
}

add_action('admin_menu', 'newsletter_admin_menu');

// Applicants Archive File
include('newsletter-archive.php'); 

?> 