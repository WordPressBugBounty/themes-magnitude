<?php
if (!function_exists('magnitude_single_header')) :
    /**
     * Banner Slider
     *
     * @since Magnitude 1.0.0
     *
     */
    function magnitude_single_header()
    {
        $magnitude_enable_main_slider = magnitude_get_option('show_main_news_section');
        global $post;
        $post_id = $post->ID;
        $single_post_featured_image_view = magnitude_get_option('single_post_featured_image_view');
        if ($single_post_featured_image_view == 'full') {
            $header_class = 'af-cat-widget-carousel';
        } else {
            $header_class = '';
        }
        ?>
        <header class="entry-header pos-rel <?php echo $header_class; ?>">
            <div class="read-details">
                <div class="entry-header-details">
                    <?php if ('post' === get_post_type()) : ?>

                        <div class="figure-categories read-categories figure-categories-bg">
                            <?php echo magnitude_post_format($post->ID); ?>
                            <?php magnitude_post_categories(); ?>
                        </div>
                    <?php endif; ?>
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                    <div class="aft-post-excerpt-and-meta color-pad pad ptb-10">
                        <?php if ('post' === get_post_type($post_id)) :
                            if (has_excerpt($post_id)):

                                ?>
                                <div class="post-excerpt">
                                    <?php echo wp_kses_post(get_the_excerpt($post->ID)); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
                        //if ($single_post_featured_image_view == 'full') {
                        ?>
                        <div class="entry-meta">

                            <?php magnitude_post_item_meta(); ?>
                            <?php magnitude_count_content_words($post->ID); ?>
                            <?php magnitude_single_post_commtents_view($post->ID);
                            ?>
                        </div>
                        <?php //}
                        ?>

                    </div>
                </div>
            </div>
            <?php

            if ($single_post_featured_image_view == 'full') {

                $show_featured_image = magnitude_get_option('single_show_featured_image');
                if ($show_featured_image):

                    ?>
                    <div class="read-img pos-rel">
                        <?php magnitude_post_thumbnail(); ?>
                        <?php
                        if (has_post_thumbnail($post_id)):
                            if ($aft_image_caption = get_post(get_post_thumbnail_id())->post_excerpt):
                                if (trim($aft_image_caption) !== ''):
                                    ?>
                                    <span class="aft-image-caption">
                                        <p>
                                            <?php echo $aft_image_caption; ?>
                                        </p>
                                    </span>
                                <?php
                                endif;
                            endif;
                        endif;
                        ?>
                    </div>

                <?php endif;

            } ?>


        </header><!-- .entry-header -->

        <?php

        if ($single_post_featured_image_view == 'default') {

            magnitude_single_post_social_share_icons($post->ID);


            $show_featured_image = magnitude_get_option('single_show_featured_image');
            if ($show_featured_image):

                ?>
                <div class="read-img pos-rel">
                    <?php magnitude_post_thumbnail(); ?>
                    <?php
                    if (has_post_thumbnail($post_id)):
                        if ($aft_image_caption = get_post(get_post_thumbnail_id())->post_excerpt):
                            if (trim($aft_image_caption) !== ''):
                                ?>
                                <span class="aft-image-caption">
                            <p>
                                <?php echo $aft_image_caption; ?>
                            </p>
                        </span>
                            <?php
                            endif;
                        endif;
                    endif;
                    ?>
                </div>

            <?php endif;
        } ?>


        <!-- end slider-section -->
        <?php
    }
endif;
add_action('magnitude_action_single_header', 'magnitude_single_header', 40);