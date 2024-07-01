<?php
/**
 * The template for displaying job title in grid view.
 *
 * Override this template by copying it to yourtheme/simple_job_board/v1/listing/grid-view/title.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing/grid-view/
 * @version     1.0.0
 * @since       2.3.0   Added "sjb_grid_view_title_template" filter.
 */
ob_start();

// Job Title
sjb_the_title('<span class="job-title">', '</span>' );

$html = ob_get_clean();

/**
 * Modify the Job Listing -> Job Title Template. 
 *                                       
 * @since   2.3.0
 * 
 * @param   html    $html   Job Title HTML.                   
 */
echo apply_filters( 'sjb_grid_view_title_template', $html );