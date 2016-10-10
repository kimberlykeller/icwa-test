<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       kimberlyannkeller.com
 * @since      1.0.0
 *
 * @package    Wp_Workouts
 * @subpackage Wp_Workouts/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<h1>boop</h1>

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

<p><?php echo $this->plugin_name;?></p>
