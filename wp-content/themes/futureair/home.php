<?php

$do_not_duplicate = 13;

get_header(); ?>

<div class="container">
	<main id="main" class="home-page site-main" role="main">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post();

			if ($post->ID === $do_not_duplicate) {
				continue;
			} else {
				get_template_part( 'content', get_post_format() );
				// echo the_post_thumbnail('medium');
				// echo the_content('<span class="text-more">View more</span>');
			}
			
			endwhile; ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

	</main><!-- #main -->
</div><!-- .container -->
<?php get_footer(); ?>
