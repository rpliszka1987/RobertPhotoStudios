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
class Team_Member extends Widget_Base {

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
		return 'team-member';
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
		return __( 'Team Member', 'imaginem-blocks' );
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
		return 'eicon-person';
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
			'section_content',
			[
				'label' => __( 'Team Member', 'imaginem-blocks' ),
			]
		);


		$this->add_control(
		'member_image',
		[	
			'std' => '',
			'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
		]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'imaginem-blocks' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'square' => __( 'Square', 'imaginem-blocks' ),
					'circle' => __( 'Circle', 'imaginem-blocks' ),
				],
				'default' => 'square',
				'condition' => [
					'member_image!' => '',
				],
				'prefix_class' => 'team-image-shape-',
			]
		);

		$this->add_control(
		'title',
		[	
			'std' => '',
			'type' => Controls_Manager::TEXT,
			'group_title' => 'Content',
			'label' => __('Staff title', 'imaginem-blocks'),
		]
		);
		$this->add_control(
		'name',
		[	
			'std' => '',
			'type' => Controls_Manager::TEXT,
			'label' => __('Staff name', 'imaginem-blocks'),
		]
		);
		$this->add_control(
		'description',
		[	
			'std' => '',
			'type' => Controls_Manager::TEXTAREA,
			'label' => __('Staff Description', 'imaginem-blocks'),
		]
		);

		$this->add_responsive_control(
			'text_align',
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
				'selectors' => [
					'{{WRAPPER}} .person-details' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
		'socialicons',
		[	
			'type' => Controls_Manager::SELECT,
			'label' => __('Display social icons', 'imaginem-blocks'),
			'desc' => __('Display social icons', 'imaginem-blocks'),
			'options' => [
				'true' => __('Yes','imaginem-blocks'),
				'false' => __('No','imaginem-blocks')
			],
			'default' => 'false',
			'prefix_class' => 'social-icons-active-',
		]
		);

		$this->add_control(
			'social',
			[
				'label' => __( 'Social Icons', 'imaginem-blocks' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'url' => 'http://your-link.com'
					]
				],
				'fields' => [
					[
						'name' => 'icon',
						'label' => __( 'Icon', 'imaginem-blocks' ),
						'type' => Controls_Manager::ICON,
                        'label_block' => true,
                        'default' => 'fa fa-facebook',
						'options' => mtheme_elementor_icons(),
					],
					[
						'name' => 'url',
						'label' => __( 'Link URL', 'imaginem-blocks' ),
						'type' => Controls_Manager::URL,
						'placeholder' => 'http://your-link.com',
						'default' => [
							'url' => '',
						],
						'separator' => 'before',
						'label_block' => true,
					],
				],
				'title_field' => '<i class="{{ icon }}"></i> {{{ url.url }}}',
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
		    'iconcolor',
			[
				'label' => __('Icon color', 'imaginem-blocks'),
		        'std' => '',
		        'type' => Controls_Manager::COLOR,
		        'scheme' => [
		            'type' => Scheme_Color::get_type(),
		            'value' => Scheme_Color::COLOR_1,
		        ],
				'selectors' => [
					'{{WRAPPER}} .person.box-title i' => 'color: {{VALUE}};',
				],
		    ]
		);

		$this->add_control(
		    'iconhovercolor',
			[
				'label' => __('Icon hover color', 'imaginem-blocks'),
		        'std' => '',
		        'type' => Controls_Manager::COLOR,
		        'scheme' => [
		            'type' => Scheme_Color::get_type(),
		            'value' => Scheme_Color::COLOR_1,
		        ],
				'selectors' => [
					'{{WRAPPER}} .person-socials a:hover i' => 'color: {{VALUE}};',
				],
		    ]
		);

		$this->add_control(
		    'iconhoverbackground',
			[
				'label' => __('Icon hover background color', 'imaginem-blocks'),
		        'std' => '',
		        'type' => Controls_Manager::COLOR,
		        'scheme' => [
		            'type' => Scheme_Color::get_type(),
		            'value' => Scheme_Color::COLOR_1,
		        ],
				'selectors' => [
					'{{WRAPPER}} .person-socials a:hover' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .person h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .person h4.staff-position' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .person h4.staff-position',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'imaginem-blocks' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .person-desc' => 'color: {{VALUE}};',
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
				'label' => __( 'Description Typography', 'imaginem-blocks' ),
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .person-desc',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
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


		$child_shortcode = '';
		
		foreach( $settings['social'] as $socialprofile ) {
			$child_shortcode .= '[socials social_icon="'.$socialprofile['icon'].'" social_link="'.$socialprofile['url']['url'].'" social_target="'.$socialprofile['url']['is_external'].'"]';
		}

		$shortcode = '[staff title="'.htmlspecialchars($settings['title']).'" socialicons="'.$settings['socialicons'].'" name="'.htmlspecialchars($settings['name']).'" image="'.$settings['member_image']['url'].'"  imageid="'.$settings['member_image']['id'].'" image_size="'.$settings['image_size'].'" desc="'.htmlspecialchars($settings['description']).'"]'.$child_shortcode.'[/staff]';

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
					'field'       => 'title',
					'type'        => __( 'Staff Title', 'imaginem-blocks' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'name',
					'type'        => __( 'Staff Name', 'imaginem-blocks' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'description',
					'type'        => __( 'Staff Description', 'imaginem-blocks' ),
					'editor_type' => 'AREA'
				],
			],
		];
		return $widgets;
	}
}