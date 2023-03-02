<?php
/**
 * Custom functions added to all projects
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 */

/**
 * Excerpt Function
 *
 * @param number $count is a number of words needed in the excerpt
 *
 * Function used to create custom excerpt.
 */
function build_excerpt( $count ) {
	global $post;
	$permalink = get_permalink( $post->ID );
	$excerpt   = get_the_excerpt();
	$excerpt   = wp_strip_all_tags( $excerpt );
	$excerpt   = substr( $excerpt, 0, $count );
	$excerpt   = substr( $excerpt, 0, strripos( $excerpt, ' ' ) );
	$excerpt   = $excerpt . ' ...';
	$excerpt   = $excerpt;
	return $excerpt;
}


/**
 * Excerpt with no read more option
 *
 * Function used to create custom excerpt.
 *
 * @param number $count is a number of words needed in the excerpt.
 *
 * @return string
 */
function build_excerpt_nomore( $count ) {
	global $post;
	$permalink = get_permalink( $post->ID );
	$excerpt   = get_the_excerpt();
	$excerpt   = wp_strip_all_tags( $excerpt );
	$excerpt   = substr( $excerpt, 0, $count );
	$excerpt   = substr( $excerpt, 0, strripos( $excerpt, ' ' ) );
	$excerpt   = $excerpt;
	return $excerpt;
}


/**
 * Pagination Function
 *
 * The pagination function to display pagination on any archive page
 *
 * @param number $pages are total number of pages.
 * @param number $range is a range of pagination.
 *
 * @return void
 */
function build_pagination( $pages = '', $range = 4 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;

	if ( '' === $pages ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 !== $pages ) {
		echo '<div class="pagination"><span>Page ' . esc_html( $paged ) . ' of ' . esc_html( $pages ) . '</span>';
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<a href='" . esc_url( get_pagenum_link( 1 ) ) . "'>&laquo; First</a>";
		}
		if ( $paged > 1 && $showitems < $pages ) {
			echo "<a href='" . esc_url( get_pagenum_link( $paged - 1 ) ) . "'>&lsaquo; Previous</a>";
		}

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 !== $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged === $i ) ? '<span class="current">' . $i . '</span>' : "<a href='" . esc_url( get_pagenum_link( $i ) ) . "' class=\"inactive\">" . $i . '</a>';
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo '<a href="' . esc_url( get_pagenum_link( $paged + 1 ) ) . '">Next &rsaquo;</a>';
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<a href='" . esc_url( get_pagenum_link( $pages ) ) . "'>Last &raquo;</a>";
		}
		echo "<div class='clear'></div></div>\n";
	}
}


/**
 * Helper function that builds button from ACF link object
 *
 * @param object $object is a acf button object.
 * @param string $classes are the string of classes of acf button.
 *
 * @return string
 */
function build_acf_button( $object, $classes = '' ) {
	if ( $object['url'] ) {
		$link = '';
		$link = "<a href='" . esc_url( $object['url'] ) . "' title='" . esc_html( $object['title'] ) . "' target='" . $object['target'] . "' class='" . $classes . "'>" . esc_html( $object['title'] ) . '</a>';
		return $link;
	}
	return null;
}

/**
 * Helper function to get escaped field from ACF
 * and also normalize values.
 *
 * @param string $field_key is the acf key name.
 * @param string $escape_method is the method of escaping html.
 *
 * @return mixed
 */
function get_fields_escaped( $field_key, $escape_method = 'esc_html' ) {
	if ( function_exists( 'get_fields' ) ) {
		$field = get_fields( $field_key );
	}
	/* Check for null and falsy values and always return space */
	if ( false === $field || null === $field ) {
		$field = '';
	}

	/* Handle arrays */
	if ( is_array( $field ) || is_object( $field ) ) {
		$field_escaped = array();
		foreach ( $field as $key => $value ) {
			if ( is_array( $value ) || is_object( $value ) ) {
				$field_escaped[ $key ] = get_sub_field_escaped( $value, $escape_method );
			} else {
				$field_escaped[ $key ] = if_exist( ( null === $escape_method ) ? $value : $escape_method( $value ) );
				// $field_escaped[$key] =   esc_html($value);
			}
		}
		return $field_escaped;
	} else {
		return if_exist( ( null === $escape_method ) ? $field : $escape_method( $field ) );
	}
}

/**
 * Helper function to get escaped field for a sub-field from ACF inside a parent
 * and also normalize values.
 *
 * @param string $parent is the acf key name.
 * @param string $escape_method is the method of escaping html.
 *
 * @return mixed
 */
function get_sub_field_escaped( $parent = null, $escape_method = 'esc_html' ) {
	$field = $parent;
	/* Check for null and falsy values and always return space */
	if ( false === $field || null === $field ) {
		$field = '';
	}

	/* Handle arrays */
	if ( is_array( $field ) || is_object( $value ) ) {
		$field_escaped = array();
		foreach ( $field as $key => $value ) {
			if ( is_array( $value ) || is_object( $value ) ) {
				if ( is_object( $value ) ) {
					$obj = new \stdClass();

					foreach ( $value as $obj_k => $obj_v ) {

						$obj->$obj_k = if_exist( ( null === $escape_method ) ? $obj_v : $escape_method( $obj_v ) );
					}
					$field_escaped[ $key ] = $obj;
				} else {
					$field_escaped[ $key ] = get_sub_field_escaped( $value, $escape_method );
				}
			} else {

				$field_escaped[ $key ] = if_exist( ( null === $escape_method ) ? $value : $escape_method( $value ) );
			}
		}
		return $field_escaped;
	} else {
		return if_exist( ( null === $escape_method ) ? $field : $escape_method( $field ) );
	}

}

/**
 * Check if value exist
 *
 * @param mixed $value value to be checked.
 *
 * @return string
 */
function if_exist( $value ) {
	return ( isset( $value ) && '' !== $value ) ? $value : null;
}

/**
 * Return escaped string
 *
 * @param string $string string to decode.
 *
 * @return string
 */
function html_entity_remove( $string ) {
	return sanitize_text_field( html_entity_decode( $string ) );
}

/**
 * Fallback function for menus
 *
 * @return void
 */
function nav_fallback() {
	if ( is_user_logged_in() ) {
		?>
		<ul>
			<li> <?php esc_html__( 'Go to admin area to create navigation menu', 'basetheme_td' ); ?></li>
		</ul>
		<?php
	}
}

/**
 * A Function that check if post exist then print class;
 *
 * @param string $class post class.
 *
 * @return void
 */
function have_post_class( $class ) {
	if ( have_posts() ) {
		echo esc_html( $class );
	}
}
