<?php   

function jobseekers_user_menu_shortcode() {

    wp_enqueue_script('jobseekers-user-script', get_template_directory_uri() . '/admin/jobseekers/js/jobseekers-user.js', array('jquery'), null, true);
    wp_localize_script('jobseekers-user-script', 'jobseekers_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));

    ob_start();

    if ( isset( $_COOKIE['jobseeker_logged_in'] ) && $_COOKIE['jobseeker_logged_in'] === 'true' ) {
        global $wpdb;
        $username = isset( $_COOKIE['jobseeker_username'] ) ? esc_html( $_COOKIE['jobseeker_username'] ) : '';
        if ( $username ) { 
            $user = $wpdb->get_row( $wpdb->prepare(
                "SELECT first_name, email, user_info FROM {$wpdb->prefix}jobseekers_users WHERE username = %s",
                $username
            ));
    
            if ( $user ) {
                    $email = esc_html( $user->email );
                    $user_info = maybe_unserialize($user->user_info); 
                    $profile_pic = isset($user_info['profile_pic']) ? esc_html($user_info['profile_pic']) : '';
    
                    // Set default profile picture if not set
                    if (!empty($profile_pic)) {
                        $upload_dir = wp_upload_dir();
                        $custom_upload_dir = $upload_dir['baseurl'] . '/jobseekers-assets';
                        $profile_pic = $custom_upload_dir . '/' . ltrim($profile_pic, '/');
                    } else {
                        $profile_pic = get_template_directory_uri() . '/assets/images/user.png';
                    }
                ?>
                <a href="/jobseekers-user-profile/" class="dashboardProfile">
                    <div class="dashboardProfileCont">
                        <div class="dashboardProfileImg">  
                            <img src="<?php echo esc_html( $profile_pic ); ?>" alt="Profile Icon">
                        </div>
                        <div class="dashboardProfileName">
                            <div class="dashboardProfileNm"><?php echo esc_html( $user->first_name ); ?></div>
                            <div class="dashboardProfileEmail"><?php echo $email; ?></div>
                        </div>
                    </div> 
                </a>
                <?php
            } else {
                echo 'User not found.';
            }
        } else {
            echo 'Username not set in cookie.';
        }
    } else {
        // Display login link if user is not logged in
        ?>
        <div class="jobseek-user-menu">
            <a href="<?php echo home_url( '/login' ); ?>" class="jobseek-login-trigger">Sign In</a>
        </div>
        <?php
    }

    return ob_get_clean();
}

add_shortcode('jobseekers_user_menu', 'jobseekers_user_menu_shortcode');

function jobseekers_logout() {    

    setcookie('jobseeker_logged_in', '', time() - 3600, '/'); 
    setcookie('jobseeker_username', '', time() - 3600, '/');

    // Set up response
    $response = array(
        'success' => true
    );

    wp_send_json_success($response);
}

add_action('wp_ajax_jobseekers_logout', 'jobseekers_logout');
add_action('wp_ajax_nopriv_jobseekers_logout', 'jobseekers_logout'); 