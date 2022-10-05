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
class Post_Heading extends Widget_Base {

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
		return 'post-heading';
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
		return __( 'Post Heading', 'imaginem-blocks' );
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
		return 'eicon-post-title';
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
				'label' => __( 'Section Heading', 'imaginem-blocks' ),
			]
		);

		$this->add_control(
			'headingstyle',
			[
				'label' => __( 'Section Style', 'imaginem-blocks' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default','mthemelocal'),
					'subtitle' => __('Date - Title','mthemelocal'),
					'title' => __('Title - Date','mthemelocal'),
					'titleonly' => __('Title','mthemelocal')
				],
				'default' => 'default',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'imaginem-blocks' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'imaginem-blocks' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'imaginem-blocks' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'imaginem-blocks' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'imaginem-blocks' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => '',
				'prefix_class' => 'section-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'imaginem-blocks' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'titlewidth',
			[
				'label' => __( 'Title Width', 'imaginem-blocks' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .section-title' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1400,
					],
				],
			]
		);

		$this->add_control(
			'descriptionwidth',
			[
				'label' => __( 'Description Width', 'imaginem-blocks' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .section-description-inner' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1400,
					],
				],
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
			'title_color',
			[
				'label' => __( 'Title Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}}.elementor-widget-post-heading .section-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Subtitle Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}}.elementor-widget-post-heading .section-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Description Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid post style from overwriting
					'.entry-content {{WRAPPER}}.elementor-widget-post-heading .section-description' => 'color: {{VALUE}};',
					'.entry-content {{WRAPPER}}.elementor-widget-post-heading .section-description p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '.entry-content {{WRAPPER}}.elementor-widget-post-heading .section-title',
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

		$shortcode = '[postheading headingstyle="'.$settings['headingstyle'].'"]';

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
}
