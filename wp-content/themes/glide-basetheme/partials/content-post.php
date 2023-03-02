<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

// @codingStandardsIgnoreStart
$post_data = get_queried_object();
$post_id   = get_the_ID();
if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	$post_fields = get_fields_escaped( $post_id );
}
// @codingStandardsIgnoreEnd

// Post Tags & Categories.
$basethemevar_post_categories = get_categories( $post_id );


$basethemevar_pagetitle = ( isset( $fields['basethemevar_pagetitle'] ) ) ? $fields['basethemevar_pagetitle'] : null;
if ( ! $basethemevar_pagetitle ) {
	$basethemevar_pagetitle = get_the_title();
}

?>

<div class="container-980">
	<div class="wrapper">
		<div class="post-box-img post-image">
			<a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					?>
				<div class="post-featured-thumb">
					<?php
					the_post_thumbnail(
						'thumb_600',
						array(
							'alt'   => get_the_title(),
							'title' => get_the_title(),
						)
					);
					?>
					</div>
					<?php
				} else {
					?>
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/admin/defaults/default-image.webp" class="" alt="<?php get_the_title(); ?>" title="<?php get_the_title(); ?>"> <?php } ?> </a>
		</div>
		<div class="post-meta d-flex align-items-center justify-content-between">
			<!-- /.post-tags -->
			<?php if ( $basethemevar_post_categories ) { ?>
				<div class="post-cat">
					<?php foreach ( $basethemevar_post_categories as $basethemevar_category ) { ?>
						<a href="<?php echo esc_url( get_category_link( $basethemevar_category ) ); ?>"><?php echo html_entity_remove( $basethemevar_category->name ); ?></a>
					<?php } ?>
				</div>
				<!-- /.post-cat -->
			<?php } ?>
			<div class="post-shares">
				<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" target="_blank"
					rel="noopener" rel="noreferrer"
					onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/facebook-icon.svg" alt="Facebook"
						class="post-fb-share"></a>
				<a href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>"
					target="_blank" rel="noopener" rel="noreferrer"
					onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/linkedin-icon.svg" alt="Linked In"
						class="post-li-share"></a>
						<a href="http://twitter.com/intent/tweet?text=Currently reading <?php the_title(); ?>&amp;url=<?php the_permalink(); ?>"
					target="_blank" rel="noopener" rel="noreferrer"
					onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
						src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/twitter-icon.svg" alt="Twitter"
						class="post-tw-share"></a>
			</div>
			<!-- /.post-shares -->
		</div>


		<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-ctn' ); ?>>
				<?php get_template_part( 'partials/content' ); ?>
				<div class="clear"></div>
				<div class="post-details">
					<div class="post-pagination"> <?php the_posts_pagination(); ?> </div>
					<div class="post-comments">
					<?php
							// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
					</div>
				</div>
			</div>

			<?php
			wp_reset_postdata();

			$basethemevar_rp_selection_criteria = isset( $fields['basethemevar_rp_selection_criteria'] ) ? $fields['basethemevar_rp_selection_criteria'] : null;
			if ( 'random' === $basethemevar_rp_selection_criteria ) {

				$args = array(
					'posts_per_page' => 3,
					'post__not_in'   => array( $post->ID ),
					'orderby'        => 'rand',
				);

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
				}
			} else {
				global $post;
				$basethemevar_selected_posts = array();
				$basethemevar_selected_posts = isset( $fields['basethemevar_rp_selected_posts'] ) ? $fields['basethemevar_rp_selected_posts'] : null;
				if ( $basethemevar_selected_posts ) {

					?>
				<div class="related-posts ">
				<h3><?php esc_html__( 'Related Posts', 'basetheme_td' ); ?></h3>
					<?php
					foreach ( $basethemevar_selected_posts as $basethemevar_post ) {
						setup_postdata( $post );

						$post_fields      = get_fields( get_the_ID() );
						$basethemevar_src = wp_get_attachment_image_url( get_post_thumbnail_id( $post_id ), 'thumb_600', false );
						if ( ! $basethemevar_src ) {
							$basethemevar_src = get_template_directory_uri() . '/assets/img/admin/defaults/default-image.webp';
						}
							get_template_part( 'partials/content', 'archive-post' );
					}
					?>
				</div>
					<?php
				}
				wp_reset_postdata();
			}
			?>
		</article>
	</div>
</div>
