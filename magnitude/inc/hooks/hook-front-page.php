<?php
if ( ! function_exists( 'magnitude_front_page_widgets_section' ) ) :
    /**
     *
     * @since Magnitude 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function magnitude_front_page_widgets_section() {
        ?>
        <!-- Main Content section -->
        <?php

                $frontpage_layout = magnitude_get_option('frontpage_content_alignment');

        ?>
        <?php if ( is_active_sidebar( 'home-content-widgets') || is_active_sidebar( 'home-sidebar-widgets') ) {  ?>
            


                    
                <div id="primary" class="content-area">

                    <main id="main" class="site-main">
                        <?php dynamic_sidebar('home-content-widgets'); ?>
                    </main>
                </div>

                <?php if (is_active_sidebar( 'home-sidebar-widgets') && $frontpage_layout != 'full-width-content' ) { ?>
                <?php 
                        $sticky_sidebar_class = '';
                        $sticky_sidebar = magnitude_get_option('frontpage_sticky_sidebar');
                        if($sticky_sidebar){
                         $sticky_sidebar_class = 'aft-sticky-sidebar';   
                        }
                    ?>
                <div id="secondary" class="sidebar-area <?php echo esc_attr($sticky_sidebar_class); ?>">
                    <div class="theiaStickySidebar">
                        <aside class="widget-area color-pad">
                        
                            <?php dynamic_sidebar('home-sidebar-widgets'); ?>
                        </aside>
                    </div>
                </div>
                <?php } ?>
                
            
        <?php }
    }
endif;
add_action( 'magnitude_front_page_section', 'magnitude_front_page_widgets_section', 50 );