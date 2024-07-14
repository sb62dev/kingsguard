jQuery(document).ready(function($) {
    // Rename WPForms menu item to 'Form Entries'
    $('#toplevel_page_wpforms-overview .wp-menu-name').text('Form Entries');

    // Remove unnecessary submenus under 'Form Entries'
    $('#toplevel_page_wpforms-overview .wp-submenu, #wpforms-flyout, #wpfooter, #wpforms-header, .wpforms-overview-chart, #wpforms-entries-list .wp-list-table .column-actions .edit').remove(); 
    $('tr.user-rich-editing-wrap, tr.user-admin-color-wrap, tr.user-comment-shortcuts-wrap, tr.show-admin-bar.user-admin-bar-front-wrap, tr.user-language-wrap, tr.user-role-wrap, .profile-php div#contextual-help-link-wrap').remove(); 

    var logoUrl = '<?php echo get_template_directory_uri(); ?>/assets/images/blue-logo-kings.png';
    $('#toplevel_page_logo_based_menu').css({
        'background-image': 'url(' + logoUrl + ')',
        'background-repeat': 'no-repeat',
        'background-position': 'center'
    });

    $('#toplevel_page_logo_based_menu > a, #toplevel_page_logo_based_menu > a > div.wp-menu-image').css('display', 'none');
});
