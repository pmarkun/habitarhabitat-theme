<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
        <?php while ( have_posts() ) : the_post(); ?>
		<div id="content" role="main">
        <?php the_content(); ?>
		</div><!-- #content -->
        <?php endwhile; // end of the loop. ?>
	</div><!-- #primary -->
    
    <?php if ( is_front_page() ) : // Only display Excerpts for Search ?>
    <div id="secondary" class="widget-area" role="complementary">
        <?php if ( is_active_sidebar( 'home_left_sidebar' ) ) : ?>
        <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
            <?php dynamic_sidebar( 'home_left_sidebar' ); ?>
        </div><!-- #primary-sidebar -->
        <?php endif; ?>
    </div>
    <?php endif; ?>                
<?php get_footer(); ?>