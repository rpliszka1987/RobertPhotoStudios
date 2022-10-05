<?php
/**
 * Fullscreen Video
 */
$featured_page = blacksilver_get_active_fullscreen_post();
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	$_type         = get_post_type( $featured_page );
	$featured_page = icl_object_id( $featured_page, $_type, true, ICL_LANGUAGE_CODE );
}
$fullscreen_infobox = '';
$custom             = get_post_custom( $featured_page );
if ( isset( $custom['pagemeta_html5_poster'][0] ) ) {
	$html5_poster = $custom['pagemeta_html5_poster'][0];
}
if ( isset( $custom['pagemeta_html5_mp4'][0] ) ) {
	$html5_mp4 = $custom['pagemeta_html5_mp4'][0];
}
if ( isset( $custom['pagemeta_html5_webm'][0] ) ) {
	$html5_webm = $custom['pagemeta_html5_webm'][0];
}
if ( isset( $custom['pagemeta_html5_ogv'][0] ) ) {
	$html5_ogv = $custom['pagemeta_html5_ogv'][0];
}
if ( isset( $custom['pagemeta_fullscreen_infobox'][0] ) ) {
	$fullscreen_infobox = $custom['pagemeta_fullscreen_infobox'][0];
}

$video_control_bar              = blacksilver_get_option_data( 'video_control_bar' );
$fullscreen_menu_toggle         = blacksilver_get_option_data( 'fullscreen_menu_toggle' );
$fullscreen_menu_toggle_nothome = blacksilver_get_option_data( 'fullscreen_menu_toggle_nothome' );
?>
<div id="backgroundvideo" class="html5-background-video">
	<div class="fullscreen-video-audio"><i class="feather-icon-volume"></i></div>
	<div class="fullscreen-video-play"><i class="feather-icon-play"></i></div>
<video autoplay muted loop playsinline id="videocontainer" preload="auto" width="100%" height="100%" style="background-image:url(<?php echo esc_url( $html5_poster ); ?>);" poster="<?php echo esc_url( $html5_poster ); ?>">
	<source src="<?php echo esc_attr( $html5_webm ); ?>" type="video/webm">
	<source src="<?php echo esc_attr( $html5_mp4 ); ?>" type="video/mp4">
	<source src="<?php echo esc_attr( $html5_ogv ); ?>" type="video/ogg">
</video>
</div>
