<?php 

function add_wpforms_capabilities_to_existing_roles() {
    $role = get_role('editor');
    if ($role) {
        $role->add_cap('wpforms_view_entries');
        $role->add_cap('wpforms_manage_entries');
        $role->add_cap('wpforms_create_forms');
        $role->add_cap('wpforms_edit_forms');
        $role->add_cap('wpforms_delete_forms');
        $role->add_cap('wpforms_view_settings');
        $role->add_cap('wpforms_view_tools');
    }
}
add_action('admin_init', 'add_wpforms_capabilities_to_existing_roles'); 

function remove_menus_for_edituser_role() {
    // Get current user
    $user = wp_get_current_user();
    
    // Check if the current user has the 'kingsuser_role' role
    if (in_array('editor', (array) $user->roles)) {
        remove_menu_page('tools.php');      // Tools
        remove_menu_page('edit-comments.php'); // Comments
        remove_menu_page('profile.php');
    }
}
add_action('admin_menu', 'remove_menus_for_edituser_role', 999);

function remove_admin_bar_items_for_editsuser_role() {
    // Get current user
    $user = wp_get_current_user();
     
    if (in_array('editor', (array) $user->roles)) {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');   // Comments
        $wp_admin_bar->remove_menu('new-content'); // New (from New Content) 
        $wp_admin_bar->remove_menu('edit-profile'); // Remove the profile link
        $wp_admin_bar->remove_menu('user-info'); // Remove the user info menu
    }
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_items_for_editsuser_role');  

function redirect_editor_from_profile_page() {
    // Get current user
    $user = wp_get_current_user();
    
    // Check if the current user has the 'editor' role and is trying to access profile.php
    global $pagenow;
    if (in_array('editor', (array) $user->roles) && $pagenow === 'profile.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'redirect_editor_from_profile_page');   

function remove_menus_for_specific_user() {
    // Get current user
    $user = wp_get_current_user();
    
    // Check if the current user's username matches the specified username
    if ($user->user_login === 'kingsadmin') {
        remove_menu_page('edit.php'); 
        remove_menu_page('edit.php?post_type=page'); 
        remove_menu_page('edit.php?post_type=services'); 
        remove_menu_page('edit.php?post_type=projects'); 
        remove_menu_page('edit.php?post_type=industries'); 
        remove_menu_page('edit.php?post_type=general_settings'); 
        remove_menu_page('upload.php');   
    }
}
add_action('admin_menu', 'remove_menus_for_specific_user', 999);

function remove_admin_bar_items_for_specific_user() {
    // Get current user
    $user = wp_get_current_user();
    
    // Check if the current user's username matches the specified username
    if ($user->user_login === 'kingsadmin') {
        global $wp_admin_bar;    
        $wp_admin_bar->remove_menu('new-post'); // New Post
        $wp_admin_bar->remove_menu('new-media'); // New Media
    }
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_items_for_specific_user');  

function enqueue_admin_menu_hiding_script() {
    // Get current user
    $user = wp_get_current_user();

    // Check if the current user's username matches the specified username
    if ($user->user_login === 'kingsadmineditor') {
        // Enqueue script to hide admin menu items
        add_action('admin_footer', 'hide_admin_menu_items_script');
    }
}
add_action('admin_menu', 'enqueue_admin_menu_hiding_script');

function hide_admin_menu_items_script() {
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Hide specific admin menu items
            var menuItems = [
                '#menu-posts-careers',
                '#toplevel_page_newsletter-entries',
                '#toplevel_page_jobseekers-job-applications',
                '#toplevel_page_quote-applications'
            ];

            menuItems.forEach(function(selector) {
                var element = document.querySelector(selector);
                if (element) {
                    element.style.display = 'none';
                }
            });
        });
    </script> 
    <?php
} 



?>