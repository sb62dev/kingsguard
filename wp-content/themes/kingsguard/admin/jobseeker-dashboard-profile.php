<?php
/**
 * Template Name: Jobseekers User Profile
**/

if ( !isset($_COOKIE['jobseeker_logged_in']) || $_COOKIE['jobseeker_logged_in'] !== 'true' ) {
    wp_redirect('/jobseekers-login');
    exit;
}

get_header(); 

global $wpdb;
$username = isset($_COOKIE['jobseeker_username']) ? sanitize_text_field($_COOKIE['jobseeker_username']) : '';
$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}jobseekers_users WHERE username = %s", $username));

?> 

<div class="dashboardWrapper">
    <?php include('jobseeker-dashboard/dashboard-sidebar.php') ?> 
    <div class="dashboardContent">
        <?php include('jobseeker-dashboard/dashboard-header.php') ?> 
        <div id="dashboard-content" class="dashboard-main">
            <section class="dash_profilePage dashboardInner pb100">   
                <div class="dash_profilePage-wrap">
                    <div class="dash_profilePage-header"> 
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="h2"> Profile Information </h1>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="/jobseekers-user-profile-edit/" class="viewAllLink"> Edit Profile </a> 
                            </div>
                        </div>  
                    </div>
                    <div class="dash_profilePage-formWrapper"> 
                        <?php if ($user) { ?>
                            <div class="profileInfo">
                                <div class="row">
                                    <?php if (isset($user->profile_pic) && !empty($user->profile_pic)) { ?>
                                        <div class="col-md-4">
                                            <div class="prfile_lbl"> Picture: </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="prfile_cntInfo_img"> 
                                                <div class="prfile_cntInfo_imgIn"> 
                                                    <img src="<?php echo esc_attr($user->profile_pic); ?>" alt="Profile Pic">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?> 
                                    <?php if (isset($user->first_name) && !empty($user->first_name)) { ?>
                                        <div class="col-md-4">
                                            <div class="prfile_lbl"> Name: </div>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="prfile_cntInfo"> <?php echo esc_attr($user->first_name); ?> <?php echo esc_attr($user->last_name); ?></div>
                                        </div>
                                    <?php } ?>
                                    <?php if (isset($user->email) && !empty($user->email)) { ?>
                                        <div class="col-md-4">
                                            <div class="prfile_lbl"> Email Address: </div>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="prfile_cntInfo"> <?php echo esc_attr($user->email); ?> </div>
                                        </div>
                                    <?php } ?>
                                    <?php if (isset($user->username) && !empty($user->username)) { ?>
                                        <div class="col-md-4">
                                            <div class="prfile_lbl"> Username: </div>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="prfile_cntInfo"> <?php echo esc_attr($user->username); ?></div>
                                        </div>
                                    <?php } ?> 
                                </div>
                            </div> 
                        <?php } else { ?>
                            <p>User not found.</p>
                        <?php } ?>
                    </div>
                </div> 
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?> 