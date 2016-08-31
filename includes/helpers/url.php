<?php
/**
 * @file
 * Contains helper functions for working with URLs
 */

namespace AZ\Helpers;

/**
 * @class
 * Contains helper functions for working with CSS in PHP
 */

class URL {

	/**
	 * Check if the URL exists (does not return a 404 error)
	 *
	 * @param string $url
	 * @return bool
	 * @static
	 * @access public
	 */
	public static function url_exists( $url ) {
		if ( ! $fp = curl_init( $url ) ) {
			return false;
		}
		return true;
	}

}

