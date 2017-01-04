<?php

$elements_with_widgets = [

    // 'hero'

];

foreach ( $elements_with_widgets as  $element ) {

    az_elements_register_widget( $element );

}

/**
 * Register widget for this controller
 *
 * @return bool
 * @access public
 */
function az_elements_register_widget( $element ) {

    $widget_class = 'Az_Element_Widget_' . ucwords( str_replace( '-', '_', $element ) );
    $widget_reference = 'az-element-widget-' . strtolower( $element );
    $widget_name = 'AZ Element: ' . ucwords( str_replace( '-', ' ', $element ) );
    $widget_description = 'Displays the ' . $element . ' element';

    $class = '
class ' . $widget_class . ' extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array(
            "classname" => "' . $widget_reference . '",
            "description" => "' . $widget_description. '",
        );
        parent::__construct( "' . $widget_reference . '", "' . $widget_name . '", $widget_ops );
    }

    public function widget( $args, $instance ) {

        echo AZ\Elements::render("' . $element . '");

    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }

    public function register() {
        register_widget( __CLASS__ );
    }

}

';

    eval( $class );

    add_action( 'widgets_init', array( $widget_class, 'register' ) );

}