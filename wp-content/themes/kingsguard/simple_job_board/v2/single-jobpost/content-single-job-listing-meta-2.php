<?php

/**
 * Single view Job Meta Box
 *
 * Override this template by copying it to yourtheme/simple_job_board/v2/single-jobpost/content-single-job-listing-meta.php
 * 
 * Hooked into single_job_listing_start priority 20
 * 
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/Templates
 * @version     2.0.0
 * @since       2.0.0
 * @since       2.3.0   Added "sjb_job_meta_2_template" filter.
 * @since       2.4.0   Revised whole HTML template
 */
ob_start();
global $post;

/**
 * Fires on job detail page before comapny meta  
 *                   
 * @since   2.1.0                   
 */
do_action('single_job_listing_meta_2_before');
?>

<!-- Start Company Meta
================================================== -->
<div class="sjb-job-characteristicsWrap">
    <div class="sjb-job-characteristics">
        <div class="sjb-job-type-location-date">
            <div class="row"> 
            <?php  
                /**
                 * Fires before type, location, date displayed
                 * 
                 * @since 2.10.1
                */
                do_action('sjb_single_job_type_location_date_before'); 

                /**
                 * Template -> Job Type:
                 * 
                 * - Display Job Type.
                 */
                get_simple_job_board_template('single-jobpost/job-meta/job-type.php');

                /**
                 * Template -> Job Location:
                 * 
                 * - Display Job Location.
                 */
                get_simple_job_board_template('single-jobpost/job-meta/job-location.php');

                /**
                 * Template -> Job Posted Date:
                 * 
                 * - Display Job Posted Date.
                 */
                get_simple_job_board_template('single-jobpost/job-meta/job-posted-date.php'); 
                /**
                 * Fires after type, location, date displayed
                 * 
                 * @since 2.10.1
                */
                do_action('sjb_single_job_type_location_date_after'); ?>
            </div> 
        </div> 
    </div>
</div>
<!-- ==================================================
End Company Meta -->

<?php
/**
 * Fires on job detail page after comapny meta  
 *                   
 * @since   2.1.0                   
 */
do_action('single_job_listing_meta_2_after');

$html_job_meta = ob_get_clean();

/**
 * Modify the Job Meta Template. 
 *                                       
 * @since   2.3.0
 * 
 * @param   html    $html_job_meta   Job Meta HTML.                   
 */
echo apply_filters('sjb_job_meta_2_template', $html_job_meta);
