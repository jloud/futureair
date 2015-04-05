<?php

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'futureair_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function futureair_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on futureair, use a find and replace
	 * to change 'futureair' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'futureair', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'futureair' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'futureair_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // futureair_setup
add_action( 'after_setup_theme', 'futureair_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function futureair_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'futureair' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'futureair_widgets_init' );


function fa_scripts()
{
	wp_enqueue_script( 'fa-jquery', get_template_directory_uri() . '/js/jquery-1.11.2.min.js', array(), '1', true );
	wp_enqueue_script( 'fa-smoothstate', get_template_directory_uri() . '/js/jquery.smoothState.js', array(), '1', true );
	wp_enqueue_script( 'fa-main', get_template_directory_uri() . '/js/main.js', array(), '1', true );
	wp_enqueue_script( 'futureair-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
}
add_action( 'wp_enqueue_scripts', 'fa_scripts' );


function futureair_styles()
{
  wp_register_style('main-styles', get_template_directory_uri() . '/css/styles.css', array(), '1.0', 'all');
  wp_enqueue_style('main-styles');
}
add_action('wp_enqueue_scripts', 'futureair_styles'); 


function removeReadMoreHash($link) {
   $offset = strpos($link, '#more-');
   if ($offset) {
	  $end = strpos($link, '"',$offset);
   }
   if ($end) {
	  $link = substr_replace($link, '', $offset, $end-$offset);
   }
   return $link;
}
add_filter('the_content_more_link', 'removeReadMoreHash');


function xf_tag_cloud($tag_string){
   return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}
add_filter('wp_generate_tag_cloud', 'xf_tag_cloud',10,3);

/**
* Implement the Custom Header feature.
*/
require get_template_directory() . '/inc/custom-header.php';

/**
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';

/**
* Custom functions that act independently of the theme templates.
*/
require get_template_directory() . '/inc/extras.php';

/**
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';

/**
* Load Jetpack compatibility file.
*/
require get_template_directory() . '/inc/jetpack.php';

remove_filter('the_excerpt', 'wpautop');



// function fa_limit_posts_on ($query) {

//   $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//   $first_page_limit = 3;
//   $limit = get_option('posts_per_page');
//   $offset = 3;

//   if (!is_admin()) {
//   	if($query->is_main_query()) {
// 	    if ($paged === 1) {
// 	      $limit = $first_page_limit;
// 	    } else {
// 	      $offset = $first_page_limit + (($paged - 1) * $limit);
// 	      set_query_var('offset', $offset);   
// 	    }
// 	    set_query_var('posts_per_page', $limit);
//   	} else {
//   		set_query_var('posts_per_page', $limit);
//   	}
//   } else {
//   	set_query_var('posts_per_page', $limit);
//   }
// }
// add_filter('pre_get_posts', 'fa_limit_posts_on');


// function fa_pagination() {
// 	global $wp_query;

// 	$big = 999999999; // This needs to be an unlikely integer

// 	// For more options and info view the docs for paginate_links()
// 	// http://codex.wordpress.org/Function_Reference/paginate_links
// 	$paginate_links = paginate_links( array(
// 		'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
// 		'current' => max( 1, get_query_var('paged') ),
// 		'total' => $wp_query->max_num_pages,
// 		'mid_size' => 5,
// 		'prev_next' => True,
// 	    'prev_text' => __('&laquo;'),
// 	    'next_text' => __('&raquo;'),
// 		'type' => 'list'
// 	) );

// 	if ( $paginate_links ) {
// 		echo '<div class="pagination-centered">';
// 		echo $paginate_links;
// 		echo '</div><!--// end .pagination -->';
// 	}
// }

