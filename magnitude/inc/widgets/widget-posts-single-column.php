<?php
if (!class_exists('Magnitude_Single_Col_Categorised_Posts')) :
    /**
     * Adds Magnitude_Single_Col_Categorised_Posts widget.
     */
    class Magnitude_Single_Col_Categorised_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('magnitude-categorised-posts-title', 'magnitude-posts-number', 'magnitude-excerpt-length');
            $this->select_fields = array('magnitude-select-category', 'magnitude-show-excerpt');

            $widget_ops = array(
                'classname' => 'magnitude_single_col_categorised_posts',
                'description' => __('Displays posts from selected category in single column.', 'magnitude'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('magnitude_single_col_categorised_posts', __('AFTM Single Column ', 'magnitude'), $widget_ops);
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
            $show_excerpt = isset($instance['magnitude-show-excerpt']) ? $instance['magnitude-show-excerpt'] : 'true';


            // open the widget container
            echo $args['before_widget'];
            ?>
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
            <div class="widget-block list-style clearfix af-widget-body magnitude-widget">
                <?php
                if ($all_posts->have_posts()) :
                    while ($all_posts->have_posts()) : $all_posts->the_post();
                        global $post;

                        $thumbnail_size =  'magnitude-medium';

                        ?>

                        <div class="read-single color-pad">
                            <div class="read-img pos-rel col-2 float-l read-bg-img af-sec-list-img">
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
                            <div class="read-details col-2 float-l pad color-tp-pad ptb-10">

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
                                <?php if ($show_excerpt != 'false'): ?>
                                    <div class="read-descprition full-item-discription">
                                        <div class="post-description">

                                                <?php echo wp_kses_post(magnitude_get_the_excerpt($post->ID)); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    ?>
                <?php endif;
                wp_reset_postdata(); ?>
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
            $options = array(
                'true' => __('Yes', 'magnitude'),
                'false' => __('No', 'magnitude'),

            );

            $categories = magnitude_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::magnitude_generate_text_input('magnitude-categorised-posts-title', 'Title', 'Single Column Posts');
                echo parent::magnitude_generate_select_options('magnitude-select-category', __('Select category', 'magnitude'), $categories);
                echo parent::magnitude_generate_select_options('magnitude-show-excerpt', __('Show excerpt', 'magnitude'), $options);



            }

            //print_pre($terms);


        }

    }
endif;