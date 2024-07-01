<?php
/**
 * Single view Job Fetures
 * 
 * The template for displaying job content in the single-jobpost.php template
 * 
 * Override this template by copying it to yourtheme/simple_job_board/v2/content-single-job-listing.php
 * 
 * @author 	PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/Templates
 * @version     1.0.0
 * @since       2.1.0
 * @since       2.2.3   Added the_content function.
 * @since       2.3.0   Added "sjb_single_job_listing_template" filter.
 */
ob_start();
?>

<!-- Start Job Details
================================================== -->

<div class="jobDetails_wrap">
    <div class="jobDetails_mainHeader">
        <div class="jobDetails_header"> 
            <?php
                /**
                 * single_job_listing_start hook 
                 * @hooked job_listing_meta_display - 20 ( Job Listing Company Meta ) 
                 * @since   2.1.0
                 */
                do_action('sjb_single_job_listing_start');
            ?>
        </div> 
        <div class="jobDetails_headerBtn">
            <a href="javascript:void(0)" class="btn-style gradientBtn"> Apply Now </a>
        </div>
    </div>
    <div class="jobDetails_mainBody">
        <div class="row">
            <div class="col-md-7">
                <div class="jobDetails_wrap_lftside"> 
                    <div class="job-description"> 
                        <?php the_content(); ?>
                    </div>   
                </div>
            </div>
            <div class="col-md-5">
                <div class="jobDetails_wrap_rghtside">
                    <div class="sjb_featuresWrap_1 sjb_featuresWrap_boxcmn">
                        <?php do_action('sjb_single_job_listing_2_start') ?> 
                    </div>
                    <div class="sjb_featuresWrap sjb_featuresWrap_boxcmn">
                        <?php do_action('sjb_single_job_listing_end_features'); ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  


<div class="jobDetails_formWrap d-none"> 
    <?php
        /**
         * single-job-listing-end hook  
         * @hooked job_listing_application_form - 30 ( Job Application Form ) 
         * @since   2.1.0
         */
        do_action('sjb_single_job_listing_end');
    ?>
</div>

<!-- ==================================================
End Job Details -->

<?php
$html = ob_get_clean();

/**
 * Modify the Single Job Listing Template. 
 *                                       
 * @since   2.3.0
 * 
 * @param   html    $html   Single Job Listing HTML.                   
 */
echo apply_filters('sjb_single_job_listing_template', $html);