<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<?php

if(is_single() || is_category()) :
    foreach ( get_the_category() as $category ) {
        if ( $category->category_parent != 0 ) {
            $cat = $category->category_parent;
        }
    }
$args = array('category' => $cat, 'posts_per_page' => 100);
$posts = get_posts($args);
?>
<div id="secondary" class="widget-area" role="complementary">
<?php foreach ($posts as $post ) : setup_postdata( $post ); ?>
    <?php
    if (  $wp_query->post->ID == $post->ID ) {
        $current = 'current';
    } else {
        $current = '';
    }
?>
    <a href="<?php echo the_permalink() ?>">
    <aside class="cat-historias <?php echo $current ?>">
<?php echo get_the_post_thumbnail(get_the_ID(), 'video-small') ?>
    <div class="content">
    <?php echo the_title() ?>
    </div>
    </aside>
    </a>
<?php endforeach; ?>
<?php endif; ?>
</div><!-- #secondary -->

	<?php if ( !is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>