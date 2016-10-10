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

	<form method="post" name="options" action="options.php">

		<?php
		//Grab all options
		$options = get_option($this->plugin_name);

		// Workout fields
		$name = $options['name'];


		?>

		<?php
		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		?>


		<!--table with rows for name, reps, set, percentage -->

		<table class="widefat">
			<!--Table Headers-->
			<tr>
				<th><strong>Exercise</strong></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Add exercise', $this->plugin_name); ?></span></legend>
						<label for="<?php echo $this->plugin_name; ?>-name">
							<input type="text" id="<?php echo $this->plugin_name;?>-name" name="<?php echo $this->plugin_name; ?>[name]" value="<?php if(!empty($name)) echo $name; ?>" />
							<span><?php esc_attr_e('Add exercise', $this->plugin_name); ?></span>
						</label>
					</fieldset>

				</td>

			</tr>
			<tr>
				<th>Set</th>
				<th>Reps</th>
				<th>% of Max</th>
				<th>Based On</th>
			</tr>
			<!--Table form fields-->
			<tr>
				<td><input type="text" value="Set" class="small-text" id="<?php echo $this->plugin_name; ?>-set" /></td>
				<td><input type="text" value="Reps" class="small-text" id="<?php echo $this->plugin_name; ?>-reps" /></td>
				<td><input type="text" value="" class="small-text" id="<?php echo $this->plugin_name; ?>-percentage" /></td>

				<td><select name="exercise" id="exercise">
						<option selected="selected" value="" id="<?php echo $this->plugin_name; ?>-cleanjerk">Clean & Jerk</option>
						<option value="" id="<?php echo $this->plugin_name; ?>-snatch">Snatch</option>
						<option value="" id="<?php echo $this->plugin_name; ?>-backsquat">Back Squat</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><?php submit_button('Add Set', 'secondary','submit', TRUE); ?></td>
			</tr>
		</table>


		<?php submit_button('Add Exercise', 'primary','submit', TRUE); ?>

		<?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

	</form>

</div>