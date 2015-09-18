<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if( is_sticky() && is_home() && ! is_paged() ){
		?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php
	}
	if( is_search() ){
		?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php
	}
	else{
		?>
		<div class="entry-content">
		<?php 
		$video_url = get_post_meta($post->ID, "video_url", TRUE);
		if( $video_url ){
			render_video_url($video_url);
		}
		else{
			?>
			<div class="video-placeholder"></div>
			<?php
		}
		if( is_single() ){
			?>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
			<?php
		}
		else{
			?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php
		}
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) );
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) );
		the_tags( "TAGS: ", "," );
		?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
	</article><!-- #post -->