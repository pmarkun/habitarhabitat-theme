<?php
/*
Template Name: Mapa
*/

get_header();



?>
<div id="map" style="height:500px"></div>
    <link rel="stylesheet" href="/wp-content/themes/habitarhabitat-theme/leaflet.css" />
    <script src="/wp-content/themes/habitarhabitat-theme/leaflet.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
    var map = L.map('map').setView([-19.352611,-43.989258], 4);

    var RedIcon = L.Icon.Default.extend({
            options: {
                    iconUrl: '<?php echo get_stylesheet_directory_uri(); ?>/images/marker-icon-red.png' 
            }
         });
    var redIcon = new RedIcon();

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

<?php
$posts = get_posts( array('meta_key' => 'lat', 'numberposts' => -1, 'posts_per_page' => -1) );
foreach($posts as $post) : setup_postdata($post);
?>
L.marker([<?php echo get_post_meta(get_the_ID(), 'lat', true) ?>, <?php echo get_post_meta(get_the_ID(), 'lng', true) ?>], {icon: redIcon}).bindPopup('<a href="<?php the_permalink() ?>"><?php echo get_the_title() ?></a>').addTo(map);
<?php
endforeach;
?>
})
</script>
<?php
get_footer();
?>