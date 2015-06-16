<?php
global $post;
$do_not_duplicate;
$intro_query = new WP_Query('category_name=Introduction&showposts=1');

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

<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">
<meta name="theme-color" content="#ffffff">

<?php wp_head(); ?>
</head>

<body>

<div id="wrapper" class="wrapper">
	<div id="left-content" class="site-content left page-default">
		<div class="container">
		<header class="main-header" role="banner">
			<h1 class="site-title">
				<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="logo" src="<?php echo get_template_directory_uri(); ?>/inc/imgs/logo.svg">
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