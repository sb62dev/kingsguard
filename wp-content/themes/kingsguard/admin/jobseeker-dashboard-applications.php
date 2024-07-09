<?php
/**
 * Template Name: Jobseekers Dashboard Applications
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
            <section class="dash_appliPage pb100">   
                <div class="dash_appli-listings-wrap">
                    <div class="dash_appli-listings-header">
                        <h1> My Applications </h1>
                    </div>
                    <div class="dash_appli-listings-wrap">  
                        <div class="appli-listings">
                            <?php echo do_shortcode('[user_submitted_jobs]') ?> 
                        </div>   
                    </div>
                </div> 
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?> 