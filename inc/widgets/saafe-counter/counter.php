<?php
/**
 * Counter Elementor Widget
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

class SAAFE_Counter extends Widget_Base {
    public function get_name(){
		return 'saafe-counter';
	}

	public function get_title(){
		return esc_html__( 'Counter', 'sublimetheme-advanced-addons-for-elementor' );
	}

	public function get_icon(){
		return 'eicon-counter';
	}

	public function get_categories(){
		return ['sublimetheme-advanced-addons-for-elementor'];
	}

    public function get_style_depends() {
        wp_register_style( 'saafe-counter', SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL . 'inc/widgets/saafe-counter/counter.css', array(), SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION );
        return ['saafe-counter'];
    }

    public function get_script_depends() {
        wp_register_script( 'jquery-waypoints', SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL . 'inc/widgets/saafe-counter/jquery.waypoints.js', array(), '4.0.1' );
        wp_register_script( 'saafe-counter', SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL . 'inc/widgets/saafe-counter/counter.js', array( 'jquery-waypoints' ), SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION );
        return [ 'jquery', 'jquery-numerator', 'saafe-counter' ];
    }

    public function get_keywords()
    {
        return [
            'counter',
            'sublime',
            'sublimetheme',
            'sublimetheme elements',
        ];
    }

    protected function register_controls(){
        /**
         * Counter Icon Settings
         */
        $this->start_controls_section(
            'counter_icon_settings',
            [
                'label' => esc_html__( 'Counter Icon Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'counter_icon_or_image',
            [
                'label'       => esc_html__( 'Icon or Image', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::CHOOSE,
                'default'     => 'none',
                'label_block' => true,
                'options'     => [
                    'none'        => [
						'title' => esc_html__( 'None', 'sublimetheme-advanced-addons-for-elementor' ),
						'icon'  => 'eicon-ban',
					],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-info-circle-o',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'eicon-image-bold',
                    ],
                ],                
            ]
        );

        $this->add_control(
            'counter_icon',
            [
                'label'   => esc_html__( 'Counter Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-building',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'counter_icon_or_image' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'counter_image',
            [
                'label'   => esc_html__( 'Counter Image', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'counter_icon_or_image' => 'image',
                ],
            ]
        );

        $this->end_controls_section(); //End Counter Icon Settings.
        
        /**
         * Counter Settings
         */
        $this->start_controls_section(
            'counter_settings',
            [
                'label' => esc_html__( 'Counter Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'counter_number',
            [
                'label'   => esc_html__( 'Counter Number', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => esc_html__( '250', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'thousand_separator',
            [
                'label'         => esc_html__( 'Thousand Separator', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__( 'Converts 1000 into 1,000', 'sublimetheme-advanced-addons-for-elementor' ),
                'default'       => ','
            ]
        );

        $this->add_control(
            'digits_after_decimal',
            [
                'label'         => esc_html__( 'Digits After Decimal Point', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 0
            ]
        );

        $this->add_control(
            'number_prefix',
            [
                'label' => __( 'Number Prefix', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'number_suffix',
            [
                'label' => __( 'Number Suffix', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'counter_speed',
            [
                'label'   => __( 'Counter Speed', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [ 'size' => 1500 ],
                'range'   => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 2000,
                        'step' => 1,
                    ],
                ],
                'size_units' => '',
            ]
        );

        $this->end_controls_section(); //End Counter Settings.

        /**
         * Content Settings
         */
        $this->start_controls_section(
            'counter_content_settings',
            [
                'label' => esc_html__( 'Content Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'counter_title',
            [
                'label'       => esc_html__( 'Title', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Counter', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'counter_title_tag',
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
            'counter_text',
            [
                'label'       => esc_html__( 'Content', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default'     => esc_html__( 'Write a short description, that will describe the counter.', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->end_controls_section(); //End Content Settings.

        /**
         * Counter Box Style ( Style Tab )
         */
        $this->start_controls_section(
            'counter_box_style_settings',
            [
                'label' => esc_html__( 'Counter Box Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_alignment',
            [
                'label'       => esc_html__( 'Counter Alignment', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::CHOOSE,
                'default'     => 'left',
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
                'prefix_class' => 'ste-counter-icon-align-',
                'selectors' => [
                    '{{WRAPPER}} .ste-counter' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'counter_box_padding',
			[
				'label'      => esc_html__( 'Counter Box Padding', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ste-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'counter_box_bg_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-counter' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'counter_box_border',
                'label' => esc_html__( 'Counter Box Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-counter',
            ]
        );

        $this->add_control(
			'counter_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ste-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'counter_box_shadow',
                'selector' => '{{WRAPPER}} .ste-counter',
            ]
        );

        $this->end_controls_section(); //End Counter Box Style Settings.

        /**
         * Icon Style ( Style Tab )
         */
        $this->start_controls_section(
            'counter_icon_style_settings',
            [
                'label'     => esc_html__( 'Icon Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'counter_icon_or_image' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_size',
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
                    '{{WRAPPER}} .ste-counter .icon-box i' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ste-counter .icon-box svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
			'counter_icon_bottom_margin',
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
					'{{WRAPPER}} .ste-counter .icon-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'counter_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-counter .icon-box i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-counter .icon-box svg' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_icon_bg_shape',
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
                'prefix_class' => 'ste-counter-icon-bg-shape-',
            ]
        );

        $this->add_control(
            'counter_icon_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'counter_icon_bg_shape!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-counter .icon-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_bg_size',
            [
                'label'   => __( 'Icon Background Size', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 90,
                ],
                'condition' => [
                    'counter_icon_bg_shape!' => 'none',
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-counter .icon-box' => 'height: {{SIZE}}px; width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'counter_icon_border',
                'label' => esc_html__( 'Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-counter .icon-box',
            ]
        );

        $this->add_control(
			'counter_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
                'condition' => [
                    'counter_icon_bg_shape' => 'square',
                ],
				'selectors' => [
					'{{WRAPPER}} .ste-counter .icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Icon Style Settings.

        /**
         * Image Style ( Style Tab )
         */
        $this->start_controls_section(
            'counter_image_style_settings',
            [
                'label'     => esc_html__( 'Image Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'counter_icon_or_image' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'counter_icon_image',
                'default' => 'full',
            ]
        );

        $this->add_control(
            'counter_image_resize',
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
                    '{{WRAPPER}} .ste-counter .icon-box img' => 'width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
			'counter_image_bottom_margin',
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
					'{{WRAPPER}} .ste-counter .icon-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'counter_image_shape',
            [
                'label'       => esc_html__( 'Image Shape', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'    => esc_html__( 'None', 'sublimetheme-advanced-addons-for-elementor' ),
                    'rounded' => esc_html__( 'Rounded', 'sublimetheme-advanced-addons-for-elementor' ),
                    'square'  => esc_html__( 'Square', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'prefix_class' => 'ste-counter-image-shape-',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'counter_image_border',
                'label' => esc_html__( 'Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-counter .icon-box img',
            ]
        );

        $this->add_control(
			'counter_image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
                'condition' => [
                    'counter_image_shape' => 'square',
                ],
				'selectors' => [
					'{{WRAPPER}} .ste-counter .icon-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Image Style Settings.

        /**
         * Counter Number Style ( Style Tab )
         */
        $this->start_controls_section(
            'counter_number_style_settings',
            [
                'label' => esc_html__( 'Counter Number Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_number_typography',
                'selector' => '{{WRAPPER}} .ste-counter .count-number .ste-counter-init',
            ]
        );

        $this->add_control(
            'counter_number_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-counter .count-number .ste-counter-init' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'counter_number_bottom_margin',
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
					'{{WRAPPER}} .ste-counter .counter .count-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Counter Number Style Settings.

        /**
         * Number Prefix Style ( Style Tab )
         */
        $this->start_controls_section(
            'number_prefix_style',
            [
                'label'     => esc_html__( 'Number Prefix', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'number_prefix!' => '',
                ],
            ]
        );

        $this->add_control(
            'number_prefix_color',
            [
                'label'     => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-counter .count-number .counter-prefix' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_prefix_typography',
                'label'    => esc_html__( 'Typography', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-counter .count-number .counter-prefix',
            ]
        );
        
        $this->end_controls_section(); //End Number Prefix Style Settings.

        /**
         * Number Suffix Style ( Style Tab )
         */
        $this->start_controls_section(
            'number_suffix_style',
            [
                'label'     => esc_html__( 'Number Suffix', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'number_suffix!' => '',
                ],
            ]
        );

        $this->add_control(
            'number_suffix_color',
            [
                'label'     => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-counter .count-number .counter-postfix' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'number_suffix_typography',
                'label'    => esc_html__( 'Typography', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-counter .count-number .counter-postfix',
            ]
        );
        
        $this->end_controls_section(); //End Number Suffix Style Settings.

        /**
         * Title Style ( Style Tab )
         */
        $this->start_controls_section(
            'counter_title_style_settings',
            [
                'label' => esc_html__( 'Title Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_title_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-counter .text-holder .ste-counter-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_title_typography',
                'selector' => '{{WRAPPER}} .ste-counter .text-holder .ste-counter-title',
            ]
        );

        $this->add_responsive_control(
			'counter_title_bottom_margin',
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
					'{{WRAPPER}} .ste-counter .text-holder .ste-counter-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Title Style Settings.

        /**
         * Content Style ( Style Tab )
         */
        $this->start_controls_section(
            'counter_content_style_settings',
            [
                'label' => esc_html__( 'Content Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_content_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-counter .text-holder .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_content_typography',
                'selector' => '{{WRAPPER}} .ste-counter .text-holder .content',
            ]
        );

        $this->add_responsive_control(
			'counter_content_bottom_margin',
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
					'{{WRAPPER}} .ste-counter .text-holder .content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section(); //End Content Style Settings.
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'ste_counter',
            [
                'class'           => 'ste-counter',
                'data-from-value' => 0,
                'data-to-value'   => empty ( $settings['counter_number'] ) ? 250  : $settings['counter_number'],
                'data-delimiter'  => $settings['thousand_separator'],
                'data-rounding'   => empty ( $settings['digits_after_decimal'] ) ? 0  : $settings['digits_after_decimal'],
                'data-duration'   => empty ( $settings['counter_speed']['size'] ) ? 1500  : $settings['counter_speed']['size']
            ] 
        );

        ob_start(); ?>            
        <div <?php echo $this->get_render_attribute_string( 'ste_counter' ); ?>> 
            <?php 
                if( $settings['counter_icon_or_image'] !== 'none' ){
                    echo '<div class="icon-box">';
                    if( $settings['counter_icon_or_image'] == 'image' ){ 
                        $counter_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['counter_image']['id'], 'counter_icon_image', $settings ); 
                        if( ! $counter_image_url ) $counter_image_url = $settings['counter_image']['url']; ?>
                        <img src="<?php echo esc_url( $counter_image_url ); ?>" alt="<?php echo esc_attr( get_post_meta( $settings['counter_image']['id'], '_wp_attachment_image_alt', true) ); ?>">
                        <?php
                    }elseif( $settings['counter_icon_or_image'] == 'icon' ){
                        Icons_Manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true' ] );
                    }
                    echo '</div><!-- .icon-box -->';
                }
            ?>                    
            <div class="counter">
                <div class="count-number">
                    <span class="ste-counter-init">0</span>
                    <?php if( $settings['number_prefix'] ) echo '<span class="counter-prefix">' . esc_html( $settings['number_prefix'] ) . '</span>'; ?>
                    <?php if( $settings['number_suffix'] ) echo '<span class="counter-postfix"><sup>' . esc_html( $settings['number_suffix'] ) . '</sup></span>'; ?>
                </div>
                <div class="text-holder">                    
                    <<?php Utils::print_validated_html_tag( $settings['counter_title_tag'] ); ?> class="ste-counter-title">
                        <?php echo esc_html( $settings['counter_title'] ); ?>
                    </<?php Utils::print_validated_html_tag( $settings['counter_title_tag'] ); ?>>                        
                    <?php
                        if( $settings['counter_text'] ) echo '<div class="content">' . wpautop( wp_kses_post( $settings['counter_text'] ) ) . '</div>';
                    ?>                              
                </div>
            </div>
        </div><!-- ste-counter -->
        <?php
        $html = ob_get_clean();
        echo apply_filters( 'saafe_counter_widget_filter', $html, $settings );
    }
}