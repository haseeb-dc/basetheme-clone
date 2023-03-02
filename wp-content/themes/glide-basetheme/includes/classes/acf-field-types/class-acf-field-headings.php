<?php
/**
 * Functions for advanced custom fields plugin
 *
 * @link https://www.advancedcustomfields.com/resources/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

namespace BaseTheme\Acf\Acf_Fields;

/**
 * Template Class For Acf Block Field Headings
 *
 * Template Class
 *
 * @category Acf_Field
 * @package  BaseTheme Package
 */
class Acf_Field_Headings extends \acf_field {
	/**
	 * Controls field type visibility in REST requests.
	 *
	 * @var bool
	 */
	public $show_in_rest = true;

	/**
	 * Environment values relating to the theme or plugin.
	 *
	 * @var array $env Plugin or theme context such as 'url' and 'version'.
	 */
	private $env;

	/**
	 * Constructor.
	 */
	public function __construct() {
		/**
		 * Field type reference used in PHP and JS code.
		 *
		 * No spaces. Underscores allowed.
		 */
		$this->name = 'headings';

		/**
		 * Field type label.
		 *
		 * For public-facing UI. May contain spaces.
		 */
		$this->label = __( 'Headings', 'basetheme_td' );

		/**
		 * The category the field appears within in the field type picker.
		 */
		$this->category = 'basic'; // basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME.

		/**
		 * Defaults for your custom user-facing settings for this field type.
		 */
		$this->defaults = array( 'font_size' => 14 );

		/**
		 * Strings used in JavaScript code.
		 *
		 * Allows JS strings to be translated in PHP and loaded in JS via:
		 *
		 * ```js
		 * const errorMessage = acf._e("headings", "error");
		 * ```
		 */
		$this->l10n = array( 'error' => __( 'Error! Please enter a higher value', 'basetheme_td' ) );

		$this->env = array(
			'url'     => site_url( str_replace( ABSPATH, '', __DIR__ ) ), // URL to the acf-FIELD-NAME directory.
			'version' => '1.0', // Replace this with your theme or plugin version constant.
		);

		parent::__construct();
	}


	/**
	 * HTML content to show when a publisher edits the field on the edit screen.
	 *
	 * @param array $field The field settings and values.
	 * @return void
	 */
	// @codingStandardsIgnoreStart
	public function render_field( $field ) {
		?>
		<select name="<?php echo esc_attr( $field['name'] ); ?>">
			<option <?php if ( esc_attr( $field['value'] ) === 'h2'){ echo 'selected'; } ?> value="h2">h2</option>
			<option <?php if ( esc_attr( $field['value'] ) === 'h3'){ echo 'selected'; } ?> value="h3">h3</option>
			<option <?php if ( esc_attr( $field['value'] ) === 'h4'){ echo 'selected'; } ?> value="h4">h4</option>
			<option <?php if ( esc_attr( $field['value'] ) === 'h5'){ echo 'selected'; } ?> value="h5">h5</option>
			<option <?php if ( esc_attr( $field['value'] ) === 'h6'){ echo 'selected'; } ?> value="h6">h6</option>
		</select>
		<?php
	}
	// @codingStandardsIgnoreEnd


}
