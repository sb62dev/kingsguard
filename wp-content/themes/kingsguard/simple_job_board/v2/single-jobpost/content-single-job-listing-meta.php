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
 * @since       2.3.0   Added "sjb_job_meta_template" filter.
 * @since       2.4.0   Revised whole HTML template
 */
ob_start();
global $post;

/**
 * Fires on job detail page before comapny meta  
 *                   
 * @since   2.1.0                   
 */
do_action('single_job_listing_meta_before');
?>

<!-- Start Company Meta
================================================== -->
<div class="header-margin-top sjb-job-info">
    <div class="sjb-company-wrapper-details">
        <div class="row">
            <?php 
            /**
             * Template -> Company Logo:
             * 
             * - Display Company Logo.
             */
            get_simple_job_board_template('single-jobpost/job-meta/company-logo.php'); 
            /**
             * Template -> Company Name:
             * 
             * - Display Company Name.
             */
            get_simple_job_board_template('single-jobpost/job-meta/company-name.php');

            ?>
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
do_action('single_job_listing_meta_after');

$html_job_meta = ob_get_clean();

/**
 * Modify the Job Meta Template. 
 *                                       
 * @since   2.3.0
 * 
 * @param   html    $html_job_meta   Job Meta HTML.                   
 */
echo apply_filters('sjb_job_meta_template', $html_job_meta);
