<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>
<div class="pageBody">
	<div class="ErrorWrap">
		<div class="sm_container">
			<div class="ErrorInnerWrap py100">
				<h1 class="mb0 h2"> Oops! </h1>
				<p>The content you are looking for is no longer available.</p>
				<div class="btnWrap">
					<a href="<?php echo esc_url(get_home_url()); ?>" target="_self" aria-label="Click here to go back to Homepage" class="btn-style gradientBtn">Back to Home</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
