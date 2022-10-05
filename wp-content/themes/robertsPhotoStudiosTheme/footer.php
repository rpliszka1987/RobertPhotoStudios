<?php
/*
* Footer
*/
?>
<?php
$display_footer            = true;
$display_instagram         = true;
$pagemeta_instagram_footer = get_post_meta( get_the_id(), 'pagemeta_instagram_footer', true );
$insta_widget_location     = blacksilver_get_option_data( 'instagram_widget_location' );
$pagemeta_general_footer   = get_post_meta( get_the_id(), 'pagemeta_general_footer', true );
$theme_general_footer      = blacksilver_get_option_data( 'theme_footer' );
if ( false === $theme_general_footer ) {
	$display_footer = false;
}
if ( is_archive() ) {
	$display_instagram = true;
}
if ( is_singular( 'portfolio' ) ) {
	$display_instagram = false;
	if ( 'enable' === $pagemeta_instagram_footer ) {
		$display_instagram = true;
	}
}
if ( true === get_theme_mod( 'instagram_footer', true ) ) {
	$display_instagram = true;
} else {
	$display_instagram = false;
}
if ( is_page_template( 'template-blank.php' ) ) {
	$display_instagram = false;
}
if ( post_password_required() ) {
	$display_footer    = false;
	$display_instagram = false;
}
if ( blacksilver_is_fullscreen_post() ) {
	$display_footer    = false;
	$display_instagram = false;
}
if ( is_singular( 'proofing' ) ) {
	$client_id       = get_post_meta( get_the_id(), 'pagemeta_client_names', true );
	$proofing_status = get_post_meta( get_the_id(), 'pagemeta_proofing_status', true );
	if ( isset( $client_id ) ) {
		if ( post_password_required( $client_id ) ) {
			$display_footer = false;
		}
	}
	if ( isset( $proofing_status ) ) {
		if ( 'inactive' === $proofing_status ) {
			$display_footer = false;
		}
	}
	if ( blacksilver_is_proofing_client_protected() ) {
		$display_instagram = false;
	}
}
if ( is_404() ) {
	$display_footer    = false;
	$display_instagram = false;
}
if ( is_search() ) {
	$display_instagram = false;
}
if ( is_singular() ) {
	if ( 'disable' === $pagemeta_instagram_footer ) {
		$display_instagram = false;
	}
}
if ( 'instagram-verticalmenu' === blacksilver_get_option_data( 'instagram_location' ) && 'vertical-menu' === blacksilver_get_option_data( 'menu_type' ) ) {
	// Disable instgram on footer and will be displayed for Vertical menu
	$display_instagram = false;
}
?>
</div>
<?php
if ( is_singular( 'portfolio' ) ) {
	$portfolio_archive_nav = blacksilver_get_option_data( 'portfolio_archive_nav' );
	if ( false !== $portfolio_archive_nav ) {
		do_action( 'blacksilver_display_portfolio_single_navigation' );
	}
}
if ( is_singular( 'events' ) ) {
	$event_archive_nav = blacksilver_get_option_data( 'event_archive_nav' );
	if ( false !== $event_archive_nav ) {
		do_action( 'blacksilver_display_portfolio_single_navigation' );
	}
}
$portfolio_itemcarousel = 'enable';
if ( isset( $custom['pagemeta_portfolio_itemcarousel'][0] ) ) {
	$portfolio_itemcarousel = $custom['pagemeta_portfolio_itemcarousel'][0];
	if ( 'default' === $portfolio_itemcarousel ) {
		$portfolio_itemcarousel = 'enable';
	}
}
if ( is_singular( 'portfolio' ) ) {
	if ( ! post_password_required() ) {
		if ( blacksilver_get_option_data( 'portfolio_recently' ) && 'enable' === $portfolio_itemcarousel ) {
			?>
			<div class="portfolio-end-block clearfix">
				<div class="portfolio-section-heading mcolumn-align-center">
					<h2 class="portfolio-footer-title"><?php echo esc_html( blacksilver_get_option_data( 'portfolio_carousel_heading' ) ); ?></h2>
				</div>
				<?php
				$orientation          = blacksilver_get_option_data( 'portfolio_related_format' );
				$portfolio_recentlink = blacksilver_get_option_data( 'portfolio_recentlink' );
				$works_recentlink     = 'false';
				if ( $portfolio_recentlink ) {
					$works_recentlink = 'true';
				}
				if ( 'portrait' === $orientation ) {
					$column_slots = 4;
				} else {
					$column_slots = 4;
				}
				if ( shortcode_exists( 'workscarousel' ) ) {
					echo do_shortcode( '[workscarousel classprefix="recently-" lazyload="true" directlink="' . esc_attr( $works_recentlink ) . '" pagination="false" format="' . esc_attr( $orientation ) . '" worktype_slug="" boxtitle="true" category_display="false" columns="' . esc_attr( $column_slots ) . '"]' );
				}
				?>
			</div>
				<?php
		}
	}
}
if ( ! blacksilver_is_fullscreen_post() ) {
	// Closing container-outer
	echo '</div>';
}
if ( 'disable' === $pagemeta_general_footer ) {
	$display_footer = false;
}
// Elementor `footer` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	// Elementor not overiding
	$elementor_overriding = false;
} else {
	$elementor_overriding                  = true;
	$display_footer                        = false;
	$elementor_themebuilder_footer_overide = blacksilver_get_option_data( 'elementor_themebuilder_footer_overide' );
	if ( 'withthemefooter' === $elementor_themebuilder_footer_overide ) {
		$display_footer = true;
	}
}
if ( $display_footer ) {
	echo '<div class="footer-outer-wrap">';
	if ( $display_instagram ) {
		if ( 'below' !== $insta_widget_location ) {
			get_template_part( 'template-parts/grid', 'instagram' );
		}
	}
}
if ( $display_footer ) {
	$footer_class = 'footer-logo-absent';
	$footer_logo  = blacksilver_get_option_data( 'footer_logo' );
	if ( '' !== $footer_logo ) {
		$footer_class = 'footer-logo-present';
	}
	if ( is_active_sidebar( 'site_footer' ) ) {
		?>
		<div class="footer-container-column">
			<?php
			echo '<div class="footer-container-column-inner sidebar-widget">';
			dynamic_sidebar( 'site_footer' );
			echo '</div>';
			?>
		</div>
		<?php
	}
	echo '<div class="footer-multi-column-wrap">';
	if ( is_active_sidebar( 'footer_column_one' ) ) {
		?>
		<div class="footer-container-column footer-multi-column">
			<?php
			echo '<div class="footer-container-column-inner sidebar-widget">';
			dynamic_sidebar( 'footer_column_one' );
			echo '</div>';
			?>
		</div>
		<?php
	}
	if ( is_active_sidebar( 'footer_column_two' ) ) {
		?>
		<div class="footer-container-column footer-multi-column">
			<?php
			echo '<div class="footer-container-column-inner sidebar-widget">';
			dynamic_sidebar( 'footer_column_two' );
			echo '</div>';
			?>
		</div>
		<?php
	}
	if ( is_active_sidebar( 'footer_column_three' ) ) {
		?>
		<div class="footer-container-column footer-multi-column">
			<?php
			echo '<div class="footer-container-column-inner sidebar-widget">';
			dynamic_sidebar( 'footer_column_three' );
			echo '</div>';
			?>
		</div>
		<?php
	}
	if ( $display_instagram ) {
		if ( 'below' === $insta_widget_location ) {
			get_template_part( 'template-parts/grid', 'instagram' );
		}
	}
	echo '</div>';
	?>
	<div id="copyright" class="footer-container <?php echo esc_attr( $footer_class ); ?>">
		<div class="footer-logo">
				<?php
				if ( '' !== $footer_logo ) {
					echo '<img class="custom-footer-logo footer-logo-image" src="' . esc_url( $footer_logo ) . '" alt="' . esc_attr__( 'logo', 'blacksilver' ) . '" />';
				}
				?>
		</div>
		<?php
		$footer_text = do_shortcode( blacksilver_get_option_data( 'footer_copyright' ) );
		if ( '' === $footer_text ) {
			$footer_text = esc_html__( 'Copyright 2020', 'blacksilver' );
		}
		$copyright_allowedtags = array(
			'a'      => array(
				'href'  => true,
				'title' => true,
			),
			'br'     => array(),
			'b'      => array(),
			'strong' => array(),
		);
		?>
			<div class="horizontal-footer-copyright"><?php echo wp_kses( $footer_text, blacksilver_get_allowed_tags() ); ?></div>
		</div>
	</div>
	<?php
}
if ( ! blacksilver_is_fullscreen_post() ) {
		// Closing horizontal/vertical-menu-body-container
		echo '</div>';
	// Closing container-wrapper
	echo '</div>';

	if ( ! wp_is_mobile() ) {
		if ( blacksilver_get_option_data( 'enable_goto_top' ) ) {
			$goto_top_location = ' location-right';
			if ( 'left' === blacksilver_get_option_data( 'goto_top_location' ) ) {
				$goto_top_location = ' location-left';
			}
			?>
		<div class="progress-wrap<?php echo esc_attr( $goto_top_location ); ?>">
			<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
			</svg>
		</div>
			<?php
		}
	}
}
do_action( 'blacksilver_contextmenu_msg' );
if ( blacksilver_get_option_data( 'enable_animated_cursor' ) ) {
	?>
	<div class="cursor">
			<div class="cursor__inner cursor__inner--circle"></div>
			<div class="cursor__inner cursor__inner--dot"></div>
	</div>
	<?php
}
?>
<div class="site-back-cover"></div>
<?php
do_action( 'blacksilver_starting_footer' );
wp_footer();
?>
</body>
</html>
