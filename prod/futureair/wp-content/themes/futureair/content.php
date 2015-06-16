<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-thumb"><?php the_post_thumbnail('medium'); ?></div>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header>

	<div class="entry-content">
		<p>
		<?php
			remove_filter ('the_content', 'wpautop');
			the_content(
				__( '<span class="more-text">View More <span class="arrows">&#x3E;&#x3E;</span></span>', 'futureair' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			);
		?>
		</p>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php fa_entry_footer(); ?>
	</footer>
</article><!-- #post-## -->