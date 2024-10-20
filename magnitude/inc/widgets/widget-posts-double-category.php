<?php
if (!class_exists('Magnitude_Double_Col_Categorised_Posts')) :
    /**
     * Adds Magnitude_Double_Col_Categorised_Posts widget.
     */
    class Magnitude_Double_Col_Categorised_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('magnitude-categorised-posts-title-1', 'magnitude-categorised-posts-title-2', 'magnitude-posts-number-1', 'magnitude-posts-number-2');
            $this->select_fields = array('magnitude-select-category-1', 'magnitude-select-category-2', 'magnitude-select-layout-1', 'magnitude-select-layout-2');

            $widget_ops = array(
                'classname' => 'magnitude_double_col_categorised_posts',
                'description' => __('Displays posts from 2 selected categories in double column.', 'magnitude'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('magnitude_double_col_categorised_posts', __('AFTM Double Categories Posts', 'magnitude'), $widget_ops);
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

            $title_1 = apply_filters('widget_title', $instance['magnitude-categorised-posts-title-1'], $instance, $this->id_base);
            $title_2 = apply_filters('widget_title', $instance['magnitude-categorised-posts-title-2'], $instance, $this->id_base);
            $category_1 = isset($instance['magnitude-select-category-1']) ? $instance['magnitude-select-category-1'] : '0';
            $category_2 = isset($instance['magnitude-select-category-2']) ? $instance['magnitude-select-category-2'] : '0';
            $layout_1 = isset($instance['magnitude-select-layout-1']) ? $instance['magnitude-select-layout-1'] : 'full-plus-list';
            $layout_2 = isset($instance['magnitude-select-layout-2']) ? $instance['magnitude-select-layout-2'] : 'list';



            // open the widget container
            echo $args['before_widget'];
            ?>


            <div class="widget-block">
                <div class="af-container-row clearfix">
                    <div class="col-2 float-l pad <?php echo esc_attr($layout_1); ?> grid-plus-list af-sec-post">
                        <div class="af-title-subtitle-wrap">
                        <?php if (!empty($title_1)): ?>
                            <h4 class="widget-title header-after1">
                            <span class="header-after">
                                <?php echo esc_html($title_1); ?>
                            </span>
                            </h4>
                        <?php endif; ?>
                        </div>
                        <div class="clearfix af-double-column list-style af-widget-body magnitude-widget">
                            <?php $all_posts = magnitude_get_posts(5, $category_1); ?>
                            <?php
                            $count_1 = 1;


                            if ($all_posts->have_posts()) :
                                while ($all_posts->have_posts()) : $all_posts->the_post();



                                        if ($count_1 == 1) {
                                            $thumbnail_size = 'magnitude-medium';

                                        } else {
                                            $thumbnail_size = 'thumbnail';
                                        }


                                    global $post;

                                    ?>

                                    <div class="col-1 float-l aft-spotlight-posts-<?php echo esc_attr($count_1); ?>">
                                        <div class="read-single color-pad">
                                            <div class="read-img col-4 pos-rel read-bg-img">
                                                <a class="aft-post-image-link" href="<?php the_permalink(); ?>">
                                                    <?php if ( has_post_thumbnail() ):
                                                        the_post_thumbnail($thumbnail_size);
                                                    endif;
                                                    ?>
                                                    <?php the_title(); ?>
                                                </a>
                                                <?php echo magnitude_post_format($post->ID); ?>
                                                <?php magnitude_count_content_words($post->ID); ?>
                                                <?php magnitude_archive_social_share_icons($post->ID); ?>

                                            </div>
                                            <div class="read-details col-75 color-tp-pad pad ptb-10">
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
                                    $count_1++;
                                endwhile;
                                ?>
                            <?php endif;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>

                    <div class="col-2 float-l pad <?php echo esc_attr($layout_2); ?> grid-plus-list af-sec-post">
                        <div class="af-title-subtitle-wrap">
                        <?php if (!empty($title_2)): ?>
                            <h4 class="widget-title header-after1">
                                <span class="header-after">
                                <?php echo esc_html($title_2); ?>
                                </span>
                            </h4>
                        <?php endif; ?>
                        </div>
                        <div class="clearfix af-double-column list-style af-widget-body magnitude-widget">
                            <?php $all_posts = magnitude_get_posts(5, $category_2); ?>
                            <?php
                            $count_2 = 1;


                            if ($all_posts->have_posts()) :
                                while ($all_posts->have_posts()) : $all_posts->the_post();



                                        if ($count_2 == 1) {
                                            $thumbnail_size = 'magnitude-medium';

                                        } else {
                                            $thumbnail_size = 'thumbnail';
                                        }
                                    global $post;


                                    ?>

                                    <div class="col-1 float-l aft-spotlight-posts-<?php echo esc_attr($count_2); ?>">
                                        <div class="read-single color-pad">
                                            <div class="read-img col-4 pos-rel read-bg-img">
                                                <a class="aft-post-image-link" href="<?php the_permalink(); ?>">
                                                    <?php if ( has_post_thumbnail() ):
                                                        the_post_thumbnail($thumbnail_size);
                                                    endif;
                                                    ?>
                                                    <?php the_title(); ?>
                                                </a>
                                                <?php echo magnitude_post_format($post->ID); ?>
                                                <?php magnitude_count_content_words($post->ID); ?>
                                                <?php magnitude_archive_social_share_icons($post->ID); ?>

                                            </div>
                                            <div class="read-details col-75 color-tp-pad pad ptb-10">
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
                                    $count_2++;
                                endwhile;
                                ?>
                            <?php endif;
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
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
            $options = array(
                'full-plus-list' => __('Big thumb in first and other in list', 'magnitude'),
                'list' => __('All in list', 'magnitude')

            );


            //print_pre($terms);
            $categories = magnitude_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::magnitude_generate_text_input('magnitude-categorised-posts-title-1', __('Title 1', 'magnitude'), 'Double Categories Posts 1');
                echo parent::magnitude_generate_select_options('magnitude-select-category-1', __('Select category 1', 'magnitude'), $categories);

                echo parent::magnitude_generate_text_input('magnitude-categorised-posts-title-2', __('Title 2', 'magnitude'), 'Double Categories Posts 2');
                echo parent::magnitude_generate_select_options('magnitude-select-category-2', __('Select category 2', 'magnitude'), $categories);



            }

            //print_pre($terms);


        }

    }
endif;