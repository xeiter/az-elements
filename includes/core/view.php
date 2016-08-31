<?php
/**
 * @class
 * Base class for template view
 */

namespace AZ;

class View {

    /**
     * Location for the elements in the theme
     */
    const ELEMENT_THEME_DIRECTORY = 'elements';

    /**
     * Suffix for the view file name
     */
    const ELEMENT_VIEW_FILE_NAME_SUFFIX = '-view.php';

    /**
     * Template file
     * @var null|string
     */
    private $_template = null;

    /**
     * Element reference
     * @var null|string
     */
    private $_element = null;

    /**
     * Variables registered for the view
     * @var array
     */
    private $_variables = array();

    /**
     * View constructor.
     *
     * @param string $template
     */
    public function __construct( $template ) {

        // Set default template
        $this->_template = $template;

        // Save the element
        $this->_element = $template;

    }

    /**
     * Set template for this view
     *
     * @param string $template
     */
    public function set_template( $template ) {

        $this->_template = $template;

    }

	/**
	 * Render view template
	 *
	 * @param $template
	 * @return string
	 */
	public function render() {

        $theme_directory = get_stylesheet_directory() . '/' . self::ELEMENT_THEME_DIRECTORY;

        $view_file_name = $theme_directory . '/' . $this->_element . '/' . $this->_template . self::ELEMENT_VIEW_FILE_NAME_SUFFIX;

        if ( file_exists( $view_file_name ) ) {

            ob_start();

            foreach ( $this->_variables as $variable_name => $variable_value ) {
                ${$variable_name} = $variable_value;
            }

            require $view_file_name;

            $template_content = str_replace( '``', '"', ob_get_contents() );

            ob_end_clean();

            return $template_content;

        } else {

            $this->_process_error( 'View template file was not found: ' . $view_file_name );

        }

        return false;

	}

    /**
     * Set view variable
     *
     * @param string $name
     * @param mixed $value
     */
    public function set_variable( $name, $value ) {

        $this->_variables[ $name ] = $value;

    }

    /**
	 * Process an error
	 *
	 * @param string $message
	 *
	 * @throws Exception
	 * @access private
	 */
	public function _process_error( $message ) {

		throw new Exception( $message );

	}

	/**
	 * Convert class to string
	 *
	 * @return string
	 * @access public
	 */
	public function __toString() {
		return $this->render();
	}

    /**
     * Get variables
     *
     * @param mixed $value
     */
    public function get_variables() {

       return $this->_variables;

    }

}