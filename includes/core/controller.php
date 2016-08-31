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
     * Controller's view object
     *
     * @var null|View
     */
    private $_view = null;

    /**
     * Controller constructor.
     */
    public function __construct( $element ) {

        $this->_element = $element;

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

        $this->_view = new View( $this->_element );

    }

    /**
     * Initiate render of the view
     *
     * @return string
     */
    public function render_view() {

        return $this->_view->render();

    }

    /**
     * Set variable
     *
     * @param string $name
     * @param mixed $value
     */
    public function set_variable( $name, $value ) {

        $this->_view->set_variable( $name, $value );

    }

    /**
     * Get variables
     *
     * @param mixed $value
     */
    public function get_variables() {

        return $this->_view->get_variables();

    }

}