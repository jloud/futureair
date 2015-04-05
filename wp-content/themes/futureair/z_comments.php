<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package futureair
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php function fa_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>">
			<header class="comment-author">
				<div class="author-meta">
					<?php printf(__('<cite class="fn">%s / </cite>', 'futureair'), get_comment_author_link()) ?>
					<time class="time" datetime="<?php echo comment_date('M j Y') ?>">
						<?php printf(__('%1$s', 'futureair'), get_comment_date('M j Y'),  get_comment_time()) ?>
					</time>
					<?php edit_comment_link(__(' (Edit your post) ', 'futureair'), '', '') ?>
				</div>
			</header>
			
			<?php if ($comment->comment_approved == '0') : ?>
       	<div class="notice">
					<p class="bottom"><?php _e('Your comment is awaiting moderation.', 'futureair') ?></p>
        </div>
			<?php endif; ?>
			
			<section class="comment">
				<?php comment_text() ?>
				<?php comment_reply_link(array_merge( $args, array('before' => '<span class="reply-arrow"></span>', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</section>

		</article>
<?php } ?>

<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'futureair'));

	if ( post_password_required() ) { ?>
	<section id="comments">
		<div class="notice">
			<p class="bottom"><?php _e('This post is password protected. Enter the password to view comments.', 'futureair'); ?></p>
		</div>
	</section>
	<?php
		return;
	}
?>





<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'futureair' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'futureair' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'futureair' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'futureair' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments('type=comment&callback=fa_comments');
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'futureair' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'futureair' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'futureair' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'futureair' ); ?></p>
	<?php endif; ?>

	<?php //comment_form(); ?>


<?php if (comments_open()) : ?>

<section id="respond" class="row">
	<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
	<?php if ( get_option('comment_registration') && !is_user_logged_in()) : ?>
	<p><?php printf( __('You must be <a href="%s">logged in</a> to post a comment.', 'futureair'), wp_login_url( get_permalink() ) ); ?></p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( is_user_logged_in() ) : ?>
		<p>
		<?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'futureair'), get_option('siteurl'), $user_identity); ?>
			<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'futureair'); ?>">
				<?php _e('Log out &raquo;', 'futureair'); ?>
			</a>
		</p>
		<?php else : ?>
		<p>
			<input type="text" class="five" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> placeholder="Name*">
		</p>
		<p>
			<input type="text" class="five" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> placeholder="Email*">
		</p>
		<?php endif; ?>
		<p>
			<textarea name="comment" id="comment" tabindex="3"></textarea>
		</p>
		<p class="but-sub">
			<input name="submit" class="button" type="submit" id="submit" tabindex="4" value="<?php _e('Submit', 'futureair'); ?>">
		</p>
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>
	</form>
	<?php endif;  ?>
</section>
<?php endif; ?>

</div><!-- #comments -->
