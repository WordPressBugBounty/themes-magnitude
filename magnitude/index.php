<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magnitude
 */

get_header(); ?>
    

        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <!--<div class="af-container-row">-->

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>

					<?php
					endif;

					//div wrap start
					do_action( 'magnitude_archive_layout_before_loop' );
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */

						get_template_part( 'template-parts/content', get_post_format() );


					endwhile;

					//div wrap end
					do_action( 'magnitude_archive_layout_after_loop' );

					?>

				<?php

				else :
					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

                <!--</div>-->
            </main><!-- #main -->
            <div class="col col-ten">
                <div class="magnitude-pagination">
					<?php magnitude_numeric_pagination(); ?>
                </div>
            </div>
        </div><!-- #primary -->

		<?php
		get_sidebar();
		?>

<?php
get_footer();
