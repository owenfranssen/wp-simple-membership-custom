<?php
add_action('pre_get_posts', 's4f_check_user_access');

function s4f_check_user_access($query) {
  IF (is_admin()){
    //Inside the admin dashboard. Nothing to do.
    return;
  }

  IF ( !SwpmMemberUtils::is_member_logged_in()
      && !$query->is_front_page()
      && !$query->is_home()
      && !$query->is_page( array( 'membership-login', 'membership-join', 'membership-registration' ))
      && ( !in_array( $query->query_vars['page_id']+0, [
          get_page_by_path( 'membership-join' )->ID,
          get_page_by_path( 'membership-login' )->ID ]
        ) 
        || $query->query_vars['page_id']+0 === 0 )
   ) {
    wp_redirect(get_permalink(get_page_by_path('membership-join')));
    exit;
  }

  // IF( SwpmMemberUtils::is_member_logged_in() 
  //     && $query->is_front_page() ) {
  //   // send to video taxonomy page
  // }
}