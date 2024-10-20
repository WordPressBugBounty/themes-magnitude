<?php
if (!function_exists('magnitude_header_section')) :
    /**
     * Banner Slider
     *
     * @since Magnitude 1.0.0
     *
     */
    function magnitude_header_section()
    {

        $header_layout = magnitude_get_option('header_layout');
        
         if($header_layout == 'header-layout-compressed-full' || $header_layout == 'header-layout-boxed'|| $header_layout == 'header-layout-transparent') {
         $header_class = 'header-layout-compressed-full';
         }elseif($header_layout == 'header-layout-compressed-centered'){
             $header_class = 'header-layout-compressed '.$header_layout;
         }else{
             $header_class = $header_layout;
         }

        ?>

        <header id="masthead" class="<?php echo esc_attr($header_class); ?> magnitude-header">
            <?php
            if($header_layout == 'header-layout-centered') {
                magnitude_get_block('layout-extended-centered', 'header');
            }else if($header_layout == 'header-layout-compressed-full') {
                magnitude_get_block('layout-compressed', 'header');
            }else {
                magnitude_get_block('layout-default', 'header');

            }
            ?>

        </header>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('magnitude_action_header_section', 'magnitude_header_section', 40);

//Load main nav menu
if (!function_exists('magnitude_main_menu_nav_section')):

    function magnitude_main_menu_nav_section()
    {

        ?>
        <div class="navigation-container">
            <nav class="main-navigation clearfix">

                                        <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                        <span class="screen-reader-text">
                                            <?php esc_html_e('Primary Menu', 'magnitude'); ?>
                                        </span>
                                        <i class="ham"></i>
                                    </span>


                <?php
                $global_show_home_menu = magnitude_get_option('global_show_primary_menu_border');
                wp_nav_menu(array(
                    'theme_location' => 'aft-primary-nav',
                    'menu_id' => 'primary-menu',
                    'container' => 'div',
                    'container_class' => 'menu main-menu menu-desktop ' . $global_show_home_menu,
                    //'menu_class'        =>'nav navbar-nav navbar-left',
                    //'walker'      => new AfWalkernav()
                ));
                ?>
            </nav>
        </div>

    <?php }
endif;

add_action('magnitude_action_main_menu_nav', 'magnitude_main_menu_nav_section', 40);

//load search form
if (!function_exists('magnitude_load_search_form_section')):

    function magnitude_load_search_form_section()
    {
        ?>
        <div class="af-search-wrap">
            <div class="search-overlay">
                <a href="#" title="Search" class="search-icon">
                    <i class="fa fa-search"></i>
                </a>
                <div class="af-search-form">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>

    <?php }

endif;
add_action('magnitude_load_search_form', 'magnitude_load_search_form_section');

//Load off canvas section
if (!function_exists('magnitude_load_off_canvas_section')):

    function magnitude_load_off_canvas_section()
    {
        if (is_active_sidebar('express-off-canvas-panel')) :
            ?>


            <span class="offcanvas">
				<a href="#" class="offcanvas-nav">
					<div class="offcanvas-menu">
						<span class="mbtn-top"></span>
						<span class="mbtn-mid"></span>
						<span class="mbtn-bot"></span>
					</div>
				</a>
			</span>
        <?php
        endif;
    }

endif;
add_action('magnitude_load_off_canvas', 'magnitude_load_off_canvas_section');

//load date part
if (!function_exists('magnitude_load_date_section')):
    function magnitude_load_date_section()
    {
        $show_date = magnitude_get_option('show_date_section');
        if ($show_date == true): ?>
            <span class="topbar-date">
        <?php echo date_i18n('D. M jS, Y ', strtotime(current_time("Y-m-d"))); ?>
    </span>
        <?php endif;
    }
endif;
add_action('magnitude_load_date', 'magnitude_load_date_section');

//load social icon menu
if (!function_exists('magnitude_load_social_menu_section')):

    function magnitude_load_social_menu_section()
    {
        ?>
        <?php
        $show_social_menu = magnitude_get_option('show_social_menu_section');
        if (has_nav_menu('aft-social-nav') && $show_social_menu == true): ?>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'aft-social-nav',
                'link_before' => '<span class="screen-reader-text">',
                'link_after' => '</span>',
                'container' => 'div',
                'container_class' => 'social-navigation'
            ));
            ?>

        <?php endif; ?>
    <?php }

endif;

add_action('magnitude_load_social_menu', 'magnitude_load_social_menu_section');

//Load site branding section

if (!function_exists('magnitude_load_site_branding_section')):
    function magnitude_load_site_branding_section()
    {
        ?>
        <div class="site-branding">
            <?php
            the_custom_logo();
            if (is_front_page() || is_home()) : ?>
                <h1 class="site-title font-family-1">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-anchor"
                       rel="home"><?php bloginfo('name'); ?></a>
                </h1>
            <?php else : ?>
                <p class="site-title font-family-1">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-anchor"
                       rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif; ?>

            <?php
            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) : ?>
                <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php
            endif; ?>
        </div>

    <?php }

endif;
add_action('magnitude_load_site_branding', 'magnitude_load_site_branding_section');

