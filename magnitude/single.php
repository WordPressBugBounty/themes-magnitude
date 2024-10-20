<?php
    /**
     * The template for displaying all single posts
     *
     * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
     *
     * @package Magnitude
     */
    
    get_header();

?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
                $social_share_icon_opt = magnitude_get_option('single_post_social_share_view');
                if ($social_share_icon_opt == 'after-content') {
                    $wrap_class = 'social-after-content';
                }
                /*} else if ($social_share_icon_opt == 'vertical-left') {
                    $wrap_class = 'social-vertical-left social-vertical-share';
                }*/ else if ($social_share_icon_opt == 'side') {
                    $wrap_class = 'social-vertical-share';
                } else {
                    $wrap_class = 'social-after-title';
                }
                while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <div class="entry-content-wrap read-single <?php echo esc_attr($wrap_class); ?>">
                            <?php
                                
                                $single_post_featured_image_view = magnitude_get_option('single_post_featured_image_view');
                                if ($single_post_featured_image_view == 'default') {
                                    do_action('magnitude_action_single_header');
                                }
                              
                                if ($single_post_featured_image_view == 'full') {
                                    
                                    magnitude_single_post_social_share_icons($post->ID);
                                }
                            
                            ?>
                            <?php
                                get_template_part('template-parts/content', get_post_type());
                            ?>
                        </div>

                        <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif;
                        ?>

                        <?php
                        $show_related_posts = esc_attr(magnitude_get_option('single_show_related_posts'));
                        if ($show_related_posts):
                            if ('post' === get_post_type()) :
                                magnitude_get_block('related');
                            endif;
                        endif;
                        ?>
                    </article>
                <?php
                
                endwhile; // End of the loop...
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php ?>
<?php
    get_sidebar(); ?>
<?php
    get_footer();
