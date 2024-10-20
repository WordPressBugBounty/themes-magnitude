<?php
if (!class_exists('Magnitude_Posts_List')) :
    /**
     * Adds Magnitude_Posts_List widget.
     */
    class Magnitude_Posts_List extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('magnitude-categorised-posts-title', 'magnitude-posts-number');
            $this->select_fields = array('magnitude-select-category', 'magnitude-show-category');

            $widget_ops = array(
                'classname' => 'magnitude_posts_list list-layout',
                'description' => __('Displays posts from selected category in a list.', 'magnitude'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('magnitude_posts_list', __('AFTM Posts List', 'magnitude'), $widget_ops);
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
            $show_categories = isset($instance['magnitude-show-category']) ? $instance['magnitude-show-category'] : 'true';


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
            $all_posts = magnitude_get_posts(6, $category);
            ?>
            <div class="widget-block widget-wrapper af-widget-body magnitude-widget">
                <div class="af-container-row clearfix">
                    <?php
                    $count = 1;
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            global $post;
                            $thumbnail_size = 'thumbnail';
                            ?>


                            <div class="col-2 pad float-l af-double-column list-style" data-mh="af-feat-list">
                                <div class="af-double-column list-style clearfix">
                                    <div class="read-single color-pad">
                                        <div class="read-img pos-rel col-4 float-l read-bg-img">
                                            <a class="aft-post-image-link" href="<?php the_permalink(); ?>">
                                                <?php if ( has_post_thumbnail() ):
                                                    the_post_thumbnail($thumbnail_size);
                                                endif;
                                                ?>
                                                <?php the_title(); ?>
                                            </a>
                                        </div>

                                        <div class="read-details col-75 float-l pad color-tp-pad">
                                            <?php if ($show_categories == 'true'): ?>
                                                <div class="read-categories">
                                                    <?php magnitude_post_categories(); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="read-title">
                                                <h4>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h4>
                                            </div>
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
                echo parent::magnitude_generate_text_input('magnitude-categorised-posts-title', __('Title', 'magnitude'), __('Posts List', 'magnitude'));
                echo parent::magnitude_generate_select_options('magnitude-select-category', __('Select category', 'magnitude'), $categories);


            }

            //print_pre($terms);


        }

    }
endif;