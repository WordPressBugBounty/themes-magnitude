<?php
if (!function_exists('magnitude_banner_advertisement')):
    /**
     * Ticker Slider
     *
     * @since Magnitude 1.0.0
     *
     */
    function magnitude_banner_advertisement()
    {


        $magnitude_banner_advertisement = magnitude_get_option('banner_advertisement_section');
        if (('' != $magnitude_banner_advertisement) ) { ?>
            <div class="banner-promotions-wrapper">
                <?php if (('' != $magnitude_banner_advertisement)):
                    $magnitude_banner_advertisement = absint($magnitude_banner_advertisement);
                    $magnitude_banner_advertisement = wp_get_attachment_image($magnitude_banner_advertisement, 'full');
                    $magnitude_banner_advertisement_url = magnitude_get_option('banner_advertisement_section_url');
                    $magnitude_banner_advertisement_url = isset($magnitude_banner_advertisement_url) ? esc_url($magnitude_banner_advertisement_url) : '#';
                    $magnitude_open_on_new_tab = magnitude_get_option('banner_advertisement_open_on_new_tab');
                    $magnitude_open_on_new_tab = ('' != $magnitude_open_on_new_tab) ? '_blank' : '';

                    ?>
                    <div class="promotion-section">
                        <a href="<?php echo esc_url($magnitude_banner_advertisement_url); ?>" >
                            <?php echo $magnitude_banner_advertisement; ?>
                        </a>
                    </div>
                <?php endif; ?>                

            </div>
            <!-- Trending line END -->
            <?php
        }


    }
endif;

add_action('magnitude_action_banner_advertisement', 'magnitude_banner_advertisement', 10);