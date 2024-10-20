<?php
if (!class_exists('Magnitude_Posts_Grid')) :
    /**
     * Adds Magnitude_Posts_Grid widget.
     */
    class Magnitude_Posts_Grid extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('magnitude-categorised-posts-title', 'magnitude-excerpt-length', 'magnitude-posts-number');
            $this->select_fields = array('magnitude-select-category', 'magnitude-show-excerpt');

            $widget_ops = array(
                'classname' => 'magnitude_posts_grid grid-layout',
                'description' => __('Displays posts from selected category in a grid.', 'magnitude'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('magnitude_posts_grid', __('AFTM Posts Grid', 'magnitude'), $widget_ops);
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
            $title = apply_filters('widget_title', $instance['magnitude-categorised-posts-title'], $instance, $this->id_base);

            $category = isset($instance['magnitude-select-category']) ? $instance['magnitude-select-category'] : '0';



            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if (!empty($title)): ?>
            <div class="af-title-subtitle-wrap">
                <?php if (!empty($title)): ?>
                    <h4 class="widget-title header-after1">
                        <span class="header-after">
                            <?php echo esc_html($title);  ?>
                            </span>
                    </h4>
                <?php endif; ?>

            </div>
        <?php endif; ?>
            <?php
            $all_posts = magnitude_get_posts(6, $category);
            ?>
            <div class="widget-block widget-wrapper af-widget-body magnitude-widget">
                <div class="af-container-row clearfix">
                    <?php
                    $count = 1;
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            global $post;
                            $url = magnitude_get_freatured_image_url($post->ID, 'magnitude-medium');
                            $thumb_id = get_post_thumbnail_id($post->ID);

                            ?>
                            <div class="col-3 float-l pad af-sec-post" data-mh="af-grid-posts">
                                <div class="read-single color-pad">
                                    <div class="read-img pos-rel read-img read-bg-img data-bg"
                                         data-background="<?php echo esc_url($url); ?>">
                                        <a class="aft-post-image-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <?php if (!empty($url)): ?>
                                            <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr(magnitude_get_img_alt($thumb_id));?>">
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

                        <?php
                        $count++;
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>

                </div>
            </div>

            <?php
            // close the widget container
            echo $args['after_widget'];
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
                echo parent::magnitude_generate_text_input('magnitude-categorised-posts-title', __('Title', 'magnitude'), __('Posts Grid', 'magnitude'));
                echo parent::magnitude_generate_select_options('magnitude-select-category', __('Select category', 'magnitude'), $categories);

            }

            //print_pre($terms);


        }

    }
endif;