<?php
namespace ImaginemBlocks\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor icon box widget.
 *
 * Elementor widget that displays an icon, a headline and a text.
 *
 * @since 1.0.0
 */
class Swiper_Slides extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'swiper-slides';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Swiper Slides', 'imaginem-blocks' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-info-box';
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
		return [ 'imaginem-media' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'swiper'];
		//return [ 'jarallax', 'parallaxi' ];
	}

	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the element requires.
	 *
	 * @since 1.9.0
	 * @access public
	 *
	 * @return array Element styles dependencies.
	 */
	public function get_style_depends() {
		return [ 'swiper'];
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
			'section_content',
			[
				'label' => __( 'Swiper Slideshow', 'imaginem-blocks' ),
			]
		);


		$this->add_control(
			'wp_gallery',
			[
				'label' => __( 'Add Images', 'imaginem-blocks' ),
				'type' => Controls_Manager::GALLERY,
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'imaginem-blocks' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'4' => __( '4', 'imaginem-blocks' ),
					'3' => __( '3', 'imaginem-blocks' ),
					'2' => __( '2', 'imaginem-blocks' ),
					'1' => __( '1', 'imaginem-blocks' ),
				],
				'default' => '2',
			]
		);

		$this->add_control(
		'autoplay',
		[
			'default' => '5000',
			'type' => 'text',
			'label' => __('Autoplay Interval', 'imaginem-blocks'),
			'desc' => __('Autoplay Interval ( 5000 default)', 'imaginem-blocks'),
		]
		);

		$this->add_control(
		'lightbox',
		[
			'type' => 'select',
			'label' => __('Lightbox Activate', 'imaginem-blocks'),
			'desc' => __('Lightbox Activate', 'imaginem-blocks'),
			'options' => [
				'false' => __('No','imaginem-blocks'),
				'true' => __('Yes','imaginem-blocks')
			],
			'default'=>'false',
		]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'imaginem-blocks' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 500,
						'max' => 4000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'imaginem-blocks' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'carouselpagination',
			[
				'label' => __( 'Pagination Dots', 'imaginem-blocks' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'yes' => __( 'Yes', 'imaginem-blocks' ),
					'no' => __( 'No', 'imaginem-blocks' ),
				],
				'default' => 'yes',
				'prefix_class' => 'carousel-dots-',
			]
		);

		$this->add_control(
			'paginationcolor',
			[
				'label' => __( 'Pagination Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-dot span' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'paginationcoloractive',
			[
				'label' => __( 'Pagination Active Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-dot.active span' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'arrowshape',
			[
				'label' => __( 'Arrow', 'imaginem-blocks' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'imaginem-blocks' ),
					'circle' => __( 'Circle', 'imaginem-blocks' ),
					'square' => __( 'Square', 'imaginem-blocks' ),
				],
				'default' => 'default',
				'separator' => 'before',
				'prefix_class' => 'carousel-arrow-shape-',
			]
		);

		$this->add_control(
			'arrowbackground',
			[
				'label' => __( 'Arrow Background Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-next,{{WRAPPER}} .owl-prev' => 'background: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);
		$this->add_control(
			'arrow',
			[
				'label' => __( 'Arrow Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-next,{{WRAPPER}} .owl-prev' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slideshow-owl-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Title Typography', 'imaginem-blocks' ),
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .slideshow-owl-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'title_backgroundcolor',
			[
				'label' => __( 'Title Background Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .slideshow-owl-title' => 'background-color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
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

		if ( ! $settings['wp_gallery'] ) {
			return;
		}

		$ids = wp_list_pluck( $settings['wp_gallery'], 'id' );
		$pb_image_ids = implode( ',', $ids );


		$shortcode = '[swiperslides columns="'.$settings['columns'].'" autoplay="'.$settings['autoplay'].'" lightbox="'.$settings['lightbox'].'" pb_image_ids="'.$pb_image_ids.'"]';

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