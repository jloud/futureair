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
