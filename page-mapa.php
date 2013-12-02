<?php
/*
Template Name: Mapa
*/

get_header();



?>
<div id="map" style="height:500px"></div>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/leaflet/leaflet.css" />
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/leaflet/leaflet.js"></script>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/leaflet/MarkerCluster.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/leaflet/MarkerCluster.Default.css" />
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/leaflet/MarkerCluster.Default.ie.css" />
    <![endif]-->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/leaflet/leaflet.markercluster.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {
    var map = L.map('map').setView([-19.352611,-43.989258], 4);

    var markers = new L.MarkerClusterGroup();
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
    markers.addLayer(new  L.marker([<?php echo get_post_meta(get_the_ID(), 'lat', true) ?>, <?php echo get_post_meta(get_the_ID(), 'lng', true) ?>], {icon: redIcon}).bindPopup('<a href="<?php the_permalink() ?>"><?php echo get_the_title() ?></a>'));
<?php
endforeach;
?>
    map.addLayer(markers);
});
</script>
<?php
get_footer();
?>