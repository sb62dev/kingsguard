<?php
/**
 * Template Name: Jobseekers Dashboard
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
            <section class="careersPage pb100 dashboardInner"> 
                <div class="dashboard-container">
                    <div class="profileInfo-wrap">
                        <?php 
                            if ( isset( $_COOKIE['jobseeker_logged_in'] ) && $_COOKIE['jobseeker_logged_in'] === 'true' ) {
                                global $wpdb;
                                $username = isset( $_COOKIE['jobseeker_username'] ) ? esc_html( $_COOKIE['jobseeker_username'] ) : '';
                                if ( $username ) { 
                                    $user = $wpdb->get_row( $wpdb->prepare(
                                        "SELECT first_name, email FROM {$wpdb->prefix}jobseekers_users WHERE username = %s",
                                        $username
                                    ));
                            
                                    if ( $user ) { 
                                        ?>
                                            <h1> Welcome <?php echo esc_html( $user->first_name ); ?>! </h1>
                                        <?php
                                    } else {
                                        ?>
                                            <h1> Welcome! </h1>
                                        <?php
                                    }
                                } else {
                                    ?>
                                        <h1> Welcome! </h1>
                                    <?php
                                }
                            } else { 
                                ?>
                                    <h1> Welcome! </h1>
                                <?php
                            }
                        ?> 
                        <p> View all job postings and applications </p>
                    </div>
                    <div class="job-applications-wrap">
                        <div class="job-applications-header">
                            <div class="row">
                            <div class="col-md-6">
                                    <h3> My Applications </h3>
                            </div>
                            <div class="col-md-6 text-right">
                                    <a href="javascript:void(0);" class="viewAllLink"> View All </a> 
                            </div>
                            </div>  
                        </div>
                        <div class="job-listings">
                            <div class="appli-listings">
                                <?php echo do_shortcode('[user_submitted_jobs count="1"]') ?> 
                            </div>   
                        </div>  
                    </div> 
                    <div class="job-listings-wrap">
                        <div class="job-listings-header">
                            <div class="row">
                            <div class="col-md-6">
                                    <h3> Jobs Available </h3>
                            </div> 
                            <div class="col-md-6 text-right">
                                    <a href="/jobseekers-careers/" class="viewAllLink"> View All </a> 
                            </div>
                            </div>  
                        </div>
                        <div class="jobListingWrapper"> 
                            <?php include('jobseeker-dashboard/dashboard-home-careers.php') ?> 
                        </div>
                    </div> 
                </div>
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?> 