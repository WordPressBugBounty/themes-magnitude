<?php
if (!function_exists('magnitude_banner_featured_posts')):
    /**
     * Ticker Slider
     *
     * @since Magnitude 1.0.0
     *
     */
    function magnitude_banner_featured_posts()
    {

        $color_class = 'category-color-1';
        ?>
        <?php
        $magnitude_enable_featured_news = magnitude_get_option('show_featured_posts_section');

        if ($magnitude_enable_featured_news):
            $magnitude_featured_news_title = magnitude_get_option('featured_news_section_title');
            ?>
            <div class="af-main-banner-featured-posts featured-posts magnitude-customizer">
                <div class="af-title-subtitle-wrap">
                <?php if (!empty($magnitude_featured_news_title)): ?>
                    <h4 class="header-after1 ">
                                <span class="header-after <?php echo esc_attr($color_class); ?>">
                                    <?php echo esc_html($magnitude_featured_news_title); ?>
                                </span>
                    </h4>
                <?php endif; ?>
                </div>


                <div class="section-wrapper af-widget-body">
                    <div class="af-container-row clearfix">
                        <?php
                        $magnitude_featured_category = magnitude_get_option('select_featured_news_category');
                        $magnitude_number_of_featured_news = magnitude_get_option('number_of_featured_news');
                        //$magnitude_number_of_featured_news = 6;
                        $featured_posts = magnitude_get_posts($magnitude_number_of_featured_news, $magnitude_featured_category);
                        if ($featured_posts->have_posts()) :
                            while ($featured_posts->have_posts()) :
                                $featured_posts->the_post();

                                global $post;
                                $thumbnail_size =  'magnitude-medium';
                                ?>

                                <div class="col-4 pad float-l " data-mh="af-feat-list">
                                    <div class="read-single color-pad">
                                        <div class="read-img pos-rel read-bg-img">
                                             <a class="aft-post-image-link" href="<?php the_permalink(); ?>">
                                                <?php if ( has_post_thumbnail() ):
                                                    the_post_thumbnail($thumbnail_size);
                                                endif;
                                                ?>
                                                <?php the_title(); ?>
                                            </a>
                                            <?php echo magnitude_post_format($post->ID); ?>
                                            <?php magnitude_count_content_words($post->ID);   ?>
                                            <?php magnitude_archive_social_share_icons($post->ID); ?>

                                        </div>
                                        <div class="read-details color-tp-pad pad ptb-10">

                                            <div class="read-categories">
                                                <?php magnitude_post_categories(); ?>
                                            </div>
                                            <div class="read-title">
                                                <h4>
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                            </div>

                                            <div class="entry-meta">
                                                <?php magnitude_post_item_meta(); ?>

                                                <?php magnitude_get_comments_views_share($post->ID); ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <?php endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <!-- Trending line END -->
        <?php

    }
endif;

add_action('magnitude_action_banner_featured_posts', 'magnitude_banner_featured_posts', 10);