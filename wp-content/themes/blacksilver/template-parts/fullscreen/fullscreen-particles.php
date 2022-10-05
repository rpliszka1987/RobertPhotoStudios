<?php
/**
 * Cover Photo
 */
get_header();
$featured_page = blacksilver_get_active_fullscreen_post();
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	$_type         = get_post_type( $featured_page );
	$featured_page = icl_object_id( $featured_page, $_type, true, ICL_LANGUAGE_CODE );
}
$filter_image_ids = blacksilver_get_custom_attachments( $featured_page );
$count            = 0;

if ( post_password_required( $featured_page ) ) {
	get_template_part( 'password', 'box' );
} else {
	if ( '' !== $featured_page ) {
		if ( ! $filter_image_ids ) {
			echo esc_html__( 'No images present to display slideshow.', 'blacksilver' );
		} else {
			blacksilver_maybe_display_slideshow_static_titles( $featured_page, 'cover' );

			blacksilver_populate_slide_ui_colors( $featured_page );
			$count = blacksilver_get_slideshow_count( $featured_page );
			?>
			<div id="particles-js"></div>
			<?php
			if ( $count > 1 ) {
				get_template_part( '/template-parts/fullscreen/supersized', 'nav' );
			}
			?>
			<div id="slidecaption"></div>
			<?php
		}
	}
	get_template_part( '/template-parts/fullscreen/audio', 'player' );
}
get_footer();
