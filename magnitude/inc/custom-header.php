<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Magnitude
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses magnitude_header_style()
 */
function magnitude_custom_header_setup()
{
    add_theme_support('custom-header', apply_filters('magnitude_custom_header_args', array(
        'default-image' => '',
        'default-text-color' => '000000',
        'width' => 1500,
        'height' => 400,
        'flex-height' => true,
        'wp-head-callback' => 'magnitude_header_style',
    )));
}

add_action('after_setup_theme', 'magnitude_custom_header_setup');

if (!function_exists('magnitude_header_style')) :
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see magnitude_custom_header_setup().
     */
    function magnitude_header_style()
    {
        $header_image_tint_overlay = magnitude_get_option('disable_header_image_tint_overlay');
        $site_title_font_size = magnitude_get_option('site_title_font_size');
        $header_text_color = get_header_textcolor();



        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
            <?php

            if($header_image_tint_overlay):
                ?>

            body .af-header-image.data-bg:before{
                opacity:0;
            }
            <?php
            endif;
            // Has the text been hidden?
            if ( ! display_header_text() ) :
            ?>
            .site-title,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
                display: none;
            }

            <?php
                // If the user has set a custom color for the text use that.
                else :
            ?>
            .site-title a,
            .site-header .site-branding .site-title a:visited,
            .site-header .site-branding .site-title a:hover,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }

            .header-layout-3 .site-header .site-branding .site-title,
            .site-branding .site-title {
                font-size: <?php echo esc_attr( $site_title_font_size ); ?>px;
            }

            @media only screen and (max-width: 640px) {
                .site-branding .site-title {
                    font-size: 40px;

                }
              }   

           @media only screen and (max-width: 375px) {
                    .site-branding .site-title {
                        font-size: 32px;

                    }
                }

            <?php endif; ?>
            .elementor-template-full-width .elementor-section.elementor-section-full_width > .elementor-container,
            .elementor-template-full-width .elementor-section.elementor-section-boxed > .elementor-container{
                max-width: 1200px;
            }

        </style>
        <?php
    }
endif;