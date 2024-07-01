<?php

/**
 * Template Name: Contact Page
**/
get_header();

?>

<div class="pageBody">
    <section class="contact_section_one pb100">
        <div class="sm_container">
            <?php
                $contact_page_title = get_field('contact_page_title');
                if (isset($contact_page_title) && !empty($contact_page_title)) {
            ?>
            <div class="title" data-aos="fade-down" data-aos-duration="1000">
                <h2 class="mb0 h2"> <?php echo $contact_page_title; ?> </h2>
            </div>
            <?php } ?>
            <?php if (have_rows('info_card')) : ?>
                <div class="contactUsBlock">
                    <div class="mb30 row">
                        <?php while (have_rows('info_card')) : the_row(); ?>
                        <div class="column col-lg-6 col-md-6 col-sm-12">
                            <div class="border_div" data-aos="fade-down" data-aos-duration="1000">
                                <div class="contact_card_body_div">
                                    <?php
                                        $info_card_icon = get_sub_field('info_card_icon');
                                        if (isset($info_card_icon) && !empty($info_card_icon)) {
                                            $image_url = wp_get_attachment_image_src($info_card_icon, 'full')[0];
                                            $image_alt = get_post_meta($info_card_icon, '_wp_attachment_image_alt', true);
                                    ?>
                                    <div class="contactCardIcon">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                                    </div>
                                    <?php } ?>   
                                    <?php 
                                        $info_card_title = get_sub_field('info_card_title');
                                        if(isset($info_card_title) && !empty($info_card_title)){
                                    ?>                          
                                    <h3 class="h3"><?php echo $info_card_title; ?></h3>
                                    <?php } ?>
                                    <?php 
                                        $info_card_description = get_sub_field('info_card_description');
                                        if(isset($info_card_description) && !empty($info_card_description)){
                                    ?>
                                        <?php echo $info_card_description; ?>
                                    <?php } ?>
                                    <?php 
                                        $info_card_button_label = get_sub_field('info_card_button_label');
                                        if(isset($info_card_button_label) && !empty($info_card_button_label)){
                                        $info_card_button_link = get_sub_field('info_card_button_link');
                                        $info_card_button_target = get_sub_field('info_card_button_target');
                                        $info_card_button_aria_label = get_sub_field('info_card_button_aria_label');
                                    ?> 
                                    <div class="btnWrap">
                                        <a href="<?php echo $info_card_button_link; ?>" class="btn-style outlinedBtn" target="<?php echo $info_card_button_target; ?>" aria-label="<?php echo $info_card_button_aria_label; ?>"><?php echo $info_card_button_label; ?></a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?> 
            <?php if (have_rows('contact_info')) : ?>
            <div class="contactInfoBlock">
                <div class="row">
                    <?php while (have_rows('contact_info')) : the_row(); ?>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="contact_info" data-aos="fade-down" data-aos-duration="1000">
                            <?php
                                $contact_info_icon = get_sub_field('contact_info_icon');
                                if (isset($contact_info_icon) && !empty($contact_info_icon)) {
                                    $image_url = wp_get_attachment_image_src($contact_info_icon, 'full')[0];
                                    $image_alt = get_post_meta($contact_info_icon, '_wp_attachment_image_alt', true);
                            ?>
                                <div class="contactInfoIcon">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                                </div>
                            <?php } ?>   
                            <?php 
                                $contact_info_description = get_sub_field('contact_info_description');
                                if(isset($contact_info_description) && !empty($contact_info_description)){
                            ?>
                                <div class="contactInfoCont">
                                    <?php echo $contact_info_description; ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; ?> 
        </div>
    </section>
</div>

<?php get_footer(); ?>