<?php

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<div class="clear"></div>

	<div class="link-holder mob">
	<?php include (TEMPLATEPATH . '/inc/php/landing-links.php'); ?>
	</div>

<?php get_footer(); ?>
