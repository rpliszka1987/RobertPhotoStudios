<?php
/**
 * Revolution Slider
 */
get_header();
$featured_page = blacksilver_get_active_fullscreen_post();
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	$_type         = get_post_type( $featured_page );
	$featured_page = icl_object_id( $featured_page, $_type, true, ICL_LANGUAGE_CODE );
}
$custom = get_post_custom( $featured_page );
if ( isset( $custom['pagemeta_revslider'][0] ) ) {
	$revslider = $custom['pagemeta_revslider'][0];
}
if ( post_password_required( $featured_page ) ) {
	get_template_part( 'password', 'box' );
} else {
	echo do_shortcode( '[rev_slider ' . $revslider . ']' );
}
get_footer();
