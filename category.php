<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			$first = true;
			while ( have_posts() ) : the_post();
				//Check if not child
				if ( !in_category($cat) ) {
					continue;
				}
				//Check if first
				if ( $first ) : 
					get_template_part( 'content', get_post_format() ); 
					$first = false;
					echo '<div class="grid-container"></div>';
				else :
					?>
					<div class="small-grid format-<?php echo get_post_format( get_the_ID() ); ?>">
						<?php if ( has_post_thumbnail() ) {
							echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
						}
						else { ?>
							<img src='<?php echo  get_stylesheet_directory_uri() . '/images/' . get_post_format( get_the_ID() ) .'.png' ?>' width="98" height="77" />
						<?php } ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</div>
				<?php 
				endif;
			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>