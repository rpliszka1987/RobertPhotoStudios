<?php
namespace ImaginemBlocks\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Imaginem Blocks
 *
 * Elementor widget for Imaginem Blocks.
 *
 * @since 1.0.0
 */
class Events_Info extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'events-info';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Events Info', 'imaginem-blocks' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-meta-data';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'imaginem-elements' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Events Info', 'imaginem-blocks' ),
			]
		);

		$this->add_control(
			'when',
			[
				'type' => 'select',
				'group_title' => 'Properties',
				'label' => __('Display When', 'imaginem-blocks'),
				'desc' => __('Display When', 'imaginem-blocks'),
				'options' => [
					'true' => __('Yes','imaginem-blocks'),
					'false' => __('No','imaginem-blocks')
				],
				'default'=>'true',
			]
		);
		$this->add_control(
			'when_date',
			[
				'type' => 'select',
				'group_title' => 'Properties',
				'label' => __('Display Date', 'imaginem-blocks'),
				'desc' => __('Display Date', 'imaginem-blocks'),
				'options' => [
					'true' => __('Yes','imaginem-blocks'),
					'false' => __('No','imaginem-blocks')
				],
				'default'=>'true',
			]
		);
		$this->add_control(
			'when_time',
			[
				'type' => 'select',
				'group_title' => 'Properties',
				'label' => __('Display Time', 'imaginem-blocks'),
				'desc' => __('Display Time', 'imaginem-blocks'),
				'options' => [
					'true' => __('Yes','imaginem-blocks'),
					'false' => __('No','imaginem-blocks')
				],
				'default'=>'true',
			]
		);

		$this->add_control(
		    'when_text',
			[
		        'type' => Controls_Manager::TEXT,
		        'label' => __('When Text', 'imaginem-blocks'),
				'default' => __( 'When', 'imaginem-blocks' ),
				'placeholder' => __( 'When', 'imaginem-blocks' ),
				'label_block' => true,
		    ]
		);

		$this->add_control(
			'when_icon',
			[
				'label' => __( 'When Icon', 'imaginem-blocks' ),
				'type' => Controls_Manager::ICON,
				'options' => mtheme_elementor_icons(),
				'default' => 'ion-ios-clock',
			]
		);

		$this->add_control(
			'where',
			[
				'type' => 'select',
				'group_title' => 'Properties',
				'label' => __('Display Where', 'imaginem-blocks'),
				'desc' => __('Display Where', 'imaginem-blocks'),
				'options' => [
					'true' => __('Yes','imaginem-blocks'),
					'false' => __('No','imaginem-blocks')
				],
				'default'=>'true',
				'separator' => 'before',
			]
		);

		$this->add_control(
		    'where_text',
			[
		        'type' => Controls_Manager::TEXT,
		        'label' => __('Where Text', 'mthemelocal'),
				'default' => __( 'Where', 'imaginem-blocks' ),
				'placeholder' => __( 'Where', 'imaginem-blocks' ),
				'label_block' => true,
		    ]
		);

		$this->add_control(
			'where_icon',
			[
				'label' => __( 'When Icon', 'imaginem-blocks' ),
				'type' => Controls_Manager::ICON,
				'options' => mtheme_elementor_icons(),
				'default' => 'ion-ios-location',
			]
		);

		$this->add_control(
			'cost',
			[
				'type' => 'select',
				'group_title' => 'Properties',
				'label' => __('Display Cost', 'imaginem-blocks'),
				'desc' => __('Display Cost', 'imaginem-blocks'),
				'options' => [
					'true' => __('Yes','imaginem-blocks'),
					'false' => __('No','imaginem-blocks')
				],
				'default'=>'true',
				'separator' => 'before',
			]
		);

		$this->add_control(
		    'cost_text',
			[
		        'type' => Controls_Manager::TEXT,
		        'label' => __('Cost Text', 'imaginem-blocks'),
				'default' => __( 'Cost', 'imaginem-blocks' ),
				'placeholder' => __( 'Cost', 'imaginem-blocks' ),
				'label_block' => true,
		    ]
		);

		$this->add_control(
			'cost_icon',
			[
				'label' => __( 'When Icon', 'imaginem-blocks' ),
				'type' => Controls_Manager::ICON,
				'options' => mtheme_elementor_icons(),
				'default' => 'ion-ios-pricetag',
			]
		);

		$this->add_control(
			'status',
			[
				'type' => 'select',
				'group_title' => 'Status',
				'label' => __('Display Status', 'imaginem-blocks'),
				'desc' => __('Display Status', 'imaginem-blocks'),
				'options' => [
					'false' => __('No','imaginem-blocks'),
					'true' => __('Yes','imaginem-blocks')
				],
				'default'=>'true',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'imaginem-blocks' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}} .events-details-wrap .event-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'imaginem-blocks' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'.entry-content {{WRAPPER}} .events-details-wrap .event-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}} .events-details-wrap .event-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '.entry-content {{WRAPPER}} .events-details-wrap .event-heading',
			]
		);

		$this->add_control(
			'info_color',
			[
				'label' => __( 'Info Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}} .events-details-wrap ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '.entry-content {{WRAPPER}} .events-details-wrap ul li',
			]
		);


		$this->add_control(
			'info_link_color',
			[
				'label' => __( 'Info Link Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}} .events-details-wrap a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'info_link_hover_color',
			[
				'label' => __( 'Info Link Hover Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}} .events-details-wrap a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'event_status_bg',
			[
				'label' => __( 'Event Status Background', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}} .event-status' => 'background: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'event_status_text',
			[
				'label' => __( 'Event Status Text', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}} .event-status' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'event_status_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '.entry-content {{WRAPPER}} .event-status',
			]
		);


		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();

		$shortcode = '[eventinfobox status="'.$settings['status'].'" when="'.$settings['when'].'" when_date="'.$settings['when_date'].'" when_time="'.$settings['when_time'].'" when_text="'.htmlspecialchars($settings['when_text']).'" when_icon="'.$settings['when_icon'].'" where="'.$settings['where'].'" where_text="'.htmlspecialchars($settings['where_text']).'" where_icon="'.$settings['where_icon'].'" cost="'.$settings['cost'].'" cost_text="'.htmlspecialchars($settings['cost_text']).'" cost_icon="'.$settings['cost_icon'].'"]';

		echo do_shortcode($shortcode);
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$widgets[ $this->get_name() ] = [
			'conditions' => [ 'widgetType' => $this->get_name() ],
			'fields'     => [
				[
					'field'       => 'when_text',
					'type'        => __( 'When Text', 'imaginem-blocks' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'where_text',
					'type'        => __( 'Where Text', 'imaginem-blocks' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'cost_text',
					'type'        => __( 'Cost Text', 'imaginem-blocks' ),
					'editor_type' => 'LINE'
				],
			],
		];
		return $widgets;
	}
}
