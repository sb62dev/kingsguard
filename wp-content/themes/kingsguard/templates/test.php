 <?php

/**

 * Template Name: Home Test

**/

get_header();

?>

<div class="pageBody homeBody">
    <!-- <?php if (have_rows('home_img_slider')) : ?>
    <div class="homeBannerSlider slider mb-0">
        <?php while (have_rows('home_img_slider')) : the_row(); ?>
        <?php
            $home_banner_image = get_sub_field('home_banner_image');
            if (isset($home_banner_image) && !empty($home_banner_image)) {
                $image_url = wp_get_attachment_image_src($home_banner_image, 'full')[0];
                $image_alt = get_post_meta($home_banner_image, '_wp_attachment_image_alt', true);
        ?>
            <div class="homeBannerSlide">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            </div>
        <?php } ?>
        <?php endwhile; ?>
    </div>
    <?php endif; wp_reset_query(); ?>  -->

    <section class="homeVideoSlider">
        <?php if (have_rows('home_video_slider')) : ?>
        <div class="testSlider slider mb-0 homeDeskSlider">
            <?php while (have_rows('home_video_slider')) : the_row(); ?>
            <?php
                $home_banner_video = get_sub_field('home_banner_video');
                if (isset($home_banner_video) && !empty($home_banner_video)) {
                $home_video_duration = get_sub_field('home_video_duration');
            ?>
                <div class="homeBannerSlide" data-duration="<?php echo $home_video_duration; ?>">
                    <video id="slider_video" loop muted autoplay>
                        <source src="<?php echo $home_banner_video; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php } ?>
            <?php endwhile; ?>
        </div>
        <?php endif; wp_reset_query(); ?> 

        <?php if (have_rows('home_mob_video_slider')) : ?>
        <div class="testSlider slider mb-0 homeMobSlider">
            <?php while (have_rows('home_mob_video_slider')) : the_row(); ?>
            <?php
                $home_mob_banner_video = get_sub_field('home_mob_banner_video');
                if (isset($home_mob_banner_video) && !empty($home_mob_banner_video)) {
                $home_mob_video_duration = get_sub_field('home_mob_video_duration');
            ?>
                <div class="homeBannerSlide" data-duration="<?php echo $home_mob_video_duration; ?>">
                    <video id="slider_video" loop muted autoplay>
                        <source src="<?php echo $home_mob_banner_video; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php } ?>
            <?php endwhile; ?>
        </div>
        <?php endif; wp_reset_query(); ?> 
    
        <div class="scroll-guide-icon">
            <div class="desktop remove-line-height">
                <a href="#logoSliderWrap" class="smooth-scroll">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-scroll.svg" alt="Scroll down indicator"> 
                    <div class="down-arrow"></div>
                </a>
            </div>
        </div>
    </section>

    <!-- <?php
        $home_banner_title = get_field('home_banner_title');
        if (isset($home_banner_title) && !empty($home_banner_title)) {
        $home_banner_description = get_field('home_banner_description');
        $home_banner_bg = get_field('home_banner_bg');
    ?>
    <section class="hero_section">
        <div class="video-container">
            <div class="video_content_inner">
                <video id="background-video" loop muted autoplay>
                    <source src="<?php echo $home_banner_bg; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div id="video-overlay"></div>
                <div class="hero_text_main" data-aos="fade-down" data-aos-duration="1000">
                    <div class="hero_text_inner_div">
                        <h1 class="h2"><?php echo $home_banner_title; ?></h1>
                        <p><?php echo $home_banner_description; ?></p>
                        <?php
                            $home_banner_button_title = get_field('home_banner_button_title');
                            if (isset($home_banner_button_title) && !empty($home_banner_button_title)) {
                            $home_banner_button_link = get_field('home_banner_button_link');
                            $home_banner_button_target = get_field('home_banner_button_target');
                            $home_button_aria_label = get_field('home_button_aria_label');
                        ?>
                            <a href="<?php echo $home_banner_button_link; ?>" target="<?php echo $home_banner_button_target; ?>" aria-label="<?php echo $home_button_aria_label; ?>" class="btn-style gradientBtn"><?php echo $home_banner_button_title; ?></a>
                        <?php } ?>
                    </div>
                </div>
                <button id="play-button">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/play_icon.png" class="play_icon"
                        alt="">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pause.png" class="pause_icon" alt="">
                </button>
            </div>
        </div>
    </section>
    <?php } ?> -->

    <?php if (have_rows('client_logos')) : ?>
    <section>
        <div class="logosSLiderWrapper">
            <div class="sm_container">
                <div class="slider clientSlider clientLogo">
                    <?php while (have_rows('client_logos')) : the_row(); ?>
                    <div class="clientLogoSlide">
                        <?php
                            $logo_image = get_sub_field('logo_image');
                            if (isset($logo_image) && !empty($logo_image)) {
                                $image_url = wp_get_attachment_image_src($logo_image, 'full')[0];
                                $image_alt = get_post_meta($logo_image, '_wp_attachment_image_alt', true);
                        ?>
                        <div class="clientLogoSlideInner">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                        </div>
                        <?php } ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; wp_reset_query(); ?> 

    <?php if (have_rows('why_choose_kingsguard')) : ?>
    <section>
        <div class="whyChooseUs py200">
            <div class="sm_container">
                <div class="whyChooseInner">
                    <?php
                        $why_choose_title = get_field('why_choose_title');
                        if (isset($why_choose_title) && !empty($why_choose_title)) {
                    ?>
                    <div class="title" data-aos="fade-down" data-aos-duration="1000">
                        <h2 class="mb0 h2"> <?php echo $why_choose_title; ?> </h2>
                    </div>
                    <?php } ?>
                    <div class="whyChooseBlocks">
                        <div class="row">
                            <?php while (have_rows('why_choose_kingsguard')) : the_row(); ?>
                            <div class="col-md-4">
                                <div class="whyChooseBoxWrap" data-aos="fade-down" data-aos-duration="1000">
                                    <div class="whyChooseBox">
                                        <?php
                                            $why_choose_kings_icon = get_sub_field('why_choose_kings_icon');
                                            if (isset($why_choose_kings_icon) && !empty($why_choose_kings_icon)) {
                                                $image_url = wp_get_attachment_image_src($why_choose_kings_icon, 'full')[0];
                                                $image_alt = get_post_meta($why_choose_kings_icon, '_wp_attachment_image_alt', true);
                                        ?>
                                        <div class="whyChooseIcon">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        </div>
                                        <?php } ?>
                                        <?php 
                                            $why_choose_kings_title = get_sub_field('why_choose_kings_title');
                                            if(isset($why_choose_kings_title) && !empty($why_choose_kings_title)){
                                        ?> 
                                        <h5 class="h5"><?php echo $why_choose_kings_title; ?></h5>
                                        <?php } ?>
                                        <?php 
                                            $why_choose_kings_description = get_sub_field('why_choose_kings_description');
                                            if(isset($why_choose_kings_description) && !empty($why_choose_kings_description)){
                                        ?> 
                                        <?php echo $why_choose_kings_description; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="whyChooseSliderWrap">
                        <div class="whyChooseSlider slider">
                            <?php while (have_rows('why_choose_kingsguard')) : the_row(); ?>
                            <div class="whyChooseSlide" data-aos="fade-down" data-aos-duration="1000">
                                <div class="whyChooseBoxWrap">
                                    <div class="whyChooseBox">
                                        <?php
                                            $why_choose_kings_icon = get_field('why_choose_kings_icon');
                                            if (isset($why_choose_kings_icon) && !empty($why_choose_kings_icon)) {
                                                $image_url = wp_get_attachment_image_src($why_choose_kings_icon, 'full')[0];
                                                $image_alt = get_post_meta($why_choose_kings_icon, '_wp_attachment_image_alt', true);
                                        ?>
                                        <div class="whyChooseIcon">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        </div>
                                        <?php } ?>
                                        <?php 
                                            $why_choose_kings_title = get_sub_field('why_choose_kings_title');
                                            if(isset($why_choose_kings_title) && !empty($why_choose_kings_title)){
                                        ?> 
                                        <h5 class="h5"><?php echo $why_choose_kings_title; ?></h5>
                                        <?php } ?>
                                        <?php 
                                            $why_choose_kings_description = get_sub_field('why_choose_kings_description');
                                            if(isset($why_choose_kings_description) && !empty($why_choose_kings_description)){
                                        ?> 
                                        <?php echo $why_choose_kings_description; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="customArrows">
                            <button class="prev-btn"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/leftArrow.png" alt="Left Arrow" > </button>
                            <button class="next-btn"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/rightArrow.png" alt="Right Arrow" ></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; wp_reset_query(); ?> 

    <?php if (have_rows('our_services')) : ?>
    <section>
        <div class="clientSec ServiceSec" id="logoSliderWrap">
            <div class="sm_container">
                <div class="clientInner text-center">
                    <?php
                        $our_services_title = get_field('our_services_title');
                        if (isset($our_services_title) && !empty($our_services_title)) {
                    ?>
                    <div class="title" data-aos="fade-down" data-aos-duration="1000">
                        <h2 class="h2"> <?php echo $our_services_title; ?> </h2>
                    </div>
                    <?php } ?>
                    <ul class="nav nav-tabs tabsHead" role="tablist" data-aos="fade-up" data-aos-duration="1000" >
                        <?php $count = 0; while (have_rows('our_services')) : the_row(); ?>
                            <?php 
                                $our_service_tab_title = get_sub_field('our_service_tab_title');
                                if(isset($our_service_tab_title) && !empty($our_service_tab_title)){
                            ?> 
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($count === 0) ? 'active' : ''; ?>" data-toggle="tab" href="#tabs-<?php echo $count; ?>" role="tab"><?php echo $our_service_tab_title; ?></a>
                            </li>
                            <?php } ?>
                        <?php $count++; endwhile; ?>
                    </ul>
                    <div class="tab-content tabsBody" data-aos="fade-up" data-aos-duration="1000" >
                        <?php $counter = 0; while (have_rows('our_services')) : the_row(); ?>
                        <div class="tab-pane <?php echo ($counter === 0) ? 'active' : ''; ?>" id="tabs-<?php echo $counter; ?>" role="tabpanel">
                            <div class="serviceTabWrapper">
                                <div class="row">
                                    <?php
                                        $our_service_image = get_sub_field('our_service_image');
                                        if (isset($our_service_image) && !empty($our_service_image)) {
                                            $image_url = wp_get_attachment_image_src($our_service_image, 'full')[0];
                                            $image_alt = get_post_meta($our_service_image, '_wp_attachment_image_alt', true);
                                    ?>
                                    <div class="col-lg-6">
                                        <div class="serviceTabImg">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-lg-6">
                                        <div class="serviceTabCont">
                                            <div class="serviceTabContInner">
                                                <?php 
                                                    $our_service_title = get_sub_field('our_service_title');
                                                    if(isset($our_service_title) && !empty($our_service_title)){
                                                ?> 
                                                <h3 class="h3"><?php echo $our_service_title; ?></h3>
                                                <?php } ?>
                                                <?php 
                                                    $our_service_description = get_sub_field('our_service_description');
                                                    if(isset($our_service_description) && !empty($our_service_description)){
                                                ?> 
                                                <?php echo $our_service_description; ?>
                                                <?php } ?>     
                                                <?php 
                                                    $our_service_button_title = get_sub_field('our_service_button_title');
                                                    if(isset($our_service_button_title) && !empty($our_service_button_title)){
                                                    $our_service_button_url = get_sub_field('our_service_button_url');
                                                    $our_service_button_target = get_sub_field('our_service_button_target');
                                                    $our_service_button_aria_label = get_sub_field('our_service_button_aria_label');
                                                ?> 
                                                <div class="btnWrap">
                                                    <a href="<?php echo $our_service_button_url; ?>" class="btn-style gradientBtn" target="<?php echo $our_service_button_target; ?>" aria-label="<?php echo $our_service_button_aria_label; ?>"><?php echo $our_service_button_title; ?></a>
                                                </div>
                                                <?php } ?>                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $counter++; endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; wp_reset_query(); ?>
        
    <?php 
        $get_started_title = get_field('get_started_title');
        if(isset($get_started_title) && !empty($get_started_title)){
        $get_started_description = get_field('get_started_description');
        $get_started_button_label = get_field('get_started_button_label');
    ?> 
    <section>
        <div class="joinUsSecOuter getStartedSec mt200">
            <div class="sm_container">
                <div class="joinUsSec" data-aos="zoom-in-down" data-aos-duration="1000">
                    <div class="joinUsInner text-center">
                        <h2 class="mb0 h2"> <?php echo $get_started_title; ?> </h2>
                        <p><?php echo $get_started_description; ?></p>
                        <?php 
                            $get_started_button_label = get_field('get_started_button_label');
                            if(isset($get_started_button_label) && !empty($get_started_button_label)){
                            $get_started_button_link = get_field('get_started_button_link');
                            $get_started_button_target = get_field('get_started_button_target');
                            $get_started_button_aria_label = get_field('get_started_button_aria_label');
                        ?> 
                        <div class="btnWrap">
                            <a href="<?php echo $get_started_button_link; ?>" class="btn-style" target="<?php echo $get_started_button_target; ?>" aria-label="<?php echo $get_started_button_aria_label; ?>"><?php echo $get_started_button_label; ?></a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <!--<?php 
        $why_security_title = get_field('why_security_title');
        if(isset($why_security_title) && !empty($why_security_title)){
        $why_security_description = get_field('why_security_description');
        $why_security_video_url = get_field('why_security_video_url');
    ?> 
    <section>
        <div class="whySecurityMatters mt200">
            <div class="sm_container">
                <div class="whySecurityMattersSec">
                    <div class="whySecurityMattersCont text-center" data-aos="fade-up" data-aos-duration="1000" >
                        <h2 class="mb0 h2"> <?php echo $why_security_title; ?>  </h2>
                        <?php echo $why_security_description; ?>                    
                    </div>
                    <div class="videoSec" data-aos="fade-up" data-aos-duration="1000">
                        <video id="background-video2" loop muted >
                            <source src="<?php echo $why_security_video_url; ?> " type="video/mp4">
                            Your browser does not support the video tag.
                        </video>                   
                        <div id="play-button2" class="playBtn paused2">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/play2.png" alt="Play Button" class="play_icon" />
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/pause2.png" alt="Pause Button" class="pause_icon" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>-->

    
    <?php if (have_rows('client_testimonials_tabs')) : ?>
    <section>
        <div class="clientSec testimonialsSec py200">
            <div class="sm_container">
                <div class="testimonialsInner">
                    <?php
                        $testimonials_title = get_field('testimonials_title');
                        if (isset($testimonials_title) && !empty($testimonials_title)) {
                    ?>
                    <div class="title" data-aos="fade-down" data-aos-duration="1000">
                        <h2 class="mb0 h2"> <?php echo $testimonials_title; ?> </h2>
                    </div>
                    <?php } ?>
                    <div class="tabsHeadWrap">
                        <ul class="nav nav-tabs tabsHead" role="tablist" data-aos="fade-up" data-aos-duration="1000" >
                            <?php $countt = 0; while (have_rows('client_testimonials_tabs')) : the_row(); ?>
                                <?php 
                                    $client_tab_title = get_sub_field('client_tab_title');
                                    if(isset($client_tab_title) && !empty($client_tab_title)){
                                    $client_tab_value = get_sub_field('client_tab_value');
                                ?> 
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($countt === 0) ? 'active' : ''; ?>" data-toggle="tab" href="#tabss-<?php echo $countt; ?>" role="tab"><h4><?php echo $client_tab_title; ?></h4><p><?php echo $client_tab_value; ?></p></a>
                                </li>
                                <?php } ?>
                            <?php $countt++; endwhile; ?>
                        </ul>
                    </div>
                    <div class="tab-content tabsBody" data-aos="fade-up" data-aos-duration="1000" >
                        <?php $counterr = 0; while (have_rows('client_testimonials_tabs')) : the_row(); ?>
                        <div class="tab-pane <?php echo ($counterr === 0) ? 'active' : ''; ?>" id="tabss-<?php echo $counterr; ?>" role="tabpanel">
                            <div class="clientTabWrapper">
                                <?php 
                                    $client_tab_desc = get_sub_field('client_tab_desc');
                                    if(isset($client_tab_desc) && !empty($client_tab_desc)){
                                ?> 
                                <div class="clientTabDesc">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php echo $client_tab_desc; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>   
                                <?php if (have_rows('client_testimonials')) : ?>
                                    <div class="clientTabReview">
                                        <div class="row">
                                            <?php while (have_rows('client_testimonials')) : the_row(); ?>
                                                <div class="col-lg-4">
                                                    <?php 
                                                        $client_video_link = get_sub_field('client_video_link');
                                                        if (isset($client_video_link) && !empty($client_video_link)) {
                                                    ?>
                                                    <div class="clientReviewInner">
                                                        <?php
                                                            $client_image = get_sub_field('client_image');
                                                            if (isset($client_image) && !empty($client_image)) {
                                                                $image_url = wp_get_attachment_image_src($client_image, 'full')[0];
                                                                $image_alt = get_post_meta($client_image, '_wp_attachment_image_alt', true);
                                                        ?>
                                                            <div class="clientTabImg">
                                                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                                <?php 
                                                                    $client_video_link = get_sub_field('client_video_link');
                                                                    if (isset($client_video_link) && !empty($client_video_link)) {
                                                                ?>
                                                                <div class="clientPlayBtnWrap">
                                                                    <a href="#projectVideo" class="playBtn" data-toggle="modal" data-video="<?php echo esc_url($client_video_link); ?>" aria-label="Click here to open Video">
                                                                <i class="fa fa-play after"></i>
                                                                        <i class="fa fa-play"></i>
                                                                    </a>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="clientReviewCont">
                                                            <?php 
                                                                $client_review = get_sub_field('client_review');
                                                                if (isset($client_review) && !empty($client_review)) {
                                                            ?> 
                                                                <div class="clientTabReview">
                                                                    <?php echo $client_review; ?>
                                                                </div>
                                                            <?php } ?>
                                                            <?php 
                                                                $client_name = get_sub_field('client_name');
                                                                if (isset($client_name) && !empty($client_name)) {
                                                            ?> 
                                                                <h3 class="clientName"><?php echo $client_name; ?></h3>
                                                            <?php } ?>
                                                            <?php 
                                                                $client_location = get_sub_field('client_location');
                                                                if (isset($client_location) && !empty($client_location)) {
                                                            ?> 
                                                                <p class="clientLoc"><?php echo $client_location; ?></p>
                                                            <?php } ?>
                                                        </div> 
                                                    </div>
                                                    <?php } else { ?>
                                                        <div class="clientReviewInner">
                                                            <?php 
                                                                $client_project_link = get_sub_field('client_project_link');
                                                            ?> 
                                                            <a href="<?php echo esc_url($client_project_link); ?>" target="_self" aria-label="Click here to go to project page">
                                                                <?php
                                                                    $client_image = get_sub_field('client_image');
                                                                    if (isset($client_image) && !empty($client_image)) {
                                                                        $image_url = wp_get_attachment_image_src($client_image, 'full')[0];
                                                                        $image_alt = get_post_meta($client_image, '_wp_attachment_image_alt', true);
                                                                ?>
                                                                    <div class="clientTabImg">
                                                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="clientReviewCont">
                                                                    <?php 
                                                                        $client_review = get_sub_field('client_review');
                                                                        if (isset($client_review) && !empty($client_review)) {
                                                                    ?> 
                                                                        <div class="clientTabReview">
                                                                            <?php echo $client_review; ?>
                                                                        </div>
                                                                    <?php } ?>   
                                                                    <?php 
                                                                        $client_name = get_sub_field('client_name');
                                                                        if (isset($client_name) && !empty($client_name)) {
                                                                    ?> 
                                                                        <h3 class="clientName"><?php echo $client_name; ?></h3>
                                                                    <?php } ?>
                                                                    <?php 
                                                                        $client_location = get_sub_field('client_location');
                                                                        if (isset($client_location) && !empty($client_location)) {
                                                                    ?> 
                                                                        <p class="clientLoc"><?php echo $client_location; ?></p>
                                                                    <?php } ?>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                <?php endif; wp_reset_query(); ?>

                            </div>
                        </div>
                        <?php $counterr++; endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; wp_reset_query(); ?>
</div>
 <?php get_footer(); ?>
