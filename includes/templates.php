<?php
add_filter('single_template', function($single_template) {
  global $wp_query, $post;

  foreach((array)get_the_category() as $cat) :
    if(file_exists(get_template_directory() . '/single-' . $cat->slug . '.php'))
      $single_template = get_template_directory() . '/single-' . $cat->slug . '.php';
    elseif(file_exists(get_template_directory() . '/single-' . $cat->term_id . '.php'))
      $single_template = get_template_directory() . '/single-' . $cat->term_id . '.php';
  endforeach;

  return $single_template;
});

// add_filter('page_template', whattemplate);
// add_filter('category_template', whattemplate);
// add_filter('archive_template', whattemplate);
// function whattemplate($template) {
//   echo $template;
//   return $template;
// };