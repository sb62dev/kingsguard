<?php
/**
 * The template for displaying all single posts of 'services' custom post type
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 */

get_header();
?>
<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); 
        // Check if the current post is a child post
        if (wp_get_post_parent_id(get_the_ID()) !== 0) :
            // Load the child post template
            get_template_part('single-services-child');
        else :
            // Load the parent post template or default content
    ?>
        <div class="pageBody">
            <?php
                $banner_title = get_field('banner_title');
                if (isset($banner_title) && !empty($banner_title)) {
                $banner_description = get_field('banner_description');
            ?>
            <section>
                <div class="commonBannerWrapper">
                    <div class="sm_container">
                        <div class="commonBanner" data-aos="fade-down" data-aos-duration="1000">
                            <div class="bannerContent">
                                <h1 class="mb0 h2"> <?php echo $banner_title; ?> </h1>
                                <p><?php echo $banner_description; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php } ?>

            <?php 
                $key_benefit_title = get_field('key_benefit_title');
                if(isset($key_benefit_title) && !empty($key_benefit_title)){ 
            ?>
            <section>
                <div class="keyBenefitSec py200">
                    <div class="sm_container">
                        <div class="keyBenefitInner">
                            <div class="title" data-aos="fade-down" data-aos-duration="1000">
                                <h2 class="h2"><?php echo $key_benefit_title; ?></h2>
                            </div>
                            <?php if (have_rows('key_benefits')) : ?>
                                <?php $count = 0; while (have_rows('key_benefits')) : the_row(); ?>
                                    <div class="keyBenefitBlock" data-aos="fade-down" data-aos-duration="1000">
                                        <div class="row <?php echo ($count % 2 == 0) ? '' : 'flex-row-reverse'; ?>">
                                            <?php
                                                $key_benefit_image = get_sub_field('key_benefit_image');
                                                if (isset($key_benefit_image) && !empty($key_benefit_image)) {
                                                    $image_url = wp_get_attachment_image_src($key_benefit_image, 'full')[0];
                                                    $image_alt = get_post_meta($key_benefit_image, '_wp_attachment_image_alt', true);
                                            ?>
                                            <div class="col-md-6">
                                                <div class="keyBenefitImg">
                                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php 
                                                $key_benefit_heading = get_sub_field('key_benefit_heading');
                                                if(isset($key_benefit_heading) && !empty($key_benefit_heading)){ 
                                                $key_benefit_description = get_sub_field('key_benefit_description');
                                            ?>
                                            <div class="col-md-6">
                                                <div class="keyBenefitCont">
                                                    <div class="keyBenefitContInner">
                                                        <h3 class="h3"><?php echo $key_benefit_heading; ?></h3>
                                                        <p><?php echo $key_benefit_description; ?></p>
                                                    </div>                                
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php $count++; endwhile; ?>
                            <?php endif; wp_reset_query(); ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php }  ?>
            
            <?php if (have_rows('security_service_grid')) : ?>
            <section>
                <div class="securityServiceSec bgTexture py100">
                    <div class="sm_container">
                        <div class="securityServiceInner">
                            <?php 
                                $services_sec_title = get_field('services_sec_title');
                                if(isset($services_sec_title) && !empty($services_sec_title)){ 
                                $services_sec_desc = get_field('services_sec_desc');
                            ?>
                            <div class="securityServiceTitle">
                                <div class="title" data-aos="fade-down" data-aos-duration="1000">
                                    <h2 class="h2"><?php echo $services_sec_title; ?></h2>
                                </div>
                                <div class="description text-center" data-aos="fade-down" data-aos-duration="1000">
                                    <?php echo $services_sec_desc; ?>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="securityServiceBlock" data-aos="fade-down" data-aos-duration="1000">
                                <div class="row mb30">
                                    <?php while (have_rows('security_service_grid')) : the_row(); ?>
                                    <?php 
                                        $security_grid_class = get_sub_field('security_grid_class');
                                        // Check if $security_grid_class is set and not empty, else use default classes
                                        $column_class = (!empty($security_grid_class)) ? $security_grid_class : 'col-md-4 col-sm-6';
                                    ?>
                                        <div class="column <?php echo $column_class; ?>">
                                            <div class="securityServiceBox">
                                                <?php
                                                    $security_service_image = get_sub_field('security_service_image');
                                                    if (isset($security_service_image) && !empty($security_service_image)) {
                                                        $image_url = wp_get_attachment_image_src($security_service_image, 'full')[0];
                                                        $image_alt = get_post_meta($security_service_image, '_wp_attachment_image_alt', true);
                                                ?>
                                                <div class="securityServiceImg">
                                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                </div>
                                                <?php } ?>

                                                <?php 
                                                    $security_service_title = get_sub_field('security_service_title');
                                                    if(isset($security_service_title) && !empty($security_service_title)){ 
                                                    $security_service_description = get_sub_field('security_service_description');
                                                ?>
                                                    <div class="securityServiceCont">
                                                        <div class="securityServiceContInner">
                                                            <h4 class="h4"><?php echo $security_service_title; ?></h4>
                                                            <?php echo $security_service_description; ?>
                                                        </div>                                
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>
            <?php 
                $resport_sec_title = get_field('resport_sec_title');
                if(isset($resport_sec_title) && !empty($resport_sec_title)){ 
            ?>
            <section>
                <div class="reportSecOuter py100">
                    <div class="sm_container">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                <?php
                                    $report_sec_image = get_field('report_sec_image');
                                    if (isset($report_sec_image) && !empty($report_sec_image)) {
                                        $image_url = wp_get_attachment_image_src($report_sec_image, 'full')[0];
                                        $image_alt = get_post_meta($report_sec_image, '_wp_attachment_image_alt', true);
                                ?>
                                    <div class="reportImgSec">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        <?php 
                                            $report_sec_video_url = get_field('report_sec_video_url');
                                            if (isset($report_sec_video_url) && !empty($report_sec_video_url)) {
                                        ?>
                                        <div class="reportPlayBtnWrap">
                                            <a href="#projectVideo" class="playBtn" data-toggle="modal" data-video="<?php echo esc_url($report_sec_video_url); ?>" aria-label="Click here to open Video">
                                                <i class="fa fa-play after"></i>
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <?php 
                                    $resport_sec_title = get_field('resport_sec_title');
                                    if(isset($resport_sec_title) && !empty($resport_sec_title)){ 
                                    $report_sec_description = get_field('report_sec_description');
                                ?>
                                    <div class="reportSecCont">
                                        <div class="reportSecContInner">
                                            <h4 class="h2"><?php echo $resport_sec_title; ?></h4>
                                            <?php echo $report_sec_description; ?>

                                            <?php if (have_rows('report_features')) : ?>
                                            <div class="reportFeatures">
                                                <ul>
                                                    <?php while (have_rows('report_features')) : the_row(); ?>
                                                    <li>
                                                        <div class="reportList">
                                                            <?php
                                                                $report_feature_icon = get_sub_field('report_feature_icon');
                                                                if (isset($report_feature_icon) && !empty($report_feature_icon)) {
                                                                    $image_url = wp_get_attachment_image_src($report_feature_icon, 'full')[0];
                                                                    $image_alt = get_post_meta($report_feature_icon, '_wp_attachment_image_alt', true);
                                                            ?>
                                                            <div class="reportIcon">
                                                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                            </div>
                                                            <?php } ?>
                                                            <?php 
                                                                $report_feature_text = get_sub_field('report_feature_text');
                                                                if(isset($report_feature_text) && !empty($report_feature_text)){ 
                                                            ?>
                                                            <div class="reportText">
                                                                <?php echo $report_feature_text; ?>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </li>
                                                    <?php endwhile; ?>
                                                </ul>
                                            </div>
                                            <?php endif; wp_reset_query(); ?>
                                        </div>                                
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php }  ?>

            <?php if (have_rows('support_block')) : ?>
            <section>
                <div class="securityServiceSec bgTexture py100">
                    <div class="sm_container">
                        <div class="securityServiceInner">
                            <div class="securityServiceBlock" data-aos="fade-down" data-aos-duration="1000">
                                <div class="row mb30">
                                    <?php $counter = 0; while (have_rows('support_block')) : the_row(); ?>
                                        <div class="column col-md-4 col-sm-6">
                                            <div class="securityServiceBoxOuter">
                                                <div class="supportNumber">
                                                    <?php echo sprintf('%02d.', $counter + 1); ?>
                                                </div>
                                                <div class="securityServiceBox">
                                                    <?php
                                                        $support_block_img = get_sub_field('support_block_img');
                                                        if (isset($support_block_img) && !empty($support_block_img)) {
                                                            $image_url = wp_get_attachment_image_src($support_block_img, 'full')[0];
                                                            $image_alt = get_post_meta($support_block_img, '_wp_attachment_image_alt', true);
                                                    ?>
                                                    <div class="securityServiceImg">
                                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                    </div>
                                                    <?php } ?>

                                                    <?php 
                                                        $support_block_title = get_sub_field('support_block_title');
                                                        if(isset($support_block_title) && !empty($support_block_title)){ 
                                                        $support_block_description = get_sub_field('support_block_description');
                                                    ?>
                                                        <div class="securityServiceCont">
                                                            <div class="securityServiceContInner">
                                                                <h4 class="h4"><?php echo $support_block_title; ?></h4>
                                                                <?php echo $support_block_description; ?>
                                                            </div>                                
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $counter++; endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>
        </div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; wp_reset_query(); ?>
<?php
get_footer();
