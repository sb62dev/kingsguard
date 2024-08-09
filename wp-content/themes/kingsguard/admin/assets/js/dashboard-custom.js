jQuery(document).ready(function($) {
    // Wait for the DOM to be ready
    // Select the first sidebar menu (assuming it's the main navigation)
    var $sidebarMenu = $('#adminmenu');

    var username = AdminData.editorusername;

    // Create your list item with the image
    var listItem = '<li class="my-custom-logo">'
                 + '<a href="https://kingsguard.ca/" target="_self" aria-label="Click here to go to Homepage"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/assets/images/white-logo-kingsguard.svg" alt="Kingsguard Logo"></a>'
                 + '<div class="custom-logo_btmUser"> Welcome, ' + username + ' </div>';
                 + '</li>';

    // Add the new list item to the beginning of the sidebar menu
    $sidebarMenu.prepend(listItem);

    $('#wp-admin-bar-root-default').hide();
});