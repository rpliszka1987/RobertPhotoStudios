<?php
/**
 * Kenburns
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
		blacksilver_populate_slide_ui_colors( $featured_page );
		if ( ! $filter_image_ids ) {
			echo esc_html__( 'No images present to display slideshow.', 'blacksilver' );
		} else {
			?>
			<div class="kenburns-preloader"></div>
			<div id="kenburns-container">
			<?php
			foreach ( $filter_image_ids as $attachment_id ) {
				$attachment = get_post( $attachment_id );
				if ( isset( $attachment->guid ) ) {
					blacksilver_display_post_image( $post->ID, $attachment->guid, $image_link = false, $kenburns_imagetype = 'full', $post->post_title, $class = 'kenburns-images' );
				}
			}
			?>
			</div>
			<?php
			blacksilver_maybe_display_slideshow_static_titles( $featured_page, 'default' );
			get_template_part( '/template-parts/fullscreen/audio', 'player' );
		}
	}
}
get_footer();
