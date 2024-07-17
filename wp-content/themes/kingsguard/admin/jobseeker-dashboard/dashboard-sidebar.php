<div class="dashboardSidebar">
    <div class="dashboardLogo">
        <a href="<?php echo esc_url(get_home_url()); ?>" aria-label="Click here" target="_self">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/white-logo-kingsguard.svg" alt="Kingsguard Logo">
        </a>
    </div>
    <div class="dashboard_profileMenu">
        <?php echo do_shortcode('[jobseekers_user_menu]') ?> 
    </div>
    <div class="dashboardOptions">
        <ul class="dashboardMenu">
            <li>
                <a href="/jobseekers-dashboard/" class="dashboardListItem" data-view="dashboard">
                    <div class="dashboardListIcon">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </div>
                    <div class="dashboardListText">
                        Dashboard
                    </div>
                </a>
            </li>
            <li>
                <a href="/jobseekers-careers/" class="dashboardListItem" data-view="jobs">
                    <div class="dashboardListIcon">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                    </div>
                    <div class="dashboardListText"> Jobs </div>
                </a> 
            </li>
            <li>
                <a href="/jobseekers-applications/" class="dashboardListItem" data-view="applications">
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
    <div class="dashboardCollapse">
        <button type="button" class="dashboardCollapseBtn">
            <span class="dashboardCollapseIcon"><i class="fa fa-caret-left" aria-hidden="true"></i></span>
            <span class="dashboardCollapseCont">Collapse menu</span>
        </button>
    </div>
</div>

<script>
jQuery(document).ready(function () {
    jQuery(document).on("click", ".dashboardCollapseBtn", function() {
        jQuery(".dashboardSidebar").toggleClass("collapsed");
        jQuery("body").toggleClass("sidebar_collapsed");
    });
});
</script>