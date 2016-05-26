<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       kimberlyannkeller.com
 * @since      1.0.0
 *
 * @package    Wp_Workouts
 * @subpackage Wp_Workouts/admin/partials
 .*/
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<br />

	<form method="post" name="workouts" action="workouts.php">

		<!--table with rows for name, reps, set, percentage -->

		<table class="widefat">
			<!--Table Headers-->
			<tr>
				<th><strong>Exercise</strong></th>
				<td><input type="text" value="Name" class="all-options" /></td></td>
			</tr>
			<tr>
				<th>Set</th>
				<th>Reps</th>
				<th>% of Max</th>
				<th>Based On</th>
			</tr>
			<!--Table form fields-->
			<tr>
				<td><input type="text" value="Set" class="small-text" /></td>
				<td><input type="text" value="Reps" class="small-text" /></td>
				<td><input type="text" value="" class="small-text" /></td>

				<td><select name="exercise" id="exercise">
						<option selected="selected" value="">Clean & Jerk</option>
						<option value="">Snatch</option>
						<option value="">Back Squat</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><?php submit_button('Add Set', 'secondary','submit', TRUE); ?></td>
			</tr>
		</table>


		<?php submit_button('Add Exercise', 'primary','submit', TRUE); ?>

	</form>

</div>