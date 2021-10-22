<?php

namespace QR\Code;

class Wp_Enqueue {
    
    public function __construct() {
        add_action( 'admin_enqueue_scripts', [ $this, 'wp_pqrc_asset' ] );
    }

    public function wp_pqrc_asset( $screen ) {
        if( 'options-general.php' === $screen ) {
            wp_deregister_script( 'jquery' );

            wp_enqueue_style( 'minitoggle-css', WP_PTQR_URL. '/assets/css/minitoggle.css' );
            wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', '3.6.0', true );
            wp_enqueue_script( 'minitoggle-js', WP_PTQR_URL. '/assets/js/minitoggle.js', [ 'jquery'], '1.0', true );
            wp_enqueue_script( 'pqrc-main-js', WP_PTQR_URL. '/assets/js/pqrc-main.js', [ 'jquery'], time(), true );
        }
    }
}