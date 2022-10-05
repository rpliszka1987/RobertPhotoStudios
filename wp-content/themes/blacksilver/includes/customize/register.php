<?php
if ( class_exists( 'Kirki' ) ) {
	$fullscreenposts = Kirki_Helper::get_posts(
		array(
			'post_type'      => 'fullscreen',
			'posts_per_page' => -1,
		)
	);

	$default_fullscreen = false;

	if ( ! empty( $fullscreenposts ) ) {
		foreach ( $fullscreenposts as $key => $value ) {
			// Get first ID as default
			$default_fullscreen = $key;
			break;
		}
	}

	function blacksilver_kirki_add_field( $args ) {
		Kirki::add_field( 'blacksilver', $args );
	}
	// Add our config to differentiate from other themes/plugins
	// that may use Kirki at the same time.
	Kirki::add_config(
		'blacksilver',
		array(
			'capability'     => 'edit_theme_options',
			'option_type'    => 'theme_mod',
			'disable_loader' => true,
		)
	);

	function blacksilver_goto_top_status( $control ) {
		if ( true === $control->manager->get_setting( 'enable_goto_top' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

	// Condition Based Start
	function blacksilver_choice_menu_is_vertical_callback( $control ) {
		if ( 'vertical-menu' === $control->manager->get_setting( 'menu_type' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

	function blacksilver_choice_instagram_not_in_verticalmenu_callback( $control ) {
		if ( 'instagram-verticalmenu' === $control->manager->get_setting( 'instagram_location' )->value() ) {
			return false;
		} else {
			return true;
		}
	}

	function blacksilver_choice_menu_is_not_vertical_callback( $control ) {
		if ( 'vertical-menu' !== $control->manager->get_setting( 'menu_type' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

	function blacksilver_choice_menu_split_callback( $control ) {
		if ( 'split-menu' === $control->manager->get_setting( 'menu_type' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

	function blacksilver_choice_menu_is_not_centered_callback( $control ) {
		if ( 'split-menu' !== $control->manager->get_setting( 'menu_type' )->value() && 'vertical-menu' !== $control->manager->get_setting( 'menu_type' )->value() && 'centered-logo' !== $control->manager->get_setting( 'menu_type' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	function blacksilver_choice_menu_default_left_callback( $control ) {
		if ( 'split-menu' !== $control->manager->get_setting( 'menu_type' )->value() && 'vertical-menu' !== $control->manager->get_setting( 'menu_type' )->value() && 'centered-logo' !== $control->manager->get_setting( 'menu_type' )->value() && 'compact-minimal-top' !== $control->manager->get_setting( 'menu_type' )->value() && 'compact-minimal-left' !== $control->manager->get_setting( 'menu_type' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	function blacksilver_choice_menu_centered_callback( $control ) {
		if ( 'centered-logo' === $control->manager->get_setting( 'menu_type' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	function blacksilver_choice_menu_compact_top_callback( $control ) {
		if ( 'compact-minimal-top' === $control->manager->get_setting( 'menu_type' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	function blacksilver_choice_menu_compact_left_callback( $control ) {
		if ( 'compact-minimal-left' === $control->manager->get_setting( 'menu_type' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
	function blacksilver_choice_themestyle_not_display_callback( $control ) {
		if ( 'display' === $control->manager->get_setting( 'general_theme_style' )->value() ) {
			return false;
		} else {
			return true;
		}
	}


	/**
	 * Add Sections.
	 *
	 * We'll be doing things a bit differently here, just to demonstrate an example.
	 * We're going to define 1 section per control-type just to keep things clean and separate.
	 *
	 */
	$panels   = array(
		'blacksilver_logo_panel'           => array( esc_attr__( 'Logos', 'blacksilver' ) ),
		'blacksilver_general_panel'        => array( esc_attr__( 'General', 'blacksilver' ) ),
		'blacksilver_mainmenu_panel'       => array( esc_attr__( 'Main Menu', 'blacksilver' ) ),
		'blacksilver_responsivemenu_panel' => array( esc_attr__( 'Responsive Menu', 'blacksilver' ) ),
		'blacksilver_sidebar_panel'        => array( esc_attr__( 'Sidebar', 'blacksilver' ) ),
		'blacksilver_shop_panel'           => array( esc_attr__( 'Shop', 'blacksilver' ) ),
	);
	$sections = array(
		'blacksilver_menutype_section'             => array( esc_attr__( 'Header Type', 'blacksilver' ), '', 'blacksilver_logo_panel' ),
		'blacksilver_logo_section'                 => array( esc_attr__( 'Main Logo', 'blacksilver' ), '', 'blacksilver_logo_panel' ),
		'blacksilver_responsivelogo_section'       => array( esc_attr__( 'Responsive Logo', 'blacksilver' ), '', 'blacksilver_logo_panel' ),
		'blacksilver_footerlogo_section'           => array( esc_attr__( 'Footer Logo', 'blacksilver' ), '', 'blacksilver_logo_panel' ),
		'blacksilver_themestyle_section'           => array( esc_attr__( 'Theme Style', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_map_api_section'              => array( esc_attr__( 'GoogleMap API', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_api_section'                  => array( esc_attr__( 'Instagram API', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_pagegeneral_section'          => array( esc_attr__( 'Page General', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_pagecolors_section'           => array( esc_attr__( 'Page Colors', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_pagefont_section'             => array( esc_attr__( 'Page Fonts', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_pagetitle_section'            => array( esc_attr__( 'Page Title', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_footerfont_section'           => array( esc_attr__( 'Footer Font', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_content_section'              => array( esc_attr__( 'Content Headings', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_search_section'               => array( esc_attr__( 'Search', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_archivetitles_section'        => array( esc_attr__( 'Archive Titles', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_commentlabels_section'        => array( esc_attr__( 'Comment Labels', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_menutext_section'             => array( esc_attr__( 'Menu Typography', 'blacksilver' ), '', 'blacksilver_mainmenu_panel' ),
		'blacksilver_menucolors_section'           => array( esc_attr__( 'Menu Colors', 'blacksilver' ), '', 'blacksilver_mainmenu_panel' ),
		'blacksilver_responsivemenutext_section'   => array( esc_attr__( 'Responsive Menu Typography', 'blacksilver' ), '', 'blacksilver_responsivemenu_panel' ),
		'blacksilver_responsivemenucolors_section' => array( esc_attr__( 'Responsive Menu Colors', 'blacksilver' ), '', 'blacksilver_responsivemenu_panel' ),
		'blacksilver_preloader_section'            => array( esc_attr__( 'Preloader', 'blacksilver' ), '', 'blacksilver_logo_panel' ),
		'blacksilver_home_section'                 => array( esc_attr__( 'Fullscreen Home', 'blacksilver' ), '', '' ),
		'blacksilver_rightclickblock_section'      => array( esc_attr__( 'Right Click Block', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_elementor_section'            => array( esc_attr__( 'Elementor', 'blacksilver' ), '', 'blacksilver_general_panel' ),
		'blacksilver_fullscreenmedia_section'      => array( esc_attr__( 'Fullscreen Media', 'blacksilver' ), '', '' ),
		'blacksilver_fotoramaslides_section'       => array( esc_attr__( 'Fotorama Slides', 'blacksilver' ), '', '' ),
		'blacksilver_404_section'                  => array( esc_attr__( '404', 'blacksilver' ), '', '' ),
		'blacksilver_events_section'               => array( esc_attr__( 'Events', 'blacksilver' ), '', '' ),
		'blacksilver_portfolio_section'            => array( esc_attr__( 'Portfolio', 'blacksilver' ), '', '' ),
		'blacksilver_blog_section'                 => array( esc_attr__( 'Blog', 'blacksilver' ), '', '' ),
		'blacksilver_proofing_section'             => array( esc_attr__( 'Proofing', 'blacksilver' ), '', '' ),
		'blacksilver_shop_options_section'         => array( esc_attr__( 'Shop Options', 'blacksilver' ), '', 'blacksilver_shop_panel' ),
		'blacksilver_cart_dashbar_section'         => array( esc_attr__( 'Dash Cart Colors', 'blacksilver' ), '', 'blacksilver_shop_panel' ),
		'blacksilver_toggle_cart_section'          => array( esc_attr__( 'Toggle Cart', 'blacksilver' ), '', 'blacksilver_shop_panel' ),
		'blacksilver_lightbox_section'             => array( esc_attr__( 'Lightbox', 'blacksilver' ), '', '' ),
		'blacksilver_addsidebar_section'           => array( esc_attr__( 'Add a Sidebar', 'blacksilver' ), '', 'blacksilver_sidebar_panel' ),
		'blacksilver_sidebarcolors_section'        => array( esc_attr__( 'Sidebar Colors', 'blacksilver' ), '', 'blacksilver_sidebar_panel' ),
		'blacksilver_footer_section'               => array( esc_attr__( 'Footer', 'blacksilver' ), '', '' ),
	);

	foreach ( $panels as $panel_id => $panel ) {
		$panel_args = array(
			'title'    => $panel[0],
			'priority' => 30,
		);
		Kirki::add_panel( $panel_id, $panel_args );
	}
	foreach ( $sections as $section_id => $section ) {
		$section_args = array(
			'title'    => $section[0],
			'panel'    => $section[2],
			'priority' => 30,
		);
		Kirki::add_section( $section_id, $section_args );
	}

	blacksilver_kirki_add_field(
		array(
			'type'            => 'image',
			'settings'        => 'verticalmenu_logo',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_attr__( 'Vertical Menu Logo', 'blacksilver' ),
			'description'     => esc_attr__( 'Vertical Menu Logo', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	// Logo Height
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'settings'        => 'vertical_logo_height',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Logo Width', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '203',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.menu-is-vertical .vertical-logo-wrap img',
					'property' => 'width',
					'units'    => 'px',
				),
			),
		)
	);

	// Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'settings'        => 'vertical_logo_topspace',
			'label'           => esc_html__( 'Vertical Logo Top Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '90',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.menu-is-vertical .vertical-logo-wrap',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
		)
	);

	// Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'settings'        => 'vertical_logo_bottomspace',
			'label'           => esc_html__( 'Vertical Logo Bottom Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '50',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.menu-is-vertical .vertical-logo-wrap',
					'property' => 'padding-bottom',
					'units'    => 'px',
				),
			),
		)
	);

	// Logo Left Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'settings'        => 'vertical_logo_leftspace',
			'label'           => esc_html__( 'Vertical Logo Left Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '36',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.menu-is-vertical .vertical-logo-wrap',
					'property' => 'padding-left',
					'units'    => 'px',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'toggle',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'settings'        => 'vertical_menu_keep_open',
			'label'           => esc_html__( 'Show page with current menu open', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => false,
			'priority'        => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'image',
			'settings'        => 'main_logo',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_attr__( 'Primary Logo ( Dark )', 'blacksilver' ),
			'description'     => esc_attr__( 'Primary Logo', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'image',
			'settings'        => 'secondary_logo',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_attr__( 'Secondary Logo ( Bright )', 'blacksilver' ),
			'description'     => esc_attr__( 'Secondary Logo', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'image',
			'settings'    => 'responsive_logo',
			'label'       => esc_attr__( 'Responsive Logo', 'blacksilver' ),
			'description' => esc_attr__( 'Responsive Logo', 'blacksilver' ),
			'section'     => 'blacksilver_responsivelogo_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'image',
			'settings'    => 'footer_logo',
			'label'       => esc_attr__( 'Footer Logo', 'blacksilver' ),
			'description' => esc_attr__( 'Footer Logo', 'blacksilver' ),
			'section'     => 'blacksilver_footerlogo_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	// Page title
	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'hide_pagetitle',
			'label'    => esc_html__( 'Remove Page title', 'blacksilver' ),
			'section'  => 'blacksilver_pagetitle_section',
			'default'  => false,
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'pagetitle_font',
			'label'    => esc_html__( 'Page Title Font', 'blacksilver' ),
			'section'  => 'blacksilver_pagetitle_section',
			'default'  => 'sans-serif',
			'priority' => 10,
			'choices'  => Kirki_Fonts::get_font_choices(),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'pagtitle_size',
			'label'       => esc_attr__( 'Page Title Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_pagetitle_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'pagtitle_letterspacing',
			'label'       => esc_attr__( 'Page Title Letterpacing', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'     => 'blacksilver_pagetitle_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'pagtitle_weight',
			'label'       => esc_attr__( 'Page Title Weight', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'     => 'blacksilver_pagetitle_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'pagtitle_color',
			'label'     => esc_html__( 'Page Title Color', 'blacksilver' ),
			'section'   => 'blacksilver_pagetitle_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.title-container-outer-wrap .entry-title',
					'property' => 'color',
				),
			),
		)
	);
	// Footer Font
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'footertext_font',
			'label'    => esc_html__( 'Footer Font', 'blacksilver' ),
			'section'  => 'blacksilver_footerfont_section',
			'default'  => 'sans-serif',
			'priority' => 10,
			'choices'  => Kirki_Fonts::get_font_choices(),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'footertext_size',
			'label'       => esc_attr__( 'Footer Text Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_footerfont_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'footertext_letterspacing',
			'label'       => esc_attr__( 'Footer Text Letterpacing', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'     => 'blacksilver_footerfont_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'footertext_weight',
			'label'       => esc_attr__( 'Footer Text Weight', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'     => 'blacksilver_footerfont_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	// Page Comments
	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'disable_pagecomments',
			'label'    => esc_html__( 'Disable page comments', 'blacksilver' ),
			'section'  => 'blacksilver_pagegeneral_section',
			'default'  => false,
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_one_size',
			'label'       => esc_attr__( 'Content H1 Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_one_letterspacing',
			'label'       => esc_attr__( 'Content H1 Letterpacing', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'heading_one_weight',
			'label'       => esc_attr__( 'Content H1 Weight', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_two_size',
			'label'       => esc_attr__( 'Content H2 Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_two_letterspacing',
			'label'       => esc_attr__( 'Content H2 Letterpacing', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'heading_two_weight',
			'label'       => esc_attr__( 'Content H2 Weight', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_three_size',
			'label'       => esc_attr__( 'Content H3 Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_three_letterspacing',
			'label'       => esc_attr__( 'Content H3 Letterpacing', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'heading_three_weight',
			'label'       => esc_attr__( 'Content H3 Weight', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_four_size',
			'label'       => esc_attr__( 'Content H4 Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_four_letterspacing',
			'label'       => esc_attr__( 'Content H4 Letterpacing', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'heading_four_weight',
			'label'       => esc_attr__( 'Content H4 Weight', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_five_size',
			'label'       => esc_attr__( 'Content H5 Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_five_letterspacing',
			'label'       => esc_attr__( 'Content H5 Letterpacing', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'heading_five_weight',
			'label'       => esc_attr__( 'Content H5 Weight', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_six_size',
			'label'       => esc_attr__( 'Content H6 Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'heading_six_letterspacing',
			'label'       => esc_attr__( 'Content H6 Letterpacing', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'heading_six_weight',
			'label'       => esc_attr__( 'Content H6 Weight', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'     => 'blacksilver_content_section',
			'priority'    => 10,
			'default'     => '',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'search_buttontext',
			'label'    => esc_html__( 'Search button tooltip text', 'blacksilver' ),
			'section'  => 'blacksilver_search_section',
			'default'  => esc_html__( 'Search', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'search_mobileform',
			'label'    => esc_html__( 'Mobile menu search', 'blacksilver' ),
			'section'  => 'blacksilver_search_section',
			'default'  => true,
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'search_placeholder',
			'label'    => esc_html__( 'Search input placeholder text', 'blacksilver' ),
			'section'  => 'blacksilver_search_section',
			'default'  => '',
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'archive_search_notfoundtitleprefix',
			'label'    => esc_html__( 'Search results title prefix', 'blacksilver' ),
			'section'  => 'blacksilver_archivetitles_section',
			'default'  => esc_html__( 'Search Results for:', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'archive_tag_titleprefix',
			'label'    => esc_html__( 'Tag archive title', 'blacksilver' ),
			'section'  => 'blacksilver_archivetitles_section',
			'default'  => esc_html__( 'Tag:', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'archive_category_titleprefix',
			'label'    => esc_html__( 'Category title prefix', 'blacksilver' ),
			'section'  => 'blacksilver_archivetitles_section',
			'default'  => esc_html__( 'Category:', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'archive_author_titleprefix',
			'label'    => esc_html__( 'Author title prefix', 'blacksilver' ),
			'section'  => 'blacksilver_archivetitles_section',
			'default'  => esc_html__( 'Author:', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'archive_year_titleprefix',
			'label'    => esc_html__( 'Yearly title prefix', 'blacksilver' ),
			'section'  => 'blacksilver_archivetitles_section',
			'default'  => esc_html__( 'Yearly:', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'archive_monthly_titleprefix',
			'label'    => esc_html__( 'Monthly title prefix', 'blacksilver' ),
			'section'  => 'blacksilver_archivetitles_section',
			'default'  => esc_html__( 'Monthly:', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'archive_daily_titleprefix',
			'label'    => esc_html__( 'Daily title prefix', 'blacksilver' ),
			'section'  => 'blacksilver_archivetitles_section',
			'default'  => esc_html__( 'Daily:', 'blacksilver' ),
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'commentlabel_override',
			'label'    => esc_html__( 'Over-ride comment fields', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => false,
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'commentinfo_nocomment',
			'label'    => esc_html__( 'No Comments', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => esc_html__( 'No Comments', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'commentinfo_onecomment',
			'label'    => esc_html__( 'One Comment', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => esc_html__( 'One Comment', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'commentinfo_morecomments',
			'label'       => esc_html__( 'Comments', 'blacksilver' ),
			'description' => esc_html__( 'Comment number will display before text', 'blacksilver' ),
			'section'     => 'blacksilver_commentlabels_section',
			'default'     => esc_html__( 'Comments', 'blacksilver' ),
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'commentinfo_commentclosed',
			'label'    => esc_html__( 'Comments are closed', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => esc_html__( 'Comments are closed', 'blacksilver' ),
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'commentlabel_leavecomment',
			'label'    => esc_html__( 'Leave a Comment', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => esc_html__( 'Leave a Comment', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'commentlabel_commentfield',
			'label'    => esc_html__( 'Comment field', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => esc_html__( 'Comment', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'commentlabel_namefield',
			'label'    => esc_html__( 'Name field', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => esc_html__( 'Name', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'commentlabel_emailfield',
			'label'    => esc_html__( 'Email field', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => esc_html__( 'Email', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'commentlabel_websitefield',
			'label'    => esc_html__( 'Website field', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => esc_html__( 'Website', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'commentlabel_button',
			'label'    => esc_html__( 'Comment Submit Button', 'blacksilver' ),
			'section'  => 'blacksilver_commentlabels_section',
			'default'  => esc_html__( 'Post Comment', 'blacksilver' ),
			'priority' => 10,
		)
	);

	// Page Comments
	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'enable_animated_cursor',
			'label'    => esc_html__( 'Enable Animated Cursor', 'blacksilver' ),
			'section'  => 'blacksilver_themestyle_section',
			'default'  => false,
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'enable_goto_top',
			'label'    => esc_html__( 'Goto Top Indicator', 'blacksilver' ),
			'section'  => 'blacksilver_themestyle_section',
			'default'  => true,
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'select',
			'active_callback' => 'blacksilver_goto_top_status',
			'settings'        => 'goto_top_location',
			'label'           => esc_html__( 'Goto Top Location', 'blacksilver' ),
			'section'         => 'blacksilver_themestyle_section',
			'default'         => 'default',
			'choices'         => array(
				'default' => esc_html__( 'Right', 'blacksilver' ),
				'left'    => esc_html__( 'Left', 'blacksilver' ),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'general_theme_style',
			'label'    => esc_html__( 'Theme Style', 'blacksilver' ),
			'section'  => 'blacksilver_themestyle_section',
			'default'  => 'default',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'default' => esc_html__( 'Default', 'blacksilver' ),
				'compact' => esc_html__( 'Compact', 'blacksilver' ),
				'display' => esc_html__( 'Display', 'blacksilver' ),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'select',
			'active_callback' => 'blacksilver_choice_themestyle_not_display_callback',
			'settings'        => 'default_font_load',
			'label'           => esc_html__( 'Load default font', 'blacksilver' ),
			'section'         => 'blacksilver_themestyle_section',
			'default'         => 'active',
			'priority'        => 10,
			'multiple'        => 1,
			'choices'         => array(
				'active'  => esc_html__( 'Active', 'blacksilver' ),
				'disable' => esc_html__( 'Disable', 'blacksilver' ),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'general_theme_mode',
			'label'    => esc_html__( 'Theme Mode', 'blacksilver' ),
			'section'  => 'blacksilver_themestyle_section',
			'default'  => 'default',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'default' => esc_html__( 'Default ( Bright )', 'blacksilver' ),
				'dark'    => esc_html__( 'Dark', 'blacksilver' ),
			),
		)
	);

	// Accent Color
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'accent_color',
			'label'     => esc_html__( 'Accent Color', 'blacksilver' ),
			'section'   => 'blacksilver_pagecolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => blacksilver_get_css_classes( 'accent_color_classes' ),
					'property' => 'color',
				),
				array(
					'element'  => '.work-details .arrow-link svg g, .entry-blog-contents-wrap .arrow-link svg g',
					'property' => 'stroke',
				),
			),
		)
	);

	// Page Colors
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'page_titles_color',
			'label'     => esc_html__( 'Page Contents', 'blacksilver' ),
			'section'   => 'blacksilver_pagecolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => blacksilver_get_css_classes( 'page_content' ),
					'property' => 'color',
				),
				array(
					'element'  => '.theme-hover-arrow::before',
					'property' => 'background-color',
				),
			),
		)
	);
	// Page Colors
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'page_background_color',
			'label'     => esc_html__( 'Page Background', 'blacksilver' ),
			'section'   => 'blacksilver_pagecolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.menu-is-horizontal .outer-wrap,.container-outer,.comment-respond,.commentform-wrap .comment.odd,ol.commentlist li.comment',
					'property' => 'background-color',
				),
			),
		)
	);

	// Page Colors
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'page_contents_color',
			'label'     => esc_html__( 'Page Titles', 'blacksilver' ),
			'section'   => 'blacksilver_pagecolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => blacksilver_get_css_classes( 'page_titles' ),
					'property' => 'color',
				),
			),
		)
	);

	// Paragraph Link Color
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'ptag_link_color',
			'label'     => esc_html__( 'Content link color', 'blacksilver' ),
			'section'   => 'blacksilver_pagecolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.entry-content p > a,p a,a',
					'property' => 'color',
				),
			),
		)
	);

	// Paragraph Link Hover Color
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'ptag_link_hover_color',
			'label'     => esc_html__( 'Content link hover color', 'blacksilver' ),
			'section'   => 'blacksilver_pagecolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.entry-content p > a:hover,p a:hover,a:hover',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'select',
			'settings'    => 'page_general_font',
			'label'       => esc_html__( 'General page font', 'blacksilver' ),
			'description' => esc_attr__( 'Default: sans-serif', 'blacksilver' ),
			'section'     => 'blacksilver_pagefont_section',
			'default'     => 'sans-serif',
			'priority'    => 10,
			'choices'     => Kirki_Fonts::get_font_choices(),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'select',
			'settings'    => 'page_headings_font',
			'label'       => esc_html__( 'Page Headings Font', 'blacksilver' ),
			'description' => esc_attr__( 'Default: sans-serif', 'blacksilver' ),
			'section'     => 'blacksilver_pagefont_section',
			'default'     => 'sans-serif',
			'priority'    => 10,
			'choices'     => Kirki_Fonts::get_font_choices(),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'select',
			'settings'    => 'page_contents_font',
			'label'       => esc_html__( 'Contents Font', 'blacksilver' ),
			'description' => esc_attr__( 'Default: sans-serif', 'blacksilver' ),
			'section'     => 'blacksilver_pagefont_section',
			'default'     => 'sans-serif',
			'priority'    => 10,
			'choices'     => Kirki_Fonts::get_font_choices(),
		)
	);

	// Resopnsive Menu Text
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'responsivemenutext_font',
			'label'    => esc_html__( 'Menu Font', 'blacksilver' ),
			'section'  => 'blacksilver_responsivemenutext_section',
			'default'  => 'sans-serif',
			'priority' => 10,
			'choices'  => Kirki_Fonts::get_font_choices(),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'responsivemenutext_size',
			'label'       => esc_attr__( 'Menu Text Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_responsivemenutext_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'responsivemenutext_letterspacing',
			'label'       => esc_attr__( 'Menu Text Letterpacing', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'     => 'blacksilver_responsivemenutext_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'dimension',
			'settings'    => 'responsivemenutextsub_size',
			'label'       => esc_attr__( 'Sub Menu Text Size', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'     => 'blacksilver_responsivemenutext_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'responsivemenutext_weight',
			'label'       => esc_attr__( 'Menu Text Weight', 'blacksilver' ),
			'description' => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'     => 'blacksilver_responsivemenutext_section',
			'priority'    => 10,
			'default'     => '',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'color',
			'settings' => 'responsivemenu_background_one',
			'label'    => esc_html__( 'Menu Gradient Color 1', 'blacksilver' ),
			'section'  => 'blacksilver_responsivemenucolors_section',
			'default'  => '',
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'color',
			'settings' => 'responsivemenu_background_two',
			'label'    => esc_html__( 'Menu Gradient Color 2', 'blacksilver' ),
			'section'  => 'blacksilver_responsivemenucolors_section',
			'default'  => '',
			'priority' => 10,
		)
	);

	// Responsive Colors
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_bar_color',
			'label'     => esc_html__( 'Menu Bar Color', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.mobile-menu-toggle::after',
					'property' => 'background-color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_toggle_color',
			'label'     => esc_html__( 'Menu Toggle Color', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.mobile-toggle-menu-trigger span::before, .mobile-toggle-menu-trigger span::after, .mobile-toggle-menu-trigger span, .mobile-toggle-menu-open .mobile-toggle-menu-trigger span::before, .mobile-toggle-menu-open .mobile-toggle-menu-trigger span::after,.menu-is-onscreen .mobile-toggle-menu-trigger span::before, .menu-is-onscreen .mobile-toggle-menu-trigger span::after, .menu-is-onscreen .mobile-toggle-menu-trigger span, .menu-is-onscreen .mobile-toggle-menu-open .mobile-toggle-menu-trigger span::before, .menu-is-onscreen .mobile-toggle-menu-open .mobile-toggle-menu-trigger span::after',
					'property' => 'background-color',
				),
				array(
					'element'  => '.responsive-menu-wrap .wpml-lang-selector-wrap a, .responsive-menu-wrap .wpml-lang-selector-wrap',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_color',
			'label'     => esc_html__( 'Menu Item Color', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.theme-is-light .responsive-mobile-menu ul.mtree a, .menu-is-horizontal .responsive-mobile-menu .social-header-wrap ul li.contact-text a:hover, .menu-is-horizontal .responsive-mobile-menu .social-header-wrap ul li.contact-text a, .responsive-mobile-menu .social-header-wrap ul li.contact-text a, .responsive-mobile-menu .address-text, .responsive-mobile-menu .contact-text, .header-is-simple.theme-is-light .responsive-mobile-menu ul.mtree a,.vertical-menu #mobile-searchform i, .simple-menu #mobile-searchform i, .responsive-mobile-menu #mobile-searchform i,.menu-is-horizontal .responsive-mobile-menu .social-icon i, .menu-is-horizontal .responsive-mobile-menu .social-header-wrap ul li.social-icon i',
					'property' => 'color',
				),
				array(
					'element'  => '.vertical-menu #mobile-searchform input, .simple-menu #mobile-searchform input, .responsive-mobile-menu #mobile-searchform input',
					'property' => 'border-color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_socialcolor',
			'label'     => esc_html__( 'Social Icons Color', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.menu-is-horizontal .responsive-mobile-menu .social-header-wrap ul li.contact-text a:hover, .menu-is-horizontal .responsive-mobile-menu .social-header-wrap ul li.contact-text a, .responsive-mobile-menu .social-header-wrap ul li.contact-text a, .responsive-mobile-menu .address-text,.menu-is-horizontal .responsive-mobile-menu .social-icon i, .menu-is-horizontal .responsive-mobile-menu .social-header-wrap ul li.social-icon i, .menu-is-vertical .responsive-mobile-menu .social-header-wrap ul li.contact-text a:hover, .menu-is-vertical .responsive-mobile-menu .social-header-wrap ul li.contact-text a,.menu-is-vertical .responsive-mobile-menu .social-icon i, .menu-is-vertical .responsive-mobile-menu .social-header-wrap ul li.social-icon i',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_hover_color',
			'label'     => esc_html__( 'Menu Item Hover Color', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.theme-is-light .responsive-mobile-menu ul.mtree li li a:hover, .header-is-simple.theme-is-light .responsive-mobile-menu ul.mtree li li a:hover, .theme-is-light .responsive-mobile-menu ul.mtree li > a:hover, .theme-is-light .responsive-mobile-menu ul.mtree a:hover,.menu-is-horizontal .responsive-mobile-menu ul li.social-icon:hover i,.responsive-mobile-menu #mobile-searchform:hover i',
					'property' => 'color',
				),
				array(
					'element'  => '.vertical-menu #mobile-searchform input:focus, .simple-menu #mobile-searchform input:focus, .responsive-mobile-menu #mobile-searchform input:focus',
					'property' => 'border-color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_hover_socialcolor',
			'label'     => esc_html__( 'Social Icon Hover Color', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => 'body .responsive-mobile-menu .social-header-wrap ul li.contact-text a:hover,body.menu-is-horizontal .responsive-mobile-menu .social-header-wrap ul li.contact-text a:hover,body.menu-is-horizontal .responsive-mobile-menu .social-header-wrap ul li.contact-text:hover, body .responsive-mobile-menu .social-header-wrap ul li.contact-text:hover a,.menu-is-vertical .responsive-mobile-menu ul li.social-icon:hover i,.menu-is-vertical .responsive-mobile-menu ul li.contact-text a:hover,.menu-is-vertical .responsive-mobile-menu ul li.contact-text a:hover,.menu-is-horizontal .responsive-mobile-menu ul li.social-icon:hover i,.menu-is-horizontal .responsive-mobile-menu ul li.contact-text a:hover,.menu-is-horizontal .responsive-mobile-menu ul li.contact-text a:hover',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_hyphen_color',
			'label'     => esc_html__( 'Menu Hyphen', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.theme-is-light ul.mtree > li::before',
					'property' => 'background-color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_arrow_color',
			'label'     => esc_html__( 'Menu Arrow', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.theme-is-light .responsive-mobile-menu ul.mtree ul.sub-menu li.mtree-node > a::after, .theme-is-light .responsive-mobile-menu ul.mtree li.mtree-node > a::after',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_open_color',
			'label'     => esc_html__( 'Opened Menu Items', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.header-is-simple.theme-is-light .responsive-mobile-menu ul.mtree li.mtree-open > a, .theme-is-light .responsive-mobile-menu ul.mtree li.mtree-open > a',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_opensub_color',
			'label'     => esc_html__( 'Opened Submenu Menu Items', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.theme-is-light .responsive-mobile-menu ul.mtree li li a, .header-is-simple.theme-is-light .responsive-mobile-menu ul.mtree li li a',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'responsivemenu_searchinput_color',
			'label'     => esc_html__( 'Responsive Search Input', 'blacksilver' ),
			'section'   => 'blacksilver_responsivemenucolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.responsive-mobile-menu #mobile-searchform input',
					'property' => 'color',
				),
			),
		)
	);

	// Stickymenu
	blacksilver_kirki_add_field(
		array(
			'type'            => 'toggle',
			'settings'        => 'enable_stickymenu',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Enable Sticky Menu', 'blacksilver' ),
			'section'         => 'blacksilver_menutype_section',
			'default'         => false,
			'priority'        => 10,
		)
	);

	// Stickymenu
	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'wpml_lang_selector_enable',
			'label'    => esc_html__( 'Enable WPML language selector', 'blacksilver' ),
			'section'  => 'blacksilver_menutype_section',
			'default'  => false,
			'priority' => 10,
		)
	);

	// Menu Type
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'wpml_style',
			'label'    => esc_html__( 'WPML language style', 'blacksilver' ),
			'section'  => 'blacksilver_menutype_section',
			'default'  => 'default',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'default'   => esc_html__( 'Flags', 'blacksilver' ),
				'lang-code' => esc_html__( 'Language', 'blacksilver' ),
				'flag-code' => esc_html__( 'Flag + Language', 'blacksilver' ),
			),
		)
	);

	// Menu Type
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'menu_type',
			'label'    => esc_html__( 'Menu Style', 'blacksilver' ),
			'section'  => 'blacksilver_menutype_section',
			'default'  => 'left-logo',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'left-logo'        => esc_html__( 'Left Logo', 'blacksilver' ),
				'left-logo-boxed'  => esc_html__( 'Left Boxed', 'blacksilver' ),
				'centered-logo'    => esc_html__( 'Centered Logo', 'blacksilver' ),
				'split-menu'       => esc_html__( 'Split Menu', 'blacksilver' ),
				'toggle-main-menu' => esc_html__( 'Toggle Menu', 'blacksilver' ),
				'vertical-menu'    => esc_html__( 'Vertical Menu', 'blacksilver' ),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'submenu_indicator',
			'label'    => esc_html__( 'Add Parent menu submenu indicators', 'blacksilver' ),
			'section'  => 'blacksilver_menutext_section',
			'default'  => false,
			'priority' => 10,
		)
	);


	// Menu Text
	blacksilver_kirki_add_field(
		array(
			'type'            => 'select',
			'settings'        => 'menutext_font',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Menu Font', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'default'         => 'sans-serif',
			'priority'        => 10,
			'choices'         => Kirki_Fonts::get_font_choices(),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'dimension',
			'settings'        => 'menutext_size',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_attr__( 'Menu Text Size', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'dimension',
			'settings'        => 'menutext_letterspacing',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_attr__( 'Menu Text Letterpacing', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'dimension',
			'settings'        => 'menutextsub_size',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_attr__( 'Sub Menu Text Size', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'text',
			'settings'        => 'menutext_weight',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_attr__( 'Menu Text Weight', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);

	// Vertical Menu Text
	blacksilver_kirki_add_field(
		array(
			'type'            => 'select',
			'settings'        => 'vertical_menutext_font',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Menu Font', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'default'         => 'sans-serif',
			'priority'        => 10,
			'choices'         => Kirki_Fonts::get_font_choices(),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'dimension',
			'settings'        => 'vertical_menutext_size',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_attr__( 'Vertical Menu Text Size', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'dimension',
			'settings'        => 'vertical_menutext_letterspacing',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_attr__( 'Vertical Menu Text Letterpacing', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'text',
			'settings'        => 'vertical_menutext_weight',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_attr__( 'Vertical Menu Text Weight', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	// End
	// Vertical Footer Text
	blacksilver_kirki_add_field(
		array(
			'type'            => 'select',
			'settings'        => 'vertical_footer_font',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Footer Font', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'default'         => 'sans-serif',
			'priority'        => 10,
			'choices'         => Kirki_Fonts::get_font_choices(),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'dimension',
			'settings'        => 'vertical_footertext_size',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_attr__( 'Vertical Footer Text Size', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 12px , 12em', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'dimension',
			'settings'        => 'vertical_footertext_letterspacing',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_attr__( 'Vertical Footer Text Letterpacing', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 1px , 1em', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'text',
			'settings'        => 'vertical_footertext_weight',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_attr__( 'Vertical Footer Text Weight', 'blacksilver' ),
			'description'     => esc_attr__( 'eg. 100, 200, 300, 400, 500, 600, 700, 800, 900', 'blacksilver' ),
			'section'         => 'blacksilver_menutext_section',
			'priority'        => 10,
			'default'         => '',
		)
	);
	// End

	// Vertical Menu Colors

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'verticalmenu_color',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Menu Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.vertical-menu ul.mtree i,.vertical-menu ul.mtree a,.vertical-menu-wrap ul.mtree li.mtree-node > a::after,.vertical-menu ul.mtree li li a,.vertical-menu ul.mtree .sub-menu .sub-menu a',
					'property' => 'color',
				),
				array(
					'element'  => '.vertical-menu ul.mtree > li.mtree-open::before',
					'property' => 'background-color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'verticalmenu_hover_color',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Hovered Menu Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.vertical-menu ul.mtree li:hover i, .vertical-menu ul.mtree li > a:hover, .vertical-menu ul.mtree a:hover',
					'property' => 'color',
				),
			),
		)
	);


	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'verticalmenu_opened_color',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Opened Menu Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.vertical-menu ul.mtree li.mtree-open > a',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'verticalmenu_footertext_color',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Footer Text Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.menu-is-vertical .vertical-footer-copyright',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'verticalmenu_socialicons_color',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Footer Social icons Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.menu-is-vertical.header-type-overlay .vertical-footer-wrap .social-header-wrap ul li i,.menu-is-vertical.header-type-inverse .vertical-footer-wrap .social-header-wrap ul li i,.menu-is-vertical.fullscreen-header-dark .vertical-footer-wrap .social-header-wrap ul li.address-text i,.menu-is-vertical.fullscreen-header-bright .vertical-footer-wrap .social-header-wrap ul li i,.menu-is-vertical .vertical-footer-wrap .social-header-wrap ul li,.menu-is-vertical .vertical-footer-wrap .address-text a, .menu-is-vertical .vertical-footer-wrap .social-icon a,.menu-is-vertical .vertical-footer-wrap .social-icon i,.menu-is-vertical .vertical-footer-wrap .social-header-wrap ul li.social-icon i,.menu-is-vertical .vertical-footer-wrap .social-header-wrap ul li.contact-text a',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'verticalmenu_socialicons_hover_color',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Footer Hover Social icons Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.menu-is-vertical .vertical-footer-wrap .social-icon a:hover.menu-is-vertical .vertical-footer-wrap .social-icon a:hover,.menu-is-vertical .vertical-footer-wrap ul li.social-icon:hover i,.menu-is-vertical .vertical-footer-wrap .vertical-footer-wrap .social-icon:hover,.menu-is-vertical .vertical-footer-wrap .vertical-footer-wrap .social-icon i:hover,.menu-is-vertical .vertical-footer-wrap .social-header-wrap ul li.contact-text a:hover',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'background',
			'settings'        => 'verticalmenu_background',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Menu Background', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => array(
				'background-color'      => 'rgba(80, 80, 80, 1)',
				'background-image'      => '',
				'background-repeat'     => 'no-repeat',
				'background-position'   => 'center center',
				'background-size'       => 'cover',
				'background-attachment' => 'fixed',
			),
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element' => '.vertical-menu-wrap',
				),
			),
		)
	);

	// End

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_color',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Menu Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.stickymenu-active.header-type-overlay .header-cart i,.split-menu.sticky-nav-active.menu-is-horizontal .homemenu ul:first-child > li > a,.inverse-sticky.stickymenu-active.page-is-not-fullscreen .homemenu ul:first-child > li > a, .header-type-auto .homemenu ul:first-child > li .wpml-lang-selector-wrap, .header-type-auto .homemenu ul:first-child > li .wpml-lang-selector-wrap a,.header-type-auto .homemenu ul:first-child > li > a, .header-type-auto .header-cart i, .header-type-auto-bright .homemenu ul:first-child > li > a, .header-type-auto.fullscreen-header-bright .homemenu ul:first-child > li > a, .header-type-bright .homemenu ul:first-child > li > a,.inverse-sticky.stickymenu-active.page-is-not-fullscreen .homemenu ul:first-child > li > a, .header-type-auto.fullscreen-slide-dark .homemenu ul:first-child > li > a, .header-type-auto .homemenu ul:first-child > li > a, .header-type-auto .header-cart i, .header-type-auto-dark .homemenu ul:first-child > li > a, .header-type-auto.fullscreen-slide-dark .homemenu ul:first-child > li > a,.compact-layout.page-is-not-fullscreen.header-type-bright .menu-social-header .social-header-wrap .social-icon i,.compact-layout.page-is-not-fullscreen.header-type-bright .homemenu ul:first-child > li > a,.compact-layout.page-is-not-fullscreen.header-type-auto.fullscreen-header-bright .menu-social-header .social-header-wrap .social-icon i,.compact-layout.page-is-not-fullscreen.header-type-auto.fullscreen-header-bright .homemenu ul:first-child > li > a,.compact-layout.page-is-not-fullscreen.header-type-auto .homemenu ul:first-child > li > a',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_background_color',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Menu Background Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.split-menu.menu-is-horizontal .outer-wrap,.header-type-auto.page-is-not-fullscreen.split-menu.menu-is-horizontal .outer-wrap,.header-type-auto.stickymenu-active.menu-is-horizontal .outer-wrap.stickymenu-zone,.header-type-auto.centered-logo.menu-is-horizontal .outer-wrap,.minimal-logo.menu-is-horizontal .outer-wrap, .splitmenu-logo.menu-is-horizontal .outer-wrap, .left-logo.menu-is-horizontal .outer-wrap, .header-type-auto.page-is-not-fullscreen.minimal-logo.menu-is-horizontal .outer-wrap, .header-type-auto.page-is-not-fullscreen.splitmenu-logo.menu-is-horizontal .outer-wrap, .header-type-auto.page-is-not-fullscreen.left-logo.menu-is-horizontal .outer-wrap,.sticky-nav-active.menu-is-horizontal .outer-wrap,.split-menu.sticky-nav-active.menu-is-horizontal .outer-wrap',
					'property' => 'background',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_border_color',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Menu Border Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.split-menu.menu-is-horizontal .outer-wrap, .header-type-auto.page-is-not-fullscreen.split-menu.menu-is-horizontal .outer-wrap,.minimal-logo.menu-is-horizontal .outer-wrap, .splitmenu-logo.menu-is-horizontal .outer-wrap, .left-logo.menu-is-horizontal .outer-wrap, .header-type-auto.page-is-not-fullscreen.minimal-logo.menu-is-horizontal .outer-wrap, .header-type-auto.page-is-not-fullscreen.splitmenu-logo.menu-is-horizontal .outer-wrap, .header-type-auto.page-is-not-fullscreen.left-logo.menu-is-horizontal .outer-wrap',
					'property' => 'border-color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_overlay_color',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Overlay Menu Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.header-type-overlay .header-cart i, .header-type-overlay .homemenu ul:first-child > li .wpml-lang-selector-wrap, .header-type-overlay .homemenu ul:first-child > li .wpml-lang-selector-wrap a, .header-type-overlay .homemenu ul:first-child > li > a, .header-type-overlay .header-cart i',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_inverse_color',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Inverse Menu Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.header-type-inverse-overlay .homemenu .wpml-lang-selector-wrap,.header-type-inverse-overlay .homemenu ul:first-child > li > a,.header-type-inverse .header-cart i, .header-type-inverse .homemenu ul:first-child > li .wpml-lang-selector-wrap, .header-type-inverse .homemenu ul:first-child > li .wpml-lang-selector-wrap a, .header-type-inverse .homemenu ul:first-child > li > a, .header-type-inverse .header-cart i',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_background_inverse_color',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Menu Background Inverse Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.header-type-inverse.split-menu.menu-is-horizontal .outer-wrap,.header-type-inverse.page-is-not-fullscreen.split-menu.menu-is-horizontal .outer-wrap,.header-type-inverse.stickymenu-active.menu-is-horizontal .outer-wrap.stickymenu-zone,.header-type-inverse.left-logo.menu-is-horizontal .outer-wrap,.header-type-inverse.page-is-not-fullscreen.left-logo.menu-is-horizontal .outer-wrap,.header-type-inverse.page-is-not-fullscreen .outer-wrap',
					'property' => 'background',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_border_inverse_color',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Menu Border Inverse Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.header-type-inverse.split-menu.menu-is-horizontal .outer-wrap,.header-type-inverse.page-is-not-fullscreen.split-menu.menu-is-horizontal .outer-wrap,.header-type-inverse.left-logo.menu-is-horizontal .outer-wrap,.header-type-inverse.page-is-not-fullscreen.left-logo.menu-is-horizontal .outer-wrap,.header-type-inverse.page-is-not-fullscreen .outer-wrap',
					'property' => 'border-color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'submenu_bgcolor',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Submenu Background', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.homemenu ul ul',
					'property' => 'background',
				),
				array(
					'element'  => '.homemenu ul ul',
					'property' => 'border-color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'submenu_megaheadingcolor',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Mega Menu Headings', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.homemenu .sf-menu .mega-item .children-depth-0 h6',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'submenu_textcolor',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Submenu Items', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.homemenu ul ul li a',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'submenu_texthovercolor',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Submenu Items Hover', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.homemenu ul ul li a:hover',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'social_headercolor',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Social icons color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.header-type-inverse .menu-social-header .social-header-wrap .social-icon i,.header-type-inverse .social-header-wrap ul li i,.header-type-inverse .menu-social-header .social-header-wrap ul li,.header-type-inverse .menu-social-header .social-header-wrap .contact-text a,.menu-social-header .social-header-wrap ul li.contact-text a,.menu-social-header .social-header-wrap ul li.contact-text,.header-type-overlay .menu-social-header .social-header-wrap .social-icon i,.header-type-overlay .menu-social-header .social-header-wrap ul li,.header-type-overlay .menu-social-header .social-header-wrap .contact-text,.header-type-overlay .social-header-wrap ul li i,.header-type-overlay .header-cart i,.menu-social-header .social-header-wrap .social-icon i, .header-site-title-section, .header-cart i, .main-menu-on.menu-inverse-on .menu-social-header .social-header-wrap .social-icon i, .main-menu-on.menu-inverse-on .header-cart i,.menu-social-header .social-header-wrap ul li,.menu-social-header .social-header-wrap ul li,.social-header-wrap ul li.address-text i,.header-type-overlay .menu-social-header .social-header-wrap .contact-text a',
					'property' => 'color',
				),
				array(
					'element'  => '.menu-social-header .social-header-wrap ul li::after',
					'property' => 'border-color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'fullscreensocial_headercolor',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Fullsreeen Social icons color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.fullscreen-header-bright .menu-social-header .social-header-wrap .contact-text a,.fullscreen-header-dark .social-header-wrap ul li.address-text i,.fullscreen-header-dark .menu-social-header .social-header-wrap .social-icon i,.fullscreen-header-bright .menu-social-header .social-header-wrap .contact-text,.fullscreen-header-bright .social-header-wrap ul li.address-text i,.fullscreen-header-bright .menu-social-header .social-header-wrap .social-icon i,.fullscreen-header-bright .social-header-wrap ul li i,.fullscreen-header-bright .menu-social-header .social-header-wrap ul li,.fullscreen-header-dark .social-header-wrap ul li i,.fullscreen-header-dark .menu-social-header .social-header-wrap ul li',
					'property' => 'color',
				),
				array(
					'element'  => '.fullscreen-header-bright .menu-social-header .social-header-wrap ul li::after,.fullscreen-header-dark .menu-social-header .social-header-wrap ul li::after',
					'property' => 'border-color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'social_headercolor_inverse',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Inverse Menu Social icons color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.header-type-inverse-overlay .menu-social-header .social-header-wrap .contact-text a,.header-type-inverse .menu-social-header .social-header-wrap .contact-text a, .menu-social-header .social-header-wrap ul li.contact-text a,.header-type-inverse .social-header-wrap ul li i,.header-type-inverse .menu-social-header .social-header-wrap .contact-text,.header-type-inverse .social-header-wrap ul li.address-text i,.header-type-inverse .menu-social-header .social-header-wrap ul li,.header-type-inverse-overlay .menu-social-header .social-header-wrap .social-icon i,.header-type-inverse-overlay .menu-social-header .social-header-wrap ul li, .header-type-inverse-overlay .menu-social-header .social-header-wrap .contact-text, .header-type-inverse-overlay .header-cart i,.menu-social-header .social-header-wrap ul li,.header-type-inverse-overlay .social-header-wrap ul li.address-text i, .header-type-inverse .menu-social-header .social-header-wrap .social-icon i, .header-type-inverse .header-cart i',
					'property' => 'color',
				),
				array(
					'element'  => '.menu-social-header .social-header-wrap ul li::after',
					'property' => 'border-color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_onepage_underline',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'OnePage Menu Underline Color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.stickymenu-active .homemenu > ul > li.active > a::after',
					'property' => 'background',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_toggle_color',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Color for toggle as Main Menu', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.stickymenu-active.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span:before,.stickymenu-active.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span:after,.stickymenu-active.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span,.stickymenu-active.header-type-overlay.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span,.stickymenu-active.header-type-overlay.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span:before,.stickymenu-active.header-type-overlay.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span:after,.menu-is-onscreen:not(.header-type-overlay).toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span::before, .menu-is-onscreen:not(.header-type-overlay).toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span::after, .menu-is-onscreen:not(.header-type-overlay).toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-open .mobile-toggle-menu-trigger span::before, .menu-is-onscreen:not(.header-type-overlay).toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-open .mobile-toggle-menu-trigger span::after,.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span:after,.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span:before,.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span,.toggle-main-menu:not(.mobile-mode-active).fullscreen-header-dark:not(.menu-is-onscreen) .mobile-toggle-menu-trigger span:after,.toggle-main-menu:not(.mobile-mode-active).fullscreen-header-dark:not(.menu-is-onscreen) .mobile-toggle-menu-trigger span:before,.toggle-main-menu:not(.mobile-mode-active).fullscreen-header-dark:not(.menu-is-onscreen) .mobile-toggle-menu-trigger span,.toggle-main-menu:not(.mobile-mode-active).fullscreen-header-bright:not(.menu-is-onscreen) .mobile-toggle-menu-trigger span:after,.toggle-main-menu:not(.mobile-mode-active).fullscreen-header-bright:not(.menu-is-onscreen) .mobile-toggle-menu-trigger span:before,.toggle-main-menu:not(.mobile-mode-active).fullscreen-header-bright:not(.menu-is-onscreen) .mobile-toggle-menu-trigger span,.header-type-overlay.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span::before,.header-type-overlay.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span::after,.header-type-overlay.toggle-main-menu:not(.mobile-mode-active) .mobile-toggle-menu-trigger span',
					'property' => 'background',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_stickymenu_textcolor',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Sticky Menu color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.stickymenu-active.header-type-inverse-overlay .header-cart i,.stickymenu-active .homemenu .wpml-lang-selector-wrap,.stickymenu-active.header-type-inverse-overlay .homemenu ul:first-child > li > a,.stickymenu-active.header-type-inverse .header-cart i,.stickymenu-active.header-type-inverse .homemenu ul:first-child > li .wpml-lang-selector-wrap,.stickymenu-active.header-type-inverse .homemenu ul:first-child > li > a,.stickymenu-active.header-type-overlay .homemenu ul:first-child > li .wpml-lang-selector-wrap,.stickymenu-active.header-type-overlay .homemenu ul:first-child > li > a,.stickymenu-active.header-type-overlay .menu-social-header .social-header-wrap .social-icon i,.stickymenu-active.header-type-overlay .menu-social-header .social-header-wrap .contact-text,.stickymenu-active.header-type-overlay .menu-social-header .social-header-wrap .contact-text a,.stickymenu-active.header-type-overlay .header-site-title-section a,.stickymenu-active.header-type-overlay .header-cart i',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'            => 'color',
			'settings'        => 'mainmenu_stickymenu_color',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Sticky Menu Background color', 'blacksilver' ),
			'section'         => 'blacksilver_menucolors_section',
			'default'         => '',
			'priority'        => 10,
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.header-type-inverse.stickymenu-active.menu-is-horizontal .outer-wrap.stickymenu-zone,.header-type-auto.stickymenu-active.menu-is-horizontal .outer-wrap.stickymenu-zone,.stickymenu-active.menu-is-horizontal .outer-wrap.stickymenu-zone',
					'property' => 'background',
				),
			),
		)
	);


	// Right Click Block
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'rightclick_disable',
			'label'     => esc_html__( 'Right Click Block', 'blacksilver' ),
			'section'   => 'blacksilver_rightclickblock_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'textarea',
			'settings'    => 'rightclick_disabletext',
			'label'       => esc_html__( 'Right Click Block', 'blacksilver' ),
			'description' => esc_html__( 'This text appears in the popup when right click is disabled.', 'blacksilver' ),
			'section'     => 'blacksilver_rightclickblock_section',
			'default'     => esc_html__( 'You can enable/disable right clicking from Theme Options and customize this message too.', 'blacksilver' ),
			'priority'    => 10,
		)
	);
	/**
	 * Typography Control.
	 */
	blacksilver_kirki_add_field(
		array(
			'type'      => 'typography',
			'settings'  => 'rcm_typsography',
			'label'     => esc_attr__( 'Typography Control Label', 'blacksilver' ),
			'section'   => 'blacksilver_rightclickblock_section',
			'priority'  => 10,
			'transport' => 'auto',
			'default'   => array(
				'font-family'    => 'inherit',
				'variant'        => '300',
				'font-size'      => '28px',
				'line-height'    => '1.314',
				'letter-spacing' => '0',
				'color'          => '#ffffff',
			),
			'output'    => array(
				array(
					'element' => '.dimmer-text',
				),
			),
			'choices'   => array(
				'fonts' => array(
					'google'   => array( 'popularity', 60 ),
					'families' => array(
						'custom' => array(
							'text'     => 'Quick Fonts',
							'children' => array(
								array(
									'id'   => 'helvetica-neue',
									'text' => 'Helvetica Neue',
								),
								array(
									'id'   => 'linotype-authentic',
									'text' => 'Linotype Authentic',
								),
							),
						),
					),
					'variants' => array(
						'helvetica-neue'     => array( 'regular', '900' ),
						'linotype-authentic' => array( 'regular', '100', '300' ),
					),
				),
			),
		)
	);
	// Rcm Background
	blacksilver_kirki_add_field(
		array(
			'type'      => 'background',
			'settings'  => 'rcm_background',
			'label'     => esc_html__( 'Right Click Background', 'blacksilver' ),
			'section'   => 'blacksilver_rightclickblock_section',
			'default'   => array(
				'background-color'      => 'rgba(0, 0, 0, 0.8)',
				'background-image'      => '',
				'background-repeat'     => 'no-repeat',
				'background-position'   => 'center center',
				'background-size'       => 'cover',
				'background-attachment' => 'fixed',
			),
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element' => '#dimmer',
				),
			),
		)
	);

	// Elementor
	blacksilver_kirki_add_field(
		array(
			'type'        => 'select',
			'settings'    => 'elementor_style_settings',
			'label'       => esc_html__( 'Elementor Style', 'blacksilver' ),
			'description' => esc_html__( 'Disable Elementor Default font and style to Theme Defaults. The choice is found in wp-admin > Elementor > Settings > General Tab', 'blacksilver' ),
			'section'     => 'blacksilver_elementor_section',
			'default'     => 'auto',
			'priority'    => 10,
			'multiple'    => 1,
			'choices'     => array(
				'default' => esc_html__( 'Theme Defaults', 'blacksilver' ),
				'keep'    => esc_html__( 'Keep as is', 'blacksilver' ),
			),
		)
	);

	// Elementor Footer
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'elementor_themebuilder_footer_overide',
			'label'    => esc_html__( 'Themebuilder Footer', 'blacksilver' ),
			'section'  => 'blacksilver_elementor_section',
			'default'  => 'overide',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'overide'         => esc_html__( 'Replace with Elementor footer', 'blacksilver' ),
				'withthemefooter' => esc_html__( 'Display with theme footer', 'blacksilver' ),
			),
		)
	);

	// Google Maps Api
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'googlemap_api',
			'label'    => esc_html__( 'Google Map API', 'blacksilver' ),
			'section'  => 'blacksilver_map_api_section',
			'default'  => '',
			'priority' => 10,
		)
	);
	if ( shortcode_exists( 'instagram-feed' ) ) {
		$insta_notice = '<p class="customizer-theme-notice"><strong>Important Notice:</strong><br/>Instagram is shutting down the Legacy API and generating tokens using apps and plugins. Please authenticate your Instagram account using the Instagram Feeds plugin from Dashboard. After authenticating the instagram account, simply use the controls in this panel to display the footer instagram feeds.</p><p>Legacy API key input ( Discontinued )</p>';
	} else {
		$insta_notice = '<p class="customizer-theme-notice"><strong>Important Notice:</strong><br/>Instagram is shutting down the Legacy API and generating tokens using apps and plugins. Please install and activate <a target="_blank" href="https://wordpress.org/plugins/instagram-feed/">Smash Balloon Social Photo Feed</a> plugin. After authenticating your instagram account with the plugin, simply use the controls in this panel to display the footer instagram feeds.</p><p>Legacy API key input ( Discontinued )</p>';
	}

	// Instagram Maps Api
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'instagram_api',
			'label'       => esc_html__( 'Instagram API', 'blacksilver' ),
			'description' => $insta_notice,
			'section'     => 'blacksilver_api_section',
			'default'     => '',
			'priority'    => 10,
		)
	);
	// Instagram Enable
	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'instagram_footer',
			'label'    => esc_html__( 'Enable Instagram Footer', 'blacksilver' ),
			'section'  => 'blacksilver_api_section',
			'default'  => false,
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'instagram_widget_location',
			'label'    => esc_html__( 'Instagram Location', 'blacksilver' ),
			'section'  => 'blacksilver_api_section',
			'default'  => 'above',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'above' => esc_html__( 'Above Widgets', 'blacksilver' ),
				'below' => esc_html__( 'Below Widgets', 'blacksilver' ),
			),
		)
	);

	// Menu Type
	blacksilver_kirki_add_field(
		array(
			'type'            => 'select',
			'settings'        => 'instagram_location',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Display Instagram in Vertical Menu', 'blacksilver' ),
			'section'         => 'blacksilver_api_section',
			'default'         => 'left-logo',
			'priority'        => 10,
			'multiple'        => 1,
			'choices'         => array(
				'instagram-pagefooter'   => esc_html__( 'Display in Page Footer', 'blacksilver' ),
				'instagram-verticalmenu' => esc_html__( 'Display in Vertical Menu', 'blacksilver' ),
			),
		)
	);
	// Instagram Username
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'insta_username',
			'description' => esc_html__( 'Displays in Page Footer.', 'blacksilver' ),
			'label'       => esc_attr__( 'Instagram username', 'blacksilver' ),
			'section'     => 'blacksilver_api_section',
			'priority'    => 10,
			'default'     => '',
		)
	);
	// Instagram Image Limit
	blacksilver_kirki_add_field(
		array(
			'type'     => 'slider',
			'settings' => 'insta_image_limit',
			'label'    => esc_html__( 'Instagram Image Limit', 'blacksilver' ),
			'section'  => 'blacksilver_api_section',
			'default'  => '20',
			'priority' => 10,
			'choices'  => array(
				'min'  => 15,
				'max'  => 20,
				'step' => 1,
			),
		)
	);
	// Instagram row
	blacksilver_kirki_add_field(
		array(
			'type'     => 'slider',
			'settings' => 'insta_image_rows',
			'label'    => esc_html__( 'Instagram Row', 'blacksilver' ),
			'section'  => 'blacksilver_api_section',
			'default'  => '2',
			'priority' => 10,
			'choices'  => array(
				'min'  => 1,
				'max'  => 2,
				'step' => 1,
			),
		)
	);
	// Instagram columns
	blacksilver_kirki_add_field(
		array(
			'type'     => 'slider',
			'settings' => 'insta_image_columns',
			'label'    => esc_html__( 'Instagram Columns', 'blacksilver' ),
			'section'  => 'blacksilver_api_section',
			'default'  => '8',
			'priority' => 10,
			'choices'  => array(
				'min'  => 4,
				'max'  => 8,
				'step' => 1,
			),
		)
	);
	// Instagram row
	blacksilver_kirki_add_field(
		array(
			'type'        => 'slider',
			'settings'    => 'insta_image_container',
			'label'       => esc_html__( 'Instagram Container Width', 'blacksilver' ),
			'description' => esc_html__( 'Please reload or resize the browser window to see new grid size', 'blacksilver' ),
			'section'     => 'blacksilver_api_section',
			'default'     => '55',
			'priority'    => 10,
			'choices'     => array(
				'min'  => 55,
				'max'  => 100,
				'step' => 1,
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element'  => '.insta-grid-wrap',
					'property' => 'width',
					'units'    => '%',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'insta_image_space',
			'label'    => esc_html__( 'Instagram Grid Space', 'blacksilver' ),
			'section'  => 'blacksilver_api_section',
			'default'  => 'false',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'default' => esc_html__( 'Default', 'blacksilver' ),
				'nogap'   => esc_html__( 'No Gap', 'blacksilver' ),
			),
		)
	);
	// Slideshow Effect
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'insta_transition',
			'label'    => esc_html__( 'Instagram Transition', 'blacksilver' ),
			'section'  => 'blacksilver_api_section',
			'default'  => 'false',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'false'             => esc_html__( 'Disable Slideshow', 'blacksilver' ),
				'random'            => esc_html__( 'Random', 'blacksilver' ),
				'fadeInOut'         => 'fadeInOut',
				'slideLeft'         => 'slideLeft',
				'slideRight'        => 'slideRight',
				'slideTop'          => 'slideTop',
				'slideBottom'       => 'slideBottom',
				'rotateLeft'        => 'rotateLeft',
				'rotateRight'       => 'rotateRight',
				'rotateTop'         => 'rotateTop',
				'rotateBottom'      => 'rotateBottom',
				'scale'             => 'scale',
				'rotate3d'          => 'rotate3d',
				'rotateLeftScale'   => 'rotateLeftScale',
				'rotateRightScale'  => 'rotateRightScale',
				'rotateTopScale'    => 'rotateTopScale',
				'rotateBottomScale' => 'rotateBottomScale',
			),
		)
	);


	// Logo Height
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'settings'        => 'logo_height',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Logo Height', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '50',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.menu-is-horizontal .logo img',
					'property' => 'height',
					'units'    => 'px',
				),
			),
		)
	);

	// Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_default_left_callback',
			'settings'        => 'logo_topspace',
			'label'           => esc_html__( 'Logo Top Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '42',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => 'body.menu-is-horizontal .logo img',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
		)
	);

	// Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_split_callback',
			'settings'        => 'splitmenulogo_topspace',
			'label'           => esc_html__( 'Split Menu Logo Top Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '26',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.split-menu.menu-is-horizontal .logo img',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
		)
	);

	// Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_split_callback',
			'settings'        => 'splitmenulogo_centeroffset',
			'label'           => esc_html__( 'Split Menu Center Offset', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '0',
			'priority'        => 10,
			'choices'         => array(
				'min'  => -500,
				'max'  => 500,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.split-menu .homemenu',
					'property' => 'left',
					'units'    => 'px',
				),
			),
		)
	);

	// Centered Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_centered_callback',
			'settings'        => 'logo_centered_topspace',
			'label'           => esc_html__( 'Centered Logo Top Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '60',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.centered-logo.menu-is-horizontal .logo img',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
		)
	);

	// Centered Logo Left Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_centered_callback',
			'settings'        => 'logo_centered_leftspace',
			'label'           => esc_html__( 'Centered Logo Left Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '0',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.centered-logo.menu-is-horizontal .logo img',
					'property' => 'padding-left',
					'units'    => 'px',
				),
			),
		)
	);

	// Centered Logo Bottom Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_centered_callback',
			'settings'        => 'logo_centered_bottomspace',
			'label'           => esc_html__( 'Centered Logo Bottom Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '18',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.centered-logo.menu-is-horizontal .logo img',
					'property' => 'padding-bottom',
					'units'    => 'px',
				),
			),
		)
	);

	// Compact Top Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_compact_top_callback',
			'settings'        => 'logo_compact_top_topspace',
			'label'           => esc_html__( 'Compact-Top Logo Top Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '9',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.compact-layout.compact-minimal-top:not(.mobile-mode-active).menu-is-horizontal .logo img',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
		)
	);

	// Compact Left Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_compact_left_callback',
			'settings'        => 'logo_compact_left_topspace',
			'label'           => esc_html__( 'Compact-Left Logo Top Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '70',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.compact-layout.compact-minimal-left:not(.mobile-mode-active).menu-is-horizontal .logo img',
					'property' => 'margin-top',
					'units'    => 'px',
				),
			),
		)
	);

	// Condition Based End

	// Logo Left Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_is_not_centered_callback',
			'settings'        => 'logo_leftspace',
			'label'           => esc_html__( 'Logo Left Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '70',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => 'body.menu-is-horizontal .logo img',
					'property' => 'padding-left',
					'units'    => 'px',
				),
				array(
					'element'  => '.compact-layout.compact-minimal-left:not(.mobile-mode-active).menu-is-horizontal .logo img',
					'property' => 'margin-left',
					'units'    => 'px',
				),
			),
		)
	);
	// Sticky Menu Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'active_callback' => 'blacksilver_choice_menu_is_not_centered_callback',
			'settings'        => 'logo_sticky_topspace',
			'label'           => esc_html__( 'Sticky Menu Logo Top Space', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '24',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.stickymenu-active.menu-is-horizontal .logo',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
		)
	);
	// Logo Height
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'settings'        => 'logo_sticky_height',
			'active_callback' => 'blacksilver_choice_menu_is_not_centered_callback',
			'label'           => esc_html__( 'Sticky Menu Logo Height', 'blacksilver' ),
			'section'         => 'blacksilver_logo_section',
			'default'         => '50',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.stickymenu-active.menu-is-horizontal .logo img',
					'property' => 'height',
					'units'    => 'px',
				),
			),
		)
	);

	// Responsive Logo Height
	blacksilver_kirki_add_field(
		array(
			'type'      => 'slider',
			'settings'  => 'responsive_logo_height',
			'label'     => esc_html__( 'Logo Height', 'blacksilver' ),
			'section'   => 'blacksilver_responsivelogo_section',
			'default'   => '22',
			'priority'  => 10,
			'choices'   => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.logo-mobile .logoimage',
					'property' => 'height',
					'units'    => 'px',
				),
			),
		)
	);
	// Responsive Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'      => 'slider',
			'settings'  => 'responsive_logo_topmargin',
			'label'     => esc_html__( 'Logo Top Space', 'blacksilver' ),
			'section'   => 'blacksilver_responsivelogo_section',
			'default'   => '21',
			'priority'  => 10,
			'choices'   => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.logo-mobile .logoimage',
					'property' => 'top',
					'units'    => 'px',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'responsive_menu_keep_open',
			'label'    => esc_html__( 'Show page with current menu open', 'blacksilver' ),
			'section'  => 'blacksilver_responsivelogo_section',
			'default'  => false,
			'priority' => 10,
		)
	);

	// Footer Logo Height
	blacksilver_kirki_add_field(
		array(
			'type'      => 'slider',
			'settings'  => 'footer_logo_width',
			'label'     => esc_html__( 'Logo Width', 'blacksilver' ),
			'section'   => 'blacksilver_footerlogo_section',
			'default'   => '123',
			'priority'  => 10,
			'choices'   => array(
				'min'  => 0,
				'max'  => 800,
				'step' => 1,
			),
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '#copyright .footer-logo-image',
					'property' => 'width',
					'units'    => 'px',
				),
			),
		)
	);
	// Footer Logo Top Space
	blacksilver_kirki_add_field(
		array(
			'type'      => 'slider',
			'settings'  => 'footer_logo_topmargin',
			'label'     => esc_html__( 'Logo Top Space', 'blacksilver' ),
			'section'   => 'blacksilver_footerlogo_section',
			'default'   => '0',
			'priority'  => 10,
			'choices'   => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '#copyright .footer-logo-image',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
		)
	);
	// Footer Logo Bottom Space
	blacksilver_kirki_add_field(
		array(
			'type'      => 'slider',
			'settings'  => 'footer_logo_bottommargin',
			'label'     => esc_html__( 'Logo Bottom Space', 'blacksilver' ),
			'section'   => 'blacksilver_footerlogo_section',
			'default'   => '0',
			'priority'  => 10,
			'choices'   => array(
				'min'  => 0,
				'max'  => 300,
				'step' => 1,
			),
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '#copyright .footer-logo-image',
					'property' => 'padding-bottom',
					'units'    => 'px',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'preloader_style',
			'label'    => esc_html__( 'Preloader Style', 'blacksilver' ),
			'section'  => 'blacksilver_preloader_section',
			'default'  => 'false',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'default' => esc_html__( 'Default', 'blacksilver' ),
				'spinner' => esc_html__( 'Spinner', 'blacksilver' ),
			),
		)
	);

	// Preloader
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'preloader_color',
			'label'     => esc_html__( 'Preloader Color', 'blacksilver' ),
			'section'   => 'blacksilver_preloader_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.menu-is-vertical .themeloader__figure,.menu-is-vertical.page-is-not-fullscreen .loading-bar,.menu-is-vertical.page-is-fullscreen .loading-bar,.menu-is-horizontal .themeloader__figure,.menu-is-horizontal.page-is-not-fullscreen .loading-bar,.menu-is-horizontal.page-is-fullscreen .loading-bar',
					'property' => 'border-color',
				),
				array(
					'element'  => '.menu-is-vertical.page-is-not-fullscreen .loading-bar:after,.menu-is-vertical.page-is-fullscreen .loading-bar:after,.menu-is-horizontal.page-is-not-fullscreen .loading-bar:after,.menu-is-horizontal.page-is-fullscreen .loading-bar:after',
					'property' => 'background-color',
				),
			),
		)
	);

	// Preloader Background
	blacksilver_kirki_add_field(
		array(
			'type'      => 'background',
			'settings'  => 'preloader_background',
			'label'     => esc_html__( 'Preloader Background', 'blacksilver' ),
			'section'   => 'blacksilver_preloader_section',
			'default'   => array(
				'background-color'      => '#505050',
				'background-image'      => '',
				'background-repeat'     => 'no-repeat',
				'background-position'   => 'center center',
				'background-size'       => 'cover',
				'background-attachment' => 'fixed',
			),
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element' => '.preloader-style-default.loading-spinner,.preloader-cover-screen',
				),
			),
		)
	);

	// Fullscreen Controls
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'audio_loop',
			'label'     => esc_html__( 'Loop Audio', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'slider',
			'settings'  => 'audio_volume',
			'label'     => esc_html__( 'On Start Volume', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => '75',
			'priority'  => 10,
			'choices'   => array(
				'min'  => 1,
				'max'  => 100,
				'step' => 1,
			),
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'toggle',
			'settings'    => 'fullscreen_disableresponsiveset',
			'description' => 'Use source image for all devices',
			'label'       => esc_html__( 'Disable Responsive Image Set', 'blacksilver' ),
			'section'     => 'blacksilver_fullscreenmedia_section',
			'default'     => false,
			'priority'    => 10,
			'transport'   => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'hprogressbar_enable',
			'label'     => esc_html__( 'Progress Bar', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'hplaybutton_enable',
			'label'     => esc_html__( 'Slideshow Play button', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'hnavigation_enable',
			'label'     => esc_html__( 'Slideshow Navigation Arrows', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'hcontrolbar_enable',
			'label'     => esc_html__( 'Slideshow Controls', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'slideshow_autoplay',
			'label'     => esc_html__( 'Slideshow Autoplay', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'slideshow_pause_on_last',
			'label'     => esc_html__( 'Slideshow Pause on Last Slide', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'slideshow_pause_hover',
			'label'     => esc_html__( 'Slideshow Pause on Hover', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'slideshow_vertical_center',
			'label'     => esc_html__( 'Vertical Center Images', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'slideshow_horizontal_center',
			'label'     => esc_html__( 'Horizontal Center Images', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'slider',
			'settings'  => 'slideshow_interval',
			'label'     => esc_html__( 'Length between transitions', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => '8000',
			'priority'  => 10,
			'choices'   => array(
				'min'  => 500,
				'max'  => 20000,
				'step' => 1,
			),
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'slider',
			'settings'  => 'slideshow_transition_speed',
			'label'     => esc_html__( 'Speed of transition', 'blacksilver' ),
			'section'   => 'blacksilver_fullscreenmedia_section',
			'default'   => '1000',
			'priority'  => 10,
			'choices'   => array(
				'min'  => 500,
				'max'  => 20000,
				'step' => 1,
			),
			'transport' => 'auto',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'fullscreen_permalink_slug',
			'label'       => esc_html__( 'Fullscreen Permalink slug', 'blacksilver' ),
			'description' => esc_html__( 'Requires a unique slug name. After changing the slug name please make sure to flush the old cache by visiting wp-admin > Settings > Permalinks . Visiting the wp-admin page will auto renew permalinks. Otherwise it can give a 404 page not found error.', 'blacksilver' ),
			'section'     => 'blacksilver_fullscreenmedia_section',
			'default'     => '',
			'priority'    => 10,
		)
	);

	// Fullscreen Controls
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'fotorama_autoplay',
			'label'     => esc_html__( 'Fotorama Autoplay', 'blacksilver' ),
			'section'   => 'blacksilver_fotoramaslides_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'      => 'slider',
			'settings'  => 'fotorama_autoplay_speed',
			'label'     => esc_html__( 'Autoplay Speed', 'blacksilver' ),
			'section'   => 'blacksilver_fotoramaslides_section',
			'default'   => '8000',
			'priority'  => 10,
			'choices'   => array(
				'min'  => 500,
				'max'  => 20000,
				'step' => 1,
			),
			'transport' => 'auto',
		)
	);


	//Hompepage
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'fullcscreen_henable',
			'label'     => esc_html__( 'Enable Fullscreen Home', 'blacksilver' ),
			'section'   => 'blacksilver_home_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	if ( ! empty( $fullscreenposts ) ) {

		// Slideshow for Page Settings
		blacksilver_kirki_add_field(
			array(
				'type'        => 'select',
				'settings'    => 'fullcscreen_hselected',
				'label'       => esc_html__( 'Slideshow for Homepage', 'blacksilver' ),
				'description' => esc_html__( 'Choose slideshow for homepage', 'blacksilver' ),
				'section'     => 'blacksilver_home_section',
				'default'     => $default_fullscreen,
				'priority'    => 10,
				'multiple'    => 1,
				'choices'     => $fullscreenposts,
			)
		);
	}

	// 404
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'headertype_404',
			'label'    => esc_html__( '404 Header Type', 'blacksilver' ),
			'section'  => 'blacksilver_404_section',
			'default'  => 'auto',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'auto'    => esc_html__( 'Default', 'blacksilver' ),
				'overlay' => esc_html__( 'Overlay', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'background',
			'settings'  => 'general_404_background',
			'label'     => esc_html__( '404 Background', 'blacksilver' ),
			'section'   => 'blacksilver_404_section',
			'default'   => array(
				'background-color'      => '#eaeaea',
				'background-image'      => '',
				'background-repeat'     => 'no-repeat',
				'background-position'   => 'center center',
				'background-size'       => 'cover',
				'background-attachment' => 'fixed',
			),
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element' => '.error404',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'general_404_color',
			'label'     => esc_html__( '404 Text Color', 'blacksilver' ),
			'section'   => 'blacksilver_404_section',
			'default'   => '#000000',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.mtheme-404-wrap .mtheme-404-error-message1,.entry-content .mtheme-404-wrap h4,.mtheme-404-wrap #searchbutton i',
					'property' => 'color',
				),
				array(
					'element'  => '.mtheme-404-wrap #searchform input',
					'property' => 'border-color',
				),
				array(
					'element'  => '.mtheme-404-wrap #searchform input',
					'property' => 'color',
				),
				array(
					'element'  => '.mtheme-404-wrap .mtheme-404-icon i',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'pagenoutfound_title',
			'label'       => esc_html__( '404 Title', 'blacksilver' ),
			'description' => esc_html__( '404 Page not found title', 'blacksilver' ),
			'section'     => 'blacksilver_404_section',
			'default'     => '404 Page not Found!',
			'priority'    => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'pagenoutfound_search',
			'label'       => esc_html__( '404 Search Text', 'blacksilver' ),
			'description' => esc_html__( '404 Search Text', 'blacksilver' ),
			'section'     => 'blacksilver_404_section',
			'default'     => 'Would you like to search for the page',
			'priority'    => 10,
		)
	);

	// Events
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'events_time_format',
			'label'    => esc_html__( 'Events Time format', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => 'auto',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'conventional' => esc_html__( 'AM/PM', 'blacksilver' ),
				'24hr'         => esc_html__( '24 Hrs', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'events_address_format',
			'label'    => esc_html__( 'Events Address format', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => 'default',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'default' => esc_html__( 'Default', 'blacksilver' ),
				'sszv'    => esc_html__( 'Street, State, Zip, Venue', 'blacksilver' ),
				'zvss'    => esc_html__( 'Zip, Venue, Street, State', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'event_gallery_title',
			'label'    => esc_html__( 'Archive Event gallery title', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => esc_html__( 'Events', 'blacksilver' ),
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'dropdown-pages',
			'settings' => 'events_archive_page',
			'label'    => esc_html__( 'Custom Events Archive Page', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => 0,
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'event_archive_nav',
			'label'     => esc_html__( 'Events Archive Navigation', 'blacksilver' ),
			'section'   => 'blacksilver_events_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'slider',
			'settings' => 'event_achivelisting',
			'label'    => esc_html__( 'Events Archive Grid Column', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => '3',
			'priority' => 10,
			'choices'  => array(
				'min'  => 1,
				'max'  => 4,
				'step' => 1,
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'events_readmore',
			'label'    => esc_html__( 'Events Readmore', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => esc_html__( 'Continue Reading', 'blacksilver' ),
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'event_comments',
			'label'     => esc_html__( 'Event Comments', 'blacksilver' ),
			'section'   => 'blacksilver_events_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'events_permalink_slug',
			'label'       => esc_html__( 'Event Permalink slug', 'blacksilver' ),
			'description' => esc_html__( 'Requires a unique slug name. After changing the slug name please make sure to flush the old cache by visiting wp-admin > Settings > Permalinks . Visiting the wp-admin page will auto renew permalinks. Otherwise it can give a 404 page not found error.', 'blacksilver' ),
			'section'     => 'blacksilver_events_section',
			'default'     => '',
			'priority'    => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'event_postponed',
			'label'    => esc_html__( 'Postponed Event Text', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => 'This event has been postponed',
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'event_cancelled',
			'label'    => esc_html__( 'Cancelled Event Text', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => 'This event has been cancelled',
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'event_fullevent',
			'label'    => esc_html__( 'Text to notify that event is full', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => 'Sorry, participation for this event is full',
			'priority' => 10,
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'event_pastevent',
			'label'    => esc_html__( 'Past Event Text', 'blacksilver' ),
			'section'  => 'blacksilver_events_section',
			'default'  => 'This is a past event',
			'priority' => 10,
		)
	);


	// Proofing
	blacksilver_kirki_add_field(
		array(
			'type'        => 'select',
			'settings'    => 'proofing_archive_format',
			'label'       => esc_html__( 'Proofing archive format', 'blacksilver' ),
			'description' => esc_html__( 'Image format for Proofing archives', 'blacksilver' ),
			'section'     => 'blacksilver_proofing_section',
			'default'     => 'landscape',
			'priority'    => 10,
			'multiple'    => 1,
			'choices'     => array(
				'landscape' => esc_html__( 'Landscape', 'blacksilver' ),
				'portrait'  => esc_html__( 'Portrait', 'blacksilver' ),
				'square'    => esc_html__( 'Square', 'blacksilver' ),
				'masonary'  => esc_html__( 'Masonry', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'select',
			'settings'    => 'proofing_achivelisting',
			'label'       => esc_html__( 'Proofing archive format', 'blacksilver' ),
			'description' => esc_html__( 'Proofing archive listing columns', 'blacksilver' ),
			'section'     => 'blacksilver_proofing_section',
			'default'     => '3',
			'priority'    => 10,
			'multiple'    => 1,
			'choices'     => array(
				'4' => esc_html__( 'Four', 'blacksilver' ),
				'3' => esc_html__( 'Three', 'blacksilver' ),
				'2' => esc_html__( 'Two', 'blacksilver' ),
				'1' => esc_html__( 'One', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'proofing_archive_title',
			'label'       => esc_html__( 'Proofing Archive Title', 'blacksilver' ),
			'description' => esc_html__( 'This is the Title for Proofing archive', 'blacksilver' ),
			'section'     => 'blacksilver_proofing_section',
			'default'     => 'Proofing Archive',
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'proofing_all_items',
			'label'       => esc_html__( 'Proofing All items Text', 'kordex' ),
			'description' => esc_html__( 'Displayed as first item in filterable', 'kordex' ),
			'section'     => 'blacksilver_proofing_section',
			'default'     => 'All items',
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'proofing_selected_items',
			'label'       => esc_html__( 'Proofing Selected items Text', 'kordex' ),
			'description' => esc_html__( 'Displayed as selected in filterable', 'kordex' ),
			'section'     => 'blacksilver_proofing_section',
			'default'     => 'Selected',
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'proofing_rejected_items',
			'label'       => esc_html__( 'Proofing Rejected items Text', 'kordex' ),
			'description' => esc_html__( 'Displayed as rejected in filterable', 'kordex' ),
			'section'     => 'blacksilver_proofing_section',
			'default'     => 'Rejected',
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'proofing_editorchoice_items',
			'label'       => esc_html__( 'Proofing Editors choice Text', 'kordex' ),
			'description' => esc_html__( 'Displayed as editors choice in filterable', 'kordex' ),
			'section'     => 'blacksilver_proofing_section',
			'default'     => 'Editors Choice',
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'proofing_selected_count',
			'label'       => esc_html__( 'Proofing Count Selected Text', 'kordex' ),
			'description' => esc_html__( 'Displayed as selected count in filterable', 'kordex' ),
			'section'     => 'blacksilver_proofing_section',
			'default'     => 'Selected',
			'priority'    => 10,
		)
	);


	// Portfolio
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'portfolio_comments',
			'label'     => esc_html__( 'Portfolio Comments', 'blacksilver' ),
			'section'   => 'blacksilver_portfolio_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'dropdown-pages',
			'settings' => 'portfolio_archive_page',
			'label'    => esc_html__( 'Custom Portfolio Archive Page', 'blacksilver' ),
			'section'  => 'blacksilver_portfolio_section',
			'default'  => 0,
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'portfolio_archive_nav',
			'label'     => esc_html__( 'Portfolio Archive Navigation', 'blacksilver' ),
			'section'   => 'blacksilver_portfolio_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'select',
			'settings'    => 'portfolio_archive_format',
			'label'       => esc_html__( 'Portfolio archive format', 'blacksilver' ),
			'description' => esc_html__( 'Image format for Portfolio archives', 'blacksilver' ),
			'section'     => 'blacksilver_portfolio_section',
			'default'     => 'landscape',
			'priority'    => 10,
			'multiple'    => 1,
			'choices'     => array(
				'landscape' => esc_html__( 'Landscape', 'blacksilver' ),
				'portrait'  => esc_html__( 'Portrait', 'blacksilver' ),
				'square'    => esc_html__( 'Square', 'blacksilver' ),
				'masonary'  => esc_html__( 'Masonry', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'select',
			'settings'    => 'portfolio_achivelisting',
			'label'       => esc_html__( 'Portfolio archive format', 'blacksilver' ),
			'description' => esc_html__( 'Portfolio archive listing columns', 'blacksilver' ),
			'section'     => 'blacksilver_portfolio_section',
			'default'     => '3',
			'priority'    => 10,
			'multiple'    => 1,
			'choices'     => array(
				'4' => esc_html__( 'Four', 'blacksilver' ),
				'3' => esc_html__( 'Three', 'blacksilver' ),
				'2' => esc_html__( 'Two', 'blacksilver' ),
				'1' => esc_html__( 'One', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'portfolio_archive_title',
			'label'       => esc_html__( 'Portfolio Archive Title', 'blacksilver' ),
			'description' => esc_html__( 'This is also Label and Title for Portfolio archive', 'blacksilver' ),
			'section'     => 'blacksilver_portfolio_section',
			'default'     => 'Portfolios',
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'portfolio_permalink_slug',
			'label'       => esc_html__( 'Portfolio Permalink slug', 'blacksilver' ),
			'description' => esc_html__( 'Requires a unique slug name. After changing the slug name please make sure to flush the old cache by visiting wp-admin > Settings > Permalinks . Visiting the wp-admin page will auto renew permalinks. Otherwise it can give a 404 page not found error.', 'blacksilver' ),
			'section'     => 'blacksilver_portfolio_section',
			'default'     => '',
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'portfolio_allitems',
			'label'       => esc_html__( 'Portfolio All items Text', 'blacksilver' ),
			'description' => esc_html__( 'Displayed as first item in filterable', 'blacksilver' ),
			'section'     => 'blacksilver_portfolio_section',
			'default'     => 'All',
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'portfolio_fullscreen_viewtext',
			'label'       => esc_html__( 'Fullscreen Portfolio Button', 'blacksilver' ),
			'description' => esc_html__( 'Displayed in Fullscreen portfolio slideshow', 'blacksilver' ),
			'section'     => 'blacksilver_portfolio_section',
			'default'     => 'Details',
			'priority'    => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'toggle',
			'settings'    => 'portfolio_recently',
			'label'       => esc_html__( 'Display Recent Portfolios', 'blacksilver' ),
			'description' => esc_html__( 'Displays Carousel of Portfolios in details pages', 'blacksilver' ),
			'section'     => 'blacksilver_portfolio_section',
			'default'     => true,
			'priority'    => 10,
			'transport'   => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'portfolio_recentlink',
			'label'     => esc_html__( 'Portfolio Carousel Direct Link', 'blacksilver' ),
			'section'   => 'blacksilver_portfolio_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'text',
			'settings'    => 'portfolio_carousel_heading',
			'label'       => esc_html__( 'Recent Portfolio Heading', 'blacksilver' ),
			'description' => esc_html__( 'Recent portfolio title', 'blacksilver' ),
			'section'     => 'blacksilver_portfolio_section',
			'default'     => 'Recently in Portfolio',
			'priority'    => 10,
		)
	);

	//Blog
	blacksilver_kirki_add_field(
		array(
			'type'        => 'toggle',
			'settings'    => 'postformat_imagelightbox',
			'label'       => esc_html__( 'Enable lightbox for standard post details featured image.', 'blacksilver' ),
			'description' => esc_html__( 'Applies to blog posts that do not use Elementor pagebuilder.', 'blacksilver' ),
			'section'     => 'blacksilver_blog_section',
			'default'     => false,
			'priority'    => 10,
			'transport'   => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'postsingle_author',
			'label'     => esc_html__( 'Blog post Author info', 'blacksilver' ),
			'section'   => 'blacksilver_blog_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'postsingle_date',
			'label'     => esc_html__( 'Blog post Date', 'blacksilver' ),
			'section'   => 'blacksilver_blog_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'postsingle_tags',
			'label'     => esc_html__( 'Blog post Tags', 'blacksilver' ),
			'section'   => 'blacksilver_blog_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'postsingle_categories',
			'label'     => esc_html__( 'Blog post Categories', 'blacksilver' ),
			'section'   => 'blacksilver_blog_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'postsingle_comment',
			'label'     => esc_html__( 'Blog post Comment Info', 'blacksilver' ),
			'section'   => 'blacksilver_blog_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'postsingle_navigation',
			'label'     => esc_html__( 'Blog post Navigation', 'blacksilver' ),
			'section'   => 'blacksilver_blog_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'postformat_fullcontent',
			'label'     => esc_html__( 'Display full contents in archive', 'blacksilver' ),
			'section'   => 'blacksilver_blog_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'postformat_no_comments',
			'label'     => esc_html__( 'Display Comment are Closed Notice', 'blacksilver' ),
			'section'   => 'blacksilver_blog_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'blog_category_style',
			'label'    => esc_html__( 'Blog category listing style', 'blacksilver' ),
			'section'  => 'blacksilver_blog_section',
			'default'  => 'grid',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'default' => esc_html__( 'Default', 'blacksilver' ),
				'grid'    => esc_html__( 'Grid', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'slider',
			'settings' => 'blog_grid_achivestyle',
			'label'    => esc_html__( 'Blog category grid columns', 'blacksilver' ),
			'section'  => 'blacksilver_blog_section',
			'default'  => '3',
			'priority' => 10,
			'choices'  => array(
				'min'  => 1,
				'max'  => 4,
				'step' => 1,
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'author_bio',
			'label'     => esc_html__( 'Display author bio', 'blacksilver' ),
			'section'   => 'blacksilver_blog_section',
			'default'   => false,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'read_more',
			'label'    => esc_html__( 'Readmore text', 'blacksilver' ),
			'section'  => 'blacksilver_blog_section',
			'default'  => 'Continue Reading',
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'postnavigation_prev',
			'label'    => esc_html__( 'Post navigation Prev text', 'blacksilver' ),
			'section'  => 'blacksilver_blog_section',
			'default'  => 'Prev',
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'postnavigation_next',
			'label'    => esc_html__( 'Post navigation Next text', 'blacksilver' ),
			'section'  => 'blacksilver_blog_section',
			'default'  => 'Next',
			'priority' => 10,
		)
	);

	//Shop
	blacksilver_kirki_add_field(
		array(
			'type'        => 'toggle',
			'settings'    => 'enable_header_cart',
			'label'       => esc_html__( 'Enable header cart', 'blacksilver' ),
			'description' => esc_attr__( 'Enable header cart', 'blacksilver' ),
			'section'     => 'blacksilver_shop_options_section',
			'default'     => false,
			'priority'    => 10,
			'transport'   => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'        => 'toggle',
			'settings'    => 'hide_empty_cart',
			'label'       => esc_html__( 'Hide empty cart', 'blacksilver' ),
			'description' => esc_attr__( 'Hide empty cart', 'blacksilver' ),
			'section'     => 'blacksilver_shop_options_section',
			'default'     => false,
			'priority'    => 10,
			'transport'   => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'shop_page_layout',
			'label'    => esc_html__( 'Shop page layout', 'blacksilver' ),
			'section'  => 'blacksilver_shop_options_section',
			'default'  => 'fullwidth',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'fullwidth' => esc_html__( 'Fullwidth', 'blacksilver' ),
				'right'     => esc_html__( 'Sidebar Right', 'blacksilver' ),
				'left'      => esc_html__( 'Sidebar Left', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'shop_archive_layout',
			'label'    => esc_html__( 'Shop archive layout', 'blacksilver' ),
			'section'  => 'blacksilver_shop_options_section',
			'default'  => 'fullwidth',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'fullwidth' => esc_html__( 'Fullwidth', 'blacksilver' ),
				'right'     => esc_html__( 'Sidebar Right', 'blacksilver' ),
				'left'      => esc_html__( 'Sidebar Left', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'your_cart_text',
			'label'    => esc_html__( 'Toggle sidebar your cart text', 'blacksilver' ),
			'section'  => 'blacksilver_shop_options_section',
			'default'  => 'Your Cart',
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'cart_is_empty_text',
			'label'    => esc_html__( 'Toggle sidebar empty cart text', 'blacksilver' ),
			'section'  => 'blacksilver_shop_options_section',
			'default'  => 'Your cart is currently empty',
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'view_cart_button_text',
			'label'    => esc_html__( 'Toggle sidebar view cart text', 'blacksilver' ),
			'section'  => 'blacksilver_shop_options_section',
			'default'  => 'View Cart',
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'checkout_cart_button_text',
			'label'    => esc_html__( 'Toggle cidebar checkout text', 'blacksilver' ),
			'section'  => 'blacksilver_shop_options_section',
			'default'  => 'Checkout',
			'priority' => 10,
		)
	);

	// Dashcart
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_header_qty_indicator_background',
			'label'     => esc_html__( 'Header qty indicator background', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.header-cart .item-count',
					'property' => 'background',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_header_qty_indicator_text',
			'label'     => esc_html__( 'Header qty indicator text', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.header-cart .item-count',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_cart_close_icon',
			'label'     => esc_html__( 'Dash cart close icon', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.header-cart-close',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_background',
			'label'     => esc_html__( 'Dash cart background', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.mtheme-header-cart',
					'property' => 'background',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_title',
			'label'     => esc_html__( 'Dash cart title', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.mtheme-header-cart h3',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_item_title',
			'label'     => esc_html__( 'Dash cart item title', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.cart-elements .cart-title',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_item_qty',
			'label'     => esc_html__( 'Dash cart item qty', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.cart-elements .cart-item-quantity-wrap',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_item_buttons',
			'label'     => esc_html__( 'Dash cart buttons', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.cart-buttons a',
					'property' => 'border-color',
				),
				array(
					'element'  => '.cart-buttons a',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_item_buttons_hover',
			'label'     => esc_html__( 'Dash cart buttons hover', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.cart-buttons a:hover',
					'property' => 'border-color',
				),
				array(
					'element'  => '.cart-buttons a:hover',
					'property' => 'background',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'dashcart_item_buttons_hover_text',
			'label'     => esc_html__( 'Dash cart buttons hover text', 'blacksilver' ),
			'section'   => 'blacksilver_cart_dashbar_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.cart-buttons a:hover',
					'property' => 'color',
				),
			),
		)
	);


	// Lightbox
	blacksilver_kirki_add_field(
		array(
			'type'        => 'toggle',
			'settings'    => 'enable_gutenberg_lightbox',
			'label'       => esc_html__( 'Enable Lightbox for Gutenberg', 'blacksilver' ),
			'description' => esc_attr__( 'Adds Lightbox for Media File linked images and galleries in Gutenberg editor. Supports Alt text as title.', 'blacksilver' ),
			'section'     => 'blacksilver_lightbox_section',
			'default'     => false,
			'priority'    => 10,
			'transport'   => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'disable_lightbox_fullscreen',
			'label'     => esc_html__( 'Fullscreen', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'disable_lightbox_sizetoggle',
			'label'     => esc_html__( 'Sizing', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'disable_lightbox_download',
			'label'     => esc_html__( 'Download', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'disable_lightbox_zoomcontrols',
			'label'     => esc_html__( 'Zoom', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'disable_lightbox_autoplay',
			'label'     => esc_html__( 'Autoplay', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'disable_lightbox_count',
			'label'     => esc_html__( 'Count', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'toggle',
			'settings'  => 'disable_lightbox_title',
			'label'     => esc_html__( 'Title', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => true,
			'priority'  => 10,
			'transport' => 'auto',
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'lightbox_thumbnails_status',
			'label'    => esc_html__( 'Lightbox Thumbnails', 'blacksilver' ),
			'section'  => 'blacksilver_lightbox_section',
			'default'  => 'disable',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'disable' => esc_html__( 'Disable', 'blacksilver' ),
				'enable'  => esc_html__( 'Enable', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'select',
			'settings' => 'lightbox_transition',
			'label'    => esc_html__( 'Lightbox Transition', 'blacksilver' ),
			'section'  => 'blacksilver_lightbox_section',
			'default'  => 'lg-zoom-out',
			'priority' => 10,
			'multiple' => 1,
			'choices'  => array(
				'lg-slide'                    => esc_html__( 'Slide', 'blacksilver' ),
				'lg-fade'                     => esc_html__( 'Fade', 'blacksilver' ),
				'lg-zoom-in'                  => esc_html__( 'Zoom in', 'blacksilver' ),
				'lg-zoom-in-big'              => esc_html__( 'Zoom in Big', 'blacksilver' ),
				'lg-zoom-out'                 => esc_html__( 'Zoom Out', 'blacksilver' ),
				'lg-zoom-out-big'             => esc_html__( 'Zoom Out big', 'blacksilver' ),
				'lg-zoom-out-in'              => esc_html__( 'Zoom Out in', 'blacksilver' ),
				'lg-zoom-in-out'              => esc_html__( 'Zoom in Out', 'blacksilver' ),
				'lg-soft-zoom'                => esc_html__( 'Soft Zoom', 'blacksilver' ),
				'lg-scale-up'                 => esc_html__( 'Scale Up', 'blacksilver' ),
				'lg-slide-circular'           => esc_html__( 'Slide Circular', 'blacksilver' ),
				'lg-slide-circular-vertical'  => esc_html__( 'Slide Circular vertical', 'blacksilver' ),
				'lg-slide-vertical'           => esc_html__( 'Slide Vertical', 'blacksilver' ),
				'lg-slide-vertical-growth'    => esc_html__( 'Slide Vertical growth', 'blacksilver' ),
				'lg-slide-skew-only'          => esc_html__( 'Slide Skew only', 'blacksilver' ),
				'lg-slide-skew-only-rev'      => esc_html__( 'Slide Skew only reverse', 'blacksilver' ),
				'lg-slide-skew-only-y'        => esc_html__( 'Slide Skew only y', 'blacksilver' ),
				'lg-slide-skew-only-y-rev'    => esc_html__( 'Slide Skew only y reverse', 'blacksilver' ),
				'lg-slide-skew'               => esc_html__( 'Slide Skew', 'blacksilver' ),
				'lg-slide-skew-rev'           => esc_html__( 'Slide Skew reverse', 'blacksilver' ),
				'lg-slide-skew-cross'         => esc_html__( 'Slide Skew cross', 'blacksilver' ),
				'lg-slide-skew-cross-rev'     => esc_html__( 'Slide Skew cross reverse', 'blacksilver' ),
				'lg-slide-skew-ver'           => esc_html__( 'Slide Skew vertically', 'blacksilver' ),
				'lg-slide-skew-ver-rev'       => esc_html__( 'Slide Skew vertically reverse', 'blacksilver' ),
				'lg-slide-skew-ver-cross'     => esc_html__( 'Slide Skew vertically cross', 'blacksilver' ),
				'lg-slide-skew-ver-cross-rev' => esc_html__( 'Slide Skew vertically cross reverse', 'blacksilver' ),
				'lg-lollipop'                 => esc_html__( 'Lollipop', 'blacksilver' ),
				'lg-lollipop-rev'             => esc_html__( 'Lollipop reverse', 'blacksilver' ),
				'lg-rotate'                   => esc_html__( 'Rotate', 'blacksilver' ),
				'lg-rotate-rev'               => esc_html__( 'Rotate reverse', 'blacksilver' ),
				'lg-tube'                     => esc_html__( 'Tube', 'blacksilver' ),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'     => 'text',
			'settings' => 'lightbox_purchase_text',
			'label'    => esc_html__( 'Purchase link text', 'blacksilver' ),
			'section'  => 'blacksilver_lightbox_section',
			'default'  => 'Purchase',
			'priority' => 10,
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'lightbox_bgcolor',
			'label'     => esc_html__( 'Lightbox background color', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.mtheme-lightbox.lg-outer',
					'property' => 'background-color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'lightbox_elementbgcolor',
			'label'     => esc_html__( 'Lightbox element colors', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.mtheme-lightbox #lg-counter,.mtheme-lightbox #lg-counter, .mtheme-lightbox .lg-sub-html, .mtheme-lightbox .lg-toolbar .lg-icon, .mtheme-lightbox .lg-actions .lg-next, .mtheme-lightbox .lg-actions .lg-prev',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'lightbox_titlecolor',
			'label'     => esc_html__( 'Lightbox Title', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => 'body .mtheme-lightbox .lg-sub-html,body .mtheme-lightbox .lg-sub-html h4',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'lightbox_descriptioncolor',
			'label'     => esc_html__( 'Lightbox Description', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => 'body .mtheme-lightbox .entry-content',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'lightbox_purchasecolor',
			'label'     => esc_html__( 'Lightbox Purchase Link', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => 'body .lightbox-purchase > a',
					'property' => 'color',
				),
				array(
					'element'  => 'body .lightbox-purchase > a',
					'property' => 'border-color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'lightbox_purchasecolorhover',
			'label'     => esc_html__( 'Lightbox Purchase Link Hover', 'blacksilver' ),
			'section'   => 'blacksilver_lightbox_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => 'body .lightbox-purchase > a:hover',
					'property' => 'color',
				),
				array(
					'element'  => 'body .lightbox-purchase > a:hover',
					'property' => 'border-color',
				),
			),
		)
	);

	// Sidebars
	for ( $sidebar_count = 1; $sidebar_count <= 50; $sidebar_count++ ) {

		blacksilver_kirki_add_field(
			array(
				'type'        => 'text',
				'settings'    => 'mthemesidebar-' . $sidebar_count,
				'label'       => esc_attr__( 'Sidebar Name ', 'blacksilver' ) . $sidebar_count,
				'description' => esc_attr__( 'Activate extra sidebar widget. Enter name', 'blacksilver' ),
				'section'     => 'blacksilver_addsidebar_section',
				'priority'    => 10,
				'default'     => '',
			)
		);
	}
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'sidebar_headingcolor',
			'label'     => esc_html__( 'Sidebar Headings', 'blacksilver' ),
			'section'   => 'blacksilver_sidebarcolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.sidebar h3,.sidebar .product-title, .sidebar .woocommerce ul.product_list_widget li a, #events_list .recentpost_info .recentpost_title, #recentposts_list .recentpost_info .recentpost_title, #popularposts_list .popularpost_info .popularpost_title',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'sidebar_linkcolor',
			'label'     => esc_html__( 'Sidebar Links', 'blacksilver' ),
			'section'   => 'blacksilver_sidebarcolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '#recentposts_list .recentpost_info .recentpost_title, #popularposts_list .popularpost_info .popularpost_title,.sidebar a',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'sidebar_textcolor',
			'label'     => esc_html__( 'Sidebar Text', 'blacksilver' ),
			'section'   => 'blacksilver_sidebarcolors_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.contact_address_block .about_info, .sidebar-widget #searchform input, .sidebar-widget #searchform i, #recentposts_list p, #popularposts_list p,.sidebar-widget ul#recentcomments li,.sidebar',
					'property' => 'color',
				),
			),
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'     => 'toggle',
			'settings' => 'theme_footer',
			'label'    => esc_html__( 'Page Footer', 'blacksilver' ),
			'section'  => 'blacksilver_footer_section',
			'default'  => true,
			'priority' => 10,
		)
	);
	// Footers
	blacksilver_kirki_add_field(
		array(
			'type'        => 'textarea',
			'settings'    => 'footer_copyright',
			'label'       => esc_html__( 'Footer Text', 'blacksilver' ),
			'description' => esc_attr__( 'Use [theme_display_current_year] to display current year', 'blacksilver' ),
			'section'     => 'blacksilver_footer_section',
			'priority'    => 10,
			'default'     => 'Copyright 2020',
		)
	);

	// Footer Padding Top
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'settings'        => 'responsive_footer_padding_top',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Footer Padding Top', 'blacksilver' ),
			'section'         => 'blacksilver_footer_section',
			'default'         => '40',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.footer-outer-wrap #copyright',
					'property' => 'padding-top',
					'units'    => 'px',
				),
			),
		)
	);

	// Footer Padding Bottom
	blacksilver_kirki_add_field(
		array(
			'type'            => 'slider',
			'settings'        => 'responsive_footer_padding_bottom',
			'active_callback' => 'blacksilver_choice_menu_is_not_vertical_callback',
			'label'           => esc_html__( 'Footer Padding Bottom', 'blacksilver' ),
			'section'         => 'blacksilver_footer_section',
			'default'         => '40',
			'priority'        => 10,
			'choices'         => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
			'transport'       => 'auto',
			'output'          => array(
				array(
					'element'  => '.footer-outer-wrap #copyright',
					'property' => 'padding-bottom',
					'units'    => 'px',
				),
			),
		)
	);

	// Footers
	blacksilver_kirki_add_field(
		array(
			'type'            => 'textarea',
			'settings'        => 'vertical_footer_copyright',
			'active_callback' => 'blacksilver_choice_menu_is_vertical_callback',
			'label'           => esc_html__( 'Vertical Menu Footer Text', 'blacksilver' ),
			'description'     => esc_attr__( 'Use [theme_display_current_year] to display current year', 'blacksilver' ),
			'section'         => 'blacksilver_footer_section',
			'priority'        => 10,
			'default'         => 'Copyright 2019',
		)
	);

	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'footer_background',
			'label'     => esc_html__( 'Footer Background', 'blacksilver' ),
			'section'   => 'blacksilver_footer_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '#copyright,.footer-outer-wrap',
					'property' => 'background',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'footer_textcolor',
			'label'     => esc_html__( 'Footer text', 'blacksilver' ),
			'section'   => 'blacksilver_footer_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.footer-container-column .sidebar-widget .mc4wp-form input[type="submit"],.footer-container-column .sidebar-widget .mc4wp-form input,.footer-container-column label,.horizontal-footer-copyright,.footer-container-column .sidebar-widget .contact_address_block span:before,.footer-container-column .sidebar-widget .footer-widget-block #searchform i,.footer-container-column .sidebar-widget .footer-widget-block.widget_search #searchform input,.sidebar-widget .footer-widget-block.widget_search #searchform input,.footer-container-column table td,.footer-container-column .contact_name,.sidebar-widget .footer-widget-block,.footer-container-column .wp-caption p.wp-caption-text,.footer-widget-block,.footer-container-column .footer-widget-block strong,.footer-container-wrap,#copyright,#footer .social-header-wrap,#footer .social-header-wrap ul li.contact-text a,.footer-container-wrap .sidebar-widget,.footer-container-wrap .opening-hours dt.week',
					'property' => 'color',
				),
				array(
					'element'  => '.footer-container-column #wp-calendar caption,.footer-container-column #wp-calendar thead th,.footer-container-column #wp-calendar tfoot',
					'property' => 'background-color',
				),
				array(
					'element'  => '.footer-container-column .sidebar-widget .mc4wp-form input[type="submit"],.footer-container-column .sidebar-widget .mc4wp-form input,.footer-container-column input,.footer-container-column #wp-calendar tbody td,.sidebar-widget .footer-widget-block.widget_search #searchform input',
					'property' => 'border-color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'footer_headingcolor',
			'label'     => esc_html__( 'Footer Headings', 'blacksilver' ),
			'section'   => 'blacksilver_footer_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '.footer-container-column .sidebar-widget h1,.footer-container-column .sidebar-widget h2,.footer-container-column .sidebar-widget h3,.footer-container-column .sidebar-widget h4,.footer-container-column .sidebar-widget h5,.footer-container-column .sidebar-widget h6',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'footer_link',
			'label'     => esc_html__( 'Footer links', 'blacksilver' ),
			'section'   => 'blacksilver_footer_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '#copyright .horizontal-footer-copyright a,.footer-container-column .sidebar-widget .social-header-wrap ul li.contact-text i,.footer-container-column .sidebar-widget .social-header-wrap ul li.social-icon i,.sidebar-widget .footer-widget-block a,.footer-container-wrap a,#copyright a,.footer-widget-block a,.footer-container-column .sidebar-widget .product-title,.footer-container-column .sidebar-widget .woocommerce ul.product_list_widget li a,.footer-container-column #events_list .recentpost_info .recentpost_title,.footer-container-column #recentposts_list .recentpost_info .recentpost_title,.footer-container-column #popularposts_list .popularpost_info .popularpost_title',
					'property' => 'color',
				),
			),
		)
	);
	blacksilver_kirki_add_field(
		array(
			'type'      => 'color',
			'settings'  => 'footer_linkhover',
			'label'     => esc_html__( 'Footer link hover', 'blacksilver' ),
			'section'   => 'blacksilver_footer_section',
			'default'   => '',
			'priority'  => 10,
			'transport' => 'auto',
			'output'    => array(
				array(
					'element'  => '#copyright .horizontal-footer-copyright a:hover,.footer-container-wrap a:hover,#copyright a:hover,.footer-widget-block a:hover,.sidebar-widget .footer-widget-block a:hover',
					'property' => 'color',
				),
			),
		)
	);
}
