<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * Please note that missing files will produce a fatal error.
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

if ( ! defined( 'BLOCK_DIR' ) ) {
	define( 'BLOCK_DIR', __DIR__ . '/blocks' );
}
$file_includes = array(
	'includes/blocks.php',               // Custom Gutenberg blocks.
	'includes/cpt.php',                  // Custom post types setup.
	'includes/custom.php',               // Custom functions.
	'includes/api.php',                  // Api.
	'includes/classes/class-wp-theme-ajax.php',                 // Ajax related functions.
	'includes/classes/class-wp-theme-acf.php',                  // Advanced custom fields functions.
	'includes/classes/class-wp-theme-editor.php',               // Editor styles.
	'includes/classes/class-wp-theme-walker-nav.php',           // Header nav Walker.
	'includes/classes/class-wp-theme-walker-acf-settings.php',           // Header nav Walker.
	'includes/classes/class-wp-theme-walker-settings.php',           // Header nav Walker.
	'includes/classes/class-wp-theme-scripts.php',              // Enqueue theme styles and scripts.
	'includes/classes/class-wp-theme-settings.php',             // Settings.
	'includes/classes/class-wp-theme-setup.php',                // Basic theme setup.
);

/**
 * Checks if any file have error while including it.
 */
foreach ( $file_includes as $file ) {

	$filepath = locate_template( $file );
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	} else {
		echo 'Unable to load configuration file ' . esc_html( basename( $file ) ) . ' please check file name in functions.php in your current active theme.';
	}
}
