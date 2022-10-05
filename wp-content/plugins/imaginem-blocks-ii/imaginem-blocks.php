<?php
/**
 * Plugin Name: Imaginem Blocks II
 * Description: Imaginem Blocks II
 * Plugin URI:  http://support.imaginemthemes.co/
 * Version:     1.6.3
 * Author:      iMaginem
 * Author URI:  http://support.imaginemthemes.co/
 * Text Domain: imaginem-blocks
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'Imaginem_Blocks__FILE__', __FILE__ );

/**
 * Load Imaginem Blocks
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function themecore_Imaginem_Blocks_load() {
	// Load localization file
	load_plugin_textdomain( 'imaginem-blocks' );
    require( __DIR__ . '/theme-core.php' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		//add_action( 'admin_notices', 'Imaginem_Blocks_fail_load' );
		return;
	}

	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'themecore_Imaginem_Blocks_fail_load_out_of_date' );
		return;
	}

	// Require the main plugin file
    require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'themecore_Imaginem_Blocks_load' );


function themecore_Imaginem_Blocks_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Elementor Imaginem Blocks is not working because you are using an old version of Elementor.', 'imaginem-blocks' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'imaginem-blocks' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

// Add Control switch Parallax.
function themecore_add_elementor_section_background_controls( \Elementor\Element_Section $section ) {

    $section->add_control(
        'mtheme_section_parallax',
        [
            'label' => __( 'Parallax <br/>For non-dynamic background.<br/>Disables Size/Position', 'imaginem-blocks' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_off' => __( 'Off', 'imaginem-blocks' ),
            'label_on' => __( 'On', 'imaginem-blocks' ),
            'default' => 'no',
        ]
    );
}

add_action( 'elementor/element/section/section_background/before_section_end', 'themecore_add_elementor_section_background_controls' );


// Render backgrou]d parallax to column
function themecore_elementor_section_parallax_background( \Elementor\Element_Base $element ) {
    
    if('section' === $element->get_name()){

        if ( 'yes' === $element->get_settings( 'mtheme_section_parallax' ) ) {

            $add_parallax = true;
            $dynamic_settings = $element->get_settings( '__dynamic__' );
            if ( isset( $dynamic_settings) ) {
                if ( array_key_exists('background_image', $dynamic_settings) ) {
                    $add_parallax = false;
                }
            }
            if ( $add_parallax ) {
                $mtheme_background = $element->get_settings( 'background_image' );
                $mtheme_background_URL = $mtheme_background['url'];

                if ( '' !== $mtheme_background_URL ) {
                    $element->add_render_attribute( '_wrapper', [
                        'class' => 'jarallax',
                        'data-jarallax' => '',
                        'data-speed' => '0.75',
                        'data-type' => 'scroll',
                        'data-parallax' => 'scroll',
                        'style' => 'background-image:url("'.$mtheme_background_URL.'");',
                        'data-image-src' => $mtheme_background_URL,
                    ]);
                }
            }
        }
    }
}
if ( !wp_is_mobile() ) {
    add_action( 'elementor/frontend/section/before_render', 'themecore_elementor_section_parallax_background' );
}

// Bottom of section
if ( ! function_exists( 'themecore_add_custom_controls_elem_page_settings_bottom' ) ) {
    function themecore_add_custom_controls_elem_page_settings_bottom( \Elementor\Core\DocumentTypes\Post $page )
    {

        if(isset($page) && $page->get_id() > "") {
            $mtheme_post_type = false;
            $mtheme_post_type = get_post_type($page->get_id());
            if ($mtheme_post_type == 'page') {

                $page->add_control(
                    'pagemeta_pagestyle',
                    [
                        'label' => __( 'Sidebar', 'imaginem-blocks' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'edge-to-edge',
                        'options' => [
                            'leftsidebar'   => __( 'Left', 'imaginem-blocks' ),
                            'nosidebar'     => __( 'No Sidebar', 'imaginem-blocks' ),
                            'rightsidebar'  => __( 'Right', 'imaginem-blocks' ),
                            'edge-to-edge'  => __( 'Edge to Edge', 'imaginem-blocks' ),
                        ],
                    ]
                );
            }
        }

    }
}
//add_action( 'elementor/element/post/document_settings/before_section_end', 'themecore_add_custom_controls_elem_page_settings_bottom',10, 2);

if ( ! function_exists( 'themecore_setup_elementor_settings_for_theme' ) ) {
    function themecore_setup_elementor_settings_for_theme()
    {

        $elementor_style_settings = get_theme_mod( 'elementor_style_settings' );

        if ( 'keep' !== $elementor_style_settings ) {
            // Disable color schemes
            $elementor_disable_color_schemes = get_option('elementor_disable_color_schemes');
            if ( empty($elementor_disable_color_schemes) && $elementor_disable_color_schemes<>'yes' ) {
                update_option('elementor_disable_color_schemes', 'yes');
            }

            // Disable typography schemes
            $elementor_disable_typography_schemes = get_option('elementor_disable_typography_schemes');
            if ( empty($elementor_disable_typography_schemes) && $elementor_disable_typography_schemes<>'yes' ) {
                update_option('elementor_disable_typography_schemes', 'yes');
            }
        }

        //  Elementor Custom Post types.
        $elementor_cpt_support = get_option('elementor_cpt_support');
        if (empty($elementor_cpt_support)) {
            $elementor_cpt_support = array();
        }

        if (!in_array("page", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"page");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }
        if (!in_array("post", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"post");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }
        if (!in_array("events", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"events");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }
        if (!in_array("portfolio", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"portfolio");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }
        if (!in_array("proofing", $elementor_cpt_support)) {
            array_push($elementor_cpt_support,"proofing");
            update_option('elementor_cpt_support', $elementor_cpt_support);
        }

    }
}
// Add a custom category for panel widgets
add_action( 'elementor/init', 'themecore_setup_elementor_settings_for_theme' );

function themecore_elementor_categories($types) {

    if ( 'types' === $types ) {
        $the_list = get_terms('types');
    }
    if ( 'proofingsection' === $types ) {
        $the_list = get_terms('proofingsection');
    }
    if ( 'eventsection' === $types ) {
        $the_list = get_terms('eventsection');
    }
    if ( 'blog' === $types ) {
        $the_list = get_categories();
    }

    if ($the_list) {
        $portfolio_categories=array();
        //$portfolio_categories[0]="All the items";
        foreach($the_list as $key => $list) {
            if (isSet($list->slug)) {
                $portfolio_categories[$list->slug] = $list->name;
            }
        }
    } else {
        $portfolio_categories[0]="Categories Not Found.";
    }
    return $portfolio_categories;
}

require( __DIR__ . '/includes/font-data.php' );

add_action( 'elementor/element/column/section_advanced/after_section_end', 'themecore_add_rellax_controls' ); 
/**
 * Callback for the above action hook, is passed the instance of an Elementor Element
 * (which extends \Elementor\Element_Base) for whose section you
 * want to add additional controls.
 */
function themecore_add_rellax_controls( \Elementor\Element_Base $element) {
	// Create our own custom control section
	$element->start_controls_section(
		'section_rellax',
		[
			'label' => __( 'Rellax', 'imaginem-blocks' ),
			// Place our section in the Style Tab
			'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
		]
	);

	/*
	 * Since there must be at least one item of a Repeater control (you can't delete the last 
	 * item according to how the Elementor UI is set up), this control allows you to say that 
	 * you don't want the Sectino or Column to have any spacing properties.
	 */
	$element->add_control(
		'enable_rellax',
		[
			'label' => __( 'Enable Rellax', 'mld' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'description' => __( 'Uncheck this switch if you want to disable Rellax.', 'imaginem-blocks' ),
            'label_off' => __( 'Off', 'imaginem-blocks' ),
            'label_on' => __( 'On', 'imaginem-blocks' ),
            'default' => 'no',
		]
	);

    $element->add_control(
        'rellax_speed',
        [
            'label' => __( 'Speed', 'imaginem-blocks' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -10,
                    'max' => 10,
                    'step' => 0.1,
                ],
            ],
        ]
    );

	$element->end_controls_section();
};

add_action( 'elementor/frontend/column/before_render', 'themecore_before_render_column' );
function themecore_before_render_column( \Elementor\Element_Base $element ) {

	$class_name        = get_class( $element );
	$settings          = $element->get_settings();
	$rellax_speed_data = $element->get_settings( 'rellax_speed' );
	$rellax_speed      = $rellax_speed_data['size'];

	if ( 'yes' === $settings['enable_rellax'] ) {
		$element->add_render_attribute(
			'_wrapper',
			[
				'class' => 'rellax',
				'data-rellax-speed' => $rellax_speed,
			]
		);
	}

}
