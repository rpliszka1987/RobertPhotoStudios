<?php
/**
 * Fotorama
 */
get_header();
$featured_page = blacksilver_get_active_fullscreen_post();
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	$_type         = get_post_type( $featured_page );
	$featured_page = icl_object_id( $featured_page, $_type, true, ICL_LANGUAGE_CODE );
}
$count                   = 0;
$autoplay                = blacksilver_get_option_data( 'fotorama_autoplay' );
$fotorama_autoplay_speed = blacksilver_get_option_data( 'fotorama_autoplay_speed' );
$fotorama_autoplay       = false;

if ( $autoplay ) {
	$fotorama_autoplay = 'true';
}

if ( post_password_required( $featured_page ) ) {
	get_template_part( 'password', 'box' );
} else {
	$custom              = get_post_custom( $featured_page );
	$slideshow_titledesc = '';
	if ( isset( $custom['pagemeta_fotorama_fill'][0] ) ) {
		$fotorama_fill = $custom['pagemeta_fotorama_fill'][0];
	}
	if ( isset( $custom['pagemeta_slideshow_titledesc'][0] ) ) {
		$slideshow_titledesc = $custom['pagemeta_slideshow_titledesc'][0];
	}
	if ( 'enable' !== $slideshow_titledesc ) {
		$slideshow_titledesc = 'disabled';
	}
	if ( '' !== $featured_page ) {
		$filter_image_ids = blacksilver_get_custom_attachments( $featured_page );
		blacksilver_populate_slide_ui_colors( $featured_page );
		if ( $filter_image_ids ) {
			?>
			<div id="fotorama-container-wrap">
			<?php
			echo do_shortcode( '[fotorama autoplayspeed="'.$fotorama_autoplay_speed.'" autoplay="' . $fotorama_autoplay . '" titledesc="' . $slideshow_titledesc . '" filltype="' . $fotorama_fill . '" pageid=' . $featured_page . ']' );
			?>
			</div>
			<?php
		}
	}
}
get_footer();
