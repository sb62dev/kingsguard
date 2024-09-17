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
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZFW1T4H92S"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-ZFW1T4H92S');
    </script>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="google-site-verification" content="zP6hGhioY4scLgQgcmbxxUK0hQ5T8QhnbA2G-84iZww" />
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
                                                        'theme_location' => 'mobile-menu',
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
    <div class="desktopSubMenuWrap">
        <div class="desktopSubMenuWrapInner">
            <div class="sm_container">
                <div class="desktopSubMenuInner">
                    <div class="subMenuOptions">
                        <div class="serviceSubmenu">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php  
                                        wp_nav_menu(array(
                                            'theme_location' => 'submenu1',
                                            'menu_class'     => 'subMenuWrap serviceMenu',
                                            'container'      => false
                                        ));
                                    ?>
                                </div>
                                <div class="col-md-10">
                                    <div class="serviceSubMenuDetails">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="industrySubmenu">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php  
                                        wp_nav_menu(array(
                                            'theme_location' => 'submenu2',
                                            'menu_class'     => 'subMenuWrap industryMenu',
                                            'container'      => false
                                        ));
                                    ?>
                                </div>
                                <div class="col-md-10">
                                    <div class="industrySubMenuDetails">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>