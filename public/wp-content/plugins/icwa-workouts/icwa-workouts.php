<?php
/*
Plugin Name: ICWA Workouts
Description: Custom Post Types for Workouts functionality
Author: Kimberly Keller
Version: 1.0
Author URI: http://www.kimberlyannkeller.com
*/


/**
 * TODO: Combine permissions check functions so that there is only one check function
 * currently we check for the same thing twice, once for posts and once for archive and
 * load the appropriate file - need to abstract that process in order to only have one function
 * see: "does user have access"
 */

define('ICWA_WORKOUTS_PLUGIN_URL', plugin_dir_path( __FILE__ ));
/**
 * adds actions
 **/

add_action( 'init', 'workouts_cpt' );

add_action( 'wp_enqueue_scripts', 'icwa_workouts_styles' );

add_action( 'show_user_profile', 'add_custom_user_data' );
add_action( 'edit_user_profile', 'add_custom_user_data' );

add_action( 'personal_options_update', 'save_custom_user_data' );
add_action( 'edit_user_profile_update', 'save_custom_user_data' );


/**
 * icwa-workouts add the requiered stylesheets to the project
 */
function icwa_workouts_styles() {

	wp_enqueue_style('icwa_workouts_main_css', '/wp-content/plugins/icwa-workouts/style.css');
}

/**
 * include local fields
 **/

include_once ('acf-custom-workout-fields.php');

/**
 * registers custom post type for Workouts
 **/


function workouts_cpt() {

	register_post_type( 'workout', array(
		'labels' => array(
			'name' => 'Workouts',
			'singular_name' => 'Workout',
		),
		'description' => 'Individual workouts for ICWA members.',
		'public' => true,
		'has_archive' => true,
		'menu_position' => '',
		'menu_icon' => 'dashicons-admin-generic',
		'capability_type'     => 'post',
		'supports' => array( 'title', 'editor', 'custom-fields' )
	));
}



/**
 * checks to see if user can view content / acf fields
 */

function does_user_have_access() {

	// Grab the current user's info so that we can compare it to the "allowed" users from the ACF "User" field later.
	$current_user = wp_get_current_user();
	//var_dump($current_user);

	// Store the ACF "User" info
	$values = get_field('user');

	if($values) {
		// Create an array of users that will be able to access the page from the ACF "User" field
		$users_that_can_access_this_post = array();
		foreach($values as $value) {
			$user_IDs_that_can_access_this_post[] = $value['ID'];
		}
		// Check to see if the current user is in the "User" field's array
		if (in_array($current_user->ID, $user_IDs_that_can_access_this_post, false) ) {
			// Display the post
			include_once( 'custom-fields-template.php' );
		} else {
			// Hide the post content if the user is not in the ACF "User" array
			echo 'You do not have access to this post.  Please contact the ICWA if you do, indeed, need access.' . edit_post_link('Edit', '', ' ');
		}
	} else {
		// Display something if a post has no users set
		echo 'Please set the user restriction on this post.' . edit_post_link('Edit', '', ' ');
		die();
	}

}

/**
 * checks to see if user can view content for archive
 */
function does_user_have_access_archive() {

	// Grab the current user's info so that we can compare it to the "allowed" users from the ACF "User" field later.
	$current_user = wp_get_current_user();
	//var_dump($current_user);

	// Store the ACF "User" info
	$values = get_field('user');

	if($values) {
		// Create an array of users that will be able to access the page from the ACF "User" field
		$users_that_can_access_this_post = array();
		foreach($values as $value) {
			$user_IDs_that_can_access_this_post[] = $value['ID'];
		}
		// Check to see if the current user is in the "User" field's array
		if (in_array($current_user->ID, $user_IDs_that_can_access_this_post, false) ) {
			// Display the post
			include( 'workouts-archive-template.php' );
		} else {
			// Hide the post content if the user is not in the ACF "User" array
		}
	}
}



function add_custom_user_data( $user )
{
	?>
	<h3>One Rep Max</h3>
	<p>Please enter your one rep max in kilograms</p>

	<table class="form-table">
		<tr>
			<th><label for="backsquat">Back Squat</label></th>
			<td><input type="text" name="backsquat" value="<?php echo esc_attr(get_the_author_meta( 'backsquat', $user->ID )); ?>" class="regular-text" />kg</td>
		</tr>

		<tr>
			<th><label for="cleanjerk">Clean & Jerk</label></th>
			<td><input type="text" name="cleanjerk" value="<?php echo esc_attr(get_the_author_meta( 'cleanjerk', $user->ID )); ?>" class="regular-text" />kg</td>
		</tr>

		<tr>
			<th><label for="snatch">Snatch</label></th>
			<td><input type="text" name="snatch" value="<?php echo esc_attr(get_the_author_meta( 'snatch', $user->ID )); ?>" class="regular-text" />kg</td>
		</tr>
		<tr>
			<th><label for="fontsquat">Front Squat</label></th>
			<td><input type="text" name="frontsquat" value="<?php echo esc_attr(get_the_author_meta( 'frontsquat', $user->ID )); ?>" class="regular-text" />kg</td>
		</tr>
		<tr>
			<th><label for="ohs">Overhead Squat</label></th>
			<td><input type="text" name="ohs" value="<?php echo esc_attr(get_the_author_meta( 'ohs', $user->ID )); ?>" class="regular-text" />kg</td>
		</tr>
		<tr>
			<th><label for="ohp">Overhead Press</label></th>
			<td><input type="text" name="ohp" value="<?php echo esc_attr(get_the_author_meta( 'ohp', $user->ID )); ?>" class="regular-text" />kg</td>
		</tr>
		<tr>
			<th><label for="bench">Bench Press</label></th>
			<td><input type="text" name="bench" value="<?php echo esc_attr(get_the_author_meta( 'bench', $user->ID )); ?>" class="regular-text" />kg</td>
		</tr>
		<tr>
			<th><label for="deadlift">Deadlift</label></th>
			<td><input type="text" name="deadlift" value="<?php echo esc_attr(get_the_author_meta( 'deadlift', $user->ID )); ?>" class="regular-text" />kg</td>
		</tr>
	</table>
	<?php
}

/**
 * Saves the custom fields
 */

function save_custom_user_data( $user_id )
{
	update_user_meta( $user_id,'backsquat', sanitize_text_field( $_POST['backsquat'] ) );
	update_user_meta( $user_id,'cleanjerk', sanitize_text_field( $_POST['cleanjerk'] ) );
	update_user_meta( $user_id,'snatch', sanitize_text_field( $_POST['snatch'] ) );
	update_user_meta( $user_id,'frontsquat', sanitize_text_field( $_POST['frontsquat'] ) );
	update_user_meta( $user_id,'ohs', sanitize_text_field( $_POST['ohs'] ) );
	update_user_meta( $user_id,'ohp', sanitize_text_field( $_POST['ohp'] ) );
	update_user_meta( $user_id,'bench', sanitize_text_field( $_POST['bench'] ) );
	update_user_meta( $user_id,'deadlift', sanitize_text_field( $_POST['deadlift'] ) );
}

/**
 * functions to call up user data for each lift
 */

function get_custom_movement($field) {

	$user_id = get_current_user_id();
	$key = $field;
	$single = true;
	$user_last = get_user_meta( $user_id, $key, $single );
	$user_updated = $user_last;
	return $user_updated;
}



//function calculate_percentage() {
//	$movement = get_custom_movement($field);
//	$percent_rm = $movement*$onerm/100;
//	return $percent_rm;
//}

/**
 * registers single template for custom post type
 */

function get_workout_template($single_template) {
	global $post;

	if ($post->post_type == 'workout') {
		$single_template = plugin_dir_path( __FILE__ ) . '/workouts_template.php';
	}
	return $single_template;
}
add_filter( 'single_template', 'get_workout_template' );

/**
 * registers archive template for custom post type
 */

function get_workout_archive_template( $archive_template ) {
	global $post;

	if ( is_post_type_archive ( 'workout' ) ) {
		$archive_template = plugin_dir_path( __FILE__ ) . '/workouts_archive.php';
	}
	return $archive_template;
}

add_filter( 'archive_template', 'get_workout_archive_template' ) ;


/**
 * add acf to plugin and hide admin options
 */

//// 1. customize ACF path
//add_filter('acf/settings/path', 'my_acf_settings_path');
//
//function my_acf_settings_path( $path ) {
//
//	// update path
//	$path = plugin_dir_path( __FILE__ ) . '/acf/';
//
//	// return
//	return $path;
//
//}
//
//
//// 2. customize ACF dir
//add_filter('acf/settings/dir', 'my_acf_settings_dir');
//
//function my_acf_settings_dir( $dir ) {
//
//	// update path
//	$dir = plugin_dir_path( __FILE__ ) . '/acf/';
//
//	// return
//	return $dir;
//
//}
//
//
//// 3. Hide ACF field group menu item
////add_filter('acf/settings/show_admin', '__return_false');
//
//
//// 4. Include ACF
//include_once( 'acf/acf.php' );




