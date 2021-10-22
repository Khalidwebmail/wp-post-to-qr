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

        add_settings_field( 'pqrc_height', __( 'QR code height', 'qr-code-for-post' ), [ $this, 'wp_ptqr_display_field' ], 'general', 'pqrc_section', [ 'pqrc_height' ] );

        add_settings_field( 'pqrc_width', __( 'QR code width', 'qr-code-for-post' ), [ $this, 'wp_ptqr_display_field' ], 'general', 'pqrc_section', [ 'pqrc_width' ] );

        add_settings_field( 'pqrc_toggle', __( 'QR code toggle', 'qr-code-for-post' ), [ $this, 'wp_ptqr_display_toggle_field' ], 'general', 'pqrc_section', [ 'pqrc_toggle' ] );

        register_setting( 'general', 'pqrc_height', [ 'sanitize_callback' => 'esc_attr' ] );
        register_setting( 'general', 'pqrc_width',  [ 'sanitize_callback' => 'esc_attr' ] );
        register_setting( 'general', 'pqrc_toggle' );
    }

    /**
     * Create input field for plugin settings
     */
    public function wp_ptqr_display_field( $args ) {
        $options = get_option( $args[0] );
        printf( "<input type='text' id='%s' name='%s' value='%s'>", $args[0], $args[0], $options );
    }

    /**
     * Create section for plugin settings
     */
    public function wp_ptqr_settings_section() {
        echo "<p>".__( 'QR code settings', 'qr-code-for-post' )."</p>";
    }

    public function wp_ptqr_display_toggle_field() {
        $options = get_option( 'pqrc_toggle' );
        echo '<div id="toggle"></div>';
        echo "<input type='hidden' name='pqrc_toggle' id='pqrc_toggle' value='". esc_attr( $options )."'>";
    }
}
