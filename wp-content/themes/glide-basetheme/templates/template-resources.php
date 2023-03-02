<?php
/**
 * Template Name: Resources
 * Template Post Type: page
 *
 * This template is for displaying resource page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
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


$basethemevar_pagetitle          = ( isset( $fields['basethemevar_pagetitle'] ) ) ? $fields['basethemevar_pagetitle'] : get_the_title();
$basethemevar_trcho_feature_post = ( isset( $fields['basethemevar_trcho_feature_post'] ) ) ? $fields['basethemevar_trcho_feature_post'] : null;

?>


<section id="hero-section" class="hero-section">
	<div class="blog-hero">
		<div class="wrapper">
			<div class="banner-content">
				<h1><?php echo html_entity_remove( $basethemevar_pagetitle ); ?></h1>
			</div>
			<div class="s-80"></div>
			<?php
			if ( $basethemevar_trcho_feature_post ) {
				?>
				<?php
				foreach ( $basethemevar_trcho_feature_post as $basethemevar_post ) {

								setup_postdata( $basethemevar_post );
								$post_title     = get_the_title();
								$post_excerpt   = get_the_excerpt();
								$post_date      = get_the_date( 'M d Y' );
								$post_parmalink = get_the_permalink();
								$post_image     = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( $post_id, 'full' ) : get_template_directory_uri() . '/assets/img/defaults/default-image.webp';
					?>

				<div class="resources-post-box featured-post">
					<div class="resources-inner two-columns align-items-center justify-content-between">
						<?php if ( $post_image ) { ?>
							<div class="rc-post-img post-image rs-view-100">
								<a href="<?php echo esc_url( $post_parmalink ); ?>"><img src="<?php echo esc_url( $post_image ); ?>"></a>
							</div>
						<?php } ?>
						<div class="post-content rs-view-100">
							<?php if ( $post_title ) { ?>
								<div class="post-box-title">
									<h2><a href="<?php echo esc_url( $post_parmalink ); ?>"><?php echo html_entity_remove( $post_title ); ?></a></h2>
								</div>
							<?php } ?>
							<!-- post excerpt -->
							<?php if ( $post_excerpt ) { ?>
								<div class="post-box-excerpt">
									<p>
										<?php echo html_entity_remove( $post_excerpt ); ?>
									</p>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
					<?php
				}
			}
			?>
		</div>
	</div>
	<!-- Hero End -->
</section>
<section id="page-section" class="page-section">
	<!-- Content Start -->
	<div class="wrapper">
		<div class="rc-post-archive three-columns">
		<?php
			// WP_Query arguments.
			global $paged;
			$args = array(
				'post_type'      => array( 'resource' ),
				// 'meta_key' => 'basethemevar_trcho_feature_post',
				'posts_per_page' => 9, // how many posts you need.
				'paged'          => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
				// 'meta_query' => array(
				// array(
				// 'key'     => 'basethemevar_trcho_feature_post',
				// 'value'   => '1',
				// 'compare' => '!=',
				// )
				// ),
			);
			// The Query.
			$query = new WP_Query( $args );
			// The Loop.
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					// Include specific template for the content.
					get_template_part( 'partials/content', 'archive-resource' );
				}
			} else {
				// If no content, include the "No posts found" template.
				get_template_part( 'partials/content', 'none' );
			}
			?>
		</div>

		<div class="ts-40"></div>
		<?php if ( function_exists( 'build_pagination' ) ) { ?>
			<div class="center-align"> <?php build_pagination( $query->max_num_pages ); ?></div>
		<?php } ?>
		<div class="ts-80"></div>
		<!-- Content End -->
	</div>
</section>

<?php
get_footer();
