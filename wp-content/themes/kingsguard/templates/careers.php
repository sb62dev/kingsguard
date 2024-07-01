<?php
/**
 * Template Name: Careers page
 **/
get_header();
?>

<div class="pageBody">

    <section class="careersPage pb100"> 
        <div class="job-listings">
            <?php get_template_part('simple_job_board/archive-jobpost'); ?>   
        </div>  
    </section>

    <?php get_template_part('template-parts/trainingsection'); ?>   

</div> 

<?php get_footer(); ?>