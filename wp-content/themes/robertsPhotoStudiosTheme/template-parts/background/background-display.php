<?php
if ( ! blacksilver_is_fullscreen_home() && ! blacksilver_is_fullscreen_post() && is_singular() && ! post_password_required() ) {
	$bg_choice = get_post_meta( get_the_id(), 'pagemeta_meta_background_choice', true );
	blacksilver_featured_image_link( get_the_id() );

	if ( 'image_attachments' === $bg_choice ) {
		$bgchoice_page_id = get_the_id();
	}
	if ( 'options_slideshow' === $bg_choice ) {
		$bgchoice_page_id = blacksilver_get_option_data( 'general_bgslideshow' );
	}
	if ( isset( $bgchoice_page_id ) ) {
		blacksilver_populate_slide_ui_colors( $bgchoice_page_id );
	}
}
