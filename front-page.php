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
       <iframe src="//player.vimeo.com/video/78694247" width="595" height="350" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if ( !is_front_page() ) : // Only display Excerpts for Search ?>
                    <div class="entry-content">
                        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
                    </div><!-- .entry-content -->
                <?php endif; ?>
            </article>
        <?php endwhile; // end of the loop. ?>
       
			
		</div><!-- #content -->
	</div><!-- #primary -->
    
    <?php if ( is_front_page() ) : // Only display Excerpts for Search ?>    
    <div id="secondary" class="widget-area" role="complementary">
            <div class="entry-summary">
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" rel="bookmark">Leia mais</a>
            </div><!-- .entry-summary -->        
    </div>
    <?php endif; ?>                
<?php get_footer(); ?>