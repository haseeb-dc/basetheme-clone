<?php
/**
 * Setup function for the project
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

namespace BaseTheme\Script;

/**
 * Theme assets
 *
 * Define variable to store asset directory folder in it.
 *
 * That can be used afterward to call stylesheet / scripts etc
 */
// @codingStandardsIgnoreStart
// Time format for the_time()
DEFINE( 'project_dtformat', 'F j, Y' );

// Define assets folder
DEFINE( 'assetDir', get_template_directory_uri() . '/assets' );
// Define blocks folder
DEFINE( 'blockDirAssets', get_template_directory_uri() . '/blocks' );

// Define bundle version
DEFINE( 'ASSET_VERSION_JS', filemtime( get_template_directory() . '/assets/build/script.min.js' ) );
DEFINE( 'ASSET_VERSION_CSS', filemtime( get_template_directory() . '/assets/build/style.min.css' ) );
DEFINE( 'ADMIN_ASSET_VERSION_CSS', filemtime( get_template_directory() . '/assets/build/editor.min.css' ) );
// @codingStandardsIgnoreEnd
/**
 * Theme assets
 *
 * Enqueue and Dequeue required files
 */
class WP_Theme_Scripts {
	/**
	 * Define class Constructor
	 **/
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_assets' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
	}
	/**
	 * Enqueue Frontend Assets
	 *
	 * @return void
	 */
	public function theme_assets() {

		// Enqueue theme styles.
		wp_enqueue_style( 'glide-theme-stylesheet', assetDir . '/build/style.min.css?v=' . ASSET_VERSION_CSS, false, ASSET_VERSION_CSS );
		// Eliminate the emoji script.
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		// Enqueue comments reply script on single post pages.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( ! is_admin() && ! is_user_logged_in() ) {

			// Deregister dashicons on frontend.
			wp_deregister_style( 'dashicons' );
		}
		wp_enqueue_script( 'jquery' );
		// Register project scripts.
		wp_register_script( 'glide-theme-scripts', assetDir . '/build/script.min.js?v=' . ASSET_VERSION_JS, array( 'jquery' ), ASSET_VERSION_JS, false );
		// Localize.
		wp_localize_script(
			'glide-theme-scripts',
			'localVars',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);
		// Enqueue project scripts.
		wp_enqueue_script( 'glide-theme-scripts' );

	}
	/**
	 * Enqueue Backend Assets
	 *
	 * @return void
	 */
	public function admin_assets() {
		wp_enqueue_style( 'sample-editor-styles', assetDir . '/build/editor.min.css?v=' . ADMIN_ASSET_VERSION_CSS, false, ADMIN_ASSET_VERSION_CSS );
	}
}
new WP_Theme_Scripts();
