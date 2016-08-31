<?php
/**
 * @file
 * Contains helper functions for working with text
 */

namespace AZ\Helpers;

/**
 * @class
 * Contains helper functions for working with CSS in PHP
 */

class Text {

	/**
	 * Convert any text to a reference.
	 * Only allow lowercase letters and dashes.
	 * Upper case characters are converted to lower case ones
	 *
	 * @param $text
	 *
	 * @static
	 * @return string
	 */
	public static function to_reference( $text ) {

		$clean = preg_replace ( '/[^A-Za-z0-9 -_]/' , '' , $text );
		$clean = preg_replace ( '/[-_ ]/', '-', $clean );
		$clean = preg_replace ( '/[--]/', '-', $clean );
		$clean = strtolower( $clean );

		return $clean;
	}

}