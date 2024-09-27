<?php
/**
 * The template part for displaying single child posts of 'services' custom post type
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 */
?>

<div class="pageBody childServicePage">
    <?php
        $montoring_banner_title = get_field('montoring_banner_title');
        if (isset($montoring_banner_title) && !empty($montoring_banner_title)) {
        $montoring_banner_des = get_field('montoring_banner_des');
    ?>
    <section>
        <div class="commonBannerWrapper">
            <div class="sm_container">
                <div class="commonBanner" data-aos="fade-down" data-aos-duration="1000">
                    <div class="bannerContent">
                        <h1 class="mb0 h2"> <?php echo $montoring_banner_title; ?> </h1>
                        <div class="banner_cont"><?php echo $montoring_banner_des; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php 
        $about_page_title = get_field('about_page_title');
        if(isset($about_page_title) && !empty($about_page_title)) {
        $about_page_description = get_field('about_page_description'); 
    ?> 
    <div class="guardTourSec py100">
        <div class="sm_container">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="guardTourTitle" data-aos="fade-up" data-aos-duration="1000">
                        <h2 class="mb0 h2 smHeading"><?php echo $about_page_title; ?> </h2>
                        <div class=""><?php echo $about_page_description; ?></div>
                    </div>
                </div>
                <?php
                    $about_pg_image = get_field('about_pg_image');
                    if (isset($about_pg_image) && !empty($about_pg_image)) {
                        $image_url = wp_get_attachment_image_src($about_pg_image, 'full')[0];
                        $image_alt = get_post_meta($about_pg_image, '_wp_attachment_image_alt', true);
                ?>
                <div class="col-md-6">
                    <div class="guardTourImg" data-aos="fade-up" data-aos-duration="1000">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php 
        $live_tracking_title = get_field('live_tracking_title');
        if(isset($live_tracking_title) && !empty($live_tracking_title)) {
        $live_tracking_description = get_field('live_tracking_description');
        $live_tracking_image = get_field('live_tracking_image');
        $tracking_image_url = wp_get_attachment_image_src($live_tracking_image, 'full')[0]; 
        $tracking_image_alt = get_post_meta($support_protect_image, '_wp_attachment_image_alt', true);
    ?>
    <div class="liveTrackingWrap">
        <div class="sm_container">
            <div class="liveTrackingInner">
                <div class="liveTrackingImg" data-aos="fade-up" data-aos-duration="1000">
                    <img src="<?php echo esc_url($tracking_image_url); ?>" alt="<?php echo esc_attr($tracking_image_alt); ?>">
                    <div class="liveTrackingCont animated-text" data-aos="fade-up" data-aos-duration="1000">
                        <h1 class="h3 smHeading"><?php echo $live_tracking_title; ?></h1>
                        <?php echo $live_tracking_description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php 
        $support_protect_title = get_field('support_protect_title');
        if(isset($support_protect_title) && !empty($support_protect_title)) {
        $support_protect_description = get_field('support_protect_description'); 
    ?> 
    <div class="supportProtectSec py100">
        <div class="sm_container">
            <div class="supportProtectTitle" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="mb0 h2 smHeading"><?php echo $support_protect_title; ?> </h2>
                <div class=""><?php echo $support_protect_description; ?></div>
            </div>
            <?php
                $support_protect_image = get_field('support_protect_image');
                if (isset($support_protect_image) && !empty($support_protect_image)) {
                    $image_url = wp_get_attachment_image_src($support_protect_image, 'full')[0];
                    $image_alt = get_post_meta($support_protect_image, '_wp_attachment_image_alt', true);
            ?>
            <div class="supportProtectImg" data-aos="fade-up" data-aos-duration="1000">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            </div>
            <?php } ?>
            <?php 
                $identify_incident_title = get_field('identify_incident_title');
                if(isset($identify_incident_title) && !empty($identify_incident_title)) {
                $identify_incident_description = get_field('identify_incident_description'); 
            ?> 
            <div class="supportProtectTitle" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="mb0 h2 smHeading"><?php echo $identify_incident_title; ?> </h2>
                <div class=""><?php echo $identify_incident_description; ?></div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>

    <?php 
        $gps_tracking_title = get_field('gps_tracking_title');
        if(isset($gps_tracking_title) && !empty($gps_tracking_title)) {
        $gps_tracking_description = get_field('gps_tracking_description');
        $gps_tracking_image = get_field('gps_tracking_image');
        $gps_image_url = wp_get_attachment_image_src($gps_tracking_image, 'full')[0]; 
        $gps_image_alt = get_post_meta($support_protect_image, '_wp_attachment_image_alt', true);
    ?>
    <div class="liveTrackingWrap gpsTrackingWrap">
        <div class="sm_container">
            <div class="liveTrackingInner">
                <div class="liveTrackingImg" data-aos="fade-up" data-aos-duration="1000">
                    <img src="<?php echo esc_url($gps_image_url); ?>" alt="<?php echo esc_attr($gps_image_alt); ?>">
                    <div class="liveTrackingCont animated-text" data-aos="fade-up" data-aos-duration="1000">
                        <h1 class="h3 smHeading"><?php echo $gps_tracking_title; ?></h1>
                        <?php echo $gps_tracking_description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php 
        $solution_title = get_field('solution_title');
        if(isset($solution_title) && !empty($solution_title)) {
        $solution_description = get_field('solution_description'); 
    ?> 
    <div class="solutionSec py100">
        <div class="sm_container">
            <div class="row">
                <div class="col-md-6">
                    <div class="solutionTitle" data-aos="fade-up" data-aos-duration="1000">
                        <h2 class="mb0 h2 smHeading"><?php echo $solution_title; ?> </h2>
                        <?php echo $solution_description; ?>
                    </div>
                </div>
                <?php if (have_rows('solutions_grid')) : ?>
                <div class="col-md-6">
                    <div class="solutionGridWrapper" data-aos="fade-up" data-aos-duration="1000">
                        <?php while (have_rows('solutions_grid')) : the_row(); ?>
                        <div class="solutionGrid">
                            <?php
                                $solution_icon = get_sub_field('solution_icon');
                                if (isset($solution_icon) && !empty($solution_icon)) {
                                    $image_url = wp_get_attachment_image_src($solution_icon, 'full')[0];
                                    $image_alt = get_post_meta($solution_icon, '_wp_attachment_image_alt', true);
                            ?>
                            <div class="solutionIcon">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            </div>
                            <?php } ?>
                            <?php 
                                $solution_title = get_sub_field('solution_title');
                                if(isset($solution_title) && !empty($solution_title)){ 
                                $solution_description = get_sub_field('solution_description');
                            ?>
                                <div class="solutionCont">
                                    <div class="solutionContInner">
                                        <h4 class="h5"><?php echo $solution_title; ?></h4>
                                        <?php echo $solution_description; ?>
                                    </div>                                
                                </div>
                            <?php } ?>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php endif; wp_reset_query(); ?>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <?php 
        $professional_monitoring_title = get_field('professional_monitoring_title');
        if(isset($professional_monitoring_title) && !empty($professional_monitoring_title)) {
        $professional_monitoring_description = get_field('professional_monitoring_description'); 
    ?> 
    <div class="proMonitoringSec py100">
        <div class="sm_container">
            <div class="proMonitoringTitle" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="mb0 h2 smHeading"><?php echo $professional_monitoring_title; ?> </h2>
                <div class="text-center"><?php echo $professional_monitoring_description; ?></div>
            </div>
            <div class="row no-gutters">
                <?php if (have_rows('professional_monitoring_accordian')) : ?>
                <div class="col-md-6">
                    <div class="proMonitoringWrapper proMonitorWrap" data-aos="fade-up" data-aos-duration="1000">
                        <div class="accordion" id="proMonitoringAccordian">
                            <?php $counterr = 0; while (have_rows('professional_monitoring_accordian')) : the_row(); ?>
                            <div class="card">
                                <?php 
                                    $professional_monitoring_accordian_title = get_sub_field('professional_monitoring_accordian_title');
                                    if(isset($professional_monitoring_accordian_title) && !empty($professional_monitoring_accordian_title)){
                                ?> 
                                <div class="card-header" id="heading<?php echo $counterr; ?>">
                                    <h3 class="h5 mb-0 <?php echo ($counterr === 0) ? '' : 'collapsed'; ?>" data-toggle="collapse" data-target="#collapse<?php echo $counterr; ?>" aria-expanded="<?php echo ($counterr === 0) ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $counterr; ?>">
                                        <?php echo $professional_monitoring_accordian_title; ?>
                                        <span class="accordPlusIcon <?php echo ($counterr === 0) ? 'minus' : 'plus'; ?>">
                                        </span>
                                    </h3>
                                </div>
                                <?php } ?>
                                <?php 
                                    $professional_monitoring_accordian_description = get_sub_field('professional_monitoring_accordian_description');
                                    if(isset($professional_monitoring_accordian_description) && !empty($professional_monitoring_accordian_description)){
                                ?> 
                                <div id="collapse<?php echo $counterr; ?>" class="collapse <?php echo ($counterr === 0) ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $counterr; ?>" data-parent="#proMonitoringAccordian">
                                    <div class="card-body">
                                        <?php echo $professional_monitoring_accordian_description; ?>                                      
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php $counterr++; endwhile; ?>
                        </div>
                    </div>
                </div>
                <?php endif; wp_reset_query(); ?>
                <?php 
                    $pro_montoring_video = get_field('pro_montoring_video');
                    if(isset($pro_montoring_video) && !empty($pro_montoring_video)){
                ?> 
                <div class="col-md-6">
                    <div class="proMonitoringVideo" data-aos="fade-up" data-aos-duration="1000">
                        <video id="proMonitoringVideo" loop controls muted>
                            <source src="<?php echo $pro_montoring_video; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>     
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if (have_rows('reversed_grid')) : ?>
    <div class="reverseGridSec">
        <?php $counter = 0; while (have_rows('reversed_grid')) : the_row(); ?>
            <div class="reverseGridInner">
                <div class="row no-gutters align-items-center <?php echo ($counter % 2 === 1) ? 'flex-md-row-reverse' : ''; ?>">
                    <?php
                        $modern_alarm_system_image = get_sub_field('modern_alarm_system_image');
                        if (isset($modern_alarm_system_image) && !empty($modern_alarm_system_image)) {
                            $image_url = wp_get_attachment_image_src($modern_alarm_system_image, 'full')[0];
                            $image_alt = get_post_meta($modern_alarm_system_image, '_wp_attachment_image_alt', true);
                    ?>
                    <div class="col-md-6">
                        <div class="reverseGridImg" data-aos="fade-up" data-aos-duration="1000">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                        </div>
                    </div>
                    <?php } ?>
                    <?php 
                        $modern_alarm_system_title = get_sub_field('modern_alarm_system_title');
                        if(isset($modern_alarm_system_title) && !empty($modern_alarm_system_title)) {
                        $modern_alarm_system_description = get_sub_field('modern_alarm_system_description'); 
                    ?> 
                    <div class="col-md-6">
                        <div class="reverseGridCont" data-aos="fade-up" data-aos-duration="1000">
                            <h3 class="h3"><?php echo $modern_alarm_system_title; ?></h3>
                            <?php echo $modern_alarm_system_description; ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        <?php $counter++; endwhile; ?>
    </div>
    <?php endif; wp_reset_query(); ?>

    <?php 
        $alarm_licenses_title = get_field('alarm_licenses_title');
        if(isset($alarm_licenses_title) && !empty($alarm_licenses_title)) {
        $alarm_licenses_description = get_field('alarm_licenses_description'); 
    ?> 
    <div class="alarmLicenseSec py100">
        <div class="sm_container">
            <div class="alarmLicenseTitle" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="mb0 h2 smHeading"><?php echo $alarm_licenses_title; ?> </h2>
                <?php echo $alarm_licenses_description; ?>
            </div>
            <?php if (have_rows('alarm_licenses')) : ?>
                <div class="alarmLicenses">
                    <div class="row mb30">
                        <?php while (have_rows('alarm_licenses')) : the_row(); ?>
                        <div class="column col-md-4">
                            <div class="alarmLicenseWrapper" data-aos="fade-up" data-aos-duration="1000">      
                                <div class="alarmLicenseInner">  
                                    <?php 
                                        $alarm_licenses_subtitle = get_sub_field('alarm_licenses_subtitle');
                                        if(isset($alarm_licenses_subtitle) && !empty($alarm_licenses_subtitle)){ 
                                    ?>
                                        <div class="alarmLicenseSubtitle">
                                            <h3 class="h5"><?php echo $alarm_licenses_subtitle; ?></h3>
                                        </div>
                                    <?php } ?>
                                    <?php 
                                        $alarm_licenses_title = get_sub_field('alarm_licenses_title');
                                        if(isset($alarm_licenses_title) && !empty($alarm_licenses_title)){ 
                                    ?>
                                        <div class="alarmLicenseHeading">
                                            <h4 class="h3"><?php echo $alarm_licenses_title; ?></h4>
                                        </div>
                                    <?php } ?>
                                    <?php 
                                        $alarm_licenses_price = get_sub_field('alarm_licenses_price');
                                        if(isset($alarm_licenses_price) && !empty($alarm_licenses_price)){ 
                                    ?>
                                        <div class="alarmLicensePrice">
                                            <p class="p"><?php echo $alarm_licenses_price; ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php if (have_rows('alarm_licenses_features')) : ?>
                                        <?php while (have_rows('alarm_licenses_features')) : the_row(); ?>
                                        <div class="alarmLicenseFeatures">
                                            <?php 
                                                $alarm_licenses_feature_title = get_sub_field('alarm_licenses_feature_title');
                                                if(isset($alarm_licenses_feature_title) && !empty($alarm_licenses_feature_title)){ 
                                            ?>
                                            <h5 class="h6"><?php echo $alarm_licenses_feature_title; ?></h5>
                                            <?php } ?>
                                            <?php if (have_rows('alarm_licenses_feature_list')) : ?>
                                                <div class="alarmLicenseFeaturesList">
                                                    <ul>
                                                        <?php while (have_rows('alarm_licenses_feature_list')) : the_row(); ?>
                                                        <li>
                                                            <?php
                                                                $alarm_licenses_feature_listitem_icon = get_sub_field('alarm_licenses_feature_listitem_icon');
                                                                if (isset($alarm_licenses_feature_listitem_icon) && !empty($alarm_licenses_feature_listitem_icon)) {
                                                                    $image_url = wp_get_attachment_image_src($alarm_licenses_feature_listitem_icon, 'full')[0];
                                                                    $image_alt = get_post_meta($alarm_licenses_feature_listitem_icon, '_wp_attachment_image_alt', true);
                                                            ?>
                                                            <div class="alarmLicenseFeaturesIcon">
                                                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                            </div>
                                                            <?php } ?>
                                                            <?php 
                                                                $alarm_licenses_feature_listitem_text = get_sub_field('alarm_licenses_feature_listitem_text');
                                                                if(isset($alarm_licenses_feature_listitem_text) && !empty($alarm_licenses_feature_listitem_text)){ 
                                                            ?>
                                                                <div class="alarmLicenseFeaturesCont">
                                                                    <p class="p"><?php echo $alarm_licenses_feature_listitem_text; ?></p>
                                                                </div>
                                                            <?php } ?>
                                                        </li>
                                                        <?php endwhile; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; wp_reset_query(); ?>
                                        </div>
                                        <?php endwhile; ?>
                                    <?php endif; wp_reset_query(); ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; wp_reset_query(); ?>
        </div>
    </div>
    <?php } ?>
    
    <?php 
        $free_trial_title = get_field('free_trial_title');
        if(isset($free_trial_title) && !empty($free_trial_title)) {
        $free_trial_description = get_field('free_trial_description');
        $free_trial_background = get_field('free_trial_background');
        $image_url = wp_get_attachment_image_src($free_trial_background, 'full')[0];
        $free_trial_mob_background = get_field('free_trial_mob_background');
        $mob_image_url = wp_get_attachment_image_src($free_trial_mob_background, 'full')[0]; 
    ?> 
    <style>
        .freeTrialSec {
            background-image: url('<?php echo esc_url($image_url); ?>');
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 767px) {
            .freeTrialSec {
                background-image: url('<?php echo esc_url($mob_image_url); ?>');
            }
        }
    </style>
    <div class="freeTrialSec">
        <div class="sm_container">
            <div class="monitoringBannerInner">
                <div class="monitoringBannerCont animated-text" data-aos="fade-up" data-aos-duration="1000">
                    <h3 class="h2 smHeading"><?php echo $free_trial_title; ?></h3>
                    <?php echo $free_trial_description; ?>
                    <?php 
                        $free_trial_button_text = get_field('free_trial_button_text');
                        if(isset($free_trial_button_text) && !empty($free_trial_button_text)){
                        $free_trial_button_link = get_field('free_trial_button_link');
                        $free_trial_button_target = get_field('free_trial_button_target');
                        $free_trial_button_arialabel = get_field('free_trial_button_arialabel');
                    ?> 
                    <div class="freeTrialBtnWrap">
                        <div class="btnWrap">
                            <a href="<?php echo $free_trial_button_link; ?>" class="btn-style gradientBtn" target="<?php echo $free_trial_button_target; ?>" aria-label="<?php echo $free_trial_button_arialabel; ?>"><?php echo $free_trial_button_text; ?></a>
                        </div>
                    </div>
                    <?php } ?>   
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php 
        $timely_reporting_title = get_field('timely_reporting_title');
        if(isset($timely_reporting_title) && !empty($timely_reporting_title)) {
        $timely_reporting_description = get_field('timely_reporting_description');
        $timely_reporting_image = get_field('timely_reporting_image');
        $timely_image_url = wp_get_attachment_image_src($timely_reporting_image, 'full')[0]; 
        $timely_image_alt = get_post_meta($timely_reporting_image, '_wp_attachment_image_alt', true);
    ?>
    <div class="liveTrackingWrap">
        <div class="sm_container">
            <div class="liveTrackingInner">
                <div class="liveTrackingImg" data-aos="fade-up" data-aos-duration="1000">
                    <img src="<?php echo esc_url($timely_image_url); ?>" alt="<?php echo esc_attr($timely_image_alt); ?>">
                    <div class="liveTrackingCont animated-text" data-aos="fade-up" data-aos-duration="1000">
                        <h1 class="h3 smHeading"><?php echo $timely_reporting_title; ?></h1>
                        <?php echo $timely_reporting_description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php get_footer(); ?>