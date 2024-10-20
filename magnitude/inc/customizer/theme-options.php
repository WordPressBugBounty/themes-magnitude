<?php

/**
 * Option Panel
 *
 * @package Magnitude
 */

$default = magnitude_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/customizer/frontpage-options.php';



// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel',
    array(
        'title' => esc_html__('Theme Options', 'magnitude'),
        'priority' => 200,
        'capability' => 'edit_theme_options',
    )
);


// Preloader Section.
$wp_customize->add_section('site_preloader_settings',
    array(
        'title' => esc_html__('Preloader Options', 'magnitude'),
        'priority' => 4,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - preloader.
$wp_customize->add_setting('enable_site_preloader',
    array(
        'default' => $default['enable_site_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_site_preloader',
    array(
        'label' => esc_html__('Enable Preloader', 'magnitude'),
        'section' => 'site_preloader_settings',
        'type' => 'checkbox',
        'priority' => 10,
    )
);


/**
 * Header section
 *
 * @package Magnitude
 */

// Frontpage Section.
$wp_customize->add_section('header_options_settings',
    array(
        'title' => esc_html__('Header Options', 'magnitude'),
        'priority' => 49,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('show_date_section',
    array(
        'default' => $default['show_date_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_date_section',
    array(
        'label' => esc_html__('Show Date on Header', 'magnitude'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 10,
        //'active_callback' => 'magnitude_show_date_on_header'
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting('show_social_menu_section',
    array(
        'default' => $default['show_social_menu_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_social_menu_section',
    array(
        'label' => esc_html__('Show Social Menu on Header', 'magnitude'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 11,
        //'active_callback' => 'magnitude_top_header_status'
    )
);


// Setting - breadcrumb.
$wp_customize->add_setting('enable_breadcrumb',
    array(
        'default' => $default['enable_breadcrumb'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_breadcrumb',
    array(
        'label' => esc_html__('Show breadcrumbs', 'magnitude'),
        'section' => 'site_layout_settings',
        'type' => 'checkbox',
        'priority' => 10,
    )
);



/**
 * Layout options section
 *
 * @package Magnitude
 */

// Layout Section.
$wp_customize->add_section('site_layout_settings',
    array(
        'title' => esc_html__('Global Settings', 'magnitude'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);






// Setting - global content alignment of news.
$wp_customize->add_setting('global_content_alignment',
    array(
        'default' => $default['global_content_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('global_content_alignment',
    array(
        'label' => esc_html__('Global Content Alignment', 'magnitude'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'align-content-left' => esc_html__('Content - Primary sidebar', 'magnitude'),
            'align-content-right' => esc_html__('Primary sidebar - Content', 'magnitude'),
            'full-width-content' => esc_html__('Full width content', 'magnitude')
        ),
        'priority' => 130,
    ));




// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_categories',
    array(
        'default' => $default['global_show_categories'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('global_show_categories',
    array(
        'label' => esc_html__('Post Categories', 'magnitude'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'magnitude'),
            'no' => esc_html__('Hide', 'magnitude'),

        ),
        'priority' => 130,
    ));



// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_comment_count',
    array(
        'default' => $default['global_show_comment_count'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('global_show_comment_count',
    array(
        'label' => esc_html__('Comment Count', 'magnitude'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'magnitude'),
            'no' => esc_html__('Hide', 'magnitude'),

        ),
        'priority' => 130,
    ));



//========== minutes read count options ===============

// Global Section.
$wp_customize->add_section('site_min_read_settings',
    array(
        'title' => esc_html__('Minutes Read Count', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_min_read',
    array(
        'default' => $default['global_show_min_read'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('global_show_min_read',
    array(
        'label' => esc_html__('Minutes Read Count', 'magnitude'),
        'section' => 'site_min_read_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'magnitude'),
            'no' => esc_html__('Hide', 'magnitude'),

        ),
        'priority' => 130,
    ));




// Setting - global content alignment of news.
$wp_customize->add_setting('global_post_date_author_setting',
    array(
        'default' => $default['global_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('global_post_date_author_setting',
    array(
        'label' => esc_html__('Date and Author', 'magnitude'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'show-date-author' => esc_html__('Show Date and Author', 'magnitude'),
            'show-date-only' => esc_html__('Show Date Only', 'magnitude'),
            'show-author-only' => esc_html__('Show Author Only', 'magnitude'),
            'hide-date-author' => esc_html__('Hide All', 'magnitude'),
        ),
        'priority' => 130,
    ));


// Setting - global content alignment of news.
$wp_customize->add_setting('global_date_display_setting',
    array(
        'default' => $default['global_date_display_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('global_date_display_setting',
    array(
        'label' => esc_html__('Date Format', 'magnitude'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'theme-date' => esc_html__('Date Format by Theme', 'magnitude'),
            'default-date' => esc_html__('WordPress Default Date Format', 'magnitude'),

        ),
        'priority' => 130,
        'active_callback' => 'magnitude_display_date_status'
    ));



// Setting - related posts.
$wp_customize->add_setting('global_excerpt_length',
    array(
        'default' => $default['global_excerpt_length'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control('global_excerpt_length',
    array(
        'label' => __('Global Excerpt Length', 'magnitude'),
        'section' => 'site_layout_settings',
        'type' => 'number',
        'priority' => 130,

    )
);

// Setting - related posts.
$wp_customize->add_setting('global_read_more_texts',
    array(
        'default' => $default['global_read_more_texts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('global_read_more_texts',
    array(
        'label' => __('Global Excerpt Read More', 'magnitude'),
        'section' => 'site_layout_settings',
        'type' => 'text',
        'priority' => 130,

    )
);



//========== single posts options ===============

// Single Section.
$wp_customize->add_section('site_single_posts_settings',
    array(
        'title' => esc_html__('Single Post', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_show_featured_image',
    array(
        'default' => $default['single_show_featured_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('single_show_featured_image',
    array(
        'label' => __('Show on featured image', 'magnitude'),
        'section' => 'site_single_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);

//Setting - archive content view of news.
$wp_customize->add_setting('single_post_featured_image_view',
    array(
        'default' => $default['single_post_featured_image_view'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('single_post_featured_image_view',
    array(
        'label' => esc_html__('Posts Featured Image View', 'magnitude'),
        'description' => esc_html__('Select content view for featured image', 'magnitude'),
        'section' => 'site_single_posts_settings',
        'type' => 'select',
        'choices' => array(
            'default' => esc_html__('Default', 'magnitude'),
            'full' => esc_html__('Full', 'magnitude'),

        ),
        'priority' => 130,
    ));

//Social share option
    
    if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')):
    $wp_customize->add_setting('single_post_social_share_view',
        array(
            'default' => $default['single_post_social_share_view'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'magnitude_sanitize_select',
        )
    );
    
    $wp_customize->add_control('single_post_social_share_view',
        array(
            'label' => esc_html__('Social Share Option', 'magnitude'),
            'description' => esc_html__('Social Share from Jetpack plugin', 'magnitude'),
            'section' => 'site_single_posts_settings',
            'type' => 'select',
            'choices' => array(
                'after-title-default' => esc_html__('Default - Top', 'magnitude'),
                'after-content' => esc_html__('Bottom', 'magnitude'),

            ),
            'priority' => 130,
            
        ));
    
    endif;


    

//========== related posts  options ===============

// Single Section.
$wp_customize->add_section('site_single_related_posts_settings',
    array(
        'title' => esc_html__('Related Posts', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_show_related_posts',
    array(
        'default' => $default['single_show_related_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('single_show_related_posts',
    array(
        'label' => __('Show On Single Posts', 'magnitude'),
        'section' => 'site_single_related_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);

// Setting - related posts.
$wp_customize->add_setting('single_related_posts_title',
    array(
        'default' => $default['single_related_posts_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('single_related_posts_title',
    array(
        'label' => __('Title', 'magnitude'),
        'section' => 'site_single_related_posts_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'magnitude_related_posts_status'
    )
);



/**
 * Archive options section
 *
 * @package Magnitude
 */

// Archive Section.
$wp_customize->add_section('site_archive_settings',
    array(
        'title' => esc_html__('Archive Settings', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - archive content view of news.
$wp_customize->add_setting('archive_image_alignment',
    array(
        'default' => $default['archive_image_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('archive_image_alignment',
    array(
        'label' => esc_html__('Image Alignment', 'magnitude'),
        'description' => esc_html__('Select image alignment for archive', 'magnitude'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'archive-image-left' => esc_html__('Left', 'magnitude'),
            'archive-image-right' => esc_html__('Right', 'magnitude'),
            'archive-image-alternate' => esc_html__('Alternate', 'magnitude'),
        ),
        'priority' => 130,

    ));


//// Setting - archive content view of news.
//$wp_customize->add_setting('archive_image_alignment_grid',
//    array(
//        'default' => $default['archive_image_alignment_grid'],
//        'capability' => 'edit_theme_options',
//        'sanitize_callback' => 'magnitude_sanitize_select',
//    )
//);
//
//$wp_customize->add_control('archive_image_alignment_grid',
//    array(
//        'label' => esc_html__('Image Alignment', 'magnitude'),
//        'description' => esc_html__('Select image alignment for archive', 'magnitude'),
//        'section' => 'site_archive_settings',
//        'type' => 'select',
//        'choices' => array(
//            'archive-image-default' => esc_html__('Default', 'magnitude'),
//            'archive-image-up-alternate' => esc_html__('Alternate', 'magnitude'),
//            'archive-image-full-alternate' => esc_html__('Alternate With Full ', 'magnitude'),
//            'archive-image-list-alternate' => esc_html__('Alternate With List', 'magnitude'),
//        ),
//        'priority' => 130,
//        'active_callback' => 'magnitude_archive_image_gird_status'
//    ));
//
//
//// Setting - archive grid view column option
//    $wp_customize->add_setting('archive_grid_column_layout',
//        array(
//            'default' => $default['archive_grid_column_layout'],
//            'capability' => 'edit_theme_options',
//            'sanitize_callback' => 'magnitude_sanitize_select',
//        )
//    );
//
//    $wp_customize->add_control('archive_grid_column_layout',
//        array(
//            'label' => esc_html__('Grid Column Layout', 'magnitude'),
//            'description' => esc_html__('Select column for archive grid', 'magnitude'),
//            'section' => 'site_archive_settings',
//            'type' => 'select',
//            'choices' => array(
//                'gird-layout-two' => esc_html__('Two Column', 'magnitude'),
//                'grid-layout-default' => esc_html__('Three Column', 'magnitude'),
//                'grid-layout-four' => esc_html__('Four Column', 'magnitude'),
//            ),
//            'priority' => 130,
//            'active_callback' => 'magnitude_archive_image_gird_status'
//        ));
//
//
////Settings - archive content masonry view
//    $wp_customize->add_setting('archive_layout_masonry',
//        array(
//            'default' => $default['archive_layout_masonry'],
//            'capability' => 'edit_theme_options',
//            'sanitize_callback' => 'magnitude_sanitize_select',
//        )
//    );
//
//    $wp_customize->add_control('archive_layout_masonry',
//        array(
//            'label' => esc_html__('Select Masonry Layout', 'magnitude'),
//            'description' => esc_html__('Select masonry layout for archive', 'magnitude'),
//            'section' => 'site_archive_settings',
//            'type' => 'select',
//            'choices' => array(
//                'masonry-layout-two' => esc_html__('Two Column', 'magnitude'),
//                'masonry-layout-default' => esc_html__('Three Column', 'magnitude'),
//                'masonry-layout-four' => esc_html__('Four Column', 'magnitude'),
//            ),
//            'priority' => 130,
//            'active_callback' => 'magnitude_archive_masonry_status'
//        ));
//
////Settings - archive content full view
//    $wp_customize->add_setting('archive_layout_full',
//        array(
//            'default' => $default['archive_layout_full'],
//            'capability' => 'edit_theme_options',
//            'sanitize_callback' => 'magnitude_sanitize_select',
//        )
//    );
//
//    $wp_customize->add_control('archive_layout_full',
//        array(
//            'label' => esc_html__('Select Full Layout', 'magnitude'),
//            'description' => esc_html__('Select full layout for archive', 'magnitude'),
//            'section' => 'site_archive_settings',
//            'type' => 'select',
//            'choices' => array(
//                'full-image-first' => esc_html__('Posts Title After Image', 'magnitude'),
//                'full-title-first' => esc_html__('Posts Title Before Image', 'magnitude'),
//                'archive-full-grid' => esc_html__('Full With Grid', 'magnitude'),
//
//            ),
//            'priority' => 130,
//            'active_callback' => 'magnitude_archive_full_status'
//        ));

//Setting - archive content view of news.
$wp_customize->add_setting('archive_content_view',
    array(
        'default' => $default['archive_content_view'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_select',
    )
);

$wp_customize->add_control('archive_content_view',
    array(
        'label' => esc_html__('Content View', 'magnitude'),
        'description' => esc_html__('Select content view for archive', 'magnitude'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'archive-content-excerpt' => esc_html__('Post Excerpt', 'magnitude'),
            'archive-content-none' => esc_html__('None', 'magnitude'),

        ),
        'priority' => 130,
    ));


//========== footer latest blog carousel options ===============

// Footer Section.
$wp_customize->add_section('frontpage_latest_posts_settings',
    array(
        'title' => esc_html__('You May Have Missed', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);
// Setting - latest blog carousel.
$wp_customize->add_setting('frontpage_show_latest_posts',
    array(
        'default' => $default['frontpage_show_latest_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('frontpage_show_latest_posts',
    array(
        'label' => __('Show Latest Posts Section Above Footer', 'magnitude'),
        'section' => 'frontpage_latest_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


// Setting - featured_news_section_title.
$wp_customize->add_setting('frontpage_latest_posts_section_title',
    array(
        'default' => $default['frontpage_latest_posts_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('frontpage_latest_posts_section_title',
    array(
        'label' => esc_html__('Posts Section Title', 'magnitude'),
        'section' => 'frontpage_latest_posts_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'magnitude_latest_news_section_status'

    )
);




//========== footer section options ===============
// Footer Section.
$wp_customize->add_section('site_footer_settings',
    array(
        'title' => esc_html__('Footer', 'magnitude'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('footer_copyright_text',
    array(
        'default' => $default['footer_copyright_text'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('footer_copyright_text',
    array(
        'label' => __('Copyright Text', 'magnitude'),
        'section' => 'site_footer_settings',
        'type' => 'text',
        'priority' => 100,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('hide_footer_menu_section',
    array(
        'default' => $default['hide_footer_menu_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'magnitude_sanitize_checkbox',
    )
);

$wp_customize->add_control('hide_footer_menu_section',
    array(
        'label' => __('Hide footer Menu Section', 'magnitude'),
        'section' => 'site_footer_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);



