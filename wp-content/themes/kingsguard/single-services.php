<?php
/**
 * The template for displaying all single services
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-service
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
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
    
    <?php $homepage = get_page_by_path('home');
        if ($homepage) {
        $homepage_id = $homepage->ID;

        $get_started_title = get_field('get_started_title', $homepage_id);
        if (isset($get_started_title) && !empty($get_started_title)) {
            $get_started_description = get_field('get_started_description', $homepage_id);
            $get_started_button_label = get_field('get_started_button_label', $homepage_id);
            ?> 
            <section>
                <div class="joinUsSecOuter getStartedSec py100">
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

    <?php 
        $services_sec_title = get_field('services_sec_title');
        if(isset($services_sec_title) && !empty($services_sec_title)){ 
        $services_sec_desc = get_field('services_sec_desc');
    ?>
    <section>
        <div class="securityServiceSec bgTexture py200">
            <div class="sm_container">
                <div class="securityServiceInner">
                    <div class="securityServiceTitle">
                        <div class="title" data-aos="fade-down" data-aos-duration="1000">
                            <h2 class="h2"><?php echo $services_sec_title; ?></h2>
                        </div>
                        <div class="description text-center" data-aos="fade-down" data-aos-duration="1000">
                            <?php echo $services_sec_desc; ?>
                        </div>
                    </div>

                    <div class="securityServiceBlock" data-aos="fade-down" data-aos-duration="1000">
                        <div class="row mb30">
                            <?php if (have_rows('security_service_grid')) : ?>
                                <?php while (have_rows('security_service_grid')) : the_row(); ?>
                                    <div class="column col-md-4 col-sm-6">
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
                                <?php $count++; endwhile; ?>
                            <?php endif; wp_reset_query(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php }  ?>
</div>
<?php
get_footer();
