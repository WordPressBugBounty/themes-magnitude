<?php
if (!class_exists('Magnitude_Posts_Slider')) :
    /**
     * Adds Magnitude_Posts_Slider widget.
     */
    class Magnitude_Posts_Slider extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('magnitude-posts-slider-title', 'magnitude-excerpt-length', 'magnitude-posts-slider-number');
            $this->select_fields = array('magnitude-select-category', 'magnitude-show-excerpt', 'magnitude-show-posts-slider-thumbnail');

            $widget_ops = array(
                'classname' => 'magnitude_posts_slider_widget',
                'description' => __('Displays posts slider from selected category.', 'magnitude'),
                'customize_selective_refresh' => false,


            );

            parent::__construct('magnitude_posts_slider', __('AFTM Posts Slider', 'magnitude'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {
            $instance = parent::magnitude_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters('widget_title', $instance['magnitude-posts-slider-title'], $instance, $this->id_base);
            $category = isset($instance['magnitude-select-category']) ? $instance['magnitude-select-category'] : 0;


            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="magnitude_posts_slider_widget">
            <?php if (!empty($title)): ?>
            <div class="af-title-subtitle-wrap">
                <?php if (!empty($title)): ?>
                    <h4 class="widget-title header-after1">
                        <span class="header-after">
                            <?php echo esc_html($title); ?>
                            </span>
                    </h4>
                <?php endif; ?>
            </div>
        <?php endif; ?>
            <?php

            $all_posts = magnitude_get_posts(5, $category);
            ?>

            <div class="af-cat-widget-carousel af-widget-body pos-rel none clearfix magnitude-widget hasthumbslide">
                <div class="slick-wrapper af-post-slider af-widget-carousel">
                    <?php
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            global $post;
                            $thumbnail_size = 'magnitude-slider-full';
                            ?>
                            <div class="slick-item">
                                <div class="big-grid">
                                    <div class="read-single pos-rel">
                                        <div class="read-img pos-rel read-bg-img">
                                            <a class="aft-post-image-link" href="<?php the_permalink(); ?>">
                                                <?php if ( has_post_thumbnail() ):
                                                    the_post_thumbnail($thumbnail_size);
                                                endif;
                                                ?>
                                                <?php the_title(); ?>
                                            </a>
                                            <?php magnitude_archive_social_share_icons($post->ID); ?>

                                        </div>
                                        <div class="read-details forvertical-wrapper">
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
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            </div>

            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        public function enqueue()
        {
            wp_enqueue_script('magnitude-script');
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;

            $categories = magnitude_get_terms();
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::magnitude_generate_text_input('magnitude-posts-slider-title', __('Title', 'magnitude'), 'Posts Slider');
                echo parent::magnitude_generate_select_options('magnitude-select-category', __('Select category', 'magnitude'), $categories);


            }
        }
    }
endif;