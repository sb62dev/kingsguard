<?php

/**
 * Template Name: Projects Page
**/
get_header();

?>

<div class="pageBody">
    
    <section class="projects_section_one">
        <div class="sm_container">
            <?php
                $page_title = get_field('page_title');
                if (isset($page_title) && !empty($page_title)) {
            ?>
            <div class="title" data-aos="fade-down" data-aos-duration="1000">
                <h2 class="h2"> <?php echo $page_title; ?> </h2>
            </div>
            <?php } ?>
            <div class="projects_top_inputs_main">
                <div class="projects_top_input_div">
                    <input type="text" placeholder="Search" class="inputField">
                    <span class="searchIcon"><i class="fa fa-search"></i></span>
                </div>
                <div class="projects_top_btn_div">
                    <a href="#" class="btn-style gradientBtn">Search</a>
                </div>
            </div>
            <div class="projects_top_selects_main">
                <div class="row mb15">
                    <div class="column col-md-4">
                        <div class="projects_top_select_inner">
                            <label for="">Location</label>
                            <select name="" id="" class="selectField">
                                <option value="" selected disabled>Select</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                    </div>

                    <div class="column col-md-4">
                        <div class="projects_top_select_inner">
                            <label for="">Location</label>
                            <select name="" id="" class="selectField">
                                <option value="" selected disabled>Select</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                    </div>

                    <div class="column col-md-4">
                        <div class="projects_top_select_inner">
                            <label for="">Location</label>
                            <select name="" id="" class="selectField">
                                <option value="" selected disabled>Select</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                            <div class="clearBtn">
                                <a href="#" class="clearLink">Clear</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="projects_section_two pb100">
        <div class="sm_container">
            <div class="row">
                <?php
                $args = array(
                    'post_type' => 'projects',
                    'posts_per_page' => -1,
                );

                $projects_query = new WP_Query($args);

                if ($projects_query->have_posts()) :
                    $count = 0;
                    while ($projects_query->have_posts()) : $projects_query->the_post();
                        $location = get_field('location');
                        $project_title = get_the_title();
                        $project_link = get_permalink();
                        $image_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/assets/images/projects.jpg';
                        
                        if ($count == 0) {
                            $column_classes = 'col-lg-4 col-md-5 col-sm-12';
                        } elseif ($count == 1) {
                            $column_classes = 'col-lg-8 col-md-7 col-sm-12';
                        } else {
                            $column_classes = 'col-lg-4 col-md-6 col-sm-12';
                        }
                ?>
                <div class="<?php echo $column_classes; ?>">
                    <div class="projects_sec2_small_card_body">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($project_title); ?>">
                        <div class="project_overlay">
                            <div class="<?php echo $count == 1 ? 'project_bigcard_text' : 'project_card_text'; ?>">
                                <a href="<?php echo esc_url($project_link); ?>"><?php echo esc_html($project_title); ?></a>
                                <p><?php echo esc_html($location); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $count++; endwhile; wp_reset_postdata(); else : ?>
                <p><?php _e('No projects found.', 'text-domain'); ?></p>
                <?php endif; ?>
            </div>
            <div class="load_more_btn">
                <a href="#" class="btn-style whiteOutlinedBtn">Load More</a>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>