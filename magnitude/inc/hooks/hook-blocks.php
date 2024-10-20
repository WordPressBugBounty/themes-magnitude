<?php
    if (!function_exists('magnitude_archive_layout_selection')) :
        /**
         *
         * @param null
         *
         * @return null
         *
         * @since Magnitude 1.0.0
         *
         */
        function magnitude_archive_layout_selection($archive_layout = 'full')
        {
            
            //$archive_layout = magnitude_get_option( 'archive_layout' );
            
            switch ($archive_layout) {
                case "archive-layout-grid":
                    magnitude_get_block('grid', 'archive');
                    break;
                case "archive-layout-list":
                    magnitude_get_block('list', 'archive');
                    break;
                case "archive-layout-full":
                    magnitude_get_block('full', 'archive');
                    break;
                
                case "archive-layout-masonry":
                    magnitude_get_block('masonry', 'archive');
                    break;
                default:
                    magnitude_get_block('full', 'archive');
            }
        }
    endif;
    
    if (!function_exists('magnitude_archive_layout')) :
        /**
         *
         * @param null
         *
         * @return null
         *
         * @since Newsphere 1.0.0
         *
         */
        function magnitude_archive_layout($cat_slug = '')
        {
            
            //$archive_class = magnitude_get_option('archive_layout');
            
            $archive_args = magnitude_archive_layout_class($cat_slug);
            
            ?>
            
            <?php if (!empty($archive_args['data_mh'])): ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class($archive_args['add_archive_class']); ?>
                     data-mh="<?php echo esc_attr($archive_args['data_mh']); ?>">
                <?php magnitude_archive_layout_selection($archive_args['archive_layout']); ?>
            </article>
        <?php else: ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class($archive_args['add_archive_class']); ?> >
                <?php magnitude_archive_layout_selection($archive_args['archive_layout']); ?>
            </article>
        <?php endif; ?>
            
            <?php
            
        }
        
        add_action('magnitude_action_archive_layout', 'magnitude_archive_layout', 10, 1);
    endif;
    
    function magnitude_archive_layout_class($cat_slug)
    {
        
        
        if (is_category() || !empty($cat_slug)) {
            
            $term_meta = '';
            $term_meta_list = '';
            $term_meta_grid = '';
            if (!empty($cat_slug)) {
                $ajax_term = get_term_by('slug', $cat_slug, 'category');
                $t_id = $ajax_term->term_id;
            } else {
                $queried_object = get_queried_object();
                $t_id = $queried_object->term_id;
                
            }
            
            $term_meta = get_option("category_layout_$t_id");
            $term_meta_list = get_option("category_layout_list_$t_id");
            $term_meta_grid = get_option("category_layout_grid_$t_id");
            
            $archive_args = array();
            
            if (!empty($term_meta)) {
                $archive_class = $term_meta['archive_layout_term_meta'];
            } else {
                $archive_class = magnitude_get_option('archive_layout');
            }
            
            if (!empty($term_meta_list)) {
                $archive_layout_list = $term_meta_list['archive_layout_alignment_term_meta_list'];
                
            } else {
                
                $archive_layout_list = magnitude_get_option('archive_image_alignment');
                
            }
            
            if (!empty($term_meta_grid)) {
                $archive_layout_grid = $term_meta_grid['archive_layout_alignment_term_meta_gird'];
            } else {
                $archive_layout_grid = magnitude_get_option('archive_image_alignment_grid');
            }
            
        } else {
            
            
            $archive_class = magnitude_get_option('archive_layout');
            $archive_layout_list = magnitude_get_option('archive_image_alignment');
            $archive_layout_grid = magnitude_get_option('archive_image_alignment_grid');
            
        }
        
        if ($archive_class == 'archive-layout-grid') {
            $archive_args['archive_layout'] = 'archive-layout-grid';
            $archive_args['add_archive_class'] = 'af-sec-post latest-posts-grid col-3 float-l pad ';
            //$archive_layout_mode = magnitude_get_option('archive_image_alignment_grid');
            $archive_layout_mode = $archive_layout_grid;
            if ($archive_layout_mode == 'archive-image-full-alternate' || $archive_layout_mode == 'archive-image-list-alternate') {
                $archive_args['data_mh'] = '';
            } else {
                $archive_args['data_mh'] = 'archive-layout-grid';
            }
            //$image_align_class = magnitude_get_option('archive_image_alignment_grid');
            $image_align_class = $archive_layout_grid;
            $archive_args['add_archive_class'] .= ' ' . $archive_class . ' ' . $image_align_class;
            
        } elseif ($archive_class == 'archive-layout-masonry') {
            $archive_args['archive_layout'] = 'archive-layout-masonry';
            $archive_args['add_archive_class'] = 'latest-posts-masonry col-3 float-l pad';
            $archive_args['data_mh'] = '';
        } elseif ($archive_class == 'archive-layout-list') {
            $archive_args['archive_layout'] = 'archive-layout-list';
            $archive_args['add_archive_class'] = 'latest-posts-list col-1 float-l pad';
            $archive_args['data_mh'] = '';
            //$image_align_class = magnitude_get_option('archive_image_alignment');
            $image_align_class = $archive_layout_list;
            $archive_args['add_archive_class'] .= ' ' . $archive_class . ' ' . $image_align_class;
        } else {
            $archive_args['archive_layout'] = 'archive-layout-full';
            $archive_args['add_archive_class'] = 'latest-posts-full col-1 float-l pad';
            $archive_args['data_mh'] = '';
        }
        
        return $archive_args;
        
    }


//Archive div wrap before loop
    
    if (!function_exists('magnitude_archive_layout_before_loop')) :
        
        /**
         *
         * @param null
         *
         * @return null
         *
         * @since Newsphere 1.0.0
         *
         */
        
        function magnitude_archive_layout_before_loop()
        {
            
            if (is_category()) {
                
                //check is category
                $archive_class = '';
                $archive_mode = magnitude_get_option('archive_layout');
                $queried_object = get_queried_object();
                $t_id = $queried_object->term_id;
                $term_meta = get_option("category_layout_$t_id");
                $term_meta_masonry = get_option("category_layout_masonry_$t_id");
                $term_meta_full = get_option("category_layout_full_$t_id");
                $term_meta_grid_column = get_option("category_layout_grid_column_$t_id");
                
                if (!empty($term_meta)) {
                    $term_meta = $term_meta['archive_layout_term_meta'];
                    // grid  column layout
                    if ($term_meta == 'archive-layout-grid') {
                        
                        if ($term_meta_grid_column['archive_layout_grid'] == 'gird-layout-two') {
                            $col_grid = 'two-col-masonry';
                            
                        } else if ($term_meta_grid_column['archive_layout_grid'] == 'grid-layout-four') {
                            $col_grid = 'four-col-masonry';
                            
                        } else {
                            $col_grid = 'three-col-masonry';
                            
                        }
                        
                        $archive_class .= $archive_mode . " " . $col_grid;
                    } //masonry column layout
                    else if ($term_meta == 'archive-layout-masonry') {
                        
                        if ($term_meta_masonry['archive_layout_masonry'] == 'masonry-layout-two') {
                            $col_masonry = 'two-col-masonry';
                        } else if ($term_meta_masonry['archive_layout_masonry'] == 'masonry-layout-four') {
                            $col_masonry = 'four-col-masonry';
                        } else {
                            $col_masonry = 'three-col-masonry';
                        }
                        $archive_class = 'aft-masonry-archive-posts' . " " . $col_masonry;
                    } //full layout option
                    else if ($term_meta == 'archive-layout-full') {
                        if ($term_meta_full['archive_layout_full'] == 'full-image-first') {
                            $archive_class = $archive_mode . " " . 'archive-image-first';
                        } else if ($term_meta_full['archive_layout_full'] == 'full-title-first') {
                            $archive_class = $archive_mode . " " . 'archive-title-first';
                        } else if ($term_meta_full['archive_layout_full'] == 'archive-full-grid') {
                            $archive_class = $archive_mode . " " . "full-with-grid";
                        } else {
                            $archive_class = $archive_mode . " " . 'archive-title-first';
                        }
                    } else {
                        $archive_class = $term_meta;
                    }
                    
                    
                } else {
                    //grid layout option
                    if ($archive_mode == 'archive-layout-grid') {
                        $archive_layout_grid = magnitude_get_option('archive_grid_column_layout');
                        if ($archive_layout_grid == 'gird-layout-two') {
                            $col_grid = $archive_mode . " " . 'two-col-masonry';
                        } else if ($archive_layout_grid == 'grid-layout-four') {
                            $col_grid = $archive_mode . " " . 'four-col-masonry';
                        } else {
                            $col_grid = $archive_mode . " " . 'three-col-masonry';
                        }
                        $archive_class = $col_grid;
                    } //masonry layout option
                    else if ($archive_mode == 'archive-layout-masonry') {
                        $archive_layout_masonary = magnitude_get_option('archive_layout_masonry');
                        if ($archive_layout_masonary == 'masonry-layout-two') {
                            $col_masonry = 'two-col-masonry';
                        } else if ($archive_layout_masonary == 'masonry-layout-four') {
                            $col_masonry = 'four-col-masonry';
                        } else {
                            $col_masonry = 'three-col-masonry';
                        }
                        $archive_class = 'aft-masonry-archive-posts' . " " . $col_masonry;
                    } //full layout option
                    elseif ($archive_mode == 'archive-layout-full') {
                        $archive_layout_full = magnitude_get_option('archive_layout_full');
                        if ($archive_layout_full == 'full-image-first') {
                            $archive_class = $archive_mode . " " . 'archive-image-first';
                        } else if ($archive_layout_full == 'full-title-first') {
                            $archive_class = $archive_mode . " " . 'archive-title-first';
                        } else if ($archive_layout_full == 'archive-full-grid') {
                            $archive_class = $archive_mode . " " . "full-with-grid";
                        } else {
                            $archive_class = $archive_mode . " " . 'archive-title-first';
                        }
                    } else {
                        $archive_class = $archive_mode;
                    }
                }
            } else {
                //grid layout option
                $archive_mode = magnitude_get_option('archive_layout');
                if ($archive_mode == 'archive-layout-grid') {
                    $archive_layout_grid = magnitude_get_option('archive_grid_column_layout');
                    if ($archive_layout_grid == 'gird-layout-two') {
                        $col_grid = $archive_mode . " " . 'two-col-masonry';
                    } else if ($archive_layout_grid == 'grid-layout-four') {
                        $col_grid = $archive_mode . " " . 'four-col-masonry';
                    } else {
                        $col_grid = $archive_mode . " " . 'three-col-masonry';
                    }
                    $archive_class = $col_grid;
                } //masonry layout option
                else if ($archive_mode == 'archive-layout-masonry') {
                    $archive_layout_masonary = magnitude_get_option('archive_layout_masonry');
                    if ($archive_layout_masonary == 'masonry-layout-two') {
                        $col_masonry = 'two-col-masonry';
                    } else if ($archive_layout_masonary == 'masonry-layout-four') {
                        $col_masonry = 'four-col-masonry';
                    } else {
                        $col_masonry = 'three-col-masonry';
                    }
                    $archive_class = 'aft-masonry-archive-posts' . " " . $col_masonry;;
                } //full layout option
                else if ($archive_mode == 'archive-layout-full') {
                    $archive_layout_full = magnitude_get_option('archive_layout_full');
                    if ($archive_layout_full == 'full-image-first') {
                        $archive_class = $archive_mode . " " . 'full-image-first';
                    } else if ($archive_layout_full == 'full-title-first') {
                        $archive_class = $archive_mode . " " . 'archive-title-first';
                    } else if ($archive_layout_full == 'archive-full-grid') {
                        $archive_class = $archive_mode . " " . "full-with-grid";
                    } else {
                        $archive_class = $archive_mode;
                    }
                } else {
                    
                    $archive_class = $archive_mode;
                }
            }
            ?>
            <div class="af-container-row aft-archive-wrapper magnitude-customizer clearfix <?php echo esc_attr($archive_class); ?>">
            <?php
            
        }
        
        add_action('magnitude_archive_layout_before_loop', 'magnitude_archive_layout_before_loop');
    endif;
    
    if (!function_exists('magnitude_archive_layout_after_loop')):
        
        function magnitude_archive_layout_after_loop()
        {
            ?>
            </div>
        <?php }
        
        add_action('magnitude_archive_layout_after_loop', 'magnitude_archive_layout_after_loop');
    
    endif;
