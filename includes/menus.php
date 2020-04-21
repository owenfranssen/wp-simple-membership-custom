<?php
add_action( 'init', function () {
  register_nav_menu('main-menu',__( 'Main Menu' ));
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
  //register_nav_menu('non-member-menu',__( 'Non Member Menu' ));
});

add_filter( 'nav_menu_css_class', function($classes, $item, $args) {
  if($args->menu == "main-menu") {
    $classes[] = "nav-item";
  } /*else if ($args->menu == "member-menu") {
    $classes[] = 'mb-3';
  }*/
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active';
  }
  return $classes;
}, 10, 3);

add_filter( 'nav_menu_link_attributes', function($atts, $item, $args) {
  if($args->menu == "main-menu") {
    $atts['class'] = "nav-link";
  } 
  return $atts;
}, 100, 3);

add_filter( 'nav_menu_css_class', 'menu_item_classes', 10, 4 );
function menu_item_classes( $classes, $item, $args, $depth ) {
    unset($classes);
    $classes[] = 'nav-item';
    return $classes;
}

function add_menuclass( $ulclass ) {
  return preg_replace( '/<a /', '<a class="nav-link"', $ulclass );
}
add_filter( 'wp_nav_menu', 'add_menuclass' );