<?php
# =================================
#  Custom Video Category Taxonomy
# =================================

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function register_taxonomy_video_category()
{
  $labels = [
    'name'              => _x('Video Categories', 'taxonomy general name'),
    'singular_name'     => _x('Video Category', 'taxonomy singular name'),
    'search_items'      => __('Search Video Categories'),
    'all_items'         => __('All Video Categories'),
    'parent_item'       => __('Parent Category'),
    'parent_item_colon' => __('Parent Category:'),
    'edit_item'         => __('Edit Video Category'),
    'update_item'       => __('Update Video Category'),
    'add_new_item'      => __('Add New Video Category'),
    'new_item_name'     => __('New Video Category Name'),
    'menu_name'         => __('Video Categories'),
  ];
  $args = [
    'hierarchical'      => true, // make it hierarchical (like categories)
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => true,
    'show_in_rest'      => true,
    'query_var'         => true,
    'rewrite'           => ['slug' => 'video-type'],
  ];
  register_taxonomy( 'video_category', ['video'], $args );
}
add_action( 'init', 'register_taxonomy_video_category' );
