<?php
###### DEVELOPMENT ONLY ######
function which_template_is_loaded() {
	if ( is_super_admin() ) {
    global $template;
    echo '<!-- ';
    print_r( $template );
    echo '  -->';
	}
} 
add_action( 'wp_footer', 'which_template_is_loaded' );
##############################