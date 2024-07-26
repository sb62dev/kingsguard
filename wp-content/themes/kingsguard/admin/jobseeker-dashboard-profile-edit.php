<?php
/**
 * Template Name: Jobseekers User Profile Edit
**/

if ( !isset($_COOKIE['jobseeker_logged_in']) || $_COOKIE['jobseeker_logged_in'] !== 'true' ) {
    wp_redirect('/jobseekers-login');
    exit;
}

get_header();  

?> 

<div class="dashboardWrapper">
    <?php include('jobseeker-dashboard/dashboard-sidebar.php') ?> 
    <div class="dashboardContent">
        <?php include('jobseeker-dashboard/dashboard-header.php') ?> 
        <div id="dashboard-content" class="dashboard-main">
            <section class="dash_profilePage dashboardInner pb100">   
                <div class="dash_profilePage-wrap">
                    <div class="dash_profilePage-header">
                        <h1 class="h2"> Edit Profile Information </h1>
                    </div>
                    <div class="dash_profilePage-editformWrapper"> 
                        <?php echo do_shortcode('[jobseekers_profile_form]') ?>
                    </div>
                </div> 
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?> 