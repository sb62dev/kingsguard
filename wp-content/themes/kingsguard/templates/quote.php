<?php

/**
 * Template Name: Quote Page
**/
get_header();

?>

<div class="pageBody quotePageBody">
    <section class="quoteWrapper pb50">
        <div class="sm_container">
            <div class="quoteInnerWrap">
                <div class="row">
                    <div class="col-md-3">
                        <?php
                            $banner_title = get_field('quotation_banner_title');
                            if (isset($banner_title) && !empty($banner_title)) {
                            $banner_description = get_field('quotation_banner_description');
                            $contact_detail_title = get_field('contact_detail_title');
                            $contact_detail_description = get_field('contact_detail_description');
                        ?>
                        <section>
                            <div class="commonBannerWrapper quoteWrapper quoteWrapperNoBG">
                                <div class="commonBanner" data-aos="fade-down" data-aos-duration="1000">
                                    <div class="bannerContent">
                                        <h1 class="mb0 h2"> <?php echo $banner_title; ?> </h1>
                                        <div class="banner_cont"><?php echo $banner_description; ?></div>
                                        <div class="contactDetailWrap contactDesktop">
                                            <div class="quoteleft_heading"><?php echo $contact_detail_title; ?></div>
                                            <div class="quoteleft_adrs">
                                                <?php echo $contact_detail_description; ?>
                                            </div>
                                            <?php 
                                                $hiring_button_text = get_field('hiring_button_text');
                                                if(isset($hiring_button_text) && !empty($hiring_button_text)){
                                                $hiring_button_link = get_field('hiring_button_link');
                                                $hiring_button_target = get_field('hiring_button_target');
                                                $hiring_button_aria_label = get_field('hiring_button_aria_label');
                                            ?> 
                                            <div class="hiringBtnWrap">
                                                <div class="btnWrap">
                                                    <a href="<?php echo $hiring_button_link; ?>" class="btn-style gradientBtn" target="<?php echo $hiring_button_target; ?>" aria-label="<?php echo $hiring_button_aria_label; ?>"><?php echo $hiring_button_text; ?></a>
                                                </div>
                                            </div>
                                            <?php } ?>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php } ?>
                    </div>
                    <div class="col-md-9">
                        <div class="quoteInnerWrapper">
                            <?php echo do_shortcode('[contact_form]'); ?>
                        </div>
                    </div>
                    <?php
                        $contact_detail_title = get_field('contact_detail_title');
                        if (isset($contact_detail_title) && !empty($contact_detail_title)) {
                        $contact_detail_description = get_field('contact_detail_description');
                    ?>
                    <div class="col-md-12">
                        <div class="contactDetailWrap contactMobile">
                            <div class="quoteleft_heading"><?php echo $contact_detail_title; ?></div>
                            <div class="quoteleft_adrs">
                                <?php echo $contact_detail_description; ?>
                            </div>
                            <?php 
                                $hiring_button_text = get_field('hiring_button_text');
                                if(isset($hiring_button_text) && !empty($hiring_button_text)){
                                $hiring_button_link = get_field('hiring_button_link');
                                $hiring_button_target = get_field('hiring_button_target');
                                $hiring_button_aria_label = get_field('hiring_button_aria_label');
                            ?> 
                            <div class="hiringBtnWrap">
                                <div class="btnWrap">
                                    <a href="<?php echo $hiring_button_link; ?>" class="btn-style gradientBtn" target="<?php echo $hiring_button_target; ?>" aria-label="<?php echo $hiring_button_aria_label; ?>"><?php echo $hiring_button_text; ?></a>
                                </div>
                            </div>
                            <?php } ?>   
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section> 
</div>

<?php get_footer(); ?>