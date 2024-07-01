<?php
/**
 * Template Name: Careers page
 **/
get_header();
?>

<div class="pageBody">
    <section class="careersPage pb100">
        <div class="sm_container">
            <!-- Custom Job Listings -->
            <div class="job-listings">
                <?php
                get_template_part('simple_job_board/archive-jobpost'); 
                ?>
            </div>
            <!-- End of Custom Job Listings -->

        </div>
    </section>
</div>

<?php get_footer(); ?>