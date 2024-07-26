<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>

    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/slick.css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/slick-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/fonts.css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/aos.css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ).'/assets/css/custom.css?v='.time(); ?>">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ).'/assets/css/responsive.css?v='.time(); ?>">
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php  
$current_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
if ( !is_page( array( 'jobseekers-dashboard', 'jobseekers-register', 'jobseekers-login', 'jobseekers-careers', 'jobseekers-applications', 'jobseekers-reset-password', 'jobseekers-forgot-password', 'jobseekers-user-profile', 'jobseekers-user-profile-edit' ) ) && strpos($current_url, '/jobseekers-dashboard/') === false ) : ?> 
    <div class="headerTopBar">
        <div class="sm_container">
            <div class="headerTopBarInner">
                <div class="row no-gutters">
                    <div class="col-md-7 col-12">
                        <?php
                            $general_post_name = 'header'; 
                            $general_post = get_page_by_path($general_post_name, OBJECT, 'general_settings');

                            if ($general_post) {
                                $post_id = $general_post->ID; 
                                if (have_rows('contact_details', $post_id)) :
                            ?>
                        <div class="topBarLeft">
                            <ul>
                                <?php while (have_rows('contact_details', $post_id)) : the_row(); ?>
                                <li>
                                    <?php
                                        $contact_icon_id = get_sub_field('contact_icon', $post_id);
                                        if (isset($contact_icon_id) && !empty($contact_icon_id)) {
                                            $contact_link = get_sub_field('contact_link', $post_id);
                                            $contact_text = get_sub_field('contact_text', $post_id);
                                            $contact_aria_label = get_sub_field('contact_aria_label', $post_id);
                                            $contact_target = get_sub_field('contact_target', $post_id);
                                            $contact_icon_url = wp_get_attachment_image_url($contact_icon_id, 'full');
                                    ?>
                                    <a href="<?php echo esc_url($contact_link); ?>" aria-label="<?php echo esc_attr($contact_aria_label); ?>" target="<?php echo esc_attr($contact_target); ?>">
                                        <span class="icon">
                                            <img src="<?php echo esc_url($contact_icon_url); ?>" alt="<?php echo esc_attr($contact_aria_label); ?>" />
                                        </span>
                                        <?php echo esc_attr($contact_text); ?>
                                    </a>
                                    <?php } ?>
                                </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                        <?php
                                endif;
                                wp_reset_query();
                            }
                        ?>
                    </div>
                    <div class="col-md-5 col-12">
                        <?php
                            $general_post_name = 'header'; 
                            $general_post = get_page_by_path($general_post_name, OBJECT, 'general_settings');

                            if ($general_post) {
                                $post_id = $general_post->ID; 
                                if (have_rows('social_media', $post_id)) :
                            ?>
                                <div class="header_social_list">
                                    <ul>
                                        <?php while (have_rows('social_media', $post_id)) : the_row(); ?>
                                            <li>
                                                <?php
                                                    $social_icon_id = get_sub_field('social_icon', $post_id);
                                                    if (isset($social_icon_id) && !empty($social_icon_id)) {
                                                        $social_link = get_sub_field('social_link', $post_id);
                                                        $social_aria_label = get_sub_field('social_aria_label', $post_id);
                                                        $social_target = get_sub_field('social_target', $post_id);
                                                        $social_icon_url = wp_get_attachment_image_url($social_icon_id, 'full');
                                                ?>
                                                    <a href="<?php echo esc_url($social_link); ?>" aria-label="<?php echo esc_attr($social_aria_label); ?>" target="<?php echo esc_attr($social_target); ?>">
                                                        <img src="<?php echo esc_url($social_icon_url); ?>" alt="<?php echo esc_attr($social_aria_label); ?>" />
                                                    </a>
                                                <?php } ?>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            <?php
                                endif;
                                wp_reset_query();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<header class="main_header header sticky-header">
        <div class="sm_container">
            <div class="header_wrapper">
                <div class="header_wrapper_inner">
                <?php
                    $general_post_name = 'header'; 
                    $general_post = get_page_by_path($general_post_name, OBJECT, 'general_settings');

                    if ($general_post) {
                        $logo_image = get_field('logo_image', $general_post->ID);
                        
                        if (isset($logo_image) && !empty($logo_image)) { 
                            $header_logo_aria_label = get_field('logo_aria_label', $general_post->ID);
                            $header_logo_img_url = wp_get_attachment_image_url($logo_image, 'full');
                            $header_logo_alt = get_post_meta($logo_image, '_wp_attachment_image_alt', true);
                            
                            if (empty($header_logo_alt)) {
                                $header_logo_alt = $header_logo_aria_label;
                            }
                    ?>
                    <div class="logo">
                        <a href="<?php echo esc_url(get_home_url()); ?>" aria-label="<?php echo esc_attr($header_logo_aria_label); ?>" target="_self">
                            <img src="<?php echo esc_url($header_logo_img_url); ?>" alt="<?php echo esc_attr($header_logo_alt); ?>">
                        </a>
                    </div>
                    <?php
                        }
                    }
                ?>
                    <div class="main-navigation">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#"> </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/toggle-btn.svg" alt="" > 
                            </button>
                            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                                <div class="main_nav_top desktop_menu">
                                    <?php  
                                        wp_nav_menu(
                                            array(
                                                'theme_location' => 'primary',
                                                'menu_class'     => 'website_nav'
                                            )
                                        );
                                    ?>
                                    <?php  
                                        wp_nav_menu(
                                            array(
                                                'theme_location' => 'header',
                                                'menu_class'     => 'website_nav2'
                                            )
                                        );
                                    ?>
                                </div>
                                <div class="fixdNav">
                                    <div class="fixdNav-mid">
                                        <div class="closeBtn">
                                            <a href="javascript:void(0);" data-target="#collapsibleNavbar" aria-expanded="true" data-toggle="collapse"> <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/close.svg" alt="close" width="35" height="35"> </a>
                                        </div>
                                        <div class="mobMenus">
                                            <?php  
                                                wp_nav_menu(
                                                    array(
                                                        'theme_location' => 'primary',
                                                        'menu_class'     => 'website_nav'
                                                    )
                                                );
                                            ?>
                                            <?php  
                                                wp_nav_menu(
                                                    array(
                                                        'theme_location' => 'header',
                                                        'menu_class'     => 'website_nav2'
                                                    )
                                                );
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php endif; ?>