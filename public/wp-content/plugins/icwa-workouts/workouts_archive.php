<?php

get_header();
?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">

					<?php

					$args = [
						'post_type'      => 'workout',
						'posts_per_page' => 10,
					];

					$loop = new WP_Query($args);

					while ($loop->have_posts()) {

						$loop->the_post();
						?>

						<div class="entry-content">
							<?php the_title(); ?>
						</div>
					<?php	} ?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

		</main><!-- .site-main -->

	</div><!-- .content-area -->


<?php wp_footer(); ?>