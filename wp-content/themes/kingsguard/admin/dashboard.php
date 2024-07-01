<?php
/**
 * Template Name: Dashboard
**/

get_header();

// Ensure the user is logged in and is an admin
if (!is_user_logged_in() || !current_user_can('administrator')) {
    wp_redirect(home_url());
    exit;
}
?>

<style>
.headerTopBar,
header.main_header.header.sticky-header {
    display: none;
}
</style>

<div class="dashboardWrapper">
    <div class="dashboardSidebar">
        <div class="dashboardLogo">
            <a href="<?php echo esc_url(get_home_url()); ?>" aria-label="Click here" target="_self">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/white-logo-kingsguard.svg" alt="Kingsguard Logo">
            </a>
        </div>
        <div class="dashboardProfile">
            <div class="dashboardProfileCont">
                <div class="dashboardProfileImg">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/Profile.svg" alt="Profile Icon">
                </div>
                <div class="dashboardProfileName">
                    <div class="dashboardProfileNm">
                        Shijra Hassan
                    </div>
                    <div class="dashboardProfileEmail">
                        Shijra451170@gmail.com
                    </div>
                </div>
            </div>
            <div class="dashboardProfileArrow">
                <a href="#" class="dashboardProfileBtn">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="dashboardOptions">
            <ul class="dashboardMenu">
                <li class="active">
                    <a href="#" class="dashboardListItem" data-view="dashboard">
                        <div class="dashboardListIcon">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </div>
                        <div class="dashboardListText">
                            Dashboard
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="dashboardListItem" data-view="jobs">
                        <div class="dashboardListIcon">
                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                        </div>
                        <div class="dashboardListText">
                            Jobs
                        </div>
                    </a>
                    <ul class="dashboardSubmenu">
                        <li><a href="#" class="job-menu-item" data-view="all-jobs">All Jobs</a></li>
                        <li><a href="#" class="job-menu-item" data-view="add-new-job">Add New</a></li>
                        <li><a href="#" class="job-menu-item" data-view="job-categories">Job Categories</a></li>
                        <li><a href="#" class="job-menu-item" data-view="job-types">Job Types</a></li>
                        <li><a href="#" class="job-menu-item" data-view="job-locations">Job Locations</a></li>
                        <li><a href="#" class="job-menu-item" data-view="job-tags">Job Tags</a></li>
                        <li><a href="#" class="job-menu-item" data-view="applications">Applications</a></li>
                        <li><a href="#" class="job-menu-item" data-view="settings">Settings</a></li>
                        <li><a href="#" class="job-menu-item" data-view="wizard">Wizard</a></li>
                        <li><a href="#" class="job-menu-item" data-view="add-ons">Add-ons</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dashboardListItem" data-view="applications">
                        <div class="dashboardListIcon">
                            <i class="fa fa-server" aria-hidden="true"></i>
                        </div>
                        <div class="dashboardListText">
                            Applications
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="dashboardContent">
        <div class="dashboardHead">
            <div class="dashboardSearchBox">
                <form action="/action_page.php">
                    <div class="searchGroup">
                        <input type="text" placeholder="Search" name="search">
                        <button type="submit" class="searchBtn"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="dashboardNotifications">
                <a href="#" class="dashboardNotificationBtn">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    <span class="dashboardNotificationDot"></span>
                </a>
            </div>
        </div>
        <div id="dashboard-content">
            <!-- Content will be loaded here based on the menu item clicked -->
        </div>
    </div>
</div>

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.job-menu-item');
    const contentDiv = document.getElementById('dashboard-content');

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const view = e.target.getAttribute('data-view');

            // Use AJAX to load the content
            fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=load_dashboard_content&view=${view}`)
                .then(response => response.text())
                .then(data => {
                    contentDiv.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching the content:', error);
                });
        });
    });
});
</script>
