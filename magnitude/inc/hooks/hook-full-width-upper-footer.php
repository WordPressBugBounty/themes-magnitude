<?php

/**
 * Front page section additions.
 */


if (!function_exists('magnitude_full_width_upper_footer_section')) :
    /**
     *
     * @since Magnitude 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function magnitude_full_width_upper_footer_section()
    {

        if (1 == magnitude_get_option('frontpage_show_latest_posts')) {
            magnitude_get_block('latest');
        }


    }
endif;
add_action('magnitude_action_full_width_upper_footer_section', 'magnitude_full_width_upper_footer_section');
