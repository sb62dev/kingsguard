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
        if(isset($montoring_banner_title) && !empty($montoring_banner_title))
        $montoring_banner_des = get_field('montoring_banner_des');
        $montoring_banner_bg_img = get_field('montoring_banner_bg_img');
        $image_url = wp_get_attachment_image_src($montoring_banner_bg_img, 'full')[0]; {
    ?> 
    <div class="monitoringBannerWrap" style="background-image: url('<?php echo $image_url; ?>');">
        <div class="sm_container">
            <div class="monitoringBannerInner">
                <div class="monitoringBannerCont animated-text" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <h1 class="h2"><?php echo $montoring_banner_title; ?></h1>
                    <?php echo $montoring_banner_des; ?>
                    <?php 
                        $montoring_banner_btn_text = get_field('montoring_banner_btn_text');
                        if(isset($montoring_banner_btn_text) && !empty($montoring_banner_btn_text)){
                        $montoring_banner_btn_link = get_field('montoring_banner_btn_link');
                        $montoring_banner_btn_target = get_field('montoring_banner_btn_target');
                        $montoring_banner_btn_aria_label = get_field('montoring_banner_btn_aria_label');
                    ?> 
                    <div class="hiringBtnWrap">
                        <div class="btnWrap">
                            <a href="<?php echo $montoring_banner_btn_link; ?>" class="btn-style gradientBtn" target="<?php echo $montoring_banner_btn_target; ?>" aria-label="<?php echo $montoring_banner_btn_aria_label; ?>"><?php echo $montoring_banner_btn_text; ?></a>
                        </div>
                    </div>
                    <?php } ?>   
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php get_footer(); ?>