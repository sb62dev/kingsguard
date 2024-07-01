<?php

/**
 * Template Name: Blog Page
**/
get_header();

?>

<div class="pageBody">
    <?php
        $banner_title = get_field('blog_banner_title');
        if (isset($banner_title) && !empty($banner_title)) {
        $banner_description = get_field('blog_banner_description');
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


    <section class="featured_section cmnPadd pb-0">
        <div class="sm_container">
            <div class="title" data-aos="fade-down" data-aos-duration="1000">
                <h2 class="h2"> Featured Posts </h2>
            </div>
            <div class="row mb30">
                <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => -1,
                    );

                    $the_query = new WP_Query($args);

                    if ($the_query->have_posts()) :
                        while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <div class="column col-lg-6 col-md-6 col-sm-12">
                                <div class="border_div" data-aos="fade-down" data-aos-duration="1000">
                                    <div class="fetured_card_body_div">
                                        <div class="featur_card_img_div">
                                            <?php if (has_post_thumbnail()) {
                                                the_post_thumbnail('full', ['alt' => get_the_title()]);
                                            } else { ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/our-mission.png" alt="<?php the_title(); ?>">
                                            <?php } ?>
                                        </div>
                                        <div class="fetured_card_text_main">
                                            <div class="fetured_card_text1">
                                                <p>Authored By: <?php the_author(); ?></p>
                                                <div>
                                                    <label for=""><?php echo estimated_reading_time(); ?> Min read</label>
                                                </div>
                                            </div>
                                            <div class="fetured_card_text2">
                                                <h3><?php the_title(); ?></h3>
                                                <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                                <a href="<?php the_permalink(); ?>" class="btn-style outlinedBtn">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    else : ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>

                <?php
                    function estimated_reading_time() {
                        $content = get_post_field('post_content', get_the_ID());
                        $word_count = str_word_count(strip_tags($content));
                        $reading_time = ceil($word_count / 200);
                        return $reading_time;
                    }
                ?>
            </div>
        </div>
    </section>


    <?php 
        $stay_informed_title = get_field('stay_informed_title');
        if(isset($stay_informed_title) && !empty($stay_informed_title)){
        $stay_informed_description = get_field('stay_informed_description');
    ?> 
    <section>
        <div class="joinUsSecOuter py200">
            <div class="sm_container">
                <div class="joinUsSec">
                    <div class="joinUsInner text-center">
                        <h2 class="mb0 h2"> <?php echo $stay_informed_title; ?> </h2>
                        <?php echo $stay_informed_description; ?>
                        <form class="getstarted_input_main">
                            <input type="email" placeholder="Enter your email" required>
                            <button type="submit" class="btn-style gradientBtn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
</div>

<?php get_footer(); ?>