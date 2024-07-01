<?php
/**
 * The template for displaying all single industries
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

            <?php if (have_rows('industries_content')) : ?>
            <div class="projectDetailCont py100">
                <div class="sm_container">
                    <?php while (have_rows('industries_content')) : the_row(); ?>
                    <div class="projectContentInner">
                        <?php 
                            $industry_title = get_sub_field('industry_title');
                            if(isset($industry_title) && !empty($industry_title)){ 
                        ?>
                        <h2 class="h2" data-aos="fade-down" data-aos-duration="1000">
                            <?php echo $industry_title; ?>
                        </h2>
                        <?php } ?>
                        <?php if (have_rows('industry_description')) : ?>
                        <div class="projectContInner">
                            <div class="row">
                                <?php while (have_rows('industry_description')) : the_row(); ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12" data-aos="fade-down" data-aos-duration="1000">
                                        <?php 
                                            $industry_desc_cont = get_sub_field('industry_desc_cont');
                                            if(isset($industry_desc_cont) && !empty($industry_desc_cont)){ 
                                        ?>
                                            <div class="project_detail_story_text">
                                                <?php echo $industry_desc_cont; ?>                                        
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

            <div class="industryBlock">
                <div class="sm_container">
                    <div class="industryBlockInner">
                        <div class="row">
                            <?php
                                $about_industry_image = get_field('about_industry_image');
                                if (isset($about_industry_image) && !empty($about_industry_image)) {
                                    $image_url = wp_get_attachment_image_src($about_industry_image, 'full')[0];
                                    $image_alt = get_post_meta($about_industry_image, '_wp_attachment_image_alt', true);
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="industryBlockImg">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                </div>
                            </div>
                            <?php } ?>
                            <?php 
                                $about_industry_title = get_field('about_industry_title');
                                if(isset($about_industry_title) && !empty($about_industry_title)){ 
                                $about_industry_description = get_field('about_industry_description');
                                $industry_button_label = get_field('industry_button_label');
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="industryBlockCont">
                                    <h3 class="h3"><?php echo $about_industry_title; ?></h3>
                                    <p><?php echo $about_industry_description; ?></p>
                                    <?php 
                                        if (isset($industry_button_label) && !empty($industry_button_label)) {
                                            $industry_button_link = get_field('industry_button_link');
                                            $industry_button_target = get_field('industry_button_target');
                                            $industry_button_aria_label = get_field('industry_button_aria_label');
                                        ?> 
                                        <div class="btnWrap">
                                            <a href="<?php echo $industry_button_link; ?>" class="btn-style" target="<?php echo $industry_button_target; ?>" aria-label="<?php echo $industry_button_aria_label; ?>"><?php echo $industry_button_label; ?></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $homepage = get_page_by_path('home');
        if ($homepage) {
        $homepage_id = $homepage->ID;

        $get_started_title = get_field('get_started_title', $homepage_id);
        if (isset($get_started_title) && !empty($get_started_title)) {
            $get_started_description = get_field('get_started_description', $homepage_id);
            $get_started_button_label = get_field('get_started_button_label', $homepage_id);
            ?> 
            <section>
                <div class="joinUsSecOuter getStartedSec mt200">
                    <div class="sm_container">
                        <div class="joinUsSec" data-aos="zoom-in-down" data-aos-duration="1000">
                            <div class="joinUsInner text-center">
                                <h2 class="mb0 h2"> <?php echo $get_started_title; ?> </h2>
                                <p><?php echo $get_started_description; ?></p>
                                <?php 
                                    if (isset($get_started_button_label) && !empty($get_started_button_label)) {
                                        $get_started_button_link = get_field('get_started_button_link', $homepage_id);
                                        $get_started_button_target = get_field('get_started_button_target', $homepage_id);
                                        $get_started_button_aria_label = get_field('get_started_button_aria_label', $homepage_id);
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
            <?php
        }
    } ?>
</div>
<?php
get_footer();
