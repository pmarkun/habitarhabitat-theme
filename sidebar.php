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

if(is_single()) {
    foreach ( get_the_category() as $category ) {
        if ( $category->category_parent != 0 ) {
            $cat = $category->category_parent;
        }
    }
}

$args = array('category' => $cat, 'posts_per_page' => 100);
$posts = get_posts($args);
?>
<div id="secondary" class="widget-area" role="complementary">
<?php foreach ($posts as $post) : setup_postdata( $post ); ?>
    <aside class="cat-historias">
<a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a>
    </aside>
<?php endforeach ?>
</div><!-- #secondary -->

	<?php if ( !is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>