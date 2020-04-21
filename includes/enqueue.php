<?php
add_action('wp_enqueue_scripts',  function() {
  # Theme Stylesheets
  wp_enqueue_style('bootstrap_css', '//solutions4fitness.uk/css/bootstrap.css', array(), 4, 'all');
  wp_enqueue_style('site_css', '//solutions4fitness.uk/css/style.css', array('bootstrap_css'), 0.1, 'all');
  wp_enqueue_style('theme_css', get_stylesheet_directory_uri() . '/css/site.css', array('bootstrap_css', 'site_css'), 0.41, 'all');

  # Theme Javascripts
  wp_enqueue_script('theme_js', get_template_directory_uri() . '/js/site.min.js', array('jquery', 'bootstrap'), 1.02, true);

  // IF (0 && !SwpmMemberUtils::is_member_logged_in() 
  //     && ( is_page('membership-join') || is_front_page() )
  //     ) {
  //   $sb_client_id = 'AdPSDtQS7Zy3yYa2FMu6jXgS5Nl7uNMk9up6DLsI4aeR9nhQ7NjuP9-LbrCEze7c8Xkhns-ulAGitLRM';
  //   wp_enqueue_script('paypal_js', "https://www.paypal.com/sdk/js?client-id={$sb_client_id}", [], 1, true);
  // }

});