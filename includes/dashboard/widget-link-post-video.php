<?php

function s4f_video_post_link_widget() { 
  ?>
  <h3 style="font-size:1.4rem;font-weight:normal"><span style="font-size:1.5em;padding-right:1rem;" class="dashicons dashicons-editor-video"></span> <a href="post-new.php?post_type=video">ADD A NEW VIDEO POST</a></h3>
  <?php 

}

function add_s4f_video_post_link_widget() {
  wp_add_dashboard_widget( 's4f_video_post_link_widget', __( 'New Video Post' ), 's4f_video_post_link_widget' );
}

add_action('wp_dashboard_setup', 'add_s4f_video_post_link_widget' );