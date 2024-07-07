<?php
/**
 * Template Name: Jobseekers Register
**/

if ( isset($_COOKIE['jobseeker_logged_in']) && $_COOKIE['jobseeker_logged_in'] === 'true' ) {
    wp_redirect('/jobseekers-dashboard');
    exit;
}

get_header(); 

?> 

<div class="register-wrapper">
     <?php echo do_shortcode('[jobseekers_register_form]') ?>
</div>

<?php get_footer(); ?>  