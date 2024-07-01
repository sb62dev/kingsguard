<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header(); ?>

<?php
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
	<div class="pageBody">
        <div class="singleBlogWrapper pb100">
			<div class="sm_container">
				<div class="singleBlogHeader">
					<h1 class="singleBlogTitle h2" data-aos="fade-down" data-aos-duration="1000"><?php the_title(); ?></h1>
					<div class="singleBlogMeta" data-aos="fade-down" data-aos-duration="1000">
						<p class="singleBlogAuthor">Authored By: <?php the_author(); ?></p>
						<p class="singleBlogdate"><?php echo get_the_date(); ?> at <?php echo get_the_time(); ?></p>
					</div>
				</div>

				<div class="singleBlogImage" data-aos="fade-down" data-aos-duration="1000">
					<?php if (has_post_thumbnail()) {
						the_post_thumbnail('full', ['alt' => get_the_title()]);
					} ?>
				</div>

				<div class="singleBlogContent" data-aos="fade-down" data-aos-duration="1000">
					<?php the_content(); ?>
				</div>
			</div>
        </div>
	</div>
    <?php endwhile;
else : ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php get_footer();