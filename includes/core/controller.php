<?php
/**
 * @class
 *
 * Base class for controller
 */

namespace AZ;

class Controller {

    /**
     * Reference of the element
     *
     * @var null|string
     */
    private $_element = null;

    /**
     * Controllers arguments
     *
     * @var null|string
     */
    protected $_arguments = null;

    /**
     * Controller's view object
     *
     * @var null|View
     */
    private $_view = null;

    /**
     * Specifies whether the view should be rendered
     * 
     * @var bool
     */
    private $_render_view = true;

    /**
     * ID of the current post
     * 
     * @var int
     * @access private
     */
    private $_post_id = null;

    /**
     * Controller constructor.
     */
    public function __construct( $element, $arguments = [] ) {

        global $post;

        $this->_element = $element;
        $this->_arguments = $arguments;
        $this->_post_id = $post->ID;

        self::run();
        $this->run();
        
    }

    /**
     * Set the template for the view
     *
     * @param string $template
     */
    public function set_view_template( $template ) {

        $this->_view->set_template( $template );

    }

    /**
     * Run the controller
     */
    public function run() {

        $this->_view = new View( $this->_element, $this->_arguments );

    }

    /**
     * Initiate render of the view
     *
     * @param string $classes
     * @param string $container
     * @return string
     */
    public function render_view( $classes = '', $container = 'div', $bottom_margin = null ) {

        if ( $this->_render_view ) {
            return $this->_view->render( $this->_element, $classes, $container, $bottom_margin );
        }
        
        return null;

    }

    /**
     * Set variable
     *
     * @param string $name
     * @param mixed $value
     * @param string $description
     */
    public function set_variable( $name, $value, $description = '' ) {

        $this->_view->set_variable( $name, $value, $description  );

    }

    /**
     * Get view variable
     *
     * @param string $name
     * @return mixed
     */
    public function get_variable( $name ) {

        return $this->_view->get_variable( $name ) ['value'];

    }

    /**
     * Get variables
     *
     * @param mixed $value
     */
    public function get_variables() {

        return $this->_view->get_variables();

    }

    /**
     * Show/Hide hits
     *
     * @param mixed $value
     */
    public function show_hints( $value = true) {

        return $this->_view->show_hints( $value );

    }

    /**
     * Set flag that intructs to render (or not) the view
     *
     * @param bool $value
     */
    public function set_render_view( $value ) {

        $this->_render_view = $value;

    }

    /**
     * Get the current post's ID
     *
     * @access public
     * @return int
     */
    public function get_post_id() {

        return $this->_post_id;

    }

}
