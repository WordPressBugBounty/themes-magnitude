<?php
if (!function_exists('magnitude_front_page_main_section')) :
    /**
     * Banner Slider
     *
     * @since Magnitude 1.0.0
     *
     */
    function magnitude_front_page_main_section()
    {
        $magnitude_enable_main_slider = magnitude_get_option('show_main_news_section');

        ?>

        <?php do_action('magnitude_action_banner_exclusive_posts'); ?>
        <?php if ($magnitude_enable_main_slider):
        $banner_layout = magnitude_get_option('select_main_banner_layout_section_mode');
        $magnitude_slider_mode = magnitude_get_option('select_main_banner_section_mode');
        if ($banner_layout == 'boxed') {
            $layout_class = 'af-banner-wrapper';
        } else {
            $layout_class = 'af-wide-banner-wrapper';
        }

        ?>
        <div class="<?php echo $layout_class; ?>">
            <section class="aft-blocks aft-main-banner-section banner-carousel-1-wrap bg-fixed  magnitude-customizer">
                <div class="aft-main-banner-wrapper">
                    <?php
                    if (($magnitude_slider_mode == 'layout-2') || ($magnitude_slider_mode == 'layout-3')) {
                        magnitude_get_block('extended', 'banner');
                    } else {
                        magnitude_get_block('default', 'banner');
                    }
                    ?>
                </div>
            </section>
        </div>

    <?php endif; ?>

        <?php if (is_active_sidebar('below-banner-widgets')): ?>
        <section class="aft-blocks below-banner-widget-section">
            <div class="container-wrapper">

                <div class="below-banner-wrapper">
                    <?php dynamic_sidebar('below-banner-widgets'); ?>
                </div>

            </div>
        </section>
    <?php endif; ?>


        <!-- end slider-section -->
        <?php
    }
endif;
add_action('magnitude_action_front_page_main_section', 'magnitude_front_page_main_section', 40);