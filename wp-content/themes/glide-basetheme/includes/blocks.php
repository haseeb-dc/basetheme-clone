<?php
/**
 * Functions for custom Gutenberg blocks
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

/**
 * Register custom Gutenberg blocks
 */

/**
 * A function in which all acf blocks are registered
 *
 *  @return void
 */
function register_acf_blocks() {
	// Register a block - Spacer.
	register_acf_block( 'spacer' );
	// Register a block - Button.
	register_acf_block( 'button' );
	// Register a block - AcfBlock.
	// register_acf_block('acfblock',array('jquery','owl-carousel'),function(){
	// wp_enqueue_script( 'owl-carousel', assetDir . '/js/owl.carousel.min.js' , array( 'jquery' ), null, true );
	// },true);.
}
add_action( 'init', 'register_acf_blocks' );

/**
 * A function which is used to register a block
 *
 * @param string   $block_name is the name of the block.
 * @param array    $block_script_order is a array of registered scripts in the correct order.
 * @param function $block_function is function to use when need external file in the block.
 * @param boolean  $has_script is boolean value that determines if block need to include script or not.
 *
 *  @return void
 */
function register_acf_block( $block_name = null, $block_script_order = array( 'jquery' ), $block_function = null, $has_script = false ) {
	if ( $has_script ) {
		if ( $block_function ) {
			$block_function();
		}
		wp_register_script( 'block-' . $block_name, blockDirAssets . '/' . $block_name . '/' . $block_name . '.js', $block_script_order, '1.1.0', true );
	}
	register_block_type( BLOCK_DIR . '/' . $block_name );
}
