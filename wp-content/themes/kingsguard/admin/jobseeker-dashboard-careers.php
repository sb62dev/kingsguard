<?php
/**
 * Template Name: Jobseekers Dashboard Careers
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
            <section class="dash_careersPage dashboardInner pb100">   
                <div class="dash_job-listings-wrap">
                    <div class="dash_job-listings-header">
                        <h1> Jobs Available </h1>
                    </div>
                    <div class="jobListingWrapper"> 
                        <?php include('jobseeker-dashboard/dashboard-careers-archive.php') ?>  
                    </div>
                </div> 
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?> 