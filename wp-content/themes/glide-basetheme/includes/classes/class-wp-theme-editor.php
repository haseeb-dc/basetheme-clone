<?php
/**
 * Functions for editor styles
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

namespace BaseTheme\Editor;

/**
 * Template Class For Acf Settings
 *
 * Template Class
 *
 * @category Setting_Class
 * @package  BaseTheme Package
 */
class WP_Theme_Editor {
	/**
	 * Define class Constructor
	 **/
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'editor_css_support' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'custom_editor_css' ) );

		// add_filter( 'block_editor_settings_all',array($this, 'wp_block_editor_settings'), 10, 2 );.
	}

	/**
	 * Add support for editor styles
	 *
	 * @return void
	 */
	public function editor_css_support() {
		add_theme_support( 'editor-styles' ); // if you don't add this line, your stylesheet won't be added.
	}

	/**
	 * Add CSS to Gutenberg Editor and the Blocks
	 *
	 * @return void
	 */
	public function custom_editor_css() {
		wp_enqueue_style(
			'editor-styles-css',
			get_stylesheet_directory_uri() . '/assets/css/admin/glide-editor-styles.css',
			array( 'wp-edit-blocks' ),
			time()
		);
	}

	/**
	 * Add CSS to Gutenberg Editor and the Blocks
	 *
	 * @param object $editor_settings is the editor settings object.
	 * @param object $editor_context is the editor context object.
	 *
	 * @return object
	 */
	public function wp_block_editor_settings( $editor_settings, $editor_context ) {

		$user  = wp_get_current_user();
		$roles = $user->roles;

		$theme_json = WP_Theme_JSON_Resolver::get_merged_data();

		if ( WP_Theme_JSON_Resolver::theme_has_support() ) {
			$editor_settings['styles'][] = array(
				'css'            => $theme_json->get_stylesheet( 'block_styles' ),
				'__unstableType' => 'globalStyles',
			);
			$editor_settings['styles'][] = array(
				'css'                     => $theme_json->get_stylesheet( 'css_variables' ),
				'__experimentalNoWrapper' => true,
				'__unstableType'          => 'globalStyles',
			);
		}

		$editor_settings['__experimentalFeatures'] = $theme_json->get_settings();

		if ( in_array( $editor_context->post->post_type, array( 'post' ), true ) ) { // filter by post type.

			$editor_settings['allowedBlockTypes'] = array(
				'core/freeform', // only show classic editor.
			);

		} else {
			$block_types = WP_Block_Type_Registry::get_instance()->get_all_registered();
			$types       = array();
			foreach ( $block_types as $key => $item ) {
				if ( 'acf' === explode( '/', $key )[0] ) {
					$types[] = $key;
				}
			}
			$allowed                              = array(
				'core/paragraph',
				'core/image',
				'core/gallery',
				'core/cover',
				'core/video',
				'core/list',
				'core/heading',
				'core/buttons',
				'core/columns',
				'core/separator',
				'core/spacer',
			);
			$editor_settings['allowedBlockTypes'] = array_merge( $allowed, $types );
		}

		$editor_settings['__experimentalFeatures']['appearanceTools'] = false;
		$editor_settings['__experimentalFeatures']['className']       = false;
		$editor_settings['__experimentalFeatures']['customClassName'] = false;
		$editor_settings['__experimentalFeatures']['anchor']          = false;

		$editor_settings['__experimentalFeatures']['border']['color']  = false;
		$editor_settings['__experimentalFeatures']['border']['radius'] = false;
		$editor_settings['__experimentalFeatures']['border']['style']  = false;
		$editor_settings['__experimentalFeatures']['border']['width']  = false;

		$editor_settings['__experimentalFeatures']['color']['text'] = false;
		// $editor_settings['__experimentalFeatures']['color']['background'] = false;
		$editor_settings['__experimentalFeatures']['color']['link'] = false;
		// $editor_settings['__experimentalFeatures']['color']['custom'] = false;
		$editor_settings['__experimentalFeatures']['color']['customDuotone']    = false;
		$editor_settings['__experimentalFeatures']['color']['customGradient']   = false;
		$editor_settings['__experimentalFeatures']['color']['defaultGradients'] = false;
		// $editor_settings['__experimentalFeatures']['color']['defaultPalette'] = false;
		$editor_settings['__experimentalFeatures']['color']['defaultDuotone'] = false;

		$editor_settings['__experimentalFeatures']['spacing']['blockGap'] = false;
		$editor_settings['__experimentalFeatures']['spacing']['margin']   = false;
		$editor_settings['__experimentalFeatures']['spacing']['padding']  = false;
		$editor_settings['__experimentalFeatures']['spacing']['units']    = array();

		$editor_settings['__experimentalFeatures']['typography']['customFontSize'] = false;
		$editor_settings['__experimentalFeatures']['typography']['dropCap']        = false;
		$editor_settings['__experimentalFeatures']['typography']['fontStyle']      = false;
		$editor_settings['__experimentalFeatures']['typography']['fontWeight']     = false;
		$editor_settings['__experimentalFeatures']['typography']['letterSpacing']  = false;
		$editor_settings['__experimentalFeatures']['typography']['lineHeight']     = false;
		$editor_settings['__experimentalFeatures']['typography']['textDecoration'] = false;
		$editor_settings['__experimentalFeatures']['typography']['textTransform']  = false;

		// still working on these:.

		$editor_settings['__experimentalFeatures']['blocks']['core/button']['spacing']             = false;
		$editor_settings['__experimentalFeatures']['blocks']['core/button']['typography']          = false;
		$editor_settings['__experimentalFeatures']['blocks']['core/button']['border']['radius']    = false;
		$editor_settings['__experimentalFeatures']['blocks']['core/button']['color']['background'] = false;
		$editor_settings['__experimentalFeatures']['blocks']['core/button']['color']['custom']     = false;
		$editor_settings['__experimentalFeatures']['blocks']['core/button']['width']               = false;
		$editor_settings['__experimentalFeatures']['blocks']['core/button']['defaultStylePicker']  = false;

		return $editor_settings;
	}
}
new WP_Theme_Editor();
