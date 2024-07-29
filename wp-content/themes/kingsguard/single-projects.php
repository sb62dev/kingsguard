<?php
/**
 * The template for displaying all single projects
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-project
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>
<div class="pageBody">
    <div class="projectDetailPage">
        <div class="projectDetailInner">
            <div class="title" data-aos="fade-down" data-aos-duration="1000">
                <div class="sm_container">
                    <h1 class="h2">
                        <?php echo get_the_title(); ?>
                    </h1>
                </div>
            </div>
            <div class="projectDetailImg" data-aos="fade-down" data-aos-duration="1000">
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="">
            </div>
            <div class="projectInfoWrap py100 pb-0">
                <div class="sm_container">
                    <div class="projectInfo">
                        <div class="row">
                            <?php 
                                $project_client = get_field('project_client');
                                if(isset($project_client) && !empty($project_client)){ 
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 projectInfoBlockWrap" data-aos="fade-down" data-aos-duration="1000">
                                <div class="projectInfoBlock">
                                    <h5>Client</h5>      
                                    <p><?php echo $project_client; ?> </p>                    
                                </div>
                            </div>
                            <?php } ?>
                            <?php 
                                $project_cities = get_the_terms(get_the_ID(), 'cities');
                                if($project_cities && !is_wp_error($project_cities)) { 
                                    $project_city_names = wp_list_pluck($project_cities, 'name');
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 projectInfoBlockWrap" data-aos="fade-down" data-aos-duration="1000">
                                <div class="projectInfoBlock">
                                    <h5>City</h5>      
                                    <p><?php echo implode(', ', $project_city_names); ?> </p>                    
                                </div>
                            </div>
                            <?php } ?>

                            <?php 
                                $project_services = get_the_terms(get_the_ID(), 'service-types');
                                if($project_services && !is_wp_error($project_services)) { 
                                    $project_service_names = wp_list_pluck($project_services, 'name');
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 projectInfoBlockWrap" data-aos="fade-down" data-aos-duration="1000">
                                <div class="projectInfoBlock">
                                    <h5>Service Type</h5>      
                                    <p><?php echo implode(', ', $project_service_names); ?> </p>                    
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="projectInfo projectInfoBorder">
                        <div class="row">
                            <?php 
                                $project_service_period = get_field('project_service_period');
                                if(isset($project_service_period) && !empty($project_service_period)){ 
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 projectInfoBlockWrap" data-aos="fade-down" data-aos-duration="1000">
                                <div class="projectInfoBlock">
                                    <h5>Service Period</h5>      
                                    <p><?php echo $project_service_period; ?> </p>                    
                                </div>
                            </div>
                            <?php } ?>
                            <?php 
                                $project_value = get_field('project_value');
                                if(isset($project_value) && !empty($project_value)){ 
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 projectInfoBlockWrap" data-aos="fade-down" data-aos-duration="1000">
                                <div class="projectInfoBlock">
                                    <h5>Project Value</h5>      
                                    <p><?php echo $project_value; ?> </p>                    
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (have_rows('project_content')) : ?>
            <div class="projectDetailCont py100">
                <div class="sm_container">
                    <?php while (have_rows('project_content')) : the_row(); ?>
                    <div class="projectContentInner">
                        <?php 
                            $project_cont_title = get_sub_field('project_cont_title');
                            if(isset($project_cont_title) && !empty($project_cont_title)){ 
                        ?>
                        <h2 class="h2" data-aos="fade-down" data-aos-duration="1000">
                            <?php echo $project_cont_title; ?>
                        </h2>
                        <?php } ?>
                        <?php if (have_rows('project_cont_desc')) : ?>
                        <div class="projectContInner">
                            <div class="row">
                                <?php while (have_rows('project_cont_desc')) : the_row(); ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12" data-aos="fade-down" data-aos-duration="1000">
                                        <?php 
                                            $project_cont_description = get_sub_field('project_cont_description');
                                            if(isset($project_cont_description) && !empty($project_cont_description)){ 
                                        ?>
                                            <div class="project_detail_story_text">
                                                <?php echo $project_cont_description; ?>                                        
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php endwhile; ?>
                            </div>
                        </div>
                        <?php endif; wp_reset_query(); ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; wp_reset_query(); ?>
        </div>
    </div>
</div>
<?php
get_footer();
