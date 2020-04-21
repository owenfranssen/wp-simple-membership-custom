<?php
# =============================
#  Custom Video post type
# =============================

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function videos_init() {
    $args = array(
      'labels' => array(
          'name'                  => __('Videos'),
          'singular_name'         => __('Video'),
          'add_new'               => __('Add New Video'),
          'add_new_item'          => __('Add a New Video'),
          'all_items'             => __('All Videos'),
          'edit_item'             => __('Edit Video'),
          'view_item'             => __('View Videos'),
          'search_items'          => __('Search Videos'),
          'featured_image'        => __('Video Cover Photo'),
          'set_featured_image'    => __('Set Video Cover Photo'),
          'remove_featured_image' => __('Remove Video Cover Photo')
        ),
      'description'           => "Uploaded Videos",
      'public'                => true,
      'show_ui'               => true,
      'capability_type'       => 'post',
      'has_archive'           => true,
      'hierarchical'          => true,
      'rewrite'               => true,
      'query_var'             => true,
      'menu_icon'             => 'dashicons-editor-video',
      'show_in_rest'          => true,
      'supports'              => [
                                'title',
                                //'editor',
                                'thumbnail',
                                'custom-fields'],
      'taxonomies'            => ['video_category']
      );
    register_post_type( 'video', $args );

    # ----------------------------------------------------
    # Create date based permalinks for video posts
    # ----------------------------------------------------
    global $wp_rewrite;
    $wp_rewrite->add_permastruct(
      'video',
      "/%year%/%monthnum%/%day%/%video%/",
      array( 'with_front' => true )
    );
    // add_rewrite_rule(
    //   'videos/^([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$',
    //   'index.php?post_type=video&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]',
    //   'top'
    // );
    // add_rewrite_rule(
    //   'videos/^([0-9]{4})/([0-9]{1,2})/?$',
    //   'index.php?post_type=video&year=$matches[1]&monthnum=$matches[2]',
    //   'top'
    // );
    // add_rewrite_rule(
    //   'videos/^([0-9]{4})/?$',
    //   'index.php?post_type=video&year=$matches[1]',
    //   'top'
    // );
}
add_action( 'init', 'videos_init' );

function video_permalinks( $url, $post ) {
  if ( 'video' == get_post_type( $post ) ) {
    $url = str_replace( "%year%", get_the_date('Y'), $url );
    $url = str_replace( "%monthnum%", get_the_date('m'), $url );
    $url = str_replace( "%day%", get_the_date('d'), $url );
  }
  return $url;
}
add_filter( 'post_type_link', 'video_permalinks', 10, 2 );

# ----------------------------------------------------
# Set default category for new videos if none selected
# ----------------------------------------------------
function save_video_post( $post_id, $post ) {
  if ( 'publish' === $post->post_status && $post->post_type === 'video' ) {
    $defaults = array(
      'video_category' => array( 'fitness' )
      );
    $taxonomies = get_object_taxonomies( $post->post_type );
    foreach ( (array) $taxonomies as $taxonomy ) {
      $terms = wp_get_post_terms( $post_id, $taxonomy );
      if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
          wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
      }
    }
  }
}
add_action('save_post', 'save_video_post', 0, 2);

# ----------------------------------------------------
# Set default category for new videos if none selected
# ----------------------------------------------------
function rearrange_media_tabs($_default_tabs) {
  $_default_tabs = array(        
      'library'  => __( 'Media Library' ),
      'type'     => __( 'From Computer' )
  );

 return $_default_tabs;
}

add_filter( 'media_upload_tabs', 'rearrange_media_tabs' );