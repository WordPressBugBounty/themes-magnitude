<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function magnitude_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'magnitude'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets for Main Sidebar.', 'magnitude'),
        'before_widget' => '<div id="%1$s" class="widget magnitude-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Off Canvas Section', 'magnitude'),
        'id'            => 'express-off-canvas-panel',
        'description'   => esc_html__('Add widgets for Off Canvas Section', 'magnitude'),
        'before_widget' => '<div id="%1$s" class="widget magnitude-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Content Section', 'magnitude'),
        'id' => 'home-content-widgets',
        'description' => esc_html__('Add widgets to front-page contents section.', 'magnitude'),
        'before_widget' => '<div id="%1$s" class="widget magnitude-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Sidebar Section', 'magnitude'),
        'id' => 'home-sidebar-widgets',
        'description' => esc_html__('Add widgets to front-page sidebar section.', 'magnitude'),
        'before_widget' => '<div id="%1$s" class="widget magnitude-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));



    register_sidebar(array(
        'name' => esc_html__('Footer First Section', 'magnitude'),
        'id' => 'footer-first-widgets-section',
        'description' => esc_html__('Displays items on Footer First Column.', 'magnitude'),
        'before_widget' => '<div id="%1$s" class="widget magnitude-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="header-after">',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Second Section', 'magnitude'),
        'id' => 'footer-second-widgets-section',
        'description' => esc_html__('Displays items on Footer Second Column.', 'magnitude'),
        'before_widget' => '<div id="%1$s" class="widget magnitude-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="header-after">',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Third Section', 'magnitude'),
        'id' => 'footer-third-widgets-section',
        'description' => esc_html__('Displays items on Footer Third Column.', 'magnitude'),
        'before_widget' => '<div id="%1$s" class="widget magnitude-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="header-after">',
        'after_title' => '</span></h2>',
    ));



}

add_action('widgets_init', 'magnitude_widgets_init');