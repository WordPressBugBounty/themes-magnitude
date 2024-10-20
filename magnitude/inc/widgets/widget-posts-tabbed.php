<?php
if (!class_exists('Magnitude_Tabbed_Posts')) :
    /**
     * Adds Magnitude_Tabbed_Posts widget.
     */
    class Magnitude_Tabbed_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('magnitude-tabbed-popular-posts-title', 'magnitude-tabbed-latest-posts-title', 'magnitude-tabbed-categorised-posts-title', 'magnitude-excerpt-length', 'magnitude-posts-number');

            $this->select_fields = array('magnitude-show-excerpt', 'magnitude-enable-categorised-tab', 'magnitude-select-category', 'magnitude-show-category');

            $widget_ops = array(
                'classname' => 'magnitude_tabbed_posts_widget',
                'description' => __('Displays tabbed posts lists from selected settings.', 'magnitude'),
                'customize_selective_refresh' => false,

            );

            parent::__construct('magnitude_tabbed_posts', __('AFTM Tabbed Posts', 'magnitude'), $widget_ops);
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
            $tab_id = 'tabbed-' . $this->number;


            /** This filter is documented in wp-includes/default-widgets.php */

            $show_category =  'true';

            $popular_title = isset($instance['magnitude-tabbed-popular-posts-title']) ? $instance['magnitude-tabbed-popular-posts-title'] : __('AFTM Popular', 'magnitude');
            $latest_title = isset($instance['magnitude-tabbed-latest-posts-title']) ? $instance['magnitude-tabbed-latest-posts-title'] : __('AFTM Latest', 'magnitude');


            $enable_categorised_tab = isset($instance['magnitude-enable-categorised-tab']) ? $instance['magnitude-enable-categorised-tab'] : 'true';
            $categorised_title = isset($instance['magnitude-tabbed-categorised-posts-title']) ? $instance['magnitude-tabbed-categorised-posts-title'] : __('Trending', 'magnitude');
            $category = isset($instance['magnitude-select-category']) ? $instance['magnitude-select-category'] : '0';


            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="tabbed-head">
                    <ul class="nav nav-tabs af-tabs tab-warpper" role="tablist">
                        <li class="tab tab-recent active">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-label="<?php esc_attr_e('Recent', 'magnitude'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1">
                                <i class="fa fa-bolt" aria-hidden="true"></i>  <?php echo esc_html($latest_title); ?>
                            </a>
                        </li>
                        <li role="presentation" class="tab tab-popular">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-label="<?php esc_attr_e('Popular', 'magnitude'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>  <?php echo esc_html($popular_title); ?>
                            </a>
                        </li>

                        <?php if ($enable_categorised_tab == 'true'): ?>
                            <li class="tab tab-categorised">
                                <a href="#<?php echo esc_attr($tab_id); ?>-categorised"
                                   aria-label="<?php esc_attr_e('Categorised', 'magnitude'); ?>" role="tab"
                                   data-toggle="tab" class="font-family-1">
                                   <i class="fa fa-fire" aria-hidden="true"></i>  <?php echo esc_html($categorised_title); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="tab-content af-widget-body">
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane active">
                        <?php
                        magnitude_render_posts('recent', 5, '0', $show_category);
                        ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane">
                        <?php
                        magnitude_render_posts('popular', 5, '0', $show_category);
                        ?>
                    </div>
                    <?php if ($enable_categorised_tab == 'true'): ?>
                        <div id="<?php echo esc_attr($tab_id); ?>-categorised" role="tabpanel" class="tab-pane">
                            <?php
                            magnitude_render_posts('categorised', 5, $category, $show_category);
                            ?>
                        </div>
                    <?php endif; ?>
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
            $enable_categorised_tab = array(
                'true' => __('Yes', 'magnitude'),
                'false' => __('No', 'magnitude')

            );

            $options = array(
                'true' => __('Yes', 'magnitude'),
                'false' => __('No', 'magnitude'),

            );

            // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
            ?><h4><?php _e('Latest Posts', 'magnitude'); ?></h4><?php
            echo parent::magnitude_generate_text_input('magnitude-tabbed-latest-posts-title', __('Title', 'magnitude'), __('Latest', 'magnitude'));

            ?><h4><?php _e('Popular Posts', 'magnitude'); ?></h4><?php
            echo parent::magnitude_generate_text_input('magnitude-tabbed-popular-posts-title', __('Title', 'magnitude'), __('Popular', 'magnitude'));

            $categories = magnitude_get_terms();
            if (isset($categories) && !empty($categories)) {
                ?><h4><?php _e('Categorised Posts', 'magnitude'); ?></h4>
                <?php
                echo parent::magnitude_generate_select_options('magnitude-enable-categorised-tab', __('Enable Categorised Tab', 'magnitude'), $enable_categorised_tab);
                echo parent::magnitude_generate_text_input('magnitude-tabbed-categorised-posts-title', __('Title', 'magnitude'), __('Trending', 'magnitude'));
                echo parent::magnitude_generate_select_options('magnitude-select-category', __('Select category', 'magnitude'), $categories);

            }
            ?><h4><?php _e('Settings for all tabs', 'magnitude'); ?></h4><?php
            echo parent::magnitude_generate_select_options('magnitude-show-category', __('Show categories', 'magnitude'), $options);


        }
    }
endif;