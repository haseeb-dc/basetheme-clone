<?php
/**
 * Functions for advanced custom fields plugin
 *
 * @link https://www.advancedcustomfields.com/resources/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

namespace BaseTheme\Acf;

/**
 * Template Class For Acf Settings
 *
 * Template Class
 *
 * @category Setting_Class
 * @package  BaseTheme Package
 */
class WP_Theme_Acf {
	/**
	 * Define class Constructor
	 **/
	public function __construct() {

		/**
		 * Build ACF based theme Options page
		 */
		if ( function_exists( 'acf_add_options_page' ) ) {
			$option_page = acf_add_options_page(
				array(
					'page_title' => __( 'Theme Options', 'basetheme_td' ),
					'menu_title' => __( 'Theme Options', 'basetheme_td' ),
					'menu_slug'  => 'acf-options',
					'capability' => 'edit_posts',
					'redirect'   => false,
					'position'   => 2,
				)
			);
		}

		add_filter( 'block_categories_all', array( $this, 'blocks_category' ), 10, 2 );
		add_action( 'acf/render_field_settings/type=wysiwyg', array( $this, 'wysiwyg_render_field_settings' ), 10, 1 );
		add_action( 'acf/render_field/type=wysiwyg', array( $this, 'wysiwyg_render_field' ), 10, 1 );
		add_action( 'init', array( $this, 'include_acf_field_block_title' ) );
	}

	/**
	 * Register custom Gutenberg blocks category
	 *
	 *  @param array $categories is a array of theme categories.
	 *
	 *  @return array
	 */
	public function blocks_category( $categories ) {
		$custom_block = array(
			'slug'  => 'theme-blocks',
			'title' => __( 'Theme Blocks', 'basetheme_td' ),
			'icon'  => 'theme-blocks',
		);

		$categories_sorted    = array();
		$categories_sorted[0] = $custom_block;

		foreach ( $categories as $category ) {
			$categories_sorted[] = $category;
		}

		return $categories_sorted;
	}

	/**
	 * Add height field to ACF WYSIWYG
	 *
	 * @param array $field is a array of acf wysiwyg settings.
	 *
	 * @return void
	 */
	public function wysiwyg_render_field_settings( $field ) {
		acf_render_field_setting(
			$field,
			array(
				'label'        => __( 'Height of Editor', 'basetheme_td' ),
				'instructions' => __( 'Height of Editor after Init', 'basetheme_td' ),
				'name'         => 'wysiwyg_height',
				'type'         => 'number',
			)
		);
	}

	/**
	 * Render height on ACF WYSIWYG
	 *
	 * @param array $field is a array of acf wysiwyg settings.
	 *
	 * @return void
	 */
	public function wysiwyg_render_field( $field ) {
		$field_class    = '.acf-' . str_replace( '_', '-', $field['key'] );
		$wysiwyg_height = ( isset( $field['wysiwyg_height'] ) ) ? $field['wysiwyg_height'] : null;
		if ( ! $wysiwyg_height ) {
			$custom_acf_wysiwyg_height = '150';
		} else {
			$custom_acf_wysiwyg_height = $field['wysiwyg_height'];
		}
		// @codingStandardsIgnoreStart
		echo `
		<style type="text/css">
			`. esc_html( $field_class ) .` iframe {
					min-height: `. esc_html( $custom_acf_wysiwyg_height ) .`px;
				}
			</style>
			<script type="text/javascript">
				jQuery(window).load(function() {
					jQuery( '`. esc_html( $field_class )  .`' ).each( function() {
						jQuery('#'+jQuery(this).find('iframe').attr('id')).height( `. esc_html( $custom_acf_wysiwyg_height ) .` );
					});
				});
			</script>
		`;
		// @codingStandardsIgnoreEnd
	}
	/**
	 * Registers the ACF field type.
	 */
	public function include_acf_field_block_title() {
		if ( ! function_exists( 'acf_register_field_type' ) ) {
			return;
		}

		require_once __DIR__ . '/acf-field-types/class-acf-field-block-title.php';
		require_once __DIR__ . '/acf-field-types/class-acf-field-headings.php';
		require_once __DIR__ . '/acf-field-types/class-acf-field-spacer.php';

		acf_register_field_type( '\BaseTheme\Acf\Acf_Fields\Acf_Field_Block_Title' );
		acf_register_field_type( '\BaseTheme\Acf\Acf_Fields\Acf_Field_Headings' );
		acf_register_field_type( '\BaseTheme\Acf\Acf_Fields\Acf_Field_Spacer' );
	}


}
new WP_Theme_Acf();
