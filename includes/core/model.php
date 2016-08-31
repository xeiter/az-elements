<?php
/**
 * @class
 * Base class for template view
 */

namespace AZ;

class Model {

	/**
	 * @var array
	 * Default get_posts() Wordpress function options
	 * @access protected
	 */
	protected $_default_get_posts_options = array(
		'orderby'        => 'title',
		'order'          => 'ASC',
		'posts_per_page' => - 1
	);

	public function __construct() {
	}

	/**
	 * Get list of posts by post type
	 *
	 * @param string $post_type
	 * @param array $options
	 *
	 * @access public
	 * @return array
	 */
	public function get_posts_by_post_type( $post_type, $options = array() ) {

		// Prepare options for get_posts() call
		$options = $this->_generate_db_call_options( 'get_posts', $options );

		// Only get posts of the provided post type
		$options['post_type'] = $post_type;

		if ( ! $post_type ) {
			throw new \AZ\Exception( 'Post type has not been provided.' );
		}

		// Make database call
		$result = get_posts( $options );

		return $result;

	}

	/**
	 * Make a database call using get_post() Wordpress function
	 *
	 * @param array $options
	 *
	 * @access public
	 * @return array
	 */
	public function get_posts( $options = array() ) {

		// Prepare options for get_posts() call
		$options = $this->_generate_db_call_options( 'get_posts', $options );

		// Make database call
		$result = get_posts( $options );

		return $result;

	}

	/**
	 * Get value of a particular metadata item of a post
	 *
	 * @param int $post_id
	 * @param string $reference
	 * @param bool $single
	 * @param bool $wpautop
	 *
	 * @access public
	 * @return array
	 */
	public function get_post_meta_value( $post_id, $reference, $single = true, $wpautop = false ) {
		// Make database call
		$result = get_post_meta( $post_id, $reference, $single );

		// Check if need to add paragraphs
		if ( $wpautop ) {
			$result = wpautop( $result );
		}

		return $result;
	}

	/**
	 * Generate options for Wordpress functions that call to database
	 *
	 * @param string $function_name
	 * @param $options
	 *
	 * @return array
	 * @throws Exception
	 * @access private
	 */
	private function _generate_db_call_options( $function_name, $options ) {
		// Check that the options provided are an array
		if ( ! is_array( $options ) ) {
			throw new \AZ\Exception( 'Provided options must be an array.' );
		}

		switch ( $function_name ) {

			case 'get_posts':
				// Get default options
				$default_options = $this->_get_default_get_posts_options();
				break;
			default:
				throw new \AZ\Exception( 'Provided function name has been recognised.' );
				break;
		}

		// Override default options (if required)
		$merged_options = array_merge( $default_options, $options );

		return $merged_options;
	}

	/**
	 * Generate default options for get_posts calls
	 *
	 * @return array
	 */
	protected function _get_default_get_posts_options() {
		return $this->_default_get_posts_options;
	}

	/**
	 * Get list taxonomy items assigned to a specific post
	 * Only supports 2 levels - the rest will be ignored
	 *
	 * @param int $post_id
	 * @param string $taxonomy_reference
	 * @param array $extra_options
	 *
	 * @return array
	 * @access public
	 */
	public function get_posts_taxonomy_items( $post_id, $taxonomy_reference, $extra_options ) {
		$terms = wp_get_post_terms( $post_id, $taxonomy_reference, $extra_options );

		$result = array();

		foreach ( $terms as $id => $term ) {
			if ( $term->parent == 0 ) {
				$result[ $term->term_id ] = $term;
				unset( $terms[ $id ] );
			}
		}

		foreach ( $terms as $term ) {

			if ( isset( $result[ $term->parent ] ) ) {

				if ( is_array( $result[ $term->parent ]->children ) ) {
					$result[ $term->parent ]->children[ $term->term_id ] = $term;
				} else {
					$result[ $term->parent ]->children                   = array();
					$result[ $term->parent ]->children[ $term->term_id ] = $term;
				}

			}
		}

		return $result;
	}

}