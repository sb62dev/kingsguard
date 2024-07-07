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

<div class="loginWrapper registerWrapper">
    <div class="sm_container">
        <div class="registerInner">
            <?php
                $kingsguard_logo_img = get_field('kingsguard_logo_img');
                if (isset($kingsguard_logo_img) && !empty($kingsguard_logo_img)) {
                    $image_url = wp_get_attachment_image_src($kingsguard_logo_img, 'full')[0];
                    $image_alt = get_post_meta($kingsguard_logo_img, '_wp_attachment_image_alt', true);
            ?>
            <div class="kingsLogo">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            </div>
            <?php } ?>
            <?php
                $page_title = get_field('page_title');
                if ($page_title) {
            ?>
            <div class="jobRegisterTitle">
                <h2 class="h2"><?php echo esc_html($page_title); ?></h2>
            </div>
            <?php } ?>
            <?php echo do_shortcode('[jobseekers_login_form]') ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>  