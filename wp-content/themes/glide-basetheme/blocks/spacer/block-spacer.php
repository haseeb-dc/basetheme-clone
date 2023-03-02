<?php
/**
 * Block Name: Spacer
 *
 * The template for displaying the custom gutenberg block named Spacer.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package basethemevar
 * @since 1.0.0
 */

namespace BaseTheme\Spacer;

// Get all the fields from ACF for this block ID.
$block_fields = get_fields_escaped( $block['id'] );
// $block_fields = get_fields_escaped( $block['id'] ,'sanitize_text_field' ); // if want to remove all html.


// Set the block name for it's ID & class from it's file name.
$block_name = $block['name'];
$block_name = str_replace( 'acf/', '', $block_name );

// Set the preview thumbnail for this block for gutenberg editor view.
if ( isset( $block['data']['preview'] ) ) {
	echo '<img src="' . esc_url( get_template_directory_uri() . '/blocks/' . $block_name . '/' . $block['data']['preview'] ) . '" style="width:100%; height:auto;">';
}

// create align class ("alignwide") from block setting ("wide").
$basethemevar_align_class = $block['align'] ? 'align' . $block['align'] : '';

// Get the class name for the block to be used for it.
$basethemevar_class_name = ( isset( $block['className'] ) ) ? $block['className'] : null;

// Making the unique ID for the block.
$basethemevar_id = 'block-' . $block_name . '-' . $block['id'];

// Making the unique ID for the block.
if ( $block['name'] ) {
	$block_name        = $block['name'];
	$block_name        = str_replace( '/', '-', $block_name );
	$basethemevar_name = 'block-' . $block_name;
}


// Block variables.
$basethemevar_blk_spacer       = ( isset( $block_fields['basethemevar_blk_spacer'] ) ) ? $block_fields['basethemevar_blk_spacer'] : null;
$basethemevar_blk_spacer_class = html_entity_remove( $basethemevar_blk_spacer );

?>
<div id="<?php echo html_entity_remove( $basethemevar_id ); ?>" class="<?php echo html_entity_remove( $basethemevar_align_class . ' ' . $basethemevar_class_name . ' ' . $basethemevar_name ); ?> block-<?php echo html_entity_remove( $block_name ); ?>">

	<div class="devcause-spacer <?php echo esc_html( $basethemevar_blk_spacer_class ); ?>"></div>

</div>
