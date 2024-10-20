<?php
$magnitude_slider_category = magnitude_get_option('select_top_news_category');
$magnitude_number_of_slides = magnitude_get_option('number_of_top_news');
$magnitude_grid_layout_opt = magnitude_get_option('select_main_banner_grid_option');


$grid_posts = magnitude_get_posts($magnitude_number_of_slides, $magnitude_slider_category);
if ($grid_posts->have_posts()):
    ?>
    <div class="banner-grid-wrapper clearfix grid-layout-default">
        <div class="aft-banner-slider-wrapper first-grid-item-warpper af-cat-widget-carousel">
            <?php magnitude_get_block('slider', 'banner'); ?>
        </div>
        <?php
        $count = 1;
        while ($grid_posts->have_posts()):
            $grid_posts->the_post();
            global $post;

            if( $count == 1){
                $url = magnitude_get_freatured_image_url($post->ID, 'magnitude-medium');
            }else{
                $url = magnitude_get_freatured_image_url($post->ID, 'magnitude-medium-square');
            }

            $thumb_id = get_post_thumbnail_id($post->ID);
            ?>
            <?php if ($count == 1): ?>
            <div class="col-4 common-grid secondary-grid">
                <div class="grid-item">
                    <div class="read-single color-pad">
                        <div class="read-img pos-rel read-img read-bg-img data-bg"
                             data-background="<?php echo esc_url($url); ?>">
                            <a class="aft-post-image-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php if (!empty($url)): ?>
                                <img src="<?php echo esc_url($url); ?>"
                                     alt="<?php echo esc_attr(magnitude_get_img_alt($thumb_id)); ?>">
                            <?php endif; ?>
                            <?php echo magnitude_post_format($post->ID); ?>
                            <?php magnitude_count_content_words($post->ID); ?>
                            <?php magnitude_archive_social_share_icons($post->ID); ?>
                        </div>
                        <div class="read-details pad ptb-10">
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
            </div>
        <?php else: ?>
            <div class="col-4 common-grid">
                <div class="grid-item">
                    <div class="read-single color-pad">
                        <div class="read-img pos-rel read-img read-bg-img data-bg"
                             data-background="<?php echo esc_url($url); ?>">
                            <a class="aft-post-image-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php if (!empty($url)): ?>
                                <img src="<?php echo esc_url($url); ?>"
                                     alt="<?php echo esc_attr(magnitude_get_img_alt($thumb_id)); ?>">
                            <?php endif; ?>
                            <?php echo magnitude_post_format($post->ID); ?>
                            <?php magnitude_count_content_words($post->ID); ?>
                            <?php magnitude_archive_social_share_icons($post->ID); ?>
                        </div>
                        <div class="read-details pad ptb-10">
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
            </div>
        <?php endif; ?>


            <?php
            $count++;
        endwhile; ?>
    </div>
<?php endif;
