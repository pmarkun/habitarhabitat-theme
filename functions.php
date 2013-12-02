<?php 
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

//Adicionando MenU Header
register_nav_menu( 'header', 'Header Menu' );

//Adicionando suporte a thumbs

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 100, 80, true );
add_image_size( 'video-small', 65, 40, true); // name, width, height, crop
add_image_size( 'video-large', 100, 80, true); // name, width, height, crop

//Adicionando formatos
add_action( 'after_setup_theme', 'childtheme_formats', 11 );
function childtheme_formats(){
    add_theme_support( 'post-formats', array( 'video', 'image', 'link', 'status', 'quote' ) );
}
//Get Video ID

function render_video_url( $url ) {
    $vimeo = strpos($url, "vimeo");
    $youtube = strpos($url, "youtube");
    if ( $vimeo ) {
        $id = substr(parse_url($url, PHP_URL_PATH), 1);
        render_video_vimeo($id);
    }
    elseif ( $youtube ) {
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        $id = $my_array_of_vars['v'];
        render_video_youtube($id);
    }
}

function render_video_vimeo( $id, $w='622', $h='350' ) {
    $html = '<iframe src="//player.vimeo.com/video/'.$id.'?portrait=0&title=0&=badge=0&byline=0&color=93101c" width="'.$w.'" height="'.$h.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    printf($html);
}

function render_video_youtube( $id, $w='622', $h='350' ) {
    $html = '<iframe width="'.$w.'" height="'.$h.'" src="//www.youtube.com/embed/'.$id.'?controls=2&modestbranding=1&showinfo=0" frameborder="0" allowfullscreen></iframe>';
    printf($html);
}

function get_youtube_id($url) {
    parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
    $id = $my_array_of_vars['v'];
    return $id;
}

function get_vimeo_id($url) {
    $id = substr(parse_url($url, PHP_URL_PATH), 1);
    return $id;
}

function get_video_thumbnail($url) {
    $vimeo = strpos($url, "vimeo");
    $youtube = strpos($url, "youtube");

    if ( $youtube ) {
        $url = 'http://img.youtube.com/vi/'. get_youtube_id($url) .'/0.jpg';
    } elseif ( $vimeo ) {
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/". get_vimeo_id($url) .".php"));
        $url = $hash[0]['thumbnail_medium'];  
    }

    return $url;
}

add_action('save_post', 'get_geolocation');
function get_geolocation() {
    global $post;
    
    $address = get_post_meta($post->ID, 'address', true);
    
    if(!empty($address)) {
        $address = str_replace(" ", "+", $address);

        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
        $json = json_decode($json);

        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $lng = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

        update_post_meta( $post->ID, 'lat', $lat, true );
        update_post_meta( $post->ID, 'lng', $lng, true );
    }
}

// Save Featured Image If It's a youtube video
add_action('save_post', 'wds_video_sideload_post_thumb');
function wds_video_sideload_post_thumb() {
    global $post;

    $video_url = get_post_meta( $post->ID, 'video_url', true );
    $thumb_url = get_video_thumbnail($video_url);

    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    set_time_limit(300);

    if ( ! empty($thumb_url) ) {
        // Download file to temp location
        $tmp = download_url( $thumb_url );

        // Set variables for storage
        // fix file filename for query strings
        preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $thumb_url, $matches);
        $file_array['name'] = basename($matches[0]);
        $file_array['tmp_name'] = $tmp;

        // If error storing temporarily, unlink
        if ( is_wp_error( $tmp ) ) {
            @unlink($file_array['tmp_name']);
            $file_array['tmp_name'] = '';
        }

        // do the validation and storage stuff
        $thumbid = media_handle_sideload( $file_array, $post->ID, $desc );
        // If error storing permanently, unlink
        if ( is_wp_error($thumbid) ) {
            @unlink($file_array['tmp_name']);
            return $thumbid;
        }
    }

    set_post_thumbnail( $post, $thumbid );
}


function get_related_parent_content($id) {
    foreach ( get_the_category($id) as $category ) {
        if ( $category->category_parent != 0 ) {
            $cat = $category->category_parent;
            break;
        }
    }
    if ($cat) {
        $args = array('category__in' => array($cat), 'posts_per_page' => 100, 'depth' => 1);
        $posts = get_posts($args);
        return $posts;
    }
}

function get_related_post_content($id) {
    foreach ( get_the_category($id) as $category ) {
        if ( $category->category_parent != 0 ) {
            $cat = $category->term_id;
            break;
        }
    }
    if ($cat) {
        $args = array('category__in' => array($cat), 'posts_per_page' => -1, 'depth' => 1, 'post__not_in' => array($id));
        $posts = get_posts($args);
        return $posts;
    }
}
?>