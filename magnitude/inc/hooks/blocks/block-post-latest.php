<?php
/**
 * List block part for displaying latest posts in footer.php
 *
 * @package Magnitude
 */

$magnitude_latest_posts_title = magnitude_get_option('frontpage_latest_posts_section_title');
$magnitude_latest_posts_subtitle = magnitude_get_option('frontpage_latest_posts_section_subtitle');
$number_of_posts = magnitude_get_option('number_of_frontpage_latest_posts');

$all_posts = magnitude_get_posts($number_of_posts);
?>
<div class="af-main-banner-latest-posts grid-layout magnitude-customizer">
    <div class="container-wrapper">
        <div class="widget-title-section">
            <?php if (!empty($magnitude_latest_posts_title)): ?>
                <h4 class="widget-title header-after1">
                            <span class="header-after">
                                <?php echo esc_html($magnitude_latest_posts_title);  ?>
                            </span>
                </h4>
            <?php endif; ?>

        </div>
        <div class="af-container-row clearfix">
        <?php
        if ($all_posts->have_posts()) :
            while ($all_posts->have_posts()) : $all_posts->the_post();
                global $post;
                $thumbnail_size = 'magnitude-medium';

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
            <?php
            endwhile; ?>
        <?php
        endif;
        wp_reset_postdata();
        ?>
        </div>
    </div>
</div>
