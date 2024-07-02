<?php
/**
 * The template for displaying job type in list view
 *
 * Override this template by copying it to yourtheme/simple_job_board/listing/list-view/type.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing/list-view
 * @version     2.0.0
 * @since       2.2.3
 * @since       2.3.0   Added "sjb_list_view_job_type_template" filter.
 * @since       2.4.0   Revised the whole HTML template
 */
ob_start();
?>

<!-- Start Job Type
================================================== -->
<?php if ($job_type = sjb_get_the_job_type()) {
    ?>
	<div class="col-md-3 col-sm-4 col-xs-12">
        <?php do_action('sjb_job_type_title'); ?>
        <div class="job-type"><span class="jobMetaIcon"><i class="fa fa-briefcase"></i></span><span class="jobMetaText"><?php sjb_the_job_type(); ?></span></div>
    </div>
<?php } ?> 
<!-- ==================================================
End Job Type -->

<?php
$html = ob_get_clean();

/**
 * Modify the Job Listing -> Job Title Template. 
 *                                       
 * @since   2.3.0
 * 
 * @param   html    $html   Job Title HTML.                   
 */
echo apply_filters('sjb_list_view_job_type_template', $html);