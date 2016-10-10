<?php


/**
 * The admin-specific functionality of the plugin.
 *
 * @link       kimberlyannkeller.com
 * @since      1.0.0
 *
 * @package    Wp_Workouts
 * @subpackage Wp_Workouts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Workouts
 * @subpackage Wp_Workouts/admin
 * @author     Kimberly Keller <keller.kimberly@gmail.com>
 */
class Wp_Workouts_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Workouts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Workouts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-workouts-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Workouts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Workouts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-workouts-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */


	public function add_plugin_admin_menu() {


//		add_options_page( 'Custom Workouts', 'Workouts', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
//		);

		add_menu_page('Custom Workouts', 'Workouts', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'), 'dashicons-admin-generic');

	}


	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */

	public function add_action_links( $links ) {
		/*
		*  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
		$settings_link = array(
				'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_setup_page() {
		include_once( 'partials/wp-workouts-admin-display.php' );

	}


	/**
	 *
	 * saving/updating data from wp-workouts
	 *
	 **/
	public function options_update() {
		register_setting( $this->plugin_name, $this->plugin_name, array($this, 'validate') );
	}

	/**
	 *
	 * validate and sanitize user input
	 *
	 **/
	public function validate($input) {
		// All text fields inputs
		$valid = array();

		$valid['name'] = (isset($input['name']) && !empty($input['name'])) ? sanitize_text_field($input['name']) : '';
		if (  empty($valid['name']) ) {
			add_settings_error(
					'name',                     // Setting title
					'name_texterror',            // Error ID
					__('Please enter a name', $this->plugin_name),     // Error message
					'error'                         // Type of message
			);
		}

		$valid['reps'] = (isset($input['reps']) && !empty($input['name'])) ? sanitize_text_field($input['reps']) : '';
		if (  empty($valid['reps']) ) {
			add_settings_error(
					'reps',                     // Setting title
					'reps_texterror',            // Error ID
					__('Please enter the number of reps', $this->plugin_name),     // Error message
					'error'                         // Type of message
			);
		}

		$valid['set'] = (isset($input['set']) && !empty($input['set'])) ? sanitize_text_field($input['set']) : '';
		if (  empty($valid['set']) ) {
			add_settings_error(
					'set',                     // Setting title
					'set_texterror',            // Error ID
					__('Please enter the set', $this->plugin_name),     // Error message
					'error'                         // Type of message
			);
		}



		return $valid;
	}


}

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'My Workouts', 'My Workouts', 'subscriber', 'partials/wp-workouts-member-display.php', 'display_plugin_member_page', 'dashicons-tickets', 6  );

}

/**
 * Render the settings page for this plugin.
 *
 * @since    1.0.0
 */

function display_plugin_member_page() {
	include_once( 'partials/wp-workouts-member-display.php' );
}




