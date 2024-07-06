<?php
/**
 * Template Name: Dashboard
**/

if ( !isset($_COOKIE['jobseeker_logged_in']) || $_COOKIE['jobseeker_logged_in'] !== 'true' ) {
    wp_redirect('/login');
    exit;
}

get_header(); 

?> 

<div class="dashboardWrapper">
    <?php include('dashboard-sidebar.php') ?> 
    <div class="dashboardContent">
        <?php include('dashboard-header.php') ?> 
        <div id="dashboard-content">
            <section class="careersPage pb100"> 
                <div class="job-listings">
                    <?php get_template_part('simple_job_board/archive-jobpost'); ?>    
                </div>  
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?> 