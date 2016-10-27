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
    const ELEMENT_THEME_DIRECTORY = 'az-elements';

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
    public function __construct( $template, $arguments = [] ) {

        // Set default template
        $this->_template = $template;

        // Save the element
        $this->_element = $template;

        // Save the arguments
        $this->_arguments = $arguments;

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
     * Show hints in the view template
     * @param  bool $value
     */
    public function show_hints( $value ) {
        $this->_show_hints = $value;
    }

    /**
     * Render variables hint
     *
     * @return string
     */
    protected function _render_variables_hint() {

        if ( $this->_show_hints ) {

            $variables_html = '';

            foreach ( $this->_variables as $variable_name => $variable_options ) {
                $variables_html .= '<tr>';
                $variables_html .= '<td style="padding-left: 15px;"><var>$' . $variable_name . '</var></td>';
                $variables_html .= '<td><pre>' . print_r( $variable_options['value'], true ) . '</pre></td>';
                $variables_html .= '<td>' . $variable_options['description'] . '</td>';
                $variables_html .= '</tr>';
            }

            foreach ( $this->_arguments as $variable_name => $variable_value ) {
                $variables_html .= '<tr>';
                $variables_html .= '<td style="padding-left: 15px;"><var>$' . $variable_name . '</var></td>';
                $variables_html .= '<td>' . print_r( $variable_value, true ) . '</td>';
                $variables_html .= '<td>' . $variable_options['description'] . '</td>';
                $variables_html .= '</tr>';
            }

            $html = <<<MULTI

<style type="text/css">
    .view__hints table { font-size: 12px; }
</style>

<div class="view__hints panel panel-default">

    <div class="panel-heading">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Available variables <i class="glyphicon glyphicon-zoom-in"></i>
            </a>
    </div>

    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
            <table class="table table-hover">
                <tr>
                    <th style="padding-left: 15px;"">Variable</th>
                    <th>Value</th>
                    <th>Description</th>
                </tr>
                {$variables_html}
            </table>
        </div>
    </div>

</div>

MULTI;

            return $html;

        }
    }

	/**
	 * Render view template
	 *
	 * @param string $element
	 * @param string $classes
     * @param string $container
     * @param array $args
	 * @return string
	 */
	public function render( $element, $classes = '', $container = 'div' ) {

        $theme_directory = get_stylesheet_directory() . '/' . self::ELEMENT_THEME_DIRECTORY;

        $view_file_name = $theme_directory . '/' . $this->_element . '/' . $this->_template . self::ELEMENT_VIEW_FILE_NAME_SUFFIX;

        if ( file_exists( $view_file_name ) ) {

            ob_start();

            echo $this->_render_variables_hint();

            foreach ( $this->_variables as $variable_name => $variable_options ) {
                ${$variable_name} = $variable_options['value'];
            }

            foreach ( $this->_arguments as $variable_name => $variable_value ) {
                ${$variable_name} = $variable_value;
            }

            $class = 'element element__' . $element . ' element-view__' . $this->_template . ' ' . $classes;

            if ( ! is_null( $container ) ) {
                echo '<' . $container . ' class="' . $class . ' mb6">';
            }

            require $view_file_name;

            if ( ! is_null( $container ) ) {
                echo '</' . $container . '>';
            }

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
     * @param string $description
     */
    public function set_variable( $name, $value, $description = null ) {

        $this->_variables[ $name ] = [ 'value' => $value, 'description' => $description ];

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
