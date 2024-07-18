<div class="job-listings">
    <div class="row">
        <?php
            $args = array(
                'post_type' => 'careers',
                'posts_per_page' => -1,
                'post_status' => 'publish', 
                'orderby' => 'date', 
                'order' => 'ASC',   
            ); 
            $job_query = new WP_Query($args); 
            if ($job_query->have_posts()) : $count = 0;
                while ($job_query->have_posts()) : $job_query->the_post();
                $location = get_field('location');
                $job_title = get_the_title();
                $job_link = get_permalink();
                $job_types = wp_get_post_terms(get_the_ID(), 'jobs_job_types', array('fields' => 'names'));
                $job_locations = wp_get_post_terms(get_the_ID(), 'jobs_job_locations', array('fields' => 'names'));
        ?>
        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12"  data-aos="fade-down" data-aos-duration="1000" >
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
            <div class="noJobsFound">No Jobs Found!</div>
        </div>
        <?php endif; ?>
    </div>
</div>   