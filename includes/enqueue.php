<?php
// This file enqueues scripts and styles

defined( 'ABSPATH' ) or die( 'Direct script access disallowed.' );

add_action( 'init', function() {

    add_filter( 'script_loader_tag', function( $tag, $handle ) {
      if ( ! preg_match( '/^bb-/', $handle ) ) { return $tag; }
      return str_replace( ' src', ' async defer src', $tag );
    }, 10, 2 );
  
    add_action( 'wp_enqueue_scripts', function() {
  
        $asset_manifest = json_decode( file_get_contents( BETTERBOOK_ASSET_MANIFEST ), true )['files'];
       
        if ( isset( $asset_manifest[ 'main.css' ] ) ) {
          wp_enqueue_style( 'bb', BETTERBOOK_WIDGET_PATH . $asset_manifest[ 'main.css' ] );
        }
    
         
        wp_enqueue_script( 'bb-runtime', BETTERBOOK_WIDGET_PATH . $asset_manifest[ 'runtime~main.js' ], array(), null, true );
    
        wp_enqueue_script( 'bb-main', BETTERBOOK_WIDGET_PATH . $asset_manifest[ 'main.js' ], array('bb-runtime'), null, true );

        foreach ( $asset_manifest as $key => $value ) {
          if ( preg_match( '@static/js/(.*)\.chunk\.js@', $key, $matches ) ) {
            if ( $matches && is_array( $matches ) && count( $matches ) === 2 ) {
              $name = "bb-" . preg_replace( '/[^A-Za-z0-9_]/', '-', $matches[1] );
              wp_enqueue_script( $name, BETTERBOOK_WIDGET_PATH . $value, array( 'bb-main' ), null, true );
            }
          }
    
          if ( preg_match( '@static/css/(.*)\.chunk\.css@', $key, $matches ) ) {
            if ( $matches && is_array( $matches ) && count( $matches ) == 2 ) {
              $name = "bb-" . preg_replace( '/[^A-Za-z0-9_]/', '-', $matches[1] );
              wp_enqueue_style( $name, BETTERBOOK_WIDGET_PATH . $value, array( 'bb' ), null );
            }
          }
        }
    

    });
  });