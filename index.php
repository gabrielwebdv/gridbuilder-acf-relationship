<?php

function related_shortcode() {
    global $post;
    $output = '';
    $related = get_field( 'related_stories',  false,  false );

    if( !$related ) return;

    add_filter( 'wp_grid_builder/grid/query_args',  function( $content ) use ( $related ) {
    return grid_filter( $content, $related ); }, 12 );

    $output .= do_shortcode( '[wpgb_grid id="17"]' );

    return $output;
} 

add_shortcode( 'related_stories', 'related_shortcode' ); 

function grid_filter( $query_args, $related ) {
    global $post;
    $related_posts = $related;
    $query_args['post__in'] = $related_posts;
    return $query_args;
}

?>
