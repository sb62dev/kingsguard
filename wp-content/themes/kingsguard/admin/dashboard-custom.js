jQuery(document).ready(function($) {
    // Rename WPForms menu item to 'Form Entries'
    $('#toplevel_page_wpforms-overview .wp-menu-name').text('Form Entries');

    // Remove unnecessary submenus under 'Form Entries'
    $('#toplevel_page_wpforms-overview .wp-submenu, #wpforms-flyout, #wpfooter, #wpforms-header, .wpforms-overview-chart, #wpforms-entries-list .wp-list-table .column-actions .edit').remove(); 
    $('tr.user-rich-editing-wrap, tr.user-admin-color-wrap, tr.user-comment-shortcuts-wrap, tr.show-admin-bar.user-admin-bar-front-wrap, tr.user-language-wrap, tr.user-role-wrap, .profile-php div#contextual-help-link-wrap').remove(); 
});
