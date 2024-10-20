<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Magnitude
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function magnitude_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }


    $show_main_news_section = magnitude_get_option('show_main_news_section');
    $show_featured_posts_section = magnitude_get_option('show_featured_posts_section');
    $show_featured_category_section = magnitude_get_option('show_featured_category_section');

    if (is_front_page() || is_home()) {
        if (($show_main_news_section == 0) && ($show_featured_posts_section == 0) && ($show_featured_category_section == 0)) {
            $classes[] = 'no-main-banner-and-featured-section';
        }
    }


    $global_site_mode_setting = magnitude_get_option('global_site_mode_setting');
    if (!empty($global_site_mode_setting)) {
        $classes[] = $global_site_mode_setting;
    }

    $secondary_color_mode = magnitude_get_option('secondary_color_mode');
    if (!empty($secondary_color_mode)) {
        $classes[] = 'aft-secondary-' . $secondary_color_mode;
    }

    $header_layout = magnitude_get_option('header_layout');
    if (!empty($header_layout)) {
        $classes[] = 'aft-' . $header_layout;
    }

    $remove_gaps = magnitude_get_option('remove_gaps_between_thumbs');
    if ($remove_gaps) {
        $classes[] = 'aft-no-thumbs-gap';
    }

    $global_widget_title_border = magnitude_get_option('global_widget_title_border');
    if (!empty($global_widget_title_border)) {
        $classes[] = $global_widget_title_border;
    }


    $single_post_featured_image_view = magnitude_get_option('single_post_featured_image_view');
    if ($single_post_featured_image_view == 'full') {
        $classes[] = 'aft-single-full-header';
    }

    global $post;

    $global_layout = magnitude_get_option('global_content_layout');
    if (!empty($global_layout)) {
        $classes[] = $global_layout;
    }


    $global_alignment = magnitude_get_option('global_content_alignment');
    $page_layout = $global_alignment;
    $disable_class = '';
    $frontpage_content_status = magnitude_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if ($post && is_singular()) {
        $post_options = get_post_meta($post->ID, 'magnitude-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_alignment;
        }
    }


    if (is_front_page() || is_home()) {
        $frontpage_layout = magnitude_get_option('frontpage_content_alignment');

        if (!empty($frontpage_layout)) {
            $page_layout = $frontpage_layout;
        } else {
            $page_layout = $global_alignment;
        }

    }

    if ($page_layout == 'align-content-right') {
        if (is_front_page()) {
            if (is_page_template('tmpl-front-page.php')) {
                if (is_active_sidebar('home-sidebar-widgets')) {
                    $classes[] = 'align-content-right';
                } else {
                    $classes[] = 'full-width-content';
                }
            } else {
                if (is_active_sidebar('sidebar-1')) {
                    $classes[] = 'align-content-right';
                } else {
                    $classes[] = 'full-width-content';
                }
            }
        } else {
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-right';
            } else {
                $classes[] = 'full-width-content';
            }
        }
    } elseif ($page_layout == 'full-width-content') {
        $classes[] = 'full-width-content';
    } else {
        if (is_front_page()) {
            if (is_page_template('tmpl-front-page.php')) {
                if (is_active_sidebar('home-sidebar-widgets')) {
                    $classes[] = 'align-content-left';
                } else {
                    $classes[] = 'full-width-content';
                }
            } else {
                if (is_active_sidebar('sidebar-1')) {
                    $classes[] = 'align-content-left';
                } else {
                    $classes[] = 'full-width-content';
                }
            }

        } else {
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-left';
            } else {
                $classes[] = 'full-width-content';
            }
        }
    }

    $banner_layout = magnitude_get_option('global_site_layout_setting');

    if ($banner_layout == 'boxed') {
        $classes[] = 'af-boxed-layout';
    } elseif ($banner_layout == 'wide') {
        $classes[] = 'af-wide-layout';
    } else {
        $classes[] = '';
    }


    return $classes;


}

add_filter('body_class', 'magnitude_body_classes');


function magnitude_is_elementor()
{
    global $post;
    return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function magnitude_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'magnitude_pingback_header');


/**
 * Returns posts.
 *
 * @since Magnitude 1.0.0
 */
if (!function_exists('magnitude_get_posts')):
    function magnitude_get_posts($number_of_posts, $category = '0')
    {
        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
        $ins_args = array(
            'post_type' => 'post',
            'posts_per_page' => absint($number_of_posts),
//            'paged' => $paged,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );

        $category = isset($category) ? $category : '0';
        if (absint($category) > 0) {
            $ins_args['cat'] = absint($category);
        }

        $all_posts = new WP_Query($ins_args);

        return $all_posts;
    }

endif;


/**
 * Returns no image url.
 *
 * @since  Magnitude 1.0.0
 */
if (!function_exists('magnitude_post_format')):
    function magnitude_post_format($post_id)
    {
        $post_format = get_post_format($post_id);
        switch ($post_format) {
            case "image":
                $post_format = "<div class='af-post-format em-post-format'><i class='fa fa-camera'></i></div>";
                break;
            case "video":
                $post_format = "<div class='af-post-format em-post-format'><i class='fa fa-video-camera'></i></div>";

                break;
            case "gallery":
                $post_format = "<div class='af-post-format em-post-format'><i class='fa fa-camera'></i></div>";
                break;
            default:
                $post_format = "";
        }

        echo $post_format;
    }

endif;


if (!function_exists('magnitude_get_block')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since Magnitude 1.0.0
     *
     */
    function magnitude_get_block($block = 'grid', $section = 'post')
    {

        get_template_part('inc/hooks/blocks/block-' . $section, $block);

    }
endif;

if (!function_exists('magnitude_archive_title')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since Magnitude 1.0.0
     *
     */

    function magnitude_archive_title($title)
    {
        if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        }

        return $title;
    }

endif;
add_filter('get_the_archive_title', 'magnitude_archive_title');

/* Display Breadcrumbs */
if (!function_exists('magnitude_get_breadcrumb')) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function magnitude_get_breadcrumb()
    {

        $enable_breadcrumbs = magnitude_get_option('enable_breadcrumb');
        if (1 != $enable_breadcrumbs) {
            return;
        }
        // Bail if Home Page.
        if (is_front_page() || is_home()) {
            return;
        }


        if (!function_exists('breadcrumb_trail')) {

            /**
             * Load libraries.
             */

            require_once get_template_directory() . '/lib/breadcrumb-trail/breadcrumb-trail.php';
        }

        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false,
        ); ?>


<div class="af-breadcrumbs-wrapper container-wrapper">
            <div class="af-breadcrumbs font-family-1 color-pad">
                <?php breadcrumb_trail($breadcrumb_args); ?>
            </div>
        </div>


    <?php }

endif;
add_action('magnitude_action_get_breadcrumb', 'magnitude_get_breadcrumb');


/**
 * Front-page main banner section layout
 */
if (!function_exists('magnitude_front_page_main_section_scope')) {

    function magnitude_front_page_main_section_scope()
    {

        $hide_on_blog = magnitude_get_option('disable_main_banner_on_blog_archive');

        if ($hide_on_blog) {
            if (is_front_page()) {
                do_action('magnitude_action_front_page_main_section');
            }
        } else {
            if (is_front_page() || is_home()) {
                do_action('magnitude_action_front_page_main_section');
            }
        }

    }
}
add_action('magnitude_action_front_page_main_section_scope', 'magnitude_front_page_main_section_scope');


/* Display Breadcrumbs */
if (!function_exists('magnitude_excerpt_length')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function magnitude_excerpt_length($length)
    {

        $global_excerpt_length = magnitude_get_option('global_excerpt_length');
        if (is_admin()) {
            return $length;
        }
        return $global_excerpt_length;
    }

endif;
add_filter('excerpt_length', 'magnitude_excerpt_length', 999);


/* Display Breadcrumbs */
if (!function_exists('magnitude_excerpt_more')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function magnitude_excerpt_more($more)
    {
        if (is_admin()) {
            return $more;
        }
        global $post;
        $global_read_more_texts = magnitude_get_option('global_read_more_texts');
        //return $global_read_more_texts;
        return '';
    }

endif;
add_filter('excerpt_more', 'magnitude_excerpt_more');


/* Display Breadcrumbs */
if (!function_exists('magnitude_get_the_excerpt')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function magnitude_get_the_excerpt($post_id)
    {


        $content = apply_filters('the_content', get_the_content($post_id));

        $default_excerpt = get_the_excerpt($post_id);
        $global_read_more_texts = magnitude_get_option('global_read_more_texts');
        $read_more = '... <a href="' . get_permalink($post_id) . '" class="aft-readmore">' . $global_read_more_texts . '</a>';
        if (trim($default_excerpt) !== '') {

            return $default_excerpt . $read_more;
        }

        $global_excerpt_length = magnitude_get_option('global_excerpt_length');

        return wp_trim_words($content, $global_excerpt_length, $read_more);

    }

endif;


/* Display Pagination */
if (!function_exists('magnitude_numeric_pagination')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function magnitude_numeric_pagination()
    {

        $pagination_type = magnitude_get_option('archive_pagination_view');
        switch ($pagination_type) {
            case 'archive-default':
                the_posts_pagination(array(
                    'mid_size' => 3,
                    'prev_text' => __('Previous', 'magnitude'),
                    'next_text' => __('Next', 'magnitude'),
                ));
                break;
            default:
                break;
        }

        return;
    }

endif;


/* Word read count Pagination */
if (!function_exists('magnitude_count_content_words')) :
    /**
     * @param $content
     *
     * @return string
     */
    function magnitude_count_content_words($post_id)
    {

        $show_read_mins = magnitude_get_option('global_show_min_read');
        if ($show_read_mins == 'yes') {
            $content = apply_filters('the_content', get_post_field('post_content', $post_id));
            $read_words = magnitude_get_option('global_show_min_read_number');
            $decode_content = html_entity_decode($content);
            $filter_shortcode = do_shortcode($decode_content);
            $strip_tags = wp_strip_all_tags($filter_shortcode, true);
            $count = str_word_count($strip_tags);
            $word_per_min = (absint($count) / $read_words);
            $word_per_min = ceil($word_per_min);

            if (absint($word_per_min) > 0) {
                $word_count_strings = sprintf(_n('%s min read', '%s min read', number_format_i18n($word_per_min), 'magnitude'), number_format_i18n($word_per_min));
                if ('post' == get_post_type($post_id)):

                    echo '<span class="min-read">';
                    echo esc_html($word_count_strings);
                    echo '</span>';
                endif;
            }

        }
    }

endif;


/**
 * Check if given term has child terms
 *
 * @param Integer $term_id
 * @param String $taxonomy
 *
 * @return Boolean
 */
function magnitude_list_popular_taxonomies($taxonomy = 'post_tag', $title = "Popular Tags", $number = 5)
{
    $popular_taxonomies = get_terms(array(
        'taxonomy' => $taxonomy,
        'number' => absint($number),
        'orderby' => 'count',
        'order' => 'DESC',
        'hide_empty' => true,
    ));

    $html = '';

    if (isset($popular_taxonomies) && !empty($popular_taxonomies)):
        $html .= '<div class="aft-popular-taxonomies-lists clearfix">';
        if (!empty($title)):
            $html .= '<strong>';
            $html .= esc_html($title);
            $html .= '</strong>';
        endif;
        $html .= '<ul>';
        foreach ($popular_taxonomies as $tax_term):
            $html .= '<li>';
            $html .= '<a href="' . esc_url(get_term_link($tax_term)) . '">';
            $html .= $tax_term->name;
            $html .= '</a>';
            $html .= '</li>';
        endforeach;
        $html .= '</ul>';
        $html .= '</div>';
    endif;

    echo $html;
}


/**
 * @param $post_id
 * @param string $size
 *
 * @return mixed|string
 */
function magnitude_get_freatured_image_url($post_id, $size = 'magnitude-featured')
{
    if (has_post_thumbnail($post_id)) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
        $url = $thumb['0'];
    } else {
        $url = '';
    }

    return $url;
}


//Get attachment alt tag

if (!function_exists('magnitude_get_img_alt')):
    function magnitude_get_img_alt($attachment_ID)
    {
        // Get ALT
        $thumb_alt = get_post_meta($attachment_ID, '_wp_attachment_image_alt', true);

        // No ALT supplied get attachment info
        if (empty($thumb_alt))
            $attachment = get_post($attachment_ID);

        // Use caption if no ALT supplied
        if (empty($thumb_alt))
            $thumb_alt = $attachment->post_excerpt;

        // Use title if no caption supplied either
        if (empty($thumb_alt))
            $thumb_alt = $attachment->post_title;

        // Return ALT
        return trim(strip_tags($thumb_alt));
    }
endif;

// Move Jetpack from the_content / the_excerpt using shortcode

function jptweak_remove_share()
{
    remove_filter('the_content', 'sharing_display', 19);
    remove_filter('the_excerpt', 'sharing_display', 19);

}

add_action('loop_start', 'jptweak_remove_share');


/**
 * @param $post_id
 */
function magnitude_get_comments_views_share($post_id)
{

    ?>
    <span class="aft-comment-view-share">
        <?php
        $show_comment_count = $section_mode = magnitude_get_option('global_show_comment_count');
        if ($show_comment_count == 'yes'):
            $comment_count = get_comments_number($post_id);
            if (absint($comment_count) > 1):
                ?>
                <span class="aft-comment-count">
        <a href="<?php the_permalink(); ?>">
            <i class="fa fa-comments-o" aria-hidden="true"></i>
            <span class="aft-show-hover">
            <?php echo get_comments_number($post_id); ?>
            </span>
        </a>
        </span>
            <?php endif;
        endif;

        $show_view_count = $section_mode = magnitude_get_option('global_show_view_count');
        if ($show_view_count == 'yes'):
            ?>
            <span class="aft-view-count">
        <a href="<?php the_permalink(); ?>">
            <i class="fa fa-eye" aria-hidden="true"></i>
            <span class="aft-show-hover">
            <?php echo af_get_post_views($post_id); ?>
            </span>
        </a>
        </span>

        <?php endif;
        ?>
    </span>
    <?php
}


/**
 * @param $post_id
 */
function magnitude_archive_social_share_icons($post_id)
{
    if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')):
        if (function_exists('sharing_display')):
            $sharer = new Sharing_Service();
            $global = $sharer->get_global_options();
            if (in_array('index', $global['show']) && (is_home() || is_front_page() || is_archive() || is_search() || in_array(get_post_type(), $global['show']))):
                ?>
                <div class="aft-comment-view-share">
            <span class="aft-jpshare">
                <i class="fa fa-share-alt" aria-hidden="true"></i>
                <?php sharing_display('', true); ?>
        </span>
                </div>
            <?php
            endif;
        endif;
    endif;


}

//Social share icons and comments view for single page

function magnitude_single_post_social_share_icons()
{
    if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')):

        $social_share_icon_opt = magnitude_get_option('single_post_social_share_view');

        if ($social_share_icon_opt == 'side') {
            echo '<div class="vertical-left-right">';
        }
        ?>
        <div class="aft-social-share">
            <?php
            if (function_exists('sharing_display')) {
                sharing_display('', true);
            }
            ?>

        </div>
        <?php
        if ($social_share_icon_opt == 'side') {
            echo '</div>';
        }
    endif;

}

function magnitude_single_post_commtents_view($post_id)
{
    ?>
    <div class="aft-comment-view-share">
        <?php
        $show_comment_count = $section_mode = magnitude_get_option('global_show_comment_count');
        if ($show_comment_count == 'yes'):
            $comment_count = get_comments_number($post_id);
            if (absint($comment_count) > 1):
                ?>
                <span class="aft-comment-count">
                <a href="<?php the_permalink(); ?>">
                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                    <span class="aft-show-hover">
                        <?php echo get_comments_number($post_id); ?>
                    </span>
                </a>
            </span>
            <?php endif;
        endif;

        $show_view_count = $section_mode = magnitude_get_option('global_show_view_count');
        if ($show_view_count == 'yes'):
            ?>
            <span class="aft-view-count">
        <a href="<?php the_permalink(); ?>">
            <i class="fa fa-eye" aria-hidden="true"></i>
            <span class="aft-show-hover">
            <?php echo af_get_post_views($post_id); ?>
            </span>
        </a>
        </span>
        <?php endif;
        ?>
    </div>
    <?php
}


/*
 * Enqueue and localization for pagination js
 *
 */
if (!function_exists('magnitude_pagination_scripts_args')):
    function magnitude_pagination_scripts_args()
    {


        //Ajax load
        $args['nonce'] = wp_create_nonce('magnitude-load-more-nonce');
        $args['ajaxurl'] = admin_url('admin-ajax.php');
        $view_count_onscroll = magnitude_get_option('single_post_view_count');
        if ($view_count_onscroll == 'count-content-scroll') {
            $args['view_count'] = true;
        } else {
            $args['view_count'] = false;
        }


        if (is_front_page()) {
            $args['post_type'] = 'post';
        }

        //Custom post types
        if (is_post_type_archive()) {
            $args['post_type'] = get_queried_object()->name;
        }

        //Search
        if (is_search()) {
            $args['search'] = get_search_query();
        }


        //Author
        if (is_author()) {
            $args['author'] = get_the_author_meta('user_nicename');
        }


        //Date archive
        if (is_date()) {
            $args['year'] = get_query_var('year');
            $args['month'] = get_query_var('monthnum');
            $args['day'] = get_query_var('day');
        }

        /*
         *  Categories and taxonomies
         *  Get the affiliated post type for custom taxonomy
         */

        if (is_category() || is_tag() || is_tax()) {
            $args['cat'] = get_queried_object()->slug;
            $args['taxonomy'] = get_queried_object()->taxonomy;
            if (is_tax()) {
                global $wp_taxonomies;
                $tax_object = isset($wp_taxonomies[$args['taxonomy']]) ? $wp_taxonomies[$args['taxonomy']]->object_type : array();
                $args['post_type'] = array_pop($tax_object);
            }

        }

        return $args;


    }
endif;