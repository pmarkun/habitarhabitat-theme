<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<h1 class="saibamais">Saiba mais:</h1>
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