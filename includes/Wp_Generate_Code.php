<?php

namespace QR\Code;

class Wp_Generate_Code {
    
    /**
     * Class constructor
     */
    public function __construct() {
        add_filter( 'the_content', [ $this, 'wp_ptqr_display_code' ] );
    }

    /**
     * Create QR code for signle post
     * @param string $content
     * @return $content
     */
    public function wp_ptqr_display_code( $content ) {
        $current_post_id        = get_the_ID();
        $current_post_title     = get_the_title( $current_post_id );
        $current_post_url       = urlencode( get_the_permalink( $current_post_id ) );

        $height = get_option('pqrc_height') ? get_option('pqrc_height') : 150;;
        $width  = get_option('pqrc_width')  ? get_option('pqrc_width')  : 150;;

        $img_src                = sprintf( "https://api.qrserver.com/v1/create-qr-code/?size={$width}x{$height}&data=%s", $current_post_url );
        $content .= sprintf( "<div class='qrcode'><img src='%s' alt='%s'></div>", $img_src, $current_post_title );
        return $content;
    }
}