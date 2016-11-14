<?php /**
 * main content for workouts
 * acf fields for workout displayed here
 * TODO: abstract field calculations out to main functions file
 * TODO: Use a loop to call each layout field instead of copy pasting
 */
?>


<?php while ( have_posts() ) : the_post();

	// Include the single post content template.
	the_content();

	// End of the loop.
endwhile;
?>

<?php if( have_rows('movements') ): ?>

	<?php	while ( have_rows('movements') ) : the_row(); ?>

		<?php	if( get_row_layout() == 'based_on_backsquat' ):

			$name = get_sub_field('name');
			$sets = get_sub_field('sets');
			$reps = get_sub_field('reps');
			$onerm = get_sub_field('%_of_1rm');

			$field = 'backsquat';
			$movement = get_custom_movement($field);
			$percent_rm = $movement*$onerm/100;
			?>

			<h2><?php echo $name; ?></h2>
			<table>
				<tr>
					<th>sets</th>
					<th>reps</th>
					<th>kg</th>
				</tr>
				<tr>
					<td><h2><?php echo $sets; ?> sets</h2></td>
					<td><h2><?php echo $reps; ?> reps</h2></td>
					<td><h2><?php echo $percent_rm; ?> kg</h2></td>
				</tr>
			</table>
		<?php	elseif( get_row_layout() == 'based_on_snatch' ):

			$name = get_sub_field('name');
			$sets = get_sub_field('sets');
			$reps = get_sub_field('reps');
			$onerm = get_sub_field('%_of_1rm');

			$field = 'snatch';
			$movement = get_custom_movement($field);
			$percent_rm = $movement*$onerm/100;
			?>

			<h2><?php echo $name; ?></h2>
			<table>
				<tr>
					<th>sets</th>
					<th>reps</th>
					<th>kg</th>
				</tr>
				<tr>
					<td><h2><?php echo $sets; ?> sets</h2></td>
					<td><h2><?php echo $reps; ?> reps</h2></td>
					<td><h2><?php echo $percent_rm; ?> kg</h2></td>
				</tr>
			</table>

		<?php	elseif( get_row_layout() == 'based_on_cleanjerk' ):

			$name = get_sub_field('name');
			$sets = get_sub_field('sets');
			$reps = get_sub_field('reps');
			$onerm = get_sub_field('%_of_1rm');

			$field = 'cleanjerk';
			$movement = get_custom_movement($field);
			$percent_rm = $movement*$onerm/100;
			?>

			<h2><?php echo $name; ?></h2>
			<table>
				<tr>
					<th>sets</th>
					<th>reps</th>
					<th>kg</th>
				</tr>
				<tr>
					<td><h2><?php echo $sets; ?> sets</h2></td>
					<td><h2><?php echo $reps; ?> reps</h2></td>
					<td><h2><?php echo $percent_rm; ?> kg</h2></td>
				</tr>
			</table>

		<?php	elseif( get_row_layout() == 'based_on_frontsquat' ):

			$name = get_sub_field('name');
			$sets = get_sub_field('sets');
			$reps = get_sub_field('reps');
			$onerm = get_sub_field('%_of_1rm');

			$field = 'frontsquat';
			$movement = get_custom_movement($field);
			$percent_rm = $movement*$onerm/100;
			?>

			<h2><?php echo $name; ?></h2>
			<table>
				<tr>
					<th>sets</th>
					<th>reps</th>
					<th>kg</th>
				</tr>
				<tr>
					<td><h2><?php echo $sets; ?> sets</h2></td>
					<td><h2><?php echo $reps; ?> reps</h2></td>
					<td><h2><?php echo $percent_rm; ?> kg</h2></td>
				</tr>
			</table>

		<?php	elseif( get_row_layout() == 'based_on_ohs' ):

			$name = get_sub_field('name');
			$sets = get_sub_field('sets');
			$reps = get_sub_field('reps');
			$onerm = get_sub_field('%_of_1rm');

			$field = 'ohs';
			$movement = get_custom_movement($field);
			$percent_rm = $movement*$onerm/100;
			?>

			<h2><?php echo $name; ?></h2>
			<table>
				<tr>
					<th>sets</th>
					<th>reps</th>
					<th>kg</th>
				</tr>
				<tr>
					<td><h2><?php echo $sets; ?> sets</h2></td>
					<td><h2><?php echo $reps; ?> reps</h2></td>
					<td><h2><?php echo $percent_rm; ?> kg</h2></td>
				</tr>
			</table>

		<?php	elseif( get_row_layout() == 'based_on_ohp' ):

			$name = get_sub_field('name');
			$sets = get_sub_field('sets');
			$reps = get_sub_field('reps');
			$onerm = get_sub_field('%_of_1rm');

			$field = 'ohp';
			$movement = get_custom_movement($field);
			$percent_rm = $movement*$onerm/100;
			?>

			<h2><?php echo $name; ?></h2>
			<table>
				<tr>
					<th>sets</th>
					<th>reps</th>
					<th>kg</th>
				</tr>
				<tr>
					<td><h2><?php echo $sets; ?> sets</h2></td>
					<td><h2><?php echo $reps; ?> reps</h2></td>
					<td><h2><?php echo $percent_rm; ?> kg</h2></td>
				</tr>
			</table>

		<?php	elseif( get_row_layout() == 'based_on_bench' ):

			$name = get_sub_field('name');
			$sets = get_sub_field('sets');
			$reps = get_sub_field('reps');
			$onerm = get_sub_field('%_of_1rm');

			$field = 'bench';
			$movement = get_custom_movement($field);
			$percent_rm = $movement*$onerm/100;
			?>

			<h2><?php echo $name; ?></h2>
			<table>
				<tr>
					<th>sets</th>
					<th>reps</th>
					<th>kg</th>
				</tr>
				<tr>
					<td><h2><?php echo $sets; ?> sets</h2></td>
					<td><h2><?php echo $reps; ?> reps</h2></td>
					<td><h2><?php echo $percent_rm; ?> kg</h2></td>
				</tr>
			</table>

		<?php	elseif( get_row_layout() == 'based_on_deadlift' ):

			$name = get_sub_field('name');
			$sets = get_sub_field('sets');
			$reps = get_sub_field('reps');
			$onerm = get_sub_field('%_of_1rm');

			$field = 'deadlift';
			$movement = get_custom_movement($field);
			$percent_rm = $movement*$onerm/100;
			?>

			<h2><?php echo $name; ?></h2>
			<table>
				<tr>
					<th>sets</th>
					<th>reps</th>
					<th>kg</th>
				</tr>
				<tr>
					<td><h2><?php echo $sets; ?> sets</h2></td>
					<td><h2><?php echo $reps; ?> reps</h2></td>
					<td><h2><?php echo $percent_rm; ?> kg</h2></td>
				</tr>
			</table>

		<?php	endif; ?>

	<?php endwhile; ?>

<?php	else :

// no layouts found

endif;

?>

<?php // endif; ?>