<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://zaroutski.com
 * @since             1.0.0
 * @package           Az_Elements
 *
 * @wordpress-plugin
 * Plugin Name:       Elements
 * Plugin URI:        http://zaroutski.com
 * Description:       Organise code inside a theme in a clean simple MVC-like way.
 * Version:           1.0.0
 * Author:            Anton Zaroutski
 * Author URI:        http://zaroutski.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       az-elements
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-az-elements-activator.php
 */
function activate_az_elements() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-az-elements-activator.php';
	Az_Elements_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-az-elements-deactivator.php
 */
function deactivate_az_elements() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-az-elements-deactivator.php';
	Az_Elements_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_az_elements' );
register_deactivation_hook( __FILE__, 'deactivate_az_elements' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-az-elements.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_az_elements() {

	$plugin = new Az_Elements();
	$plugin->run();

}
run_az_elements();
