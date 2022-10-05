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
class Em_Like_Status extends Widget_Base {

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
		return 'like-status';
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
		return __( 'Like Status', 'imaginem-blocks' );
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
		return 'eicon-heart-o';
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
				'label' => __( 'Like Status Page', 'imaginem-blocks' ),
			]
		);


		$this->add_control(
		'hidecount',
		[
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label' => __('Display Large', 'imaginem-blocks'),
			'label_on' => __( 'Show', 'your-plugin' ),
			'label_off' => __( 'Hide', 'your-plugin' ),
			'return_value' => 'yes',
			'prefix_class' => 'display-large-',
			'default' => 'no',
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
				'label' => __( 'Icon color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'.entry-content {{WRAPPER}} .like-status-container .like-vote-icon i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Hover icon color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'.entry-content {{WRAPPER}} .like-status-container .like-vote-icon:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'imaginem-blocks' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .like-status-container .like-vote-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'count_color',
			[
				'label' => __( 'Count color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'.entry-content {{WRAPPER}} .like-status-container .post-like-count' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'count_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '.entry-content {{WRAPPER}} .like-status-container .post-like-count',
			]
		);

		$this->add_responsive_control(
			'count_top',
			[
				'label' => __( 'Count Top', 'imaginem-blocks' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .like-status-container .post-like-count' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'count_right',
			[
				'label' => __( 'Count Right', 'imaginem-blocks' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .like-status-container .post-like-count' => 'right: {{SIZE}}{{UNIT}};',
				],
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

		if ( function_exists('blacksilver_display_like_link') ) {
			echo '<div class="like-status-container">';
			echo blacksilver_display_like_link( get_the_id() );
			echo '</div>';

		}
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
}
