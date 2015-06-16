<?php

$do_not_duplicate = 13;

get_header( 'home' ); ?>

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

	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<div class="pagination-holder">
	<?php
		if ( function_exists('fa_pagination') ) {
			fa_pagination();
		} else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'futureair' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'futureair' ) ); ?></div>
		</nav>
	<?php } ?>
	</div>

	</main><!-- #main -->
</div><!-- .container -->

<div class="clear"></div>

<?php get_footer(); ?>
