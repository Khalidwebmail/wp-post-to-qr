<?php

namespace QR\Code;

class Wp_Code_Settings
{

    /**
     * Class constructor
     */

    public function __construct() {
        add_action('admin_init', [ $this, 'wp_ptqr_settings_init' ] );
    }

    /**
     * Register settings field in general section
     * @return void
     */
    public function wp_ptqr_settings_init() {

        add_settings_section( 'pqrc_section', __( 'Post to QR code', 'qr-code-for-post' ), [ $this, 'wp_ptqr_settings_section' ], 'general' );

        add_settings_field( 'pqrc_height', __( 'QR code height', 'qr-code-for-post' ), [ $this, 'wp_ptqr_display_height' ], 'general', 'pqrc_section' );

        add_settings_field( 'pqrc_width', __( 'QR code width', 'qr-code-for-post' ), [ $this, 'wp_ptqr_display_width' ], 'general', 'pqrc_section' );

        register_setting( 'general', 'pqrc_height', [ 'sanitize_callback' => 'esc_attr' ] );
        register_setting( 'general', 'pqrc_width',  [ 'sanitize_callback' => 'esc_attr' ] );
    }

    /**
     * Create section for plugin settings
     */
    public function wp_ptqr_settings_section() {
        echo "<p>".__( 'QR code settings', 'qr-code-for-post' )."</p>";
    }

    /**
     * Create settings field to take input height
     * @return void
     */
    public function wp_ptqr_display_height() {
        $height = get_option( 'pqrc_height' );
        printf( "<input type='text' name='%s' value='%s'>", 'pqrc_height', $height );
    }

    /**
     * Create settings field to take input width
     * @return void
     */
    public function wp_ptqr_display_width() {
        $width  = get_option( 'pqrc_width' );
        printf( "<input type='text' name='%s' value='%s'>", 'pqrc_width', $width );
    }
}
