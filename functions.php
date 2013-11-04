<?php 

//Adicionando MenU Header
register_nav_menu( 'header', 'Header Menu' );


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

function render_video_vimeo( $id ) {
    $w = '320';
    $h = '240';
    $html = '<iframe src="//player.vimeo.com/video/'.$id.'" width="'.$w.'" height="'.$h.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    printf($html);
}

function render_video_youtube( $id ) {
    $w = '320';
    $h = '240';
    $html = '<iframe width="'.$w.'" height="'.$h.'" src="//www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
    printf($html);
}
?>