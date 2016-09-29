<?php
/**
 * @class
 *
 * Base class for Elements Plugin
 */

namespace AZ;

class Elements {

    /**
     * Location for the elements in the theme
     */
    const ELEMENT_THEME_DIRECTORY = 'az-elements';

    /**
     * Suffix for the element's controller file name
     */
    const ELEMENT_CONTROLLER_FILE_NAME_SUFFIX = '-controller.php';

    /**
     * Suffix for the element's controller class name
     */
    const ELEMENT_CONTROLLER_CLASS_NAME_SUFFIX = '_Controller';

    /**
     * Elements constructor.
     */
    public function __construct() {
    }

    /**
     * Render view using the controller's data
     *
     * @param string $element
     * @param string $classes
     * @param string $container
     * @param array $arguments
     * @return mixed
     */
    public static function render( $element, $classes = '', $container = 'div', $arguments = [] ) {

        if ( $controller_loaded = self::_locate_controller( $element ) ) {

            $controller_class_name = 'AZ\\' . self::prepare_controller_class_name( $element );
            $controller = new $controller_class_name( $element, $arguments );

            return $controller->render_view( $classes, $container );

        }

        return false;

    }

    /**
     * Check that conroller file exists in the theme and load it
     *
     * @param string $element
     * @return bool
     * @static
     */
    private static function _locate_controller( $element ) {

        $theme_directory = get_stylesheet_directory() . '/' . self::ELEMENT_THEME_DIRECTORY;
        $controller_file_name = $theme_directory . '/' . $element . '/' . $element . self::ELEMENT_CONTROLLER_FILE_NAME_SUFFIX;

        if ( file_exists( $controller_file_name ) ) {

            // Include file if clas does not alredy exist
            if ( ! class_exists( 'AZ\\' . self::prepare_controller_class_name( $element ) ) ) {
                require $controller_file_name;
            }

            return true;
        }

        return false;

    }

    /**
     * Check that controller file exists in the theme and load it
     *
     * @param string $element
     * @return bool
     * @static
     */
    private static function prepare_controller_class_name( $element ) {

        return str_replace(' ', '_' , ucwords(str_replace( '-', ' ', $element ) ) ) . self::ELEMENT_CONTROLLER_CLASS_NAME_SUFFIX;

    }

}