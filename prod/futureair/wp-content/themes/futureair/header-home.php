<?php
global $post;
$do_not_duplicate;

$args = array(
	'name' => 'intro-front-page',
	'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 1,
  'caller_get_posts'=> 1
);

$intro_query = new WP_Query($args);

$tagArgs = array(
	'largest'                   => 22,
	'unit'                      => 'pt', 
	'number'                    => 45,  
	'format'                    => 'list',
	'orderby'                   => 'name', 
	'order'                     => 'ASC',
	'exclude'                   => null, 
	'include'                   => null, 
	'topic_count_text_callback' => default_topic_count_text,
	'link'                      => 'view', 
	'taxonomy'                  => 'post_tag', 
	'echo'                      => true,
	'child_of'                  => null, // see Note!
);

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body>

<div id="wrapper" class="wrapper">
	<div id="left-content" class="site-content left page-home">
		<div class="container">
		<header class="main-header" role="banner">
			<h1 class="site-title">
				<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img alt="FutureAir" class="logo" src="<?php echo get_template_directory_uri(); ?>/inc/imgs/logo.svg">
				</a>
			</h1>
			<div class="intro">
			<?
		  	while ($intro_query->have_posts()) : $intro_query->the_post();
		 			echo the_content();
		 		endwhile;
		 	?>
			</div><!-- intro -->
		</header><!-- .main-header -->
		<div class="link-holder desk">
			<?php include (TEMPLATEPATH . '/inc/php/landing-links.php'); ?>
		</div><!-- .link-holder -->

		</div><!-- .container -->

	</div><!-- #left-content -->

	<div id="right-content" class="site-content right">