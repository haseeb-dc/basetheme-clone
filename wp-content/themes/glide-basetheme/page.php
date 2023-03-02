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


$basethemevar_pagetitle = ( isset( $fields['basethemevar_pagetitle'] ) ) ? $fields['basethemevar_pagetitle'] : null;
if ( ! $basethemevar_pagetitle ) {
	$basethemevar_pagetitle = get_the_title();
}
?>

<section id="hero-section" class="hero-section">
	<!-- Hero Start -->

	<div class="hero-single">
		<div class="wrapper">
			<h1><?php echo html_entity_decode( $basethemevar_pagetitle ); ?></h1>
		</div>
	</div>
	<!-- Hero End -->
</section>

<section id="page-section" class="page-section">
	<!-- Content Start -->
		<?php
		global $wp_query;
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				// Include specific template for the content.
				get_template_part( 'partials/content', 'page' );
			}
			?>
			<div class="clear"></div>
			<?php
		} else {
			// If no content, include the "No posts found" template.
			get_template_part( 'partials/content', 'none' );
		}
		?>

	<div class="ts-80"></div>
	<!-- Content End -->
</section>
<?php get_footer(); ?>
