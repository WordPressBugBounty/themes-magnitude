<?php
$magnitude_slider_category = magnitude_get_option('select_slider_news_category');
$magnitude_number_of_slides = magnitude_get_option('number_of_slides');
$magnitude_grid_layout_opt = magnitude_get_option('select_main_banner_grid_option');


$grid_posts = magnitude_get_posts($magnitude_number_of_slides, $magnitude_slider_category);
if ($grid_posts->have_posts()):
    ?>
    <div class="col-4 common-grid">
        <div class="grid-item">
    <div class="slick-wrapper af-banner-slider af-widget-carousel clearfix grid-layout-default">
        <?php
        $count = 1;
        while ($grid_posts->have_posts()):
            $grid_posts->the_post();
            global $post;
            $url = magnitude_get_freatured_image_url($post->ID, 'magnitude-featured');

            $thumb_id = get_post_thumbnail_id($post->ID);
            ?>

            <div class="slick-item">

                        <div class="read-single pos-rel color-pad">
                            <div class="read-img pos-rel read-img read-bg-img data-bg"
                                 data-background="<?php echo esc_url($url); ?>">
                                <a class="aft-post-image-link"
                                   href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <?php if (!empty($url)): ?>
                                    <img src="<?php echo esc_url($url); ?>"
                                         alt="<?php echo esc_attr(magnitude_get_img_alt($thumb_id)); ?>">
                                <?php endif; ?>
                                <?php magnitude_archive_social_share_icons($post->ID); ?>
                            </div>
                            <div class="read-details">
                                <div class="container-wrapper">
                                    <div class="forvertical-wrapper">
                                        <?php echo magnitude_post_format($post->ID); ?>
                                        <?php magnitude_count_content_words($post->ID); ?>
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
            </div>
            <?php
            $count++;
        endwhile; ?>
    </div>
        </div>
    </div>
<?php endif;
