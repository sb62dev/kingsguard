<?php

/**
 * The template for displaying all single job posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?> 
        <?php if ( isset( $_COOKIE['jobseeker_logged_in'] ) && $_COOKIE['jobseeker_logged_in'] === 'true' ) : ?> 
            <div class="dashboardWrapper">
                <?php include('admin/jobseeker-dashboard/dashboard-sidebar.php') ?> 
                <div class="dashboardContent">
                    <?php include('admin/jobseeker-dashboard/dashboard-header.php') ?>  
                    <div id="dashboard-content" class="dashboard-main">
                        <div class="jobSingle-dashpost">  
                            <?php include('admin/jobseeker-dashboard/single-jobs-content.php') ?> 
                            <div class="single_appliForm_wrap" id="applicationform">
                                <?php echo do_shortcode('[job_application_form]') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        <?php else : ?>
            <div class="pageBody"> 
                <div class="jobSingle-post">  
                    <div class="sm_container">
                        <?php include('admin/jobseeker-dashboard/single-jobs-content.php') ?>   
                    </div>
                    <?php get_template_part('template-parts/trainingsection'); ?> 
                </div>
            </div>
        <?php endif; ?> 
    <?php endwhile;
endif;

get_footer();