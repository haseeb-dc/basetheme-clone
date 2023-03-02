<?php
/**
 * The template for displaying all posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

// Include header.
get_header();

// Global variables.
global $option_fields;
global $post_id;
global $fields;
?>

<section id="hero-section" class="hero-section">
	<!-- Hero Start -->

	<div class="container-980">
		<div class="hero-single">
			<div class="wrapper">
				<div class="post-title">
					<h1><?php the_title(); ?></h1>
					<!-- <div class="s-50"></div> -->
				</div> <?php get_template_part( 'partials/post-meta-single' ); ?>
			</div>
		</div>
	</div>

	<!-- Hero End  -->
</section>

<section id="page-section" class="page-section">
	<!-- Content Start -->
	<div class="wrapper">
		<div class="<?php have_post_class( 'three-columns' ); ?>">
			<?php
			global $wp_query;
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					// Include specific template for the content.
					get_template_part( 'partials/content-archive', get_post_type() );
				}
				?>
				<div class="clear"></div>
				<?php
			} else {
				// If no content, include the "No posts found" template.
				get_template_part( 'partials/content', 'none' );
			}
			?>
		</div>
		<div class="ts-40"></div>
		<?php
		if ( have_posts() ) {
			if ( function_exists( 'build_pagination' ) ) {
				?>
			<div class="center-align">
				<?php build_pagination( $wp_query->max_num_pages ); ?>
			</div>
				<?php
			}
		}
		?>
		<div class="ts-80"></div>
	</div>
	<!-- Content End -->
</section>
<?php get_footer(); ?>
