<?php
$mobile_menu_active   = false;
$fallback_menu_active = false;
$mobile_menu_location = 'mobile_menu';
$search_mobileform    = blacksilver_get_option_data( 'search_mobileform' );
if ( has_nav_menu( 'mobile_menu' ) ) {
	$mobile_menu_active = true;
} else {
	if ( has_nav_menu( 'main_menu' ) ) {
		$mobile_menu_active   = true;
		$fallback_menu_active = true;
		$mobile_menu_location = 'main_menu';
	}
}
$open_status_class = '';
if ( blacksilver_get_option_data( 'responsive_menu_keep_open' ) ) {
	$open_status_class = ' show-current-menu-open';
}
?>
<?php
if ( $mobile_menu_active ) {
	?>
	<nav id="mobile-toggle-menu" class="mobile-toggle-menu mobile-toggle-menu-close">
		<span class="mobile-toggle-menu-trigger"><span>Menu</span></span>
	</nav>
	<?php
}
?>
<div class="responsive-menu-wrap<?php echo esc_attr( $open_status_class ); ?>">
	<div class="mobile-alt-toggle">
		<?php
		do_action( 'blacksilver_add_mobile_menu_cart' );
		do_action( 'blacksilver_add_mobile_menu_wpml' );
		?>
	</div>
	<div class="mobile-menu-toggle">
		<div class="logo-mobile">
			<?php
			$responsive_logo = blacksilver_get_option_data( 'responsive_logo' );
			$theme_style     = 'light';
			$home_url_path   = home_url( '/' );

			if ( '' !== $responsive_logo ) {
				$mobile_logo     = '<img class="custom-responsive-logo logoimage" src="' . esc_url( $responsive_logo ) . '" alt="' . esc_attr__( 'logo', 'blacksilver' ) . '" />';
				$mobile_logo_tag = '<a href="' . esc_url( $home_url_path ) . '">' . $mobile_logo . '</a>';
				echo wp_kses( $mobile_logo_tag, blacksilver_get_allowed_tags() );
			} else {
				echo '<div class="mobile-site-title-section">';
				echo '<h1 class="site-title"><a href="' . esc_url( $home_url_path ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></h1>';
				echo '</div>';
			}
			?>
		</div>
		<div class="responsive-menu-overlay"></div>
	</div>
</div>
<?php
$header_menu_type = blacksilver_get_option_data( 'menu_type' );
if ( function_exists( 'theme_demo_feature_mode' ) ) {
	$header_menu_type = apply_filters( 'header_style', $header_menu_type );
}
$minimal_menu_active = false;
if ( blacksilver_header_is_toggle_main_menu() ) {
	$minimal_menu_active = true;
}
if ( $mobile_menu_active ) {
	if ( $minimal_menu_active ) {
		?>
	<div class="responsive-mobile-menu-outer">
		<div class="minimal-logo-overlay"></div>
		<?php
	}
	?>
		<div class="responsive-mobile-menu">
			<div class="dashboard-columns">
				<div class="mobile-menu-social">
					<div class="mobile-socials-wrap clearfix">
					<?php
					dynamic_sidebar( 'mobile_social_header' );
					?>
					</div>
				</div>
			<?php
			if ( $search_mobileform ) {
				get_template_part( 'mobile', 'searchform' );
			}
			?>
				<nav>
				<?php
				$custom_menu_call    = '';
				$user_choice_of_menu = get_post_meta( get_the_id(), 'pagemeta_menu_choice', true );
				if ( blacksilver_page_is_woo_shop() ) {
					$woo_shop_post_id    = get_option( 'woocommerce_shop_page_id' );
					$user_choice_of_menu = get_post_meta( $woo_shop_post_id, 'pagemeta_menu_choice', true );
				}
				if ( isset( $user_choice_of_menu ) && 'default' !== $user_choice_of_menu ) {
					$custom_menu_call = $user_choice_of_menu;
				}
				if ( blacksilver_is_fullscreen_home() ) {
					$featured_page       = blacksilver_get_active_fullscreen_post();
					$user_choice_of_menu = get_post_meta( $featured_page, 'pagemeta_menu_choice', true );
					if ( isset( $user_choice_of_menu ) && 'default' !== $user_choice_of_menu ) {
						$custom_menu_call = $user_choice_of_menu;
					}
				}
				// Responsive menu conversion to drop down list
				echo wp_nav_menu(
					array(
						'container'      => false,
						'theme_location' => $mobile_menu_location,
						'menu'           => $custom_menu_call,
						'menu_class'     => 'mtree',
						'echo'           => true,
						'before'         => '',
						'after'          => '',
						'link_before'    => '',
						'link_after'     => '',
						'depth'          => 0,
						'fallback_cb'    => 'mtheme_nav_fallback',
					)
				);
				?>
				</nav>
				<div class="clearfix"></div>
			</div>
		</div>
	<?php
	if ( $minimal_menu_active ) {
		?>
		</div>
		<?php
	}
	?>
	<?php
}
