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
    }
}
add_action('admin_menu', 'remove_menus_for_edituser_role', 999);

function remove_admin_bar_items_for_editsuser_role() {
    // Get current user
    $user = wp_get_current_user();
    
    // Check if the current user has the 'kingsuser_role' role
    if (in_array('editor', (array) $user->roles)) {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');   // Comments
        $wp_admin_bar->remove_menu('new-content'); // New (from New Content)
    }
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_items_for_editsuser_role');

function modify_wpforms_menu_for_edituser_role() {
    $user = wp_get_current_user();
    if (in_array('editor', (array) $user->roles)) {
        global $submenu;

        // Change the main WPForms menu name to 'Form Entries'
        foreach ($submenu as $key => $item) {
            foreach ($item as $index => $subitem) {
                if ($subitem[2] === 'wpforms-overview') {
                    $submenu[$key][$index][0] = 'Form Entries';
                }
            }
        }
    }
}

function remove_wpforms_submenus_for_edituser_role() {
    $user = wp_get_current_user();

    if (in_array('editor', (array) $user->roles)) {
        remove_submenu_page('wpforms-overview', 'wpforms-overview'); // Overview
        remove_submenu_page('wpforms-overview', 'wpforms-templates'); // Templates
        remove_submenu_page('wpforms-overview', 'wpforms-tools'); // Tools
        remove_submenu_page('wpforms-overview', 'wpforms-about'); // About
        remove_submenu_page('wpforms-overview', 'wpforms-builder'); // Main
    }
}

add_action('admin_menu', 'modify_wpforms_menu_for_edituser_role', 999);
add_action('admin_menu', 'remove_wpforms_submenus_for_edituser_role', 999);

?>