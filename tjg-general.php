<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://jaxgo.club/
 * @since             0.0.10
 * @package           Tjg_General
 *
 * @wordpress-plugin
 * Plugin Name:       The Johnson Group General
 * Plugin URI:        https://thejohnson.group/
 * Description:       Shortcodes and miscellaneous functions needed for The Johnson Group.
 * Version:           0.0.10
 * Author:            Tyler Karle
 * Author URI:        https://jaxgo.club/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tjg-general
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TJG_GENERAL_VERSION', '0.0.10' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tjg-general-activator.php
 */
function activate_tjg_general() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tjg-general-activator.php';
	Tjg_General_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tjg-general-deactivator.php
 */
function deactivate_tjg_general() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tjg-general-deactivator.php';
	Tjg_General_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tjg_general' );
register_deactivation_hook( __FILE__, 'deactivate_tjg_general' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tjg-general.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.10
 */
function run_tjg_general() {

	$plugin = new Tjg_General();
	$plugin->run();

}
run_tjg_general();
