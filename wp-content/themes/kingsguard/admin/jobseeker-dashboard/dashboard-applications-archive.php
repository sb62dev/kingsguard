<div class="appli-listings">
    <div class="row">
        <?php
            $args = array(
                'post_type' => 'jobs',
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12"  data-aos="fade-down" data-aos-duration="1000" >
            <div class="appliListGrid">
                 
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); else : ?>
        <div class="col-sm-12">
            <div class="noAppliFound">No Applications Found!</div>
        </div>
        <?php endif; ?>
    </div>
</div>   