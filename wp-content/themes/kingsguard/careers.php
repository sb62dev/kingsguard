<?php
/**
 * Template Name: Jobseekers Carrer LP
**/ 

get_header(); 

?> 

<div class="pageBody">
    <section class="jobListingWrapper">
        <div class="sm_container">
            <?php
                $career_page_title = get_field('career_page_title');
                if ($career_page_title) {
            ?>
            <div class="title" data-aos="fade-down" data-aos-duration="1000">
                <h2 class="h2"><?php echo esc_html($career_page_title); ?></h2>
            </div>
            <?php } ?>

            <div class="jobSearchForm">
                <form method="get" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="sr-only" for="keywords">Keywords</label>
                                <input type="text" class="inputField" value="<?php echo isset($_GET['search_keywords']) ? esc_attr($_GET['search_keywords']) : ''; ?>" placeholder="Keywords" id="keywords" name="search_keywords">
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-12">
                            <div class="form-group">
                                <select name="selected_jobtype" id="jobtype" class="selectField">
                                    <option value="-1">Job Type</option>
                                    <?php
                                    $jobs_job_types = get_terms(array(
                                        'taxonomy' => 'jobs_job_types',
                                        'hide_empty' => false,
                                    ));
                                    foreach ($jobs_job_types as $jobs_job_type) {
                                        $selected = isset($_GET['selected_jobtype']) && $_GET['selected_jobtype'] == $jobs_job_type->slug ? 'selected' : '';
                                        echo '<option value="' . esc_attr($jobs_job_type->slug) . '" ' . $selected . '>' . esc_html($jobs_job_type->name) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-12">
                            <div class="form-group">
                                <select name="selected_location" id="location" class="selectField">
                                    <option value="-1">Location</option>
                                    <?php
                                    $jobs_job_locations = get_terms(array(
                                        'taxonomy' => 'jobs_job_locations',
                                        'hide_empty' => false,
                                    ));
                                    foreach ($jobs_job_locations as $jobs_job_location) {
                                        $selected = isset($_GET['selected_location']) && $_GET['selected_location'] == $jobs_job_location->slug ? 'selected' : '';
                                        echo '<option value="' . esc_attr($jobs_job_location->slug) . '" ' . $selected . '>' . esc_html($jobs_job_location->name) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <input class="btn-search btn btn-style gradientBtn" value="Search" type="submit">
                        </div>
                    </div>
                </form>
            </div>

            <div class="jobListingInnerWrapper">
                <div class="row">
                <?php
                    $args = array(
                        'post_type' => 'jobs',
                        'posts_per_page' => -1,
                    );
    
                    if (!empty($_GET['search_keywords'])) {
                        $args['s'] = sanitize_text_field($_GET['search_keywords']);
                    }
    
                    $tax_query = array('relation' => 'AND');
    
                    if (isset($_GET['selected_jobtype']) && $_GET['selected_jobtype'] != '-1') {
                        $tax_query[] = array(
                            'taxonomy' => 'jobs_job_types',
                            'field' => 'slug',
                            'terms' => sanitize_text_field($_GET['selected_jobtype']),
                        );
                    }
    
                    if (isset($_GET['selected_location']) && $_GET['selected_location'] != '-1') {
                        $tax_query[] = array(
                            'taxonomy' => 'jobs_job_locations',
                            'field' => 'slug',
                            'terms' => sanitize_text_field($_GET['selected_location']),
                        );
                    }
    
                    if (count($tax_query) > 1) {
                        $args['tax_query'] = $tax_query;
                    }
    
                    $job_query = new WP_Query($args);
    
                    if ($job_query->have_posts()) :
                        while ($job_query->have_posts()) : $job_query->the_post();
                            $location = get_field('location');
                            $job_title = get_the_title();
                            $job_link = get_permalink();
                            $job_types = wp_get_post_terms(get_the_ID(), 'jobs_job_types', array('fields' => 'names'));
                            $job_locations = wp_get_post_terms(get_the_ID(), 'jobs_job_locations', array('fields' => 'names'));
                ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12"  data-aos="fade-down" data-aos-duration="1000" >
                        <div class="jobListGrid">
                            <a class="jobListGridInner" href="<?php echo esc_url($job_link); ?>" target="_self" aria-label="Click here to go to Job detail page">
                                <h4><?php echo esc_html($job_title); ?></h4>
                                <div class="jobInfo">
                                    <?php if (!empty($job_types)) : ?>
                                        <div class="jobInfoInner">
                                            <div class="jobInfoIcon">
                                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                            </div>
                                            <div class="jobInfoText">
                                                <?php echo !empty($job_types) ? esc_html(implode(', ', $job_types)) : ''; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($job_locations)) : ?>
                                        <div class="jobInfoInner">
                                            <div class="jobInfoIcon">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </div>
                                            <div class="jobInfoText">
                                                <?php echo !empty($job_locations) ? esc_html(implode(', ', $job_locations)) : ''; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="jobInfoInner">
                                        <div class="jobInfoIcon">
                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="jobInfoText">
                                            <?php echo get_the_date(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobListDesc">
                                    <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); else : ?>
                        <div class="col-sm-12">
                            <div class="noJobsFound">
                                <div class="noJobFoundImg">
                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/not-found.png" alt="No Found Image" />
                                </div>
                                <h2><?php _e('No Jobs found.', 'text-domain'); ?></h2>
                                <a href="<?php echo esc_url('/jobs-main'); ?>" class="btn-style gradientBtn" aria-label="Click here to go to homepage" target="_self">
                                    Back to Jobs Page
                                </a>
                            </div>
                        </div>
                <?php endif; ?>
                </div>
            </div>
        </div>  
    </section>

    <?php get_template_part('template-parts/trainingsection'); ?>   
</div>

<?php get_footer(); ?> 