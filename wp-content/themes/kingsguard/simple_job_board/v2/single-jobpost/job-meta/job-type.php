<?php
/**
 * The template for displaying job type
 *
 * Override this template by copying it to yourtheme/simple_job_board/v2/single-jobpost/job-meta/job-type.php
 * 
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/single-jobpost/job-meta
 * @version     2.0.0
 * @since       2.2.3
 * @since       2.3.0   Added "sjb_job_meta_job_type_template" filter.
 * @since       2.4.0   Revised whole HTML structure
 */
ob_start();
?>

<!-- Start Job Type 
================================================== -->
<?php if ($job_type = sjb_get_the_job_type()) {
    ?>
	<div class="col-xl-4 col-md-6 col-sm-4">
        <div class="job-meta-grid">
            <?php do_action('sjb_job_type_title'); ?>
            <h4 class="job-type"><i class="fa  fa-briefcase"></i>Job Type</h4>
            <p><?php sjb_the_job_type(); ?></p>
        </div>
	</div>
<?php } ?> 
<!-- ==================================================
End Job Type  -->

<?php
$html_job_type = ob_get_clean();

/**
 * Modify the Job Meta - Job Type Template. 
 *                                       
 * @since   2.3.0
 * 
 * @param   html    $html_job_type   Job Type HTML.                   
 */
echo apply_filters( 'sjb_job_meta_job_type_template', $html_job_type );