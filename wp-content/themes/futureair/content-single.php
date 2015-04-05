<div class="container single-post">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-thumb"><?php the_post_thumbnail('medium'); ?></div>
		<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'futureair' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
		<?php fa_entry_footer(); ?>
		</footer>

		<?php fa_post_navigation(); ?>

	</article><!-- #post-## -->

	<?php
		if ( comments_open() || get_comments_number() ) :
				comments_template();
		endif;
	?>
</div><!-- .container -->
<div class="clear"></div>