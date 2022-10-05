<?php
/**
 * Fullscreen Video
 */
get_header();
$featured_page = blacksilver_get_active_fullscreen_post();
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	$_type         = get_post_type( $featured_page );
	$featured_page = icl_object_id( $featured_page, $_type, true, ICL_LANGUAGE_CODE );
}
$custom = get_post_custom( $featured_page );
if ( isset( $custom['pagemeta_youtubevideo'][0] ) ) {
	$youtube = $custom['pagemeta_youtubevideo'][0];
}
if ( isset( $custom['pagemeta_vimeovideo'][0] ) ) {
	$vimeo_id = $custom['pagemeta_vimeovideo'][0];
}
if ( isset( $custom['pagemeta_html5_mp4'][0] ) ) {
	$html5_mp4 = $custom['pagemeta_html5_mp4'][0];
}
if ( isset( $custom['pagemeta_html5_wemb'][0] ) ) {
	$html5_wemb = $custom['pagemeta_html5_wemb'][0];
}

$video_control_bar              = blacksilver_get_option_data( 'video_control_bar' );
$fullscreen_menu_toggle         = blacksilver_get_option_data( 'fullscreen_menu_toggle' );
$fullscreen_menu_toggle_nothome = blacksilver_get_option_data( 'fullscreen_menu_toggle_nothome' );

if ( post_password_required( $featured_page ) ) {
	get_template_part( 'password', 'box' );
} else {
	$vimeo_active   = false;
	$youtube_active = false;
	$html5_active   = false;
	if ( isset( $youtube ) && ! empty( $youtube ) && ! $vimeo_active ) {
		$youtube_active = true;
		get_template_part( '/template-parts/fullscreen/fullscreenvideo', 'youtube' );
	}
	if ( isset( $html5_mp4 ) || isset( $html5_mp4 ) ) {
		if ( ! $vimeo_active && ! $youtube_active ) {
			$html5_active = true;
			get_template_part( '/template-parts/fullscreen/fullscreenvideo', 'html5' );
		}
	}
}
get_footer();
