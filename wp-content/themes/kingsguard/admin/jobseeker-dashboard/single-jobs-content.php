<div class="singleJobcontent">
    <div class="singleJobTitle">
        <div class="row">
            <div class="col-md-9">
                <h1><?php the_title(); ?></h1>
            </div>
            <div class="col-md-3">
                <div class="applyBtn">
                    <?php if ( !isset($_COOKIE['jobseeker_logged_in']) || $_COOKIE['jobseeker_logged_in'] !== 'true' ) : ?>
                        <a href="#" class="btn-style gradientBtn"> Apply Now </a>
                    <?php else : ?>
                        <a href="#applicationform" class="btn-style gradientBtn smoothScroll"> Apply Now </a>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
    </div>
    <div class="jobContent">
        <div class="row">
            <div class="col-md-7">
                <div class="jobContentInner">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="jobsInfo">
                    <?php 
                        $job_types = wp_get_post_terms(get_the_ID(), 'jobs_job_types', array('fields' => 'names'));
                        $job_locations = wp_get_post_terms(get_the_ID(), 'jobs_job_locations', array('fields' => 'names'));
                    ?>
                    <div class="row">
                        <?php if (!empty($job_types)) : ?>
                            <div class="col-xl-4 col-md-6 col-sm-4">
                                <div class="jobInfoInner">
                                    <div class="jobInfoIcon">
                                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    </div>
                                    <div class="jobInfoText">
                                        <h6>Job Type</h6>
                                        <p><?php echo !empty($job_types) ? esc_html(implode(', ', $job_types)) : ''; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($job_locations)) : ?>
                            <div class="col-xl-4 col-md-6 col-sm-4">
                                <div class="jobInfoInner">
                                    <div class="jobInfoIcon">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    </div>
                                    <div class="jobInfoText">
                                        <h6>Job Location</h6>
                                        <p><?php echo !empty($job_locations) ? esc_html(implode(', ', $job_locations)) : ''; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-xl-4 col-md-6 col-sm-4">
                            <div class="jobInfoInner">
                                <div class="jobInfoIcon">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                </div>
                                <div class="jobInfoText">
                                    <h6>Job Posted</h6>
                                    <p><?php echo get_the_date(); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jobsInfo">
                    <div class="row">
                        <?php
                            $jobs_company = get_field('jobs_company');
                            if ($jobs_company) {
                        ?>
                        <div class="col-xl-4 col-md-6 col-sm-4">
                            <div class="jobInfoInner">
                                <div class="jobInfoIcon">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                </div>
                                <div class="jobInfoText">
                                    <h6>Company</h6>
                                    <p><?php echo esc_html($jobs_company); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php
                            $job_expire_in = get_field('job_expire_in');
                            if ($job_expire_in) {
                        ?>
                        <div class="col-xl-4 col-md-6 col-sm-4">
                            <div class="jobInfoInner">
                                <div class="jobInfoIcon">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </div>
                                <div class="jobInfoText">
                                    <h6>Job Expire in</h6>
                                    <p><?php echo esc_html($job_expire_in); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php
                            $job_level = get_field('job_level');
                            if ($job_level) {
                        ?>
                        <div class="col-xl-4 col-md-6 col-sm-4">
                            <div class="jobInfoInner">
                                <div class="jobInfoIcon">
                                    <i class="fa fa-database" aria-hidden="true"></i>
                                </div>
                                <div class="jobInfoText">
                                    <h6>Job Level</h6>
                                    <p><?php echo esc_html($job_level); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php
                            $experience = get_field('experience');
                            if ($experience) {
                        ?>
                        <div class="col-xl-4 col-md-6 col-sm-4">
                            <div class="jobInfoInner">
                                <div class="jobInfoIcon">
                                    <i class="fa fa-pie-chart" aria-hidden="true"></i>
                                </div>
                                <div class="jobInfoText">
                                    <h6>Experience</h6>
                                    <p><?php echo esc_html($experience); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php
                            $jobs_education = get_field('jobs_education');
                            if ($jobs_education) {
                        ?>
                        <div class="col-xl-4 col-md-6 col-sm-4">
                            <div class="jobInfoInner">
                                <div class="jobInfoIcon">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                </div>
                                <div class="jobInfoText">
                                    <h6>Education</h6>
                                    <p><?php echo esc_html($jobs_education); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php
                            $jobs_salary = get_field('jobs_salary');
                            if ($jobs_salary) {
                        ?>
                        <div class="col-xl-4 col-md-6 col-sm-4">
                            <div class="jobInfoInner">
                                <div class="jobInfoIcon">
                                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                </div>
                                <div class="jobInfoText">
                                    <h6>Salary</h6>
                                    <p><?php echo esc_html($jobs_salary); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>