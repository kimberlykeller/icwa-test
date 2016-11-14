<?php

get_header();
?>


<?php if ( have_posts() ) : ?>

		<h1>All Workouts</h1>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post();

		does_user_have_access_archive();


 		endwhile; ?>

		<?php endif; ?>


<?php wp_footer(); ?>