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
     * @param string $classes
     * @param string $container
     * @return string
     */
    public function render_view( $classes = '', $container = 'div') {

        return $this->_view->render( $this->_element, $classes, $container );

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

}