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
		<div id="content" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
			   <!-- <iframe src="//player.vimeo.com/video/78694247?portrait=0&title=0&=badge=0&byline=0&color=93101c" width="622" height="350" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->
			   <a href="https://www.facebook.com/tvamericalatina2/app_340216556126485"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/tal.jpg" /></a>
		</div><!-- #content -->
	</div><!-- #primary -->
    
    <?php if ( is_front_page() ) : // Only display Excerpts for Search ?>    
    <div id="secondary" class="widget-area" role="complementary">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-summary">
                    <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->        
            <div id="mapa-banner">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>mapa">
                    <b>Veja o mapa</b>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/mapa-banner.png" style="width:250px;border:1px solid black;margin-top:5px;" />
                </a>
            </div>
            </article>
    </div>
    <?php endif; ?>                
     <?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>