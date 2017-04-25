<?php

// Add no-follow attribute for certain external domain
function add_nofollow( $content ) {

    $az_dom = "amazon.com";
    preg_match_all( '~<a.*>~isU', $content, $uri_match );

    for ( $i = 0; $i <= sizeof( $uri_match[0] ); $i ++ ) {
        if ( isset( $uri_match[0][ $i ] ) && ! preg_match( '~nofollow~is', $uri_match[0][ $i ] )
             && ( preg_match( '~' . preg_quote( $az_dom ) . '~', $uri_match[0][ $i ] ))
            ) {
            $uri_change = trim( $uri_match[0][ $i ], ">" );
            $uri_change .= ' rel="nofollow">';
            $content = str_replace( $uri_match[0][ $i ], $uri_change, $content );
        }
    }

    return $content;
}

add_filter( 'the_content', 'add_nofollow' );