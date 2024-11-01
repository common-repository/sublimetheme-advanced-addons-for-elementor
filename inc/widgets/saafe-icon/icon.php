<?php
/**
 * Icon Text Elementor Widget
 * 
 * @package SublimeTheme_Advanced_Addons_For_Elementor
 */

namespace SublimeTheme_Advanced_Addons_For_Elementor\Widgets;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

class SAAFE_Icon extends Widget_Base {
    public function get_name(){
		return 'saafe-icon';
	}

	public function get_title(){
		return esc_html__( 'Icon Text', 'sublimetheme-advanced-addons-for-elementor' );
	}

	public function get_icon(){
		return 'eicon-info-box';
	}

	public function get_categories(){
		return ['sublimetheme-advanced-addons-for-elementor'];
	}

    public function get_style_depends() {
        wp_register_style( 'saafe-icon', SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL . 'inc/widgets/saafe-icon/icon.css', array(), SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION );
        return ['saafe-icon'];
    }

    public function get_keywords()
    {
        return [
            'icon',
            'text',
            'icon text',
            'info',
            'box',
            'infobox',
            'info box',
            'sublime',
            'sublimetheme',
            'sublimetheme elements',
        ];
    }

    protected function register_controls(){
        /**
         * Icon Settings
         */
        $this->start_controls_section(
            'icon_settings',
            [
                'label' => esc_html__( 'Icon Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'icon_layout',
            [
                'label'   => esc_html__( 'Layouts', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'icon-on-top',
                'options' => [
                    'without-icon'  => esc_html__( 'Without Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                    'icon-on-top'   => esc_html__( 'Icon On Top', 'sublimetheme-advanced-addons-for-elementor' ),
                    'icon-on-left'  => esc_html__( 'Icon On Left', 'sublimetheme-advanced-addons-for-elementor' ),
                    'icon-on-right' => esc_html__( 'Icon On Right', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'icon_or_image',
            [
                'label'     => esc_html__( 'Image or Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'icon',
                'condition' => [
                    'icon_layout!' => 'without-icon',
                ],
                'label_block' => true,
                'options'     => [
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-info-circle-o',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-image-bold',
                    ],
                    'number' => [
                        'title' => esc_html__( 'Number', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-number-field',
                    ],
                ],                
            ]
        );

        $this->add_control(
            'icon_vertical_position',
            [
                'label'     => esc_html__( 'Icon Position', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'top',
                'condition' => [
                    'icon_layout' => [ 'icon-on-left', 'icon-on-right' ]
                ],
                'label_block' => true,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__( 'Middle', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors_dictionary' => [
                    'top'    => 'baseline',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder' => 'align-self: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_alignment',
            [
                'label'     => esc_html__( 'Alignment', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'left',
                'condition' => [
                    'icon_layout' => [ 'without-icon', 'icon-on-top' ]
                ],
                'label_block' => true,
                'options'     => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'   => esc_html__( 'Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-building',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'icon_or_image' => 'icon',
                    'icon_layout!'  => 'without-icon',
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => esc_html__( 'Image', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_or_image' => 'image',
                    'icon_layout!'  => 'without-icon',
                ],
            ]
        );

        $this->add_control(
            'number',
            [
                'label'     => esc_html__( 'Number', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'icon_or_image' => 'number',
                    'icon_layout!'  => 'without-icon',
                ],
            ]
        );

        $this->end_controls_section(); //End Icon Settings.

        /**
         * Content Settings
         */
        $this->start_controls_section(
            'icon_content_settings',
            [
                'label' => esc_html__( 'Content Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'icon_title',
            [
                'label'       => esc_html__( 'Title', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Icon Box', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'icon_title_tag',
            [
                'label'   => esc_html__( 'Select Title Tag', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1'   => esc_html__( 'H1', 'sublimetheme-advanced-addons-for-elementor' ),
                    'h2'   => esc_html__( 'H2', 'sublimetheme-advanced-addons-for-elementor' ),
                    'h3'   => esc_html__( 'H3', 'sublimetheme-advanced-addons-for-elementor' ),
                    'h4'   => esc_html__( 'H4', 'sublimetheme-advanced-addons-for-elementor' ),
                    'h5'   => esc_html__( 'H5', 'sublimetheme-advanced-addons-for-elementor' ),
                    'h6'   => esc_html__( 'H6', 'sublimetheme-advanced-addons-for-elementor' ),
                    'span' => esc_html__( 'Span', 'sublimetheme-advanced-addons-for-elementor' ),
                    'p'    => esc_html__( 'P', 'sublimetheme-advanced-addons-for-elementor' ),
                    'div'  => esc_html__( 'Div', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'icon_text',
            [
                'label'       => esc_html__( 'Content', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default'     => esc_html__( 'Write a short description, that will describe the title or something informational and useful.', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->end_controls_section(); //End Content Settings.

        /**
         * Button Settings
         */
        $this->start_controls_section(
            'icon_button',
            [
                'label' => esc_html__( 'Button Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'show_icon_button',
            [
                'label'     => esc_html__( 'Show Button', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'icon_button_label',
            [
                'label'       => esc_html__( 'Button Label', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Learn More', 'sublimetheme-advanced-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Enter button label', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition'   => [
                    'show_icon_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_button_url',
            [
                'label'         => esc_html__( 'Button URL', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'placeholder'   => esc_html__( 'Enter link for the button', 'sublimetheme-advanced-addons-for-elementor' ),
                'show_external' => true,
                'default'       => [
                    'url' => '#',
                ],
                'condition' => [
                    'show_icon_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_button_icon',
            [
                'label'     => esc_html__( 'Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_icon_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_button_alignment',
            [
                'label'   => esc_html__( 'Icon Position', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'  => esc_html__( 'Before', 'sublimetheme-advanced-addons-for-elementor' ),
                    'right' => esc_html__( 'After', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'condition' => [
                    'show_icon_button' => 'yes',
                ],
            ]
        );

        $this->end_controls_section(); //End Button Settings.

        /**
         * Icon Box Style ( Style Tab )
         */
        $this->start_controls_section(
            'icon_box_style_settings',
            [
                'label' => esc_html__( 'Icon Box Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'icon_box_padding',
			[
				'label'      => esc_html__( 'Icon Box Padding', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'icon_box_bg_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'icon_box_border',
                'label' => esc_html__( 'Icon Box Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-icon-holder',
            ]
        );

        $this->add_control(
			'icon_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .ste-icon-holder',
            ]
        );

        $this->end_controls_section(); //End Icon Box Style Settings.

        /**
         * Icon Style ( Style Tab )
         */
        $this->start_controls_section(
            'icon_style_settings',
            [
                'label'     => esc_html__( 'Icon Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon_or_image' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'   => __( 'Icon Size', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                ],
                'range' => [
                    'px' => [
                        'min'  => 20,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder i' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ste-icon-holder .icon-holder svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
			'icon_bottom_margin',
			[
				'label'      => esc_html__( 'Bottom Margin', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder .icon-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-icon-holder .icon-holder svg' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_shape',
            [
                'label'       => esc_html__( 'Background Shape', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'    => esc_html__( 'None', 'sublimetheme-advanced-addons-for-elementor' ),
                    'rounded' => esc_html__( 'Rounded', 'sublimetheme-advanced-addons-for-elementor' ),
                    'square'  => esc_html__( 'Square', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'prefix_class' => 'ste-icon-bg-shape-',
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'icon_bg_shape!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_bg_size',
            [
                'label'   => __( 'Icon Background Size', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 90,
                ],
                'condition' => [
                    'icon_bg_shape!' => 'none',
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder' => 'height: {{SIZE}}px; width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'icon_border',
                'label' => esc_html__( 'Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-icon-holder .icon-holder',
            ]
        );

        $this->add_control(
			'icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
                'condition' => [
                    'icon_bg_shape' => 'square',
                ],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder .icon-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Icon Style Settings.

        /**
         * Image Style ( Style Tab )
         */
        $this->start_controls_section(
            'image_style_settings',
            [
                'label'     => esc_html__( 'Image Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon_or_image' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'icon_image',
                'default' => 'full',
            ]
        );

        $this->add_control(
            'image_resize',
            [
                'label'   => esc_html__( 'Image Resize', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                ],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder' => 'width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_box_padding',
            [
                'label'      => esc_html__( 'Image Box Padding', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'image_bottom_margin',
			[
				'label'      => esc_html__( 'Bottom Margin', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder .icon-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'image_shape',
            [
                'label'       => esc_html__( 'Image Shape', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'square',
                'label_block' => false,
                'options'     => [
                    'none'    => esc_html__( 'None', 'sublimetheme-advanced-addons-for-elementor' ),
                    'rounded' => esc_html__( 'Rounded', 'sublimetheme-advanced-addons-for-elementor' ),
                    'square'  => esc_html__( 'Square', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'prefix_class' => 'ste-icon-image-shape-',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'image_border',
                'label' => esc_html__( 'Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-icon-holder .icon-holder img',
            ]
        );

        $this->add_control(
			'image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
                'condition' => [
                    'image_shape' => 'square',
                ],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder .icon-holder img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Image Style Settings.

        /**
         * Number Style ( Style Tab )
         */
        $this->start_controls_section(
            'number_style_settings',
            [
                'label'     => esc_html__( 'Number Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon_or_image' => 'number',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_number_typography',
                'selector' => '{{WRAPPER}} .ste-icon-holder .icon-holder .icon-number',
            ]
        );

        $this->add_responsive_control(
            'number_icon_size',
            [
                'label'   => __( 'Icon Size', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                ],
                'range' => [
                    'px' => [
                        'min'  => 20,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder .icon-number' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
			'number_icon_bottom_margin',
			[
				'label'      => esc_html__( 'Bottom Margin', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder .icon-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'number_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder .icon-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_icon_bg_shape',
            [
                'label'       => esc_html__( 'Background Shape', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'    => esc_html__( 'None', 'sublimetheme-advanced-addons-for-elementor' ),
                    'rounded' => esc_html__( 'Rounded', 'sublimetheme-advanced-addons-for-elementor' ),
                    'square'  => esc_html__( 'Square', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'prefix_class' => 'ste-icon-bg-shape-',
            ]
        );

        $this->add_control(
            'number_icon_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'number_icon_bg_shape!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'number_icon_bg_size',
            [
                'label'   => __( 'Icon Background Size', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 90,
                ],
                'condition' => [
                    'number_icon_bg_shape!' => 'none',
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .icon-holder' => 'height: {{SIZE}}px; width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'number_icon_border',
                'label' => esc_html__( 'Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-icon-holder .icon-holder',
            ]
        );

        $this->add_control(
			'number_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
                'condition' => [
                    'number_icon_bg_shape' => 'square',
                ],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder .icon-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Number Style Settings.

        /**
         * Title Style ( Style Tab )
         */
        $this->start_controls_section(
            'icon_title_style_settings',
            [
                'label' => esc_html__( 'Title Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_title_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .text-holder .ste-icon-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_title_typography',
                'selector' => '{{WRAPPER}} .ste-icon-holder .text-holder .ste-icon-title',
            ]
        );

        $this->add_responsive_control(
			'icon_title_bottom_margin',
			[
				'label'      => esc_html__( 'Bottom Margin', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder .text-holder .ste-icon-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Title Style Settings.

        /**
         * Content Style ( Style Tab )
         */
        $this->start_controls_section(
            'icon_content_style_settings',
            [
                'label' => esc_html__( 'Content Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_content_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-holder .text-holder .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_content_typography',
                'selector' => '{{WRAPPER}} .ste-icon-holder .text-holder .content',
            ]
        );

        $this->add_responsive_control(
			'icon_content_bottom_margin',
			[
				'label'      => esc_html__( 'Bottom Margin', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-holder .text-holder .content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section(); //End Content Style Settings.

        /**
         * Button Style ( Style Tab )
         */
        $this->start_controls_section(
            'icon_button_style_settings',
            [
                'label'     => esc_html__( 'Button Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon_button' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_button_typography',
                'selector' => '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button .icon-button-label',
            ]
        );

        $this->add_control(
            'icon_button_spacing',
            [
                'label' => esc_html__( 'Button Icon Spacing', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-right' => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .ste-icon-left' => 'margin-right: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_button_size',
            [
                'label'   => __( 'Button Icon Size', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_button_padding',
            [
                'label'      => esc_html__( 'Button Padding', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'icon_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'icon_button_style_tab' );

        $this->start_controls_tab( 
            'icon_button_normal', 
            [
                'label' => esc_html__( 'Normal', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'icon_button_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button .icon-button-label' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'icon_button_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button .ste-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button .ste-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_button_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_button_border',
                'selector' => '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_button_box_shadow',
                'selector' => '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button',
            ]
        );

        $this->end_controls_tab(); // End Normal Tab

        $this->start_controls_tab( 
            'icon_button_hover', 
            [
                'label' => esc_html__( 'Hover', 'sublimetheme-advanced-addons-for-elementor' ),
            ] 
        );

        $this->add_control(
            'icon_button_hover_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button:hover .icon-button-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_button_hover_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button:hover .ste-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button:hover .ste-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_button_hover_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_button_hover_border',
                'selector' => '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .ste-icon-button-wrap .ste-icon-button:hover',
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Button Style Tab

        $this->end_controls_section(); //End Button Style Settings.
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'icon_layout', 'class', 'ste-icon-holder' );

        if( $settings['icon_layout'] == 'without-icon' ){
            $this->add_render_attribute( 'icon_layout', 'class', 'layout_four' );
        }

        if( $settings['icon_layout'] == 'icon-on-top' ){
            $this->add_render_attribute( 'icon_layout', 'class', 'layout_one' );
        }

        if( $settings['icon_layout'] == 'icon-on-left' ){
            $this->add_render_attribute( 'icon_layout', 'class', 'layout_two' );
        }

        if( $settings['icon_layout'] == 'icon-on-right' ){
            $this->add_render_attribute( 'icon_layout', 'class', 'layout_three' );
        }
        
        $this->add_render_attribute( 'icon_alignment', 'class', 'ste-icon-inner-holder' );

        if( $settings['icon_alignment'] == 'center' ){
            $this->add_render_attribute( 'icon_alignment', 'class', 'center' );
        }

        if( $settings['icon_alignment'] == 'right' ){
            $this->add_render_attribute( 'icon_alignment', 'class', 'right' );
        }

        $this->add_render_attribute( 'icon_bg_shape', 'class', 'icon-holder' );

        if( $settings['icon_or_image'] == 'icon' ){
            $this->add_render_attribute( 'icon_bg_shape', 'class', $settings['icon_bg_shape'] );
        }

        if( $settings['icon_or_image'] == 'image' ){
            $this->add_render_attribute( 'icon_bg_shape', 'class', $settings['image_shape'] );
        }

        if( $settings['icon_or_image'] == 'number' ){
            $this->add_render_attribute( 'icon_bg_shape', 'class', $settings['number_icon_bg_shape'] );
        }

        ob_start(); ?>            
        <div <?php echo $this->get_render_attribute_string( 'icon_layout' ); ?>>
            <div <?php echo $this->get_render_attribute_string( 'icon_alignment' ); ?>>                
                <?php 
                    if( $settings['icon_layout'] != 'without-icon' ){ ?>
                        <div <?php echo $this->get_render_attribute_string( 'icon_bg_shape' ); ?>>
                        <?php
                        if( $settings['icon_or_image'] == 'icon' ){
                            Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                        }
                        if( $settings['icon_or_image'] == 'image' ){
                            $icon_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'icon_image', $settings );
                            if( ! $icon_image_url ) $icon_image_url = $settings['image']['url']; ?>
                            <img src="<?php echo esc_url( $icon_image_url ); ?>" alt="<?php echo esc_attr( get_post_meta( $settings['image']['id'], '_wp_attachment_image_alt', true) ); ?>">
                            <?php
                        }
                        if( $settings['icon_or_image'] == 'number' ){
                            echo '<span class="icon-number">'. esc_html( $settings['number'] ) .'</span>';
                        }
                        echo '</div>';
                    }
                ?>                
                <div class="text-holder">                    
                    <<?php Utils::print_validated_html_tag( $settings['icon_title_tag'] ); ?> class="ste-icon-title">
                        <?php echo esc_html( $settings['icon_title'] ); ?>
                    </<?php Utils::print_validated_html_tag( $settings['icon_title_tag'] ); ?>>                        
                    <?php
                        if( $settings['icon_text'] ) echo '<div class="content">' . wpautop( wp_kses_post( $settings['icon_text'] ) ) . '</div>';

                        if( 'yes' == $settings['show_icon_button'] && $settings['icon_button_label'] && $settings['icon_button_url']  ) { 
                            $this->add_render_attribute( 'icon_button_url', 'class', 'ste-icon-button' );
                            
                            if( $settings['icon_button_url']['url'] ){
                                $this->add_render_attribute( 'icon_button_url', 'href', esc_url( $settings['icon_button_url']['url'] ) );
                            }
                    
                            if( 'on' == $settings['icon_button_url']['is_external'] ){
                                $this->add_render_attribute( 'icon_button_url', 'target', '_blank' );
                            }
                    
                            if( 'on' == $settings['icon_button_url']['nofollow'] ){
                                $this->add_render_attribute( 'icon_button_url', 'rel', 'nofollow' );
                            } ?>
                            <div class="ste-icon-button-wrap">
                                <a <?php echo $this->get_render_attribute_string( 'icon_button_url' ); ?>>
                                    <?php
                                        if( $settings['icon_button_alignment'] == 'left' && $settings['icon_button_icon']['library'] ){
                                            echo '<span class="ste-icon ste-icon-left">';
                                            Icons_Manager::render_icon( $settings['icon_button_icon'], [ 'aria-hidden' => 'true' ] );
                                            echo '</span>';
                                        }
                                    ?>
                                    <span class="icon-button-label"><?php echo esc_html( $settings['icon_button_label'] ); ?></span>
                                    <?php
                                        if( $settings['icon_button_alignment'] == 'right' && $settings['icon_button_icon']['library'] ){
                                            echo '<span class="ste-icon ste-icon-right">';
                                            Icons_Manager::render_icon( $settings['icon_button_icon'], [ 'aria-hidden' => 'true' ] );
                                            echo '</span>';
                                        }
                                    ?>
                                </a>
                            </div>
                            <?php
                        }
                    ?>                              
                </div>                        
            </div>
        </div>
        <?php
        $html = ob_get_clean();
        echo apply_filters( 'saafe_icon_filter', $html, $settings );
    }
}