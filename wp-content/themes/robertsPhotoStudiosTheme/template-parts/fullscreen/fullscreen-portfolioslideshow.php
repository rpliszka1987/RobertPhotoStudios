<?php
/**
 * Portfolio Slideshow
 */
get_header();
$featured_page = blacksilver_get_active_fullscreen_post();
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	$_type         = get_post_type( $featured_page );
	$featured_page = icl_object_id( $featured_page, $_type, true, ICL_LANGUAGE_CODE );
}
$count = 0;
if ( post_password_required( $featured_page ) ) {
	get_template_part( 'password', 'box' );
} else {
	if ( '' !== $featured_page ) {
		blacksilver_maybe_display_slideshow_static_titles( $featured_page, 'cover' );
		blacksilver_populate_portfolio_ui_colors( $featured_page );
		get_template_part( '/template-parts/fullscreen/supersized', 'nav' );
		?>
		<div id="slidecaption"></div>
		<?php
		get_template_part( '/template-parts/fullscreen/audio', 'player' );
	}
}
get_footer();
