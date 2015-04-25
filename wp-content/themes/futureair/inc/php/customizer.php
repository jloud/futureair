<?php

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function futureair_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'futureair_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function futureair_customize_preview_js() {
	wp_enqueue_script( 'futureair_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'futureair_customize_preview_js' );


function fa_entry_footer() {

  $tags_list = get_the_tag_list( '', __( ', ', 'futureair' ) );

  if ( $tags_list ) {
    printf( '<span class="tags-links">' . __( '%1$s', 'futureair' ) . '</span>', $tags_list );
  }
  echo '<span class="author"> by '.get_the_author().' </span><span class="time"> / '.get_the_time('M j Y').'</span>';
}


function remove_post_classes($classes) {

  $classArray = array('type-post', 'format-standard', 'hentry', 'has-post-thumbnail', 'category-uncategorized', 'status-publish');

  $classes = array_diff($classes, $classArray);
  return $classes;
}
add_filter('post_class','remove_post_classes');



function exclude_category( $wp_query ) {
  $excluded = array( '-2' );
  set_query_var( 'category__not_in', $excluded );
}

//add_action( 'pre_get_posts', 'exclude_category' );



if ( ! function_exists( 'fa_post_navigation' ) ) :
  function fa_post_navigation() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous ) {
      return;
    }
    ?>
    <nav class="navigation post-navigation" role="navigation">
      <h2 class="screen-reader-text"><?php _e( 'Post navigation', 'futureair' ); ?></h2>
      <div class="nav-links">
        <?php
          previous_post_link( '<div class="nav-button prev">%link</div>', '%title', TRUE, '2' );
          next_post_link( '<div class="nav-button next">%link</div>', '%title', TRUE, '2' );
        ?>
      </div>
    </nav>
    <?php
  }
endif;


function fa_pagination() {
  global $wp_query;
 
  $big = 999999999; // This needs to be an unlikely integer
 
  // For more options and info view the docs for paginate_links()
  // http://codex.wordpress.org/Function_Reference/paginate_links
  $paginate_links = paginate_links( array(
    'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'mid_size' => 5,
    'prev_next' => True,
      'prev_text' => __('<span class="arrows">&#x3C;&#x3C;</span>'),
      'next_text' => __('<span class="arrows">&#x3E;&#x3E;</span>'),
    'type' => 'list'
  ) );
 
  // Display the pagination if more than one page is found
  if ( $paginate_links ) {
    echo $paginate_links;
  }
}

function fa_strip_classes($var) { 
  return is_array($var) ? array_intersect($var, array(
    'menu-item',
    'site-link'
    // 'scroll-top',
    // 'foot',
    // 'web-link',
    // 'art-link',
    // 'home-link',
    // 'email-link'
  ) ) : '';
}
add_filter('nav_menu_css_class', 'fa_strip_classes');
// add_filter('nav_menu_item_id', 'fa_strip_classes');
add_filter('page_css_class', 'fa_strip_classes');


function fa_main_menu() {

  $menu_settings = array(
    'theme_location'  => 'primary',
    'container'       => '',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'link-content',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul id="main-menu" class="%2$s">%3$s</ul>',
    'depth'           => 0,
    'walker'          => ''
  );

  wp_nav_menu( $menu_settings );
}

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


