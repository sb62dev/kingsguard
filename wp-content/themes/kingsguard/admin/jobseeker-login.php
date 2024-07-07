<?php
/**
 * Template Name: Jobseekers Login
**/

if ( isset($_COOKIE['jobseeker_logged_in']) && $_COOKIE['jobseeker_logged_in'] === 'true' ) {
    wp_redirect('/jobseekers-dashboard');
    exit;
}

get_header(); 

?> 

<div class="login-wrapper">
     <?php echo do_shortcode('[jobseekers_login_form]') ?>
</div>

<?php get_footer(); ?>  