<?php
/**
 * Swiper Slides
 */
get_header();
$featured_page = blacksilver_get_active_fullscreen_post();
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	$_type         = get_post_type( $featured_page );
	$featured_page = icl_object_id( $featured_page, $_type, true, ICL_LANGUAGE_CODE );
}
$custom                  = get_post_custom( $featured_page );
$carousel_text           = '';
$slideshow_titledesc     = 'enable';
$count                   = 0;
$carousel                = '';
$captions                = '';
$pagemeta_swiper_columns = '';
if ( isset( $custom['pagemeta_carousel_text'][0] ) ) {
	$carousel_text = $custom['pagemeta_carousel_text'][0];
}
if ( isset( $custom['pagemeta_slideshow_titledesc'][0] ) ) {
	$slideshow_titledesc = $custom['pagemeta_slideshow_titledesc'][0];
}
if ( isset( $custom['pagemeta_swiper_columns'][0] ) ) {
	$pagemeta_swiper_columns = $custom['pagemeta_swiper_columns'][0];
}
switch ( $pagemeta_swiper_columns ) {
	case '1':
		$pagemeta_swiper_columns = '1';
		break;
	case '2':
		$pagemeta_swiper_columns = '2';
		break;
	case '3':
		$pagemeta_swiper_columns = '3';
		break;
	case '4':
		$pagemeta_swiper_columns = '4';
		break;
	default:
		$pagemeta_swiper_columns = '4';
		break;
}
if ( post_password_required( $featured_page ) ) {
	get_template_part( 'password', 'box' );
} else {
	if ( '' !== $featured_page ) {
		$filter_image_ids = blacksilver_get_custom_attachments( $featured_page );
		if ( $filter_image_ids ) {
			$unique_slide_id = get_the_id() . '-' . uniqid();
			echo '<div id="' . esc_attr( $unique_slide_id ) . '" class="swiper-container fullscreen-swiper-container" data-autoplay="6000" data-columns="' . esc_attr( $pagemeta_swiper_columns ) . '" data-id="' . esc_attr( $unique_slide_id ) . '">';
			?>
			<div class="swiper-wrapper">
			<!-- Slides -->
			<?php
			// Loop through the images
			foreach ( $filter_image_ids as $attachment_id ) {
				$attachment = get_post( $attachment_id );
				if ( isset( $attachment->ID ) ) {
					$image_uri        = $attachment->guid;
					$thumb_imagearray = wp_get_attachment_image_src( $attachment->ID, 'blacksilver-gridblock-source', false );
					$thumb_image_uri  = $thumb_imagearray[0];
					$the_image_title  = sanitize_text_field( $attachment->post_title );
					$the_image_desc   = sanitize_text_field( $attachment->post_content );
					$link_text        = '';
					$link_url         = '';
					$slideshow_link   = '';
					$slideshow_color  = '';
					$link_text        = get_post_meta( $attachment->ID, 'mtheme_attachment_fullscreen_link', true );
					$link_url         = get_post_meta( $attachment->ID, 'mtheme_attachment_fullscreen_url', true );
					$slide_color      = get_post_meta( $attachment->ID, 'mtheme_attachment_fullscreen_color', true );
					$slide_color      = 'bright';
					$button_target    = '';
					$button_target    = get_post_meta( $attachment->ID, 'mtheme_fullscreen_url_target', true );
					$linktarget       = '';
					if ( 'blank' === $button_target ) {
						$linktarget = 'target="_blank" ';
					}

					if ( '' !== $thumb_image_uri ) {
						$count++;

						echo '<div class="swiper-slide slide-count-' . esc_attr( $count ) . ' slide-color-' . esc_attr( $slide_color ) . '" style="background-image: url(' . esc_url( $thumb_image_uri ) . ');">';
						if ( 'enable' === $slideshow_titledesc ) {
							echo '<div class="swiper-contents">';
							echo '<div class="swiper-title">' . wp_kses( $the_image_title, blacksilver_get_allowed_tags() ) . '</div>';
							echo '<div class="swiper-desc">' . wp_kses( $the_image_desc, blacksilver_get_allowed_tags() ) . '</div>';
							$button_color = 'bright';
							if ( '' !== $link_url && '' !== $link_text ) {
								echo '<div class="button-shortcode ' . esc_attr( $button_color ) . '"><a ' . $linktarget . 'href="' . esc_url( $link_url ) . '"><div class="mtheme-button">' . esc_attr( $link_text ) . '</div></a></div>';
							}
							echo '</div>';
						}
						echo '</div>';
					}
				}
			}
			?>
			</div>
			<?php
			if ( $count > 1 ) {
				?>
				<!-- If we need pagination -->
				<div class="swiper-pagination"></div>
				<?php
			}
			if ( $count > $pagemeta_swiper_columns ) {
				?>
				<!-- If we need navigation buttons -->
				<div class="swiper-button-prev"><i class="ion-ios-arrow-thin-left"></i></div>
				<div class="swiper-button-next"><i class="ion-ios-arrow-thin-right"></i></div>
				<?php
			}
			?>
			</div>
			<?php
			// If Ends here for the Featured Page
		}
	}
}
get_footer();
