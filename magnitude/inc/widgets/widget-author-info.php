<?php
if (!class_exists('Magnitude_author_info')) :
	/**
	 * Adds Magnitude_author_info widget.
	 */
	class Magnitude_author_info extends AFthemes_Widget_Base
	{
		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct()
		{
			$this->text_fields = array('magnitude-author-info-title', 'magnitude-author-info-subtitle', 'magnitude-author-info-image', 'magnitude-author-info-name', 'magnitude-author-info-desc', 'magnitude-author-info-phone', 'magnitude-author-info-email');
			$this->url_fields = array('magnitude-author-info-facebook', 'magnitude-author-info-twitter','magnitude-author-info-youtube');

			$widget_ops = array(
				'classname' => 'magnitude_author_info_widget',
				'description' => __('Displays author info.', 'magnitude'),
                'customize_selective_refresh' => false,

			);

			parent::__construct('magnitude_author_info', __('AFTM Author Info', 'magnitude'), $widget_ops);
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
			echo $args['before_widget'];
			$title = apply_filters('widget_title', $instance['magnitude-author-info-title'], $instance, $this->id_base);

			$profile_image = isset($instance['magnitude-author-info-image']) ? ($instance['magnitude-author-info-image']) : '';

			if ($profile_image) {
				$image_attributes = wp_get_attachment_image_src($profile_image, 'large');
				$image_src = $image_attributes[0];
				$image_class = 'data-bg-hover';

			} else {
				$image_src = '';
				$image_class = 'no-bg';
			}

            $thumbnail_size = 'large';

			$name = isset($instance['magnitude-author-info-name']) ? ($instance['magnitude-author-info-name']) : '';
			$desc = isset($instance['magnitude-author-info-desc']) ? ($instance['magnitude-author-info-desc']) : '';
			$facebook = isset($instance['magnitude-author-info-facebook']) ? ($instance['magnitude-author-info-facebook']) : '';
			$twitter = isset($instance['magnitude-author-info-twitter']) ? ($instance['magnitude-author-info-twitter']) : '';
			$youtube = isset($instance['magnitude-author-info-youtube']) ? ($instance['magnitude-author-info-youtube']) : '';

			?>
            <section class="products">
                <div class="container-wrapper">
					<?php if (!empty($title)): ?>
                        <div class="section-head">
							<?php if (!empty($title)): ?>
                                <h4 class="widget-title section-title">
                                    <span class="header-after">
                                        <?php echo esc_html($title); ?>
                                    </span>
                                </h4>
							<?php endif; ?>


                        </div>

					<?php endif; ?>
                    <div class="posts-author-wrapper">

						<?php if (!empty($image_src)) : ?>


                            <figure class="read-img pos-rel read-bg-img af-author-img <?php echo esc_attr($image_class); ?>">
                               <img src="<?php echo esc_attr($image_src); ?>" />
                            </figure>

						<?php endif; ?>
                        <div class="af-author-details">
							<?php if (!empty($name)) : ?>
                                <h4 class="af-author-display-name"><?php echo esc_html($name); ?></h4>
							<?php endif; ?>
							<?php if (!empty($desc)) : ?>
                                <p class="af-author-display-name"><?php echo esc_html($desc); ?></p>
							<?php endif; ?>

							<?php if (!empty($facebook) || !empty($twitter) || !empty($youtube)) : ?>
                                <div class="social-navigation aft-small-social-menu">
                                    <ul>
										<?php if (!empty($facebook)) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($facebook); ?>" target="_blank"></a>
                                            </li>
										<?php endif; ?>

										<?php if (!empty($youtube)) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($youtube); ?>" target="_blank"></a>
                                            </li>
										<?php endif; ?>

										<?php if (!empty($twitter)) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($twitter); ?>" target="_blank"></a>
                                            </li>
										<?php endif; ?>

                                    </ul>
                                </div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
			<?php
			//print_pre($all_posts);
			// close the widget container
			echo $args['after_widget'];

			//$instance = parent::magnitude_sanitize_data( $instance, $instance );


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
				echo parent::magnitude_generate_text_input('magnitude-author-info-title', __('About Store', 'magnitude'), __('Title', 'magnitude'));

				echo parent::magnitude_generate_image_upload('magnitude-author-info-image', __('Profile image', 'magnitude'), __('Profile image', 'magnitude'));
				echo parent::magnitude_generate_text_input('magnitude-author-info-name', __('Name', 'magnitude'), __('Name', 'magnitude'));
				echo parent::magnitude_generate_text_input('magnitude-author-info-desc', __('Descriptions', 'magnitude'), '');
				echo parent::magnitude_generate_text_input('magnitude-author-info-facebook', __('Facebook', 'magnitude'), '');
				echo parent::magnitude_generate_text_input('magnitude-author-info-youtube', __('Youtube', 'magnitude'), '');
				echo parent::magnitude_generate_text_input('magnitude-author-info-twitter', __('Twitter', 'magnitude'), '');



			}
		}
	}
endif;