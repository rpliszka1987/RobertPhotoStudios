<?php
/**
 * Carousel
 */
get_header();
$carousel_text       = '';
$slideshow_titledesc = '';
$featured_page       = blacksilver_get_active_fullscreen_post();
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	$_type         = get_post_type( $featured_page );
	$featured_page = icl_object_id( $featured_page, $_type, true, ICL_LANGUAGE_CODE );
}
$custom = get_post_custom( $featured_page );
if ( isset( $custom['pagemeta_carousel_text'][0] ) ) {
		$carousel_text = $custom['pagemeta_carousel_text'][0];
}
if ( isset( $custom['pagemeta_slideshow_titledesc'][0] ) ) {
	$slideshow_titledesc = $custom['pagemeta_slideshow_titledesc'][0];
}
$count = 0;
if ( post_password_required( $featured_page ) ) {
	get_template_part( 'password', 'box' );
} else {
	if ( '' !== $featured_page ) {
		$filter_image_ids = blacksilver_get_custom_attachments( $featured_page );
		blacksilver_populate_slide_ui_colors( $featured_page );
		if ( $filter_image_ids ) {
			$count    = 0;
			$captions = '';
			$carousel = '';
			?>
			<div class="circular-preloader"></div>
			<div class="fullscreen-horizontal-carousel <?php echo esc_attr( $carousel_text ); ?>">
				<span class="colorswitch prev-hcarousel"></span>
				<span class="colorswitch next-hcarousel"></span>
				<div class="horizontal-carousel-outer">
					<div class="horizontal-carousel-inner">
						<div class="horizontal-carousel-wrap">
							<ul class="horizontal-carousel">
								<?php
								$fullscreen_carousel = blacksilver_generate_fullscreen_carousel( $filter_image_ids, $slideshow_titledesc );
								echo wp_kses( $fullscreen_carousel, blacksilver_get_allowed_tags() );
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
get_footer();
