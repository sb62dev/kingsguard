<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<?php
	$current_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
	if ( !is_page( array( 'jobseekers-dashboard', 'jobseekers-register', 'jobseekers-login', 'jobseekers-careers', 'jobseekers-applications', 'jobseekers-reset-password', 'jobseekers-forgot-password', 'jobseekers-user-profile', 'jobseekers-user-profile-edit' ) ) && strpos($current_url, '/jobseekers-dashboard/') === false ) { 
	$general_post = 'footer'; 
	$footer_post = get_page_by_path($general_post, OBJECT, 'general_settings');
	if ($footer_post) {
		$ftr_background_image = get_field('ftr_background_image', $footer_post->ID);
?>
<footer class="main_footer fixed_bg" style="background-image: url('<?php echo $ftr_background_image; ?>');">
	<div class="sm_container">
		<div class="ftrMobLogo">
			<div class="row">
				<div class="col-md-12">
					<?php
						$general_post_name = 'footer'; 
						$general_post = get_page_by_path($general_post_name, OBJECT, 'general_settings');

						if ($general_post) {
							$logo_image = get_field('logo_image', $general_post->ID);
							
							if (isset($logo_image) && !empty($logo_image)) { 
								$footer_logo_aria_label = get_field('logo_aria_label', $general_post->ID);
								$footer_logo_img_url = wp_get_attachment_image_url($logo_image, 'full');
								$footer_logo_alt = get_post_meta($logo_image, '_wp_attachment_image_alt', true);
								
								if (empty($footer_logo_alt)) {
									$footer_logo_alt = $footer_logo_aria_label;
								}
						?>
						<div class="footerLogo">
							<a href="<?php echo esc_url(get_home_url()); ?>" aria-label="<?php echo esc_attr($footer_logo_aria_label); ?>" target="_self">
								<img src="<?php echo esc_url($footer_logo_img_url); ?>" alt="<?php echo esc_attr($footer_logo_alt); ?>">
							</a>
						</div>
						<?php
							}
						}
					?>
				</div>
			</div>
		</div>
		<div class="footer_top">
			<div class="row">
				<div class="col-lg-7 col-md-12">
					<div class="ftrMainMenu">
						<?php  
							wp_nav_menu(
								array(
									'theme_location' => 'secondary',
									'menu_class'     => 'footer_menu'
								)
							);
						?>
					</div>
				</div>
				<div class="col-lg-5 col-md-12">
					<?php
						$general_post_name = 'footer'; 
						$general_post = get_page_by_path($general_post_name, OBJECT, 'general_settings');

						if ($general_post) {
							$post_id = $general_post->ID; 
							if (have_rows('social_media', $post_id)) :
						?>
							<div class="social_list">
								<?php
									$general_post = 'footer'; 
									$footer_post = get_page_by_path($general_post, OBJECT, 'general_settings');

									if ($footer_post) {
										$social_title = get_field('social_title', $footer_post->ID);
										if ($social_title) {
								?>
								<div class="socialTitle"><?php echo $social_title; ?></div>
								<?php
										}
									}
								?>
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

		<div class="footer_btm">
			<div class="row">
				<div class="col-lg-5 col-md-12">
					<?php
						$general_post = 'footer'; 
						$footer_post = get_page_by_path($general_post, OBJECT, 'general_settings');

						if ($footer_post) {
							$copyright_text = get_field('copyright_text', $footer_post->ID);
							if ($copyright_text) {
					?>
					<div class="ftr_text">
						<p><?php echo $copyright_text; ?></p>
					</div>
					<?php
							}
						}
					?>
				</div>
				<div class="col-lg-2 col-md-12 ftrDeskLogo">
					<?php
						$general_post_name = 'footer'; 
						$general_post = get_page_by_path($general_post_name, OBJECT, 'general_settings');

						if ($general_post) {
							$logo_image = get_field('logo_image', $general_post->ID);
							
							if (isset($logo_image) && !empty($logo_image)) { 
								$footer_logo_aria_label = get_field('logo_aria_label', $general_post->ID);
								$footer_logo_img_url = wp_get_attachment_image_url($logo_image, 'full');
								$footer_logo_alt = get_post_meta($logo_image, '_wp_attachment_image_alt', true);
								
								if (empty($footer_logo_alt)) {
									$footer_logo_alt = $footer_logo_aria_label;
								}
						?>
						<div class="footerLogo">
							<a href="<?php echo esc_url(get_home_url()); ?>" aria-label="<?php echo esc_attr($footer_logo_aria_label); ?>" target="_self">
								<img src="<?php echo esc_url($footer_logo_img_url); ?>" alt="<?php echo esc_attr($footer_logo_alt); ?>">
							</a>
						</div>
						<?php
							}
						}
					?>
				</div>
				<div class="col-lg-5 col-md-12">
					<div class="ftrMenu2">
						<?php  
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'menu_class'     => 'footer_menu'
								)
							);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>	
<?php } } ?>

<?php
	$current_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
	if ( !is_page( array( 'jobseekers-dashboard', 'jobseekers-register', 'jobseekers-login', 'jobseekers-careers', 'jobseekers-applications', 'jobseekers-reset-password', 'jobseekers-forgot-password', 'jobseekers-user-profile', 'jobseekers-user-profile-edit' ) ) && strpos($current_url, '/jobseekers-dashboard/') === false ) {  
	$general_post_name = 'footer'; 
	$general_post = get_page_by_path($general_post_name, OBJECT, 'general_settings');

	if ($general_post) {
		$whatsapp_icon = get_field('whatsapp_icon', $general_post->ID);
		
		if (isset($whatsapp_icon) && !empty($whatsapp_icon)) { 
			$whatsapp_logo_aria_label = get_field('whatsapp_link_aria_label', $general_post->ID);
			$whatsapp_number = get_field('whatsapp_number', $general_post->ID);
			$whatsapp_link_target = get_field('whatsapp_link_target', $general_post->ID);
			$whatsapp_logo_img_url = wp_get_attachment_image_url($whatsapp_icon, 'full');
			$whatsapp_logo_alt = get_post_meta($whatsapp_icon, '_wp_attachment_image_alt', true);
			
			if (empty($whatsapp_logo_alt)) {
				$whatsapp_logo_alt = $whatsapp_logo_aria_label;
			}
			
			$whatsapp_number = preg_replace('/[^0-9]/', '', $whatsapp_number);
?>
<div class="whatsapp-chat">
	<a href="https://wa.me/<?php echo $whatsapp_number; ?>" target="<?php echo $whatsapp_link_target; ?>" aria-label="<?php echo $whatsapp_logo_aria_label; ?>">
		<img src="<?php echo esc_url($whatsapp_logo_img_url); ?>" alt="<?php echo esc_attr($whatsapp_logo_alt); ?>">
	</a>
</div>
<?php } } } ?>


<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/popper.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/slick.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/aos.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/custom.js"></script>
<script>
    AOS.init();
</script>
<?php wp_footer(); ?>

<div class="modal fade" id="projectVideo" tabindex="-1" role="dialog" aria-labelledby="projectVideoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
		<button type="button" class="modal_close" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>
		<iframe id="videoFrame" width="800" height="400" src="<?php echo $video_url; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
  </div>
</div>
</body>
</html>
