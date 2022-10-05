<?php
/**
 * Split Slider
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
		$filter_image_ids = blacksilver_get_custom_attachments( $featured_page );
		blacksilver_populate_slide_ui_colors( $featured_page );
		if ( $filter_image_ids ) {
			?>
			<div class="kenburns-preloader"></div>
			<?php
			$i                  = 0;
			$left_section       = '';
			$right_section      = '';
			$next_section       = '';
			$responsive_element = '';
			// Loop through the images
			foreach ( $filter_image_ids as $attachment_id ) {
				$attachment = get_post( $attachment_id );
				if ( isset( $attachment->guid ) ) {
					$the_image_uri = $attachment->guid;

					if ( ! isset( $first_image ) ) {
						$first_image = $the_image_uri;
					}

					$section_element  = '<div class="ms-section">';
					$section_element .= '<div class="multiscroll-image image-count-' . $i . ' main-image-count-' . $i . '">';
					$section_element .= '</div>';
					$section_element .= '</div>';

					$responsive_element .= '<div class="responsive-section">';
					$responsive_element .= '<div class="scroll-image image-count-' . $i . ' responsive-image-count-' . $i . '">';
					$responsive_element .= '</div>';
					$responsive_element .= '</div>';

					if ( 0 === $i % 2 ) {
						$left_section .= $section_element;
						$next_section  = 'right';
					} else {
						$right_section .= $section_element;
						$next_section   = 'left';
					}
					$i++;
				}
			}

			if ( 0 !== $i % 2 ) {
				$section_element  = '<div class="ms-section">';
				$section_element .= '<div class="multiscroll-image main-image-count-first">';
				$section_element .= '</div>';
				$section_element .= '</div>';

				if ( 'left' === $next_section ) {
					$left_section .= $section_element;
				} else {
					$right_section .= $section_element;
				}
			}
			$split_slider_slideshow = blacksilver_multiscroll_block_build( $left_section, $right_section, $responsive_element );
			echo wp_kses( $split_slider_slideshow, blacksilver_get_allowed_tags() );
			?>
			</div>
			<?php
			//End Password Check
		}
	}
}
get_footer();
