<?php /**
 * acf fields for workout displayed here
 * TODO: abstract field calculations out to main functions file
 */
?>

<?php if( have_rows('movements') ): ?>

<?php	while ( have_rows('movements') ) : the_row(); ?>

	<?php	if( get_row_layout() == 'based_on_backsquat' ):

		$name = get_sub_field('name');
		$sets = get_sub_field('sets');
		$reps = get_sub_field('reps');
		$onerm = get_sub_field('%_of_1rm');

		$backsquat = get_custom_backsquat();
		$percent_backsquat = $backsquat*$onerm/100;
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
				<td><h2><?php echo $percent_backsquat; ?> kg</h2></td>
			</tr>
		</table>
	<?php	elseif( get_row_layout() == 'based_on_snatch' ):

		$name = get_sub_field('name');
		$sets = get_sub_field('sets');
		$reps = get_sub_field('reps');
		$onerm = get_sub_field('%_of_1rm');

		$snatch = get_custom_snatch();
		$percent_snatch = $snatch*$onerm/100;
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
				<td><h2><?php echo $percent_snatch; ?> kg</h2></td>
			</tr>
		</table>

	<?php	endif; ?>

<?php endwhile; ?>

<?php	else :

// no layouts found

endif;

?>

<?php // endif; ?>