<?php
/**
 * Recommended plugins
 *
 * @package Magnitude
 */

if ( ! function_exists( 'magnitude_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function magnitude_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'TemplateSpare', 'magnitude' ),
                'slug'     => 'templatespare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Elespare', 'magnitude' ),
                'slug'     => 'elespare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Blockspare', 'magnitude' ),
                'slug'     => 'blockspare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'WP Post Author', 'magnitude' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Free Live Chat using 3CX', 'magnitude' ),
                'slug'     => 'wp-live-chat-support',
                'required' => false,
            )
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'magnitude_recommended_plugins' );
