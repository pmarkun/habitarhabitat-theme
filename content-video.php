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
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php endif; ?>
		<!-- <header class="entry-header">
			<?php the_post_thumbnail(); ?>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
			</header> -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php 
				$video_url = get_post_meta($post->ID, "video_url", TRUE);
				if ( $video_url ) {
					render_video_url($video_url);
				}
				else { ?>
					<div class="video-placeholder"></div>
				<? }
			?>

			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>

			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php if ( is_single() ) {
        		$related_posts = get_related_post_content($post->ID);
       			if ($related_posts) {
            		foreach ($related_posts as $r) {
	            		?>
	                	<div class="small-grid format-<?php echo get_post_format( $r->ID ); ?>">   
	                	<?php if ( has_post_thumbnail() ) {
	                        echo get_the_post_thumbnail( $r->ID, 'thumbnail' );
	                    }
	                    else { ?>
	                        <img src='<?php echo  get_stylesheet_directory_uri() . '/images/' . get_post_format( $r->ID ) .'.png' ?>' width="98" height="77" />
	                    <?php } ?>
	                    <a href="<?php echo $r->guid; ?>" rel="bookmark"><?php echo $r->post_title; ?></a>
	                	</div>
	                	<?php
            		}
   				}
			}
    		?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->