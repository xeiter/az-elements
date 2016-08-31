<?php
/**
 * @file
 * Contains the class that allows to render a collapsible panel
 */

namespace AZ\Html_Helpers;

/**
 * @class
 * Allows to render a collapsible panel
 */

class Collapsible_Panel {

	/**
	 * @var null|string
	 * DOM id of the panel
	 * @access private
	 */
	private $_id = null;

	/**
	 * @var null|string
	 * Heading of the panel
	 * @access private
	 */
	private $_heading = null;

	/**
	 * @var null|string
	 * Content of the panel
	 * @access private
	 */
	private $_content = null;

	/**
	 * @var null|string
	 * Name of icon to use when panel is uncollapsed
	 * @access private
	 */
	private $_icon_uncollapsed = null;

	/**
	 * @var null|string
	 * Name of icon to use when panel is collapsed
	 * @access private
	 */
	private $_icon_collapsed = null;

	/**
	 * @var null|string
	 * Link text
	 * @access private
	 */
	private $_link_text = null;

	/**
	 * @var null|string
	 * Link URL
	 * @access private
	 */
	private $_link_url = null;

	public function __construct() {

	}

	public function render() {
		$html = '';

		$html .= <<<MULTI

<!-- Collapsible panel -->
<div class="row collapsible-panel">

	<!-- Heading -->
	<div class="col-sm-12 heading">
		<i class="heading-icon glyphicon {$this->_icon_collapsed}"></i>
		<a class="heading-link" id="link-{$this->_id}" href="#">{$this->_heading}</a>
	</div>
	<!-- END: Heading -->

	<div class="col-sm-12 text-container">

		<!-- Testimonial text -->
		<div class="text">
			{$this->_content}
		</div>
		<!-- END: Testimonial text -->

		<a class="link" href="{$this->_link_url}">{$this->_link_text}</a>

	</div>
</div>
<!-- END: Collapsible panel -->

MULTI;

		return $html;
	}

	/**
	 * Set panel content
	 *
	 * @param null|string $content
	 *
	 * @access public
	 */
	public function set_content( $content ) {
		$this->_content = $content;
	}

	/**
	 * Get panel content
	 *
	 * @return null|string
	 * @access public
	 */
	public function get_content() {
		return $this->_content;
	}

	/**
	 * Set panel heading
	 *
	 * @param null|string $heading
	 *
	 * @access public
	 */
	public function set_heading( $heading ) {
		$this->_heading = $heading;
	}

	/**
	 * Get panel heading
	 *
	 * @return null|string
	 * @access public
	 */
	public function get_heading() {
		return $this->_heading;
	}

	/**
	 * Set collapsed icon
	 *
	 * @param null|string $icon_collapsed
	 *
	 * @access public
	 */
	public function set_icon_collapsed( $icon_collapsed ) {
		$this->_icon_collapsed = $icon_collapsed;
	}

	/**
	 * Get collapsed icon
	 *
	 * @return null|string
	 * @access public
	 */
	public function get_icon_collapsed() {
		return $this->_icon_collapsed;
	}

	/**
	 * Set uncollapsed icon
	 *
	 * @param null|string $icon_uncollapsed
	 *
	 * @access public
	 */
	public function set_icon_uncollapsed( $icon_uncollapsed ) {
		$this->_icon_uncollapsed = $icon_uncollapsed;
	}

	/**
	 * Get uncollapsed icon
	 *
	 * @return null|string
	 * @access public
	 */
	public function get_icon_uncollapsed() {
		return $this->_icon_uncollapsed;
	}

	/**
	 * Set link text
	 *
	 * @param null|string $linkText
	 *
	 * @access public
	 */
	public function set_link_text( $linkText ) {
		$this->_link_text = $linkText;
	}

	/**
	 * Get link text
	 *
	 * @return null|string
	 * @access public
	 */
	public function get_link_text() {
		return $this->_link_text;
	}

	/**
	 * Set link URL
	 *
	 * @param null|string $link_url
	 *
	 * @access public
	 */
	public function set_link_url( $link_url ) {
		$this->_link_url = $link_url;
	}

	/**
	 * Get link URL
	 *
	 * @return null|string
	 * @access public
	 */
	public function get_link_url() {
		return $this->_link_url;
	}

	/**
	 * Set DOM id
	 *
	 * @param null|string $id
	 *
	 * @access public
	 */
	public function set_id( $id ) {
		$this->_id = $id;
	}

	/**
	 * Get DOM id
	 *
	 * @return null|string
	 * @access public
	 */
	public function get_id() {
		return $this->_id;
	}

	/**
	 * Set collapsed and uncollapsed icons
	 *
	 * @param string $collapsed
	 * @param string $uncollapsed
	 *
	 * @access public
	 */
	public function set_icons( $collapsed, $uncollapsed ) {
		$this->set_icon_collapsed( $collapsed );
		$this->set_icon_uncollapsed( $uncollapsed );
	}

	/**
	 * Set link text and URL
	 *
	 * @param string $text
	 * @param string $url
	 *
	 * @access public
	 */
	public function set_link( $text, $url ) {
		$this->set_link_text( $text );
		$this->set_link_url( $url );
	}

}