<?php

function your_dashboard_widget() { 
  /*
  ?>
  <h3>Hello WordPress user!</h3>
  <p>Fill this with HTML or PHP.</p>
  <?php 
  */

  global $post_ID;
 
    if ( ! current_user_can( 'edit_posts' ) ) {
        return;
    }
 
    /* Check if a new auto-draft (= no new post_ID) is needed or if the old can be used */
    $last_post_id = (int) get_user_option( 'dashboard_quick_press_last_post_id' ); // Get the last post_ID.
    if ( $last_post_id ) {
        $post = get_post( $last_post_id );
        if ( empty( $post ) || 'auto-draft' !== $post->post_status ) { // auto-draft doesn't exist anymore.
            $post = get_default_post_to_edit( 'post', true );
            update_user_option( get_current_user_id(), 'dashboard_quick_press_last_post_id', (int) $post->ID ); // Save post_ID.
        } else {
            $post->post_title = ''; // Remove the auto draft title.
        }
    } else {
        $post    = get_default_post_to_edit( 'video', true );
        $user_id = get_current_user_id();
        // Don't create an option if this is a super admin who does not belong to this site.
        if ( in_array( get_current_blog_id(), array_keys( get_blogs_of_user( $user_id ) ) ) ) {
            update_user_option( $user_id, 'dashboard_quick_press_last_post_id', (int) $post->ID ); // Save post_ID.
        }
    }
 
    $post_ID = (int) $post->ID;
    ?>
 
    <form name="post" action="admin-post.php" method="post" class="initial-form hide-if-no-js">
 
        <?php if ( $error_msg ) : ?>
        <div class="error"><?php echo $error_msg; ?></div>
        <?php endif; ?>
 
        <div class="input-text-wrap" id="title-wrap">
            <label for="title">
                <?php
                /** This filter is documented in wp-admin/edit-form-advanced.php */
                echo apply_filters( 'enter_title_here', __( 'Title' ), $post );
                ?>
            </label>
            <input type="text" name="post_title" id="title" autocomplete="off" />
        </div>
 
        <div class="textarea-wrap" id="description-wrap">
            <label for="content"><?php _e( 'Content' ); ?></label>
            <textarea name="content" id="content" placeholder="<?php esc_attr_e( 'What&#8217;s on your mind?' ); ?>" class="mceEditor" rows="3" cols="15" autocomplete="off"></textarea>
        </div>

        <!-- <div class="input-text-wrap" id="video-wrap">
            <label for="video">
                <?php
                /** This filter is documented in wp-admin/edit-form-advanced.php */
                echo apply_filters( 'enter_video_here', __( 'Video' ), $post );
                ?>
            </label>
            <input type="file" name="post_video" id="video" autocomplete="off" />
        </div> -->

        <?php echo do_shortcode("[wordpress_file_upload]"); ?>
 
        <p class="submit">
            <input type="hidden" name="action" id="quickpost-action" value="post-quickdraft-save" />
            <input type="hidden" name="post_ID" value="<?php echo $post_ID; ?>" />
            <input type="hidden" name="post_type" value="post" />
            <?php wp_nonce_field( 'add-post' ); ?>
            <?php submit_button( __( 'Save Draft' ), 'primary', 'save', false, array( 'id' => 'save-post' ) ); ?>
            <br class="clear" />
        </p>
 
    </form>
    <?php
    wp_dashboard_recent_drafts();
}

// function add_your_dashboard_widget() {
//   wp_add_dashboard_widget( 'your_dashboard_widget', __( 'New Video Post' ), 'your_dashboard_widget' );
// }

//add_action('wp_dashboard_setup', 'add_your_dashboard_widget' );

//add_action( 'admin_post.php', 'admin_post' );

function admin_post()
{
    if ( ! current_user_can( 'manage_options' ) )
        return;

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename=example.csv');
    header('Pragma: no-cache');

    // output the CSV data
}