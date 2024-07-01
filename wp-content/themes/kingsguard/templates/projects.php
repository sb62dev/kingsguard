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
                if ($page_title) {
            ?>
            <div class="title" data-aos="fade-down" data-aos-duration="1000">
                <h2 class="h2"><?php echo esc_html($page_title); ?></h2>
            </div>
            <?php } ?>
            <div class="projects_top_selects_main" data-aos="fade-down" data-aos-duration="1000">
                <div class="row mb15">
                    <div class="column col-md-6">
                        <div class="projects_top_select_inner">
                            <label for="city-select">City</label>
                            <select name="city" id="city-select" class="selectField">
                                <option value="" selected disabled>Select</option>
                                <option value="all">All</option>
                                <?php
                                $cities = get_terms(array(
                                    'taxonomy' => 'cities',
                                    'hide_empty' => false,
                                ));
                                foreach ($cities as $city) {
                                    echo '<option value="' . esc_attr($city->slug) . '">' . esc_html($city->name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="column col-md-6">
                        <div class="projects_top_select_inner">
                            <label for="service-select">Service Type</label>
                            <select name="service" id="service-select" class="selectField">
                                <option value="" selected disabled>Select</option>
                                <option value="all">All</option>
                                <?php
                                $service_types = get_terms(array(
                                    'taxonomy' => 'service-types',
                                    'hide_empty' => false,
                                ));
                                foreach ($service_types as $service_type) {
                                    echo '<option value="' . esc_attr($service_type->slug) . '">' . esc_html($service_type->name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="projectLoader" class="loader">
        <div class="loading-container">
            <div class="loading-progress"></div>
        </div>
    </div>
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

                        $project_cities = get_the_terms(get_the_ID(), 'cities');
                        $project_services = get_the_terms(get_the_ID(), 'service-types');
  
                        if($project_cities && !is_wp_error($project_cities)) { 
                            $project_city_names = wp_list_pluck($project_cities, 'name');
                            $project_city_names_str = implode(', ', $project_city_names);
                        } else {
                            $project_city_names_str = '';
                        }

                        if($project_services && !is_wp_error($project_services)) { 
                            $project_service_names = wp_list_pluck($project_services, 'name');
                            $project_service_names_str = implode(', ', $project_service_names);
                        } else {
                            $project_service_names_str = '';
                        }

                        if ($count == 0) {
                            $column_classes = 'col-lg-4 col-md-5 col-sm-12';
                        } elseif ($count == 1) {
                            $column_classes = 'col-lg-8 col-md-7 col-sm-12';
                        } else {
                            $column_classes = 'col-lg-4 col-md-6 col-sm-12';
                        }
                ?>
                <div class="<?php echo $column_classes; ?>" data-aos="fade-down" data-aos-duration="1000" data-city="<?php echo esc_attr($project_city_names_str); ?>" data-service="<?php echo esc_attr($project_service_names_str); ?>">
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
                    <div class="col-sm-12">
                        <div class="noProjectFound"><?php _e('No projects found.', 'text-domain'); ?></div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- <div class="load_more_btn" data-aos="fade-down" data-aos-duration="1000">
                <a href="#" class="btn-style whiteOutlinedBtn">Load More</a>
            </div> -->
        </div>
    </section>
</div>

<?php get_footer(); ?>