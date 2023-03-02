<?php
/**
 * Template Name: Blog
 * Template Post Type: page
 *
 * This template is for displaying blog page.
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


$basethemevar_tblgho_feature_post = $fields['basethemevar_tblgho_feature_post'];
$basethemevar_author_avatar       = $fields['basethemevar_author_avatar'];
$basethemevar_pagetitle           = ( isset( $fields['basethemevar_tblgho_title'] ) ) ? $fields['basethemevar_tblgho_title'] : get_the_title();

// $categories=get_categories(array(
// 'hide_empty'    => false,
// ));

$basethemevar_post_catagories = get_categories( $post_id );

?>
<section id="hero-section" class="hero-section">
<div class="blog-hero">
	<div class="wrapper">
		<div class="banner-content">
			<h1><?php echo html_entity_remove( $basethemevar_pagetitle ); ?></h1>
		</div>
		<div class="s-50"></div>
		<div class="blog-nav">
			<div class="nav-ctn d-flex justify-content-center flex-wrap">
				<?php if ( $basethemevar_post_catagories ) { ?>
					<ul>
						<?php foreach ( $basethemevar_post_catagories as $basethemevar_category ) { ?>
							<li><a href="<?php echo esc_url( get_category_link( $basethemevar_category ) ); ?>"><?php echo html_entity_remove( $basethemevar_category->name ); ?></a></li>
						<?php } ?>
					</ul>
				<?php } ?>

			</div>
			<!-- <div class="search-blog-area">
				<span class="search-blog">Search Blog</span>
				<div class="blog-form-area">
					<div class="close-btn"><img
							src="https://cancerchoices.wpengine.com/wp-content/themes/cancerchoices/assets/img/close-light.svg"
							alt="Close"></div>
					<div class="blog-form">
						<form role="search" method="get" class="search-form"
							action="https://cancerchoices.wpengine.com/">
							<label>
								<span class="screen-reader-text">Search for:</span>
								<input type="hidden" name="post_type" value="post">
								<input type="search" class="search-field" placeholder="What are you searching for?"
									value="" name="s">
							</label>
							<input type="submit" class="search-submit" value="Search Blog">
						</form>
					</div>
				</div>
			</div> -->
		</div>
		<div class="s-80"></div>
		<?php
		if ( $basethemevar_tblgho_feature_post ) {
			?>
			<?php
			foreach ( $basethemevar_tblgho_feature_post as $basethemevar_post ) {
				setup_postdata( $basethemevar_post );
				$post_title         = get_the_title();
				$post_excerpt       = get_the_excerpt();
				$post_date          = get_the_date( 'M d Y', );
				$post_parmalink     = get_the_permalink();
				$post_tags          = get_the_tags();
				$post_author_name   = get_the_author();
				$post_author_avatar = ( $basethemevar_author_avatar ) ? $basethemevar_author_avatar : get_avatar_url();


				$post_image = get_the_post_thumbnail_url( $feature_post->ID, 'full' );
				if ( ! $post_image ) {
					$post_image = get_template_directory_uri() . '/assets/img/admin/defaults/default-image.webp';
				}
				?>
				<div class="resources-post-box featured-post">
					<div class="resources-inner d-flex flex-wrap align-items-center justify-content-between">
						<?php
						if ( $image ) {
							?>
							<div class="rc-post-img post-image rs-view-100">
									<a href="<?php echo esc_url( $parmalink ); ?>">
									<img src="<?php echo esc_url( $post_image ); ?>">
									</a>
							</div>
						<?php } ?>
						<div class="post-content rs-view-100">

							<?php if ( $post_tags ) { ?>
								<div class="post-tag">
									<?php
									foreach ( $post_tags as $post_tag ) {
										$post_cat_name = $post_tag->name;
										$post_cat_link = get_category_link( $post_tag->term_id );
										?>
										<a href="<?php echo esc_url( $post_cat_link ); ?>">
											<?php echo html_entity_remove( $post_cat_name ); ?>
										</a>
									<?php } ?>
								</div>
							<?php } ?>

							<?php if ( $post_title ) { ?>
								<div class="post-box-title">
									<h2><a href="<?php echo esc_url( $parmalink ); ?>"><?php echo html_entity_remove( $post_title ); ?></a></h2>
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
							<div class="post-box-meta">
								<div class="post-author-ctn d-flex">
									<?php if ( $author_avatar ) { ?>
										<div class="post-author-img"
											style="background-image: url(<?php echo esc_url( $author_avatar ); ?>); width:50px; height:50px; background-size:cover">
										</div>
									<?php } ?>
									<div class="author-meta">
										<?php if ( $author_name ) { ?>
											<div class="post-author-name"><?php echo html_entity_remove( $author_name ); ?></div>
										<?php } ?>
										<?php if ( $post_date ) { ?>
											<div class="post-meta-date"><?php echo html_entity_remove( $post_date ); ?></div>
										<?php } ?>
									</div>
								</div>
							</div>
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
		<div class="post-archive three-columns">
		<?php
				// WP_Query .
				$args = array(
					'post_type'      => array( 'post' ),
					'posts_per_page' => get_option( 'posts_per_page' ), // how many posts you need.
					'paged'          => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
				);
				// The Query.
				$query = new WP_Query( $args );
				// The Loop.
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						// Include specific template for the content.
						get_template_part( 'partials/content', 'archive-post' );
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
			<?php if ( function_exists( 'build_pagination' ) ) { ?>
				<div class="ts-40"></div>
				<div class="center-align"> <?php build_pagination( $query->max_num_pages ); ?></div>
				<div class="ts-80"></div>
			<?php } ?>
		<!-- Content End -->
	</div>
</section>
<?php
get_footer();
