<?php

/**
 * Template Name: About Page
**/
get_header();

?>

<div class="pageBody">
<?php
    $banner_title = get_field('about_banner_heading');
    if (isset($banner_title) && !empty($banner_title)) {
    $banner_description = get_field('about_banner_description');
?>
<section>
    <div class="commonBannerWrapper">
        <div class="sm_container">
            <div class="commonBanner" data-aos="fade-down" data-aos-duration="1000">
                <div class="bannerContent">
                    <h1 class="mb0 h2"> <?php echo $banner_title; ?> </h1>
                    <div class="banner_cont"><?php echo $banner_description; ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if (have_rows('our_goals')) : ?>
<section>
    <div class="aboutUsSec mt200">
        <div class="sm_container">
            <div class="aboutUsInner" data-aos="fade-down" data-aos-duration="1000">
                <div class="row">
                    <?php
                        $our_goals_image = get_field('our_goals_image');
                        if (isset($our_goals_image) && !empty($our_goals_image)) {
                            $image_url = wp_get_attachment_image_src($our_goals_image, 'full')[0];
                            $image_alt = get_post_meta($our_goals_image, '_wp_attachment_image_alt', true);
                    ?>
                    <div class="col-md-6">
                        <div class="aboutUsImg">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">                        
                        </div>
                    </div>
                    <?php } ?>

                    <div class="col-md-6">
                        <div class="aboutAccordion">
                            <div class="accordion" id="goalsAccordian">
                                <?php $count = 0; while (have_rows('our_goals')) : the_row(); ?>
                                <div class="card">
                                    <?php 
                                        $our_goal_title = get_sub_field('our_goal_title');
                                        if(isset($our_goal_title) && !empty($our_goal_title)){
                                    ?> 
                                    <div class="card-header" id="heading<?php echo $count; ?>">
                                        <h3 class="h3 mb-0 <?php echo ($count === 0) ? '' : 'collapsed'; ?>" data-toggle="collapse" data-target="#collapse<?php echo $count; ?>" aria-expanded="<?php echo ($count === 0) ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $count; ?>">
                                            <?php echo $our_goal_title; ?>
                                            <span class="accordArrow">
                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/accordion-arrow.svg" alt="" />
                                            </span>
                                        </h3>
                                    </div>
                                    <?php } ?>
                                    <?php 
                                        $our_goal_description = get_sub_field('our_goal_description');
                                        if(isset($our_goal_description) && !empty($our_goal_description)){
                                    ?> 
                                    <div id="collapse<?php echo $count; ?>" class="collapse <?php echo ($count === 0) ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $count; ?>" data-parent="#goalsAccordian">
                                        <div class="card-body">
                                            <?php echo $our_goal_description; ?>                                      
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php $count++; endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?> 

<?php if (have_rows('why_choose_kingsguard')) : ?>
<section>
    <div class="whyChooseUs mt200">
        <div class="sm_container">
            <div class="whyChooseInner" data-aos="fade-down" data-aos-duration="1000">
                <?php
                    $why_choose_kings_title = get_field('why_choose_kings_title');
                    if (isset($why_choose_kings_title) && !empty($why_choose_kings_title)) {
                ?>
                <h2 class="mb0 h2"> <?php echo $why_choose_kings_title; ?> </h2>
                <?php } ?>
                <div class="whyChooseBlocks">
                    <div class="row">
                        <?php while (have_rows('why_choose_kingsguard')) : the_row(); ?>
                        <?php 
                            $why_choose_title = get_sub_field('why_choose_title');
                            if(isset($why_choose_title) && !empty($why_choose_title)){
                        ?> 
                        <div class="col-md-4">
                            <div class="whyChooseBoxWrap">
                                <div class="whyChooseBox">
                                    <?php 
                                        $why_choose_title = get_sub_field('why_choose_title');
                                        if(isset($why_choose_title) && !empty($why_choose_title)){
                                    ?> 
                                    <h5 class="h5"><?php echo $why_choose_title; ?></h5>
                                    <?php } ?>
                                    <?php 
                                        $why_choose_description = get_sub_field('why_choose_description');
                                        if(isset($why_choose_description) && !empty($why_choose_description)){
                                    ?> 
                                    <?php echo $why_choose_description; ?>
                                    <?php } ?>
                                    <?php 
                                        $why_choose_btn_text = get_sub_field('why_choose_btn_text');
                                        if(isset($why_choose_btn_text) && !empty($why_choose_btn_text)){
                                        $why_choose_btn_link = get_sub_field('why_choose_btn_link');
                                        $why_choose_btn_target = get_sub_field('why_choose_btn_target');
                                        $why_choose_btn_aria_label = get_sub_field('why_choose_btn_aria_label');
                                    ?> 
                                    <div class="btnWrap">
                                        <a href="<?php echo $why_choose_btn_link; ?>" class="btn-style outlinedBtn" target="<?php echo $why_choose_btn_target; ?>" aria-label="<?php echo $why_choose_btn_aria_label; ?>"><?php echo $why_choose_btn_text; ?></a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="whyChooseSliderWrap">
                    <div class="whyChooseSlider slider">
                        <?php while (have_rows('why_choose_kingsguard')) : the_row(); ?>
                        <div class="whyChooseSlide">
                            <?php 
                                $why_choose_title = get_sub_field('why_choose_title');
                                if(isset($why_choose_title) && !empty($why_choose_title)){
                            ?> 
                                <div class="whyChooseBoxWrap">
                                    <div class="whyChooseBox">
                                        <?php 
                                            $why_choose_title = get_sub_field('why_choose_title');
                                            if(isset($why_choose_title) && !empty($why_choose_title)){
                                        ?> 
                                        <h5 class="h5"><?php echo $why_choose_title; ?></h5>
                                        <?php } ?>
                                        <?php 
                                            $why_choose_description = get_sub_field('why_choose_description');
                                            if(isset($why_choose_description) && !empty($why_choose_description)){
                                        ?> 
                                        <?php echo $why_choose_description; ?>
                                        <?php } ?>
                                        <?php 
                                            $why_choose_btn_text = get_sub_field('why_choose_btn_text');
                                            if(isset($why_choose_btn_text) && !empty($why_choose_btn_text)){
                                            $why_choose_btn_link = get_sub_field('why_choose_btn_link');
                                            $why_choose_btn_target = get_sub_field('why_choose_btn_target');
                                            $why_choose_btn_aria_label = get_sub_field('why_choose_btn_aria_label');
                                        ?> 
                                        <div class="btnWrap">
                                            <a href="<?php echo $why_choose_btn_link; ?>" class="btn-style outlinedBtn" target="<?php echo $why_choose_btn_target; ?>" aria-label="<?php echo $why_choose_btn_aria_label; ?>"><?php echo $why_choose_btn_text; ?></a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
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
<?php endif; ?> 

<?php if (have_rows('our_clients')) : ?>
<section>
    <div class="clientSec py200">
        <div class="sm_container">
            <div class="clientInner text-center" data-aos="fade-down" data-aos-duration="1000">
                <ul class="nav nav-tabs tabsHead" role="tablist">
                    <?php $counter = 0; while (have_rows('our_clients')) : the_row(); ?>
                        <?php 
                            $client_title = get_sub_field('client_title');
                            if(isset($client_title) && !empty($client_title)){
                        ?> 
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($counter === 0) ? 'active' : ''; ?>" data-toggle="tab" href="#tabs-<?php echo $counter; ?>" role="tab"><?php echo $client_title; ?></a>
                        </li>
                        <?php } ?>
                    <?php $counter++; endwhile; ?>
                </ul>
                <div class="tab-content tabsBody">
                    <?php $contCounter = 0; while (have_rows('our_clients')) : the_row(); ?>
                        <div class="tab-pane <?php echo ($contCounter === 0) ? 'active' : ''; ?>" id="tabs-<?php echo $contCounter; ?>" role="tabpanel">
                            <?php if (have_rows('client_logos')) : ?>
                            <div class="slider clientSlider clientLogo">
                                <?php while (have_rows('client_logos')) : the_row(); ?>
                                <div class="clientLogoSlide">
                                    <?php
                                        $client_logo_image = get_sub_field('client_logo_image');
                                        if (isset($client_logo_image) && !empty($client_logo_image)) {
                                            $image_url = wp_get_attachment_image_src($client_logo_image, 'full')[0];
                                            $image_alt = get_post_meta($client_logo_image, '_wp_attachment_image_alt', true);
                                    ?>
                                    <div class="clientLogoSlideInner">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php endwhile; ?>
                            </div>
                            <?php endif; wp_reset_query(); ?> 
                        </div>
                    <?php $contCounter++; endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; wp_reset_query(); ?> 

<?php 
    $join_us_title = get_field('join_us_title');
    if(isset($join_us_title) && !empty($join_us_title)){
    $join_us_description = get_field('join_us_description');
    $join_button_text = get_field('join_button_text');
?> 
<section>
    <div class="joinUsSecOuter py200">
        <div class="sm_container">
            <div class="joinUsSec">
                <div class="joinUsInner text-center">
                    <h2 class="mb0 h2"> <?php echo $join_us_title; ?> </h2>
                    <?php echo $join_us_description; ?>
                    <?php 
                        $join_button_text = get_field('join_button_text');
                        if(isset($join_button_text) && !empty($join_button_text)){
                        $join_button_link = get_field('join_button_link');
                        $join_button_target = get_field('join_button_target');
                        $join_button_aria_label = get_field('join_button_aria_label');
                    ?> 
                    <div class="btnWrap">
                        <a href="<?php echo $join_button_link; ?>" class="btn-style" target="<?php echo $join_button_target; ?>" aria-label="<?php echo $join_button_aria_label; ?>"><?php echo $join_button_text; ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php
    $map_image = get_field('map_image');
    if (isset($map_image) && !empty($map_image)) {
        $image_url = wp_get_attachment_image_src($map_image, 'full')[0];
        $image_alt = get_post_meta($map_image, '_wp_attachment_image_alt', true);
?>
<section>
    <div class="mapSection mt200">
        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
    </div>
</section>
<?php } ?>

</div>

<?php get_footer(); ?>