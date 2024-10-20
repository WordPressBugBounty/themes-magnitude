<?php
/**
 * Customizer callback functions for active_callback.
 *
 * @package Magnitude
 */

/*select page for slider*/
if (!function_exists('magnitude_frontpage_content_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_frontpage_content_status($control)
    {

        if ('page' == $control->manager->get_setting('show_on_front')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;




/*select page for trending news*/
if (!function_exists('magnitude_popular_tags_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_popular_tags_section_status($control)
    {

        if (true == $control->manager->get_setting('show_popular_tags_section')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for trending news*/
if (!function_exists('magnitude_flash_posts_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_flash_posts_section_status($control)
    {

        if (true == $control->manager->get_setting('show_flash_news_section')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for slider*/
if (!function_exists('global_site_mode_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function global_site_mode_status($control)
    {

        if (('aft-default-mode' == $control->manager->get_setting('global_site_mode_setting')->value())) {

            return true;
        } else {
            return false;
        }

    }

endif;
    
    
    //magnitude_display_message_notice
    if (!function_exists('magnitude_display_message')) :
        
        /**
         * Check if slider section page/post is active.
         *
         * @since 1.0.0
         *
         * @param WP_Customize_Control $control WP_Customize_Control instance.
         *
         * @return bool Whether the control is active to the current preview.
         */
        function magnitude_display_message($control)
        {
            
            if (('wide' == $control->manager->get_setting('global_site_layout_setting')->value()) && 'side' == $control->manager->get_setting('single_post_social_share_view')->value() ) {
                
                return true;
            } else {
                return false;
            }
            
        }
    
    endif;


/*select page for slider*/
if (!function_exists('global_site_mode_dark_light_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function global_site_mode_dark_light_status($control)
    {

        if (('aft-default-mode' !== $control->manager->get_setting('global_site_mode_setting')->value())) {

            return true;
        } else {
            return false;
        }

    }

endif;

/*select page for slider*/
if (!function_exists('magnitude_solid_secondary_color_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_solid_secondary_color_status($control)
    {

        if ('solid-color' == $control->manager->get_setting('secondary_color_mode')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for slider*/
if (!function_exists('magnitude_gradient_secondary_color_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_gradient_secondary_color_status($control)
    {

        if ('gradient-color' == $control->manager->get_setting('secondary_color_mode')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


    /*select page for slider*/
if (!function_exists('magnitude_main_navigation_background_color_mode_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_main_navigation_background_color_mode_status($control)
    {

        if ('custom-color' == $control->manager->get_setting('main_navigation_background_color_mode')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*select page for slider*/
if (!function_exists('magnitude_main_banner_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_main_banner_section_status($control)
    {

        if (true == $control->manager->get_setting('show_main_news_section')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;
    

    
    /*select post*/
    if (!function_exists('magnitude_featured_posts_section')) :
        
        /**
         * Check if ticker section page/post is active.
         *
         * @since 1.0.0
         *
         * @param WP_Customize_Control $control WP_Customize_Control instance.
         *
         * @return bool Whether the control is active to the current preview.
         */
        function magnitude_featured_posts_section($control)
        {
            
            if (true == $control->manager->get_setting('show_featured_posts_section')->value()) {
                return true;
            } else {
                return false;
            }
            
        }
    
    endif;

/*select page for slider*/
if (!function_exists('magnitude_featured_news_section_status')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_featured_news_section_status($control)
    {

        if (true == $control->manager->get_setting('show_featured_category_section')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;

    
    
    /*select page for slider*/
    if (!function_exists('magnitude_featured_news_category_section_status')) :
        
        /**
         * Check if ticker section page/post is active.
         *
         * @since 1.0.0
         *
         * @param WP_Customize_Control $control WP_Customize_Control instance.
         *
         * @return bool Whether the control is active to the current preview.
         */
        function magnitude_featured_news_category_section_status($control)
        {
            
            if ('category' == $control->manager->get_setting('show_featured_category_page_section')->value()) {
                return true;
            } else {
                return false;
            }
            
        }
    
    endif;
    
    
    //choose page
    
    /*select page for slider*/
    if (!function_exists('magnitude_featured_news_pages_section_status')) :
        
        /**
         * Check if ticker section page/post is active.
         *
         * @since 1.0.0
         *
         * @param WP_Customize_Control $control WP_Customize_Control instance.
         *
         * @return bool Whether the control is active to the current preview.
         */
        function magnitude_featured_news_pages_section_status($control)
        {
            
            if ('page' == $control->manager->get_setting('show_featured_category_page_section')->value()) {
                return true;
            } else {
                return false;
            }
            
        }
    
    endif;
    
    //choose page
    
    /*select page for slider*/
    if (!function_exists('magnitude_featured_news_custom_section_status')) :
        
        /**
         * Check if ticker section page/post is active.
         *
         * @since 1.0.0
         *
         * @param WP_Customize_Control $control WP_Customize_Control instance.
         *
         * @return bool Whether the control is active to the current preview.
         */
        function magnitude_featured_news_custom_section_status($control)
        {
            
            if ('custom' == $control->manager->get_setting('show_featured_category_page_section')->value()) {
                return true;
            } else {
                return false;
            }
            
        }
    
    endif;

/*select page for slider*/
if (!function_exists('magnitude_featured_product_section_status')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_featured_product_section_status($control)
    {

        if (true == $control->manager->get_setting('show_featured_products_section')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for slider*/
if (!function_exists('magnitude_display_date_status')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_display_date_status($control)
    {

        if (('show-date-author' == $control->manager->get_setting('global_post_date_author_setting')->value()) || ('show-date-only' == $control->manager->get_setting('global_post_date_author_setting')->value())) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*select sticky sidebar*/
if (!function_exists('frontpage_content_alignment_status')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function frontpage_content_alignment_status($control)
    {

        if ('align-content-left' == $control->manager->get_setting('frontpage_content_alignment')->value() || 'align-content-right' == $control->manager->get_setting('frontpage_content_alignment')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for slider*/
if (!function_exists('magnitude_latest_news_section_status')) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_latest_news_section_status($control)
    {

        if (true == $control->manager->get_setting('frontpage_show_latest_posts')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for slider*/
if (!function_exists('magnitude_archive_image_status')) :

    /**
     * Check if archive no image is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_archive_image_status($control)
    {

        if ('archive-layout-list' == $control->manager->get_setting('archive_layout')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;



/*related posts*/
if (!function_exists('magnitude_related_posts_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_related_posts_status($control)
    {

        if (true == $control->manager->get_setting('single_show_related_posts')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;
 
 //Single post view count session expire option
    
    if (!function_exists('magnitude_single_post_session_option_status')) :
        
        /**
         * Check if slider section page/post is active.
         *
         * @since 1.0.0
         *
         * @param WP_Customize_Control $control WP_Customize_Control instance.
         *
         * @return bool Whether the control is active to the current preview.
         */
        function magnitude_single_post_session_option_status($control)
        {
            
            if ('session' == $control->manager->get_setting('single_post_view_count')->value()) {
                return true;
            } else {
                return false;
            }
            
        }
    
    endif;

/*mailchimp*/
if (!function_exists('magnitude_mailchimp_subscriptions_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_mailchimp_subscriptions_status($control)
    {

        if (true == $control->manager->get_setting('footer_show_mailchimp_subscriptions')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*select page for slider*/
if (!function_exists('magnitude_footer_instagram_posts_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_footer_instagram_posts_status($control)
    {

        if (true == $control->manager->get_setting('footer_show_instagram_post_carousel')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;



/*select page for slider*/
if (!function_exists('magnitude_global_show_minutes_count_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_global_show_minutes_count_status($control)
    {

        if ('yes' == $control->manager->get_setting('global_show_min_read')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;


    /*select page for slider*/
if (!function_exists('magnitude_global_show_view_count_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magnitude_global_show_view_count_status($control)
    {

        if ('yes' == $control->manager->get_setting('global_show_view_count')->value()) {
            return true;
        } else {
            return false;
        }

    }

endif;

