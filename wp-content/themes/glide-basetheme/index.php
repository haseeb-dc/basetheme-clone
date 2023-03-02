<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
	<div class="hero-single">
		<div class="wrapper">
		<h1><?php echo html_entity_remove( get_bloginfo( 'name' ) ); ?></h1>
		<p><?php echo html_entity_remove( get_bloginfo( 'description' ) ); ?></p>
		</div>
	</div>
	<!-- Hero End -->
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
