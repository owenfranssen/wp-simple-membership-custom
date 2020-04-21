<?php
function pagination ( $pages = '', $range = 4 ) {
    $showitems = ($range * 2) + 1;
 
    global $paged;
    IF ( empty( $paged ) ) $paged = 1;
 
    IF ( $pages == '' ) {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      IF ( !$pages ) {
        $pages = 1;
      }
    }
 
    IF( 1 != $pages ) {
        echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
        IF ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
        IF ( $paged > 1 && $showitems < $pages ) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
        FOR ( $i=1; $i <= $pages; $i++ )
        {
            IF (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link( $i )."' class=\"inactive\">".$i."</a>";
            }
        }
 
        IF ( $paged < $pages && $showitems < $pages ) echo "<a href=\"".get_pagenum_link( $paged + 1 )."\">Next &rsaquo;</a>";
        IF ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) echo "<a href='".get_pagenum_link( $pages )."'>Last &raquo;</a>";
        echo "</div>\n";
    }
}