<?php

/**
 * Option Panel
 *
 * @package Magnitude
 */

$default = magnitude_get_default_theme_options();

/**
 * Frontpage options section
 *
 * @package Magnitude
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('frontpage_option_panel',
    array(
        'title' => esc_html__('Frontpage Options', 'magnitude'),
        'priority' => 199,
        'capability' => 'edit_theme_options',
    )
);


// Advertisement Section.
$wp_customize->add_section('frontpage_advertisement_settings',
    array(
        'title' => esc_html__('Banner Advertisement', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_advertisement_section',
    array(
        'default' => $default['banner_advertisement_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_advertisement_section',
        array(
            'label' => esc_html__('Banner Section Advertisement', 'magnitude'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'magnitude'), 930, 100),
            'section' => 'frontpage_advertisement_settings',
            'width' => 930,
            'height' => 100,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 120,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_section_url',
    array(
        'default' => $default['banner_advertisement_section_url'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_advertisement_section_url',
    array(
        'label' => esc_html__('URL Link', 'magnitude'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'text',
        'priority' => 130,
    )
);



/**
 * Main Banner Slider Section
 * */

// Main banner Sider Section.
$wp_customize->add_section('frontpage_main_banner_section_settings',
    array(
        'title' => esc_html__('Main Banner Section', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('show_main_news_section',
    array(
        'default' => $default['show_main_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_main_news_section',
    array(
        'label' => esc_html__('Enable Main Banner Section', 'magnitude'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);



// Setting - select_main_banner_section_mode.
    $wp_customize->add_setting('select_main_banner_layout_section_mode',
        array(
            'default' => $default['select_main_banner_layout_section_mode'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'magnitude_sanitize_select',
        )
    );
    
    $wp_customize->add_control('select_main_banner_layout_section_mode',
        array(
            'label' => esc_html__('Select Banner Mode', 'magnitude'),
            'section' => 'frontpage_main_banner_section_settings',
            'type' => 'select',
            'choices' => array(
                'wide' => esc_html__("Wide", 'magnitude'),
                'boxed' => esc_html__("Boxed", 'magnitude'),
            ),
            'priority' => 100,
            'active_callback' => 'magnitude_main_banner_section_status'
        ));




// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_category',
    array(
        'default' => $default['select_slider_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Magnitude_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_category',
    array(
        'label' => esc_html__('Slider Category', 'magnitude'),
        'description' => esc_html__('Select category to be shown on main slider section', 'magnitude'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => 'magnitude_main_banner_section_status'
    )));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_top_news_category',
    array(
        'default' => $default['select_top_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Magnitude_Dropdown_Taxonomies_Control($wp_customize, 'select_top_news_category',
    array(
        'label' => esc_html__('Top News Category', 'magnitude'),
        'description' => esc_html__('Select category to be shown on main slider section', 'magnitude'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => 'magnitude_main_banner_section_status'
    )));

//Flash story

$wp_customize->add_section('magnitude_flash_posts_section_settings',
    array(
        'title'      => esc_html__('Flash Posts', 'magnitude'),
        'priority'   => 30,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);

$wp_customize->add_setting('show_flash_news_section',
    array(
        'default'           => $default['show_flash_news_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_flash_news_section',
    array(
        'label'    => esc_html__('Enable Flash Posts Section', 'magnitude'),
        'section'  => 'magnitude_flash_posts_section_settings',
        'type'     => 'checkbox',
        'priority' => 22,

    )
);

// Setting - number_of_slides.
$wp_customize->add_setting('flash_news_title',
    array(
        'default'           => $default['flash_news_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('flash_news_title',
    array(
        'label'    => esc_html__('Exclusive News Title', 'magnitude'),
        'section'  => 'magnitude_flash_posts_section_settings',
        'type'     => 'text',
        'priority' => 23,
        'active_callback' => 'magnitude_flash_posts_section_status'

    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_flash_news_category',
    array(
        'default'           => $default['select_flash_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new magnitude_Dropdown_Taxonomies_Control($wp_customize, 'select_flash_news_category',
    array(
        'label'       => esc_html__('Flash Posts Category', 'magnitude'),
        'description' => esc_html__('Select category to be shown on trending posts ', 'magnitude'),
        'section'     => 'magnitude_flash_posts_section_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 23,
        'active_callback' => 'magnitude_flash_posts_section_status'
    )));





// Disable main banner in blog
$wp_customize->add_setting('disable_main_banner_on_blog_archive',
    array(
        'default' => $default['disable_main_banner_on_blog_archive'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('disable_main_banner_on_blog_archive',
    array(
        'label' => esc_html__('Disable Banner and Featured Section on Blog', 'magnitude'),
        'description' => esc_html__('The option will the section from blog archive page.', 'magnitude'),
        'section' => 'frontpage_layout_settings',
        'type' => 'checkbox',
        'priority' => 100,
        'active_callback' => 'magnitude_main_banner_section_status'
    )
);

/**
 * Featured Category Section
 * */


$wp_customize->add_section('frontpage_featured_category_settings',
    array(
        'title' => esc_html__('Featured Category Section', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);

// Setting - show_featured_category_section.
$wp_customize->add_setting('show_featured_category_section',
    array(
        'default' => $default['show_featured_category_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_featured_category_section',
    array(
        'label' => esc_html__('Enable Featured Category Section', 'magnitude'),
        'section' => 'frontpage_featured_category_settings',
        'type' => 'checkbox',
        'priority' => 22,


    )
);




// Setting - featured_category_section.
$wp_customize->add_setting('featured_category_section',
    array(
        'default' => $default['featured_category_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'featured_category_section',
    array(
        'label' => esc_html__('Section Title', 'magnitude'),
        'section' => 'frontpage_featured_category_settings',
        'type' => 'text',
        'priority' => 130,
        'active_callback' => 'magnitude_featured_news_section_status'

    )

);


//Upload category1 image

for ( $i = 1; $i < 5; $i++ ) {


    // Setting - featured  category1.
    $wp_customize->add_setting('select_featured_category_' . $i,
        array(
            'default' => $default['select_featured_category_' . $i],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(new Magnitude_Dropdown_Taxonomies_Control($wp_customize, 'select_featured_category_' . $i,
        array(
            'label' => sprintf(__('Select Category %d', 'magnitude'), $i),
            'description' => esc_html__('Select category to be shown on featured section ', 'magnitude'),
            'section' => 'frontpage_featured_category_settings',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 130,
            'active_callback' => 'magnitude_featured_news_section_status'


        )));

    $wp_customize->add_setting('featured_category_image_' . $i,
        array(
            'default' => $default['featured_category_image_' . $i],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );


    $wp_customize->add_control(
        new WP_Customize_Cropped_Image_Control($wp_customize, 'featured_category_image_' . $i,
            array(
                'label' => sprintf(__('Upload Image %d', 'magnitude'), $i),
                'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'magnitude'), 930, 100),
                'section' => 'frontpage_featured_category_settings',
                'width' => 415,
                'height' => 265,
                'flex_width' => true,
                'flex_height' => true,
                'priority' => 130,
                'active_callback' => 'magnitude_featured_news_section_status'
            )
        )
    );

}
/* End Featured Category Section */



/**
 * Featured Post Section
 * */


$wp_customize->add_section('frontpage_featured_posts_settings',
    array(
        'title' => esc_html__('Featured Posts Section', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);

// Setting - show_featured_posts_section.
$wp_customize->add_setting('show_featured_posts_section',
    array(
        'default' => $default['show_featured_posts_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_featured_posts_section',
    array(
        'label' => esc_html__('Enable Featured Posts Section', 'magnitude'),
        'section' => 'frontpage_featured_posts_settings',
        'type' => 'checkbox',
        'priority' => 22,


    )
);
    
    $wp_customize->add_setting('featured_news_section_title',
        array(
            'default' => $default['featured_news_section_title'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control('featured_news_section_title',
            array(
                'label' => esc_html__('Featured Title ', 'magnitude'),
                'section' => 'frontpage_featured_posts_settings',
                'type' => 'text',
                'priority' => 130,
                'active_callback' => 'magnitude_featured_posts_section'
                
            )
        
    );
    
    //List of categories
    
    $wp_customize->add_setting('select_featured_news_category',
        array(
            'default' => $default['select_featured_news_category'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );
    
    $wp_customize->add_control(new Magnitude_Dropdown_Taxonomies_Control($wp_customize, 'select_featured_news_category' ,
        array(
            'label' => sprintf(__('Select Category ', 'magnitude')),
            'description' => esc_html__('Select category to be shown on featured section ', 'magnitude'),
            'section' => 'frontpage_featured_posts_settings',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 130,
            'active_callback' => 'magnitude_featured_posts_section',
        
        
        )));
    

// Frontpage Layout Section.
$wp_customize->add_section('frontpage_layout_settings',
    array(
        'title' => esc_html__('Frontpage Layout Settings', 'magnitude'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('frontpage_content_alignment',
    array(
        'default' => $default['frontpage_content_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('frontpage_content_alignment',
    array(
        'label' => esc_html__('Frontpage Content Alignment', 'magnitude'),
        'description' => esc_html__('Select frontpage content alignment', 'magnitude'),
        'section' => 'frontpage_layout_settings',
        'type' => 'select',
        'choices' => array(
            'align-content-left' => esc_html__('Home Content - Home Sidebar', 'magnitude'),
            'align-content-right' => esc_html__('Home Sidebar - Home Content', 'magnitude'),
            'full-width-content' => esc_html__('Only Home Content', 'magnitude')
        ),
        'priority' => 10,
    ));

// Setting - frontpage_sticky_sidebar.
$wp_customize->add_setting('frontpage_sticky_sidebar',
    array(
        'default' => $default['frontpage_sticky_sidebar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('frontpage_sticky_sidebar',
    array(
        'label' => esc_html__('Make Frontpage Sidebar Sticky', 'magnitude'),
        'section' => 'frontpage_layout_settings',
        'type' => 'checkbox',
        'priority' => 24,
        'active_callback' => 'frontpage_content_alignment_status'
    )
);