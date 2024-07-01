<?php

/**
 * Template Name: Industries Page
**/
get_header();

?>

<div class="pageBody">
    <div class="industries_section_one pb100">
        <div class="sm_container">
            <?php
                $industry_page_title = get_field('industry_page_title');
                if (isset($industry_page_title) && !empty($industry_page_title)) {
            ?>
            <div class="title" data-aos="fade-down" data-aos-duration="1000">
                <h2 class="mb0 h2"> <?php echo $industry_page_title; ?> </h2>
            </div>
            <?php } ?>

            <?php
                $args = array(
                    'post_type' => 'industries',
                    'posts_per_page' => -1,
                );

                $industries_query = new WP_Query($args);
                if ($industries_query->have_posts()) :
            ?>
            <div class="row mb30">
                <?php $count = 0; while ($industries_query->have_posts()) : $industries_query->the_post(); ?>
                <div class="column col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="industries_card_body_div" data-aos="fade-down" data-aos-duration="1000">
                        <a href="<?php echo get_permalink(); ?>">
                            <?php
                                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full') 
                            ?>
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($project_title); ?>" />
                            <?php 
                                $industry_title = get_the_title();
                            ?> 
                            <div class="indus_overlay">
                                <p><?php echo $industry_title; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php $count++; endwhile; ?>
            </div>
            <?php wp_reset_postdata(); else : ?>
                <p><?php _e('No industries found.', 'text-domain'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>