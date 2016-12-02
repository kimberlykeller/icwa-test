<?php

get_header();
?>

<?php if ( have_posts() ) : ?>

	<h1 class="archive-title">All Workouts</h1>


<?php while ( have_posts() ) : the_post();

		does_user_have_access_archive();

endwhile; ?>

<?php endif; ?>



<?php wp_footer(); ?>