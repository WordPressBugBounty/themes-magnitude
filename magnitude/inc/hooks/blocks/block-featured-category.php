<?php
    $featured_categories = array();

    for( $i=1; $i<5 ;$i++){
        $category_id = magnitude_get_option('select_featured_category_'.$i);
        if(absint($category_id) > 0){
            $featured_categories_attachment= magnitude_get_option('featured_category_image_'.$i);
            $featured_categories['feature_'.$i][]= $category_id;
            $featured_categories['feature_'.$i][]= wp_get_attachment_url($featured_categories_attachment, 'magnitude-medium');
            $featured_categories['feature_'.$i][]= get_cat_name($category_id);
            $featured_categories['feature_'.$i][]= get_category_link($category_id);
        }
    }

    if(isset($featured_categories)):
        $count = 1;
            foreach ($featured_categories as $fc):
                ?>
                <div class="featured-category-item pad float-l">
                    <div class="read-img pos-rel read-img read-bg-img data-bg"
                         data-background="<?php echo esc_url($fc[1]); ?>">
                        <?php if (!empty($fc[1])): ?>
                            <img src="<?php echo esc_url($fc[1]); ?>" alt="">
                        <?php endif; ?>
                        <a href="<?php echo esc_url($fc[3]);?>">
                            <span><?php echo esc_html($fc[2]); ?></span>
                        </a>
                    </div><!-- read-img pos-rel read-img read-bg-img data-bg-->
                </div><!--featured-category-item-->
                
            <?php
              $count++;
            endforeach;
        endif;
