<?php

/**
 * Template Name: Quote Page
**/
get_header();

?>

<div class="pageBody">
    <?php
        $banner_title = get_field('quotation_banner_title');
        if (isset($banner_title) && !empty($banner_title)) {
        $banner_description = get_field('quotation_banner_description');
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
    <section class="quoteWrapper py100">
        <div class="sm_container">
            <div class="quoteInnerWrapper">
                <?php echo do_shortcode('[wpforms id="750" title="false"]'); ?>
            </div>
        </div>
    </section>
    <section class="quoteWrapper py100">
        <div class="sm_container">
            <div class="quoteInnerWrapper">
                <?php echo do_shortcode('[contact_form]'); ?>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>