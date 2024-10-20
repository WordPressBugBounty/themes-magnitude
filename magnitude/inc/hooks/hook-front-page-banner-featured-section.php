<?php
if (!function_exists('magnitude_banner_featured_section')):
    /**
     * Ticker Slider
     *
     * @since Magnitude 1.0.0
     *
     */
    function magnitude_banner_featured_section()
    {
        $show_featured_section = true;
        $featured_category_checkbox = magnitude_get_option('show_featured_category_section');
        $selected_page_cat = magnitude_get_option('show_featured_category_page_section');
        ?>


        <?php if (!empty($featured_category_checkbox) && $selected_page_cat == 'category') {
        $magnitude_featured_category_title = magnitude_get_option('featured_category_section');
            ?>
            <section class="aft-blocks featured-cate-sec magnitude-customizer">
                <div class="container-wrapper">
                    <?php if(!empty( $magnitude_featured_category_title)){ ?>
                        <div class="af-title-subtitle-wrap">
                            <h4 class="header-after1 ">
                                    <span class="header-after">
                                        <?php echo esc_html($magnitude_featured_category_title); ?>
                                    </span>
                            </h4>
                        </div>
                    <?php }?>
                    <div class="af-container-row af-widget-body">
                        <?php magnitude_get_block('category', 'featured'); ?>
                    </div>
                </div>
            </section>
        <?php } ?>
    
        <?php if (!empty($featured_category_checkbox) && $selected_page_cat == 'page') {
        $magnitude_featured_page_title = magnitude_get_option('featured_page_section'); ?>
            <section class="aft-blocks featured-cate-sec magnitude-customizer">
                <div class="container-wrapper">
                    <?php if(!empty( $magnitude_featured_page_title)){ ?>
                        <div class="af-title-subtitle-wrap">
                            <h4 class="header-after1 ">
                                    <span class="header-after">
                                        <?php echo esc_html($magnitude_featured_page_title); ?>
                                    </span>
                            </h4>
                        </div>
                    <?php }?>
                    <div class="af-container-row af-widget-body">
                        <?php magnitude_get_block('pages', 'featured'); ?>
                    </div>
                </div>
            </section>
        <?php } ?>
    
        <?php if (!empty($featured_category_checkbox) && $selected_page_cat == 'custom') {
        $magnitude_featured_custom_title = magnitude_get_option('featured_custom_section');?>
            <section class="aft-blocks featured-cate-sec magnitude-customizer">
                <div class="container-wrapper">
                    <?php if(!empty( $magnitude_featured_custom_title)){ ?>
                        <div class="af-title-subtitle-wrap">
                            <h4 class="header-after1 ">
                                    <span class="header-after">
                                        <?php echo esc_html($magnitude_featured_custom_title); ?>
                                    </span>
                            </h4>
                        </div>
                    <?php }?>
                    <div class="af-container-row af-widget-body">
                        <?php magnitude_get_block('custom', 'featured'); ?>
                    </div>
                </div>
            </section>
        <?php } ?>

        <?php if ($show_featured_section): ?>
        <section class="aft-blocks af-main-banner-featured-posts">
            <div class="container-wrapper">
                <?php do_action('magnitude_action_banner_featured_posts'); ?>
            </div>
        </section>
    <?php endif; ?>

        <!-- Trending line END -->
        <?php

    }
endif;

add_action('magnitude_action_banner_featured_section', 'magnitude_banner_featured_section', 10);