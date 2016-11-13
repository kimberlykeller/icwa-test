<?php
/*
Plugin Name: ICWA Workouts
Description: Custom Post Types for Workouts functionality
Author: Kimberly Keller
Author URI: http://www.kimberlyannkeller.com
*/

/**
 * registers custom post type for Workouts
 **/

add_action( 'init', 'workouts_cpt' );

function workouts_cpt() {

	register_post_type( 'workout', array(
		'labels' => array(
			'name' => 'Workouts',
			'singular_name' => 'Workout',
		),
		'description' => 'Individual workouts for ICWA members.',
		'public' => true,
		'has_archive' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-admin-generic',
			'map_meta_cap'        => true,
			'capability_type'     => array('workout', 'workouts'),
			'capabilities' => array(

				// meta caps (don't assign these to roles)
					'edit_post'              => 'edit_workout',
					'read_post'              => 'read_workout',
					'delete_post'            => 'delete_workout',

				// primitive/meta caps
					'create_posts'           => 'create_workouts',

				// primitive caps used outside of map_meta_cap()
					'edit_posts'             => 'edit_workouts',
					'edit_others_posts'      => 'manage_workouts',
					'publish_posts'          => 'manage_workouts',
					'read_private_posts'     => 'read',

				// primitive caps used inside of map_meta_cap()
					'read'                   => 'read',
					'delete_posts'           => 'manage_workouts',
					'delete_private_posts'   => 'manage_workouts',
					'delete_published_posts' => 'manage_workouts',
					'delete_others_posts'    => 'manage_workouts',
					'edit_private_posts'     => 'edit_workouts',
					'edit_published_posts'   => 'edit_workouts'
			),
		'supports' => array( 'title', 'editor', 'custom-fields' )
	));
}

/**
 * maps custom user capabilities
 **/

add_filter( 'map_meta_cap', 'my_map_meta_cap', 10, 4 );

function my_map_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a workout, get the post and post type object. */
	if ( 'edit_workout' == $cap || 'delete_workout' == $cap || 'read_workout' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a workout, assign the required capability. */
	if ( 'edit_workout' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a workout, assign the required capability. */
	elseif ( 'delete_workout' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private workout, assign the required capability. */
	elseif ( 'read_workout' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}


/**
 * Adds custom fields to user profiles
 * In this case it adds fields for users to save their 1RMs for weightlifting
 */


add_action( 'show_user_profile', 'add_custom_user_data' );
add_action( 'edit_user_profile', 'add_custom_user_data' );

function add_custom_user_data( $user )
{
	?>
	<h3>One Rep Max</h3>

	<table class="form-table">
		<tr>
			<th><label for="backsquat">Back Squat</label></th>
			<td><input type="text" name="backsquat" value="<?php echo esc_attr(get_the_author_meta( 'backsquat', $user->ID )); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="cleanjerk">Clean & Jerk</label></th>
			<td><input type="text" name="cleanjerk" value="<?php echo esc_attr(get_the_author_meta( 'cleanjerk', $user->ID )); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="snatch">Snatch</label></th>
			<td><input type="text" name="snatch" value="<?php echo esc_attr(get_the_author_meta( 'snatch', $user->ID )); ?>" class="regular-text" /></td>
		</tr>
	</table>
	<?php
}

/**
 * Saves the custom fields
 */

add_action( 'personal_options_update', 'save_custom_user_data' );
add_action( 'edit_user_profile_update', 'save_custom_user_data' );

function save_custom_user_data( $user_id )
{
	update_user_meta( $user_id,'backsquat', sanitize_text_field( $_POST['backsquat'] ) );
	update_user_meta( $user_id,'cleanjerk', sanitize_text_field( $_POST['cleanjerk'] ) );
	update_user_meta( $user_id,'snatch', sanitize_text_field( $_POST['snatch'] ) );
}

/**
 * functions to call up user data for each lift
 */


function get_custom_backsquat() {

	$user_id = get_current_user_id();
	$key = 'backsquat';
	$single = true;
	$user_last = get_user_meta( $user_id, $key, $single );
	$user_updated = $user_last;
	return $user_updated;
}

function get_custom_snatch() {

	$user_id = get_current_user_id();
	$key = 'snatch';
	$single = true;
	$user_last = get_user_meta( $user_id, $key, $single );
	$user_updated = $user_last;
	return $user_updated;
}

function get_custom_cleanjerk() {

	$user_id = get_current_user_id();
	$key = 'cleanjerk';
	$single = true;
	$user_last = get_user_meta( $user_id, $key, $single );
	$user_updated = $user_last;
	return $user_updated;
}



function calculate_percentage() {
	$backsquat = get_custom_backsquat();
	$percent_backsquat = $backsquat*.6;
	echo $percent_backsquat;
}

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



