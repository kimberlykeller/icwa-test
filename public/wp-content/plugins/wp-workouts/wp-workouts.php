<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              kimberlyannkeller.com
 * @since             1.0.0
 * @package           Wp_Workouts
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Workouts
 * Plugin URI:        https://github.com/kimberlykeller/wp-workouts
 * Description:       This plugin allows the admin to write a workout which then utilizes custom data from a registered user to generate a customized workout for the
 * user.
 * Version:           1.0.0
 * Author:            Kimberly Keller
 * Author URI:        kimberlyannkeller.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-workouts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-workouts-activator.php
 */
function activate_wp_workouts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-workouts-activator.php';
	Wp_Workouts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-workouts-deactivator.php
 */
function deactivate_wp_workouts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-workouts-deactivator.php';
	Wp_Workouts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_workouts' );
register_deactivation_hook( __FILE__, 'deactivate_wp_workouts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-workouts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_workouts() {

	$plugin = new Wp_Workouts();
	$plugin->run();

}
run_wp_workouts();
