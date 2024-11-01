<?php
/**
 * CTA Elementor Widget
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
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

class SAAFE_Cta extends Widget_Base {
    public function get_name(){
		return 'saafe-cta';
	}

	public function get_title(){
		return esc_html__( 'CTA', 'sublimetheme-advanced-addons-for-elementor' );
	}

	public function get_icon(){
		return 'eicon-call-to-action';
	}

	public function get_categories(){
		return ['sublimetheme-advanced-addons-for-elementor'];
	}

    public function get_style_depends() {
        wp_register_style( 'saafe-cta', SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL . 'inc/widgets/saafe-cta/cta.css', array(), SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION );
        return ['saafe-cta'];
    }

    public function get_keywords()
    {
        return [
            'cta',
            'call to action',
            'action box',
            'sublime',
            'sublimetheme',
            'sublimetheme elements',
        ];
    }

    protected function register_controls(){
        /**
         * Call to Action Content Settings
         */
        $this->start_controls_section(
            'cta_content_settings',
            [
                'label' => esc_html__( 'Content Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'cta_layout',
            [
                'label'       => esc_html__( 'Layouts', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'layout_one',
                'label_block' => false,
                'options'     => [
                    'layout_one' => esc_html__( 'Layout One', 'sublimetheme-advanced-addons-for-elementor' ),
                    'layout_two' => esc_html__( 'Layout Two', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'cta_title',
            [
                'label'       => esc_html__( 'Title', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'CTA Heading', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'cta_title_tag',
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
            'cta_text',
            [
                'label'       => esc_html__( 'Content', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default'     => esc_html__( 'Call To Action Content. Edit this content from here.', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->end_controls_section(); //End Content Settings.

        /**
         * Button Settings
         */
        $this->start_controls_section(
            'cta_button_settings',
            [
                'label' => esc_html__( 'Button Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'primary_btn_heading',
            [
                'label' => esc_html__( 'Primary Button', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'cta_primary_button_label',
            [
                'label'       => esc_html__( 'Primary Button Label', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Learn More', 'sublimetheme-advanced-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Enter button label', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'cta_primary_button_url',
            [
                'label'         => esc_html__( 'Primary Button URL', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'placeholder'   => esc_html__( 'Enter link for the button', 'sublimetheme-advanced-addons-for-elementor' ),
                'show_external' => true,
                'default'       => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'cta_primary_button_icon',
            [
                'label' => esc_html__( 'Primary Button Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'cta_primary_button_alignment',
            [
                'label'   => esc_html__( 'Primary Button Icon Position', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'  => esc_html__( 'Before', 'sublimetheme-advanced-addons-for-elementor' ),
                    'right' => esc_html__( 'After', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'secondary_btn_heading',
            [
                'label'     => esc_html__( 'Secondary Button', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_cta_secondary_button',
            [
                'label'     => esc_html__( 'Show Secondary Button', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                'label_off' => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'cta_secondary_button_label',
            [
                'label'       => esc_html__( 'Secondary Button Label', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Learn More', 'sublimetheme-advanced-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Enter button label', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition' => [
                    'show_cta_secondary_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'cta_secondary_button_url',
            [
                'label'         => esc_html__( 'Secondary Button URL', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'placeholder'   => esc_html__( 'Enter link for the button', 'sublimetheme-advanced-addons-for-elementor' ),
                'show_external' => true,
                'default'       => [
                    'url' => '#',
                ],
                'condition' => [
                    'show_cta_secondary_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'cta_secondary_button_icon',
            [
                'label' => esc_html__( 'Secondary Button Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_cta_secondary_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'cta_secondary_button_alignment',
            [
                'label'   => esc_html__( 'Secondary Button Icon Position', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'  => esc_html__( 'Before', 'sublimetheme-advanced-addons-for-elementor' ),
                    'right' => esc_html__( 'After', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'condition' => [
                    'show_cta_secondary_button' => 'yes',
                ],
            ]
        );

        $this->end_controls_section(); //End Button Settings.

        /**
         * Background Settings
         */
        $this->start_controls_section(
            'cta_bg_settings',
            [
                'label' => esc_html__( 'Background Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'cta_bg_type',
            [
                'label'       => esc_html__( 'Background Type', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'         => esc_html__( 'None', 'sublimetheme-advanced-addons-for-elementor' ),
                    'cta-bg-color' => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                    'cta-bg-image'   => esc_html__( 'Background Image', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'cta_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'cta_bg_type' => 'cta-bg-color',
                ],
                'selectors' => [
                    '{{WRAPPER}} .cta-image-holder' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_bg_image',
            [
                'label' => esc_html__( 'Background Image', 'sublimetheme-advanced-addons-for-elementor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'cta_bg_type' => 'cta-bg-image',
                ],
            ]
        );

        $this->add_control(
            'cta_bg_image_fixed',
            [
                'label'   => esc_html__( 'Enable Fixed Background Image', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'cta_bg_type' => 'cta-bg-image',
                ],
            ]
        );

        $this->add_control(
			'cta_opacity',
			[
				'label' => esc_html__( 'Opacity', 'sublimetheme-advanced-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
                'condition' => [
                    'cta_bg_type' => 'cta-bg-image'
                ],
				'selectors' => [
                    '{{WRAPPER}} .ste-cta-widget .cta-image-holder::before' => 'opacity: {{SIZE}};',
				],
			]
		);

        $this->end_controls_section(); //End Background Settings.

        /**
         * CTA Box Style ( Style Tab )
         */
        $this->start_controls_section(
            'cta_box_style_settings',
            [
                'label' => esc_html__( 'CTA Box Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'cta_box_padding',
			[
				'label'      => esc_html__( 'CTA Box Padding', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ste-cta-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End CTA Box Style Settings.

        $this->start_controls_section(
            'cta_inner_box_style_settings',
            [
                'label' => esc_html__( 'CTA Inner Box Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
			'cta_inner_box_padding',
			[
				'label'      => esc_html__( 'CTA Inner Box Padding', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ste-cta-widget-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'cta_inner_box_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-cta-widget-inner' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'cta_inner_box_border',
                'label' => esc_html__( 'CTA Inner Box Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-cta-widget-inner',
            ]
        );

        $this->add_control(
			'cta_inner_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ste-cta-widget-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cta_inner_box_shadow',
                'selector' => '{{WRAPPER}} .ste-cta-widget-inner',
            ]
        );

        $this->end_controls_section(); //End CTA Inner Box Style Settings.

        /**
         * Title Style ( Style Tab )
         */
        $this->start_controls_section(
            'cta_title_style_settings',
            [
                'label' => esc_html__( 'Title Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cta_title_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-cta-widget .cta-content .ste-cta-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cta_title_typography',
                'selector' => '{{WRAPPER}} .ste-cta-widget .cta-content .ste-cta-title',
            ]
        );

        $this->add_responsive_control(
			'cta_title_bottom_margin',
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
					'{{WRAPPER}} .ste-cta-widget .cta-content .ste-cta-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Title Style Settings.

        /**
         * Content Style ( Style Tab )
         */
        $this->start_controls_section(
            'cta_content_style_settings',
            [
                'label' => esc_html__( 'Content Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cta_content_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-cta-widget .cta-content .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cta_content_typography',
                'selector' => '{{WRAPPER}} .ste-cta-widget .cta-content .content',
            ]
        );

        $this->add_responsive_control(
			'cta_content_bottom_margin',
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
					'{{WRAPPER}} .ste-cta-widget .cta-content .content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section(); //End Content Style Settings.

        /**
         * Primary Button Style ( Style Tab )
         */
        $this->start_controls_section(
            'cta_primary_button_style_settings',
            [
                'label' => esc_html__( 'Primary Button Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cta_primary_button_typography',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-one',
            ]
        );

        $this->add_control(
            'cta_primary_button_icon_spacing',
            [
                'label' => esc_html__( 'Button Icon Spacing', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-primary-icon-right' => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .ste-primary-icon-left' => 'margin-right: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'cta_primary_button_icon_size',
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
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cta_primary_button_padding',
            [
                'label'      => esc_html__( 'Button Padding', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'cta_primary_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'cta_primary_button_style_tab' );

        $this->start_controls_tab(
            'cta_primary_button_normal', 
            [
                'label' => esc_html__( 'Normal', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'cta_primary_button_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore .cta-primary-button-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_primary_button_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore .ste-primary-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore .ste-primary-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_primary_button_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cta_primary_button_border',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cta_primary_button_box_shadow',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore',
            ]
        );

        $this->end_controls_tab(); // End Normal Tab

        $this->start_controls_tab(
            'cta_primary_button_hover', 
            [
                'label' => esc_html__( 'Hover', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'cta_primary_button_hover_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore:hover .cta-primary-button-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_primary_button_hover_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore:hover .ste-primary-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore:hover .ste-primary-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_primary_button_hover_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cta_primary_button_hover_border',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cta_primary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-one .btn-readmore:hover',
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Primary Button Style Tab

        $this->end_controls_section(); //End Primary Button Style Settings.

        /**
         * Secondary Button Style ( Style Tab )
         */
        $this->start_controls_section(
            'cta_secondary_button_style_settings',
            [
                'label'     => esc_html__( 'Secondary Button Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_cta_secondary_button' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cta_secondary_button_typography',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-two',
            ]
        );

        $this->add_control(
            'cta_secondary_button_icon_spacing',
            [
                'label' => esc_html__( 'Button Icon Spacing', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-secondary-icon-right' => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .ste-secondary-icon-left' => 'margin-right: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'cta_secondary_button_icon_size',
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
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cta_secondary_button_padding',
            [
                'label'      => esc_html__( 'Button Padding', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'cta_secondary_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'cta_secondary_button_style_tab' );

        $this->start_controls_tab(
            'cta_secondary_button_normal', 
            [
                'label' => esc_html__( 'Normal', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'cta_secondary_button_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore .cta-secondary-button-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_secondary_button_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore .ste-secondary-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore .ste-secondary-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_secondary_button_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cta_secondary_button_border',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cta_secondary_button_box_shadow',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore',
            ]
        );

        $this->end_controls_tab(); // End Normal Tab

        $this->start_controls_tab(
            'cta_secondary_button_hover', 
            [
                'label' => esc_html__( 'Hover', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'cta_secondary_button_hover_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore:hover .cta-secondary-button-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_secondary_button_hover_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore:hover .ste-secondary-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore:hover .ste-secondary-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cta_secondary_button_hover_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cta_secondary_button_hover_border',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cta_secondary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .cta-buttons .cta-button-two .btn-readmore:hover',
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Secondary Button Style Tab

        $this->end_controls_section(); //End Secondary Button Style Settings.
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'cta_layout', 'class', 'ste-cta-widget' );

        $this->add_render_attribute( 'cta_layout', 'class', $settings['cta_layout'] );

        if( $settings['cta_bg_type'] == 'cta-bg-image' ){
            $this->add_render_attribute( 'cta_layout', 'class', 'hs-bg-img' );
        }

        if( $settings['cta_bg_type'] == 'cta-bg-color' ){
            $this->add_render_attribute( 'cta_layout', 'class', 'hs-bg-color' );
        }

        if( $settings['cta_bg_image_fixed'] == 'yes' ){
            $this->add_render_attribute( 'cta_layout', 'class', 'parallax-enable' );
        } 

        ob_start(); ?>
        <div <?php echo $this->get_render_attribute_string( 'cta_layout' ); ?>>
            <div class="ste-cta-widget-inner">
                <?php 
                    if( $settings['cta_bg_type'] !== 'none' && $settings['cta_bg_type'] !== 'cta-bg-image' ){ ?>
                        <div class="cta-image-holder"></div>
                        <?php 
                    }
                    
                    if( $settings['cta_bg_type'] !== 'none' && $settings['cta_bg_type'] == 'cta-bg-image' ){
                        $image_url = $settings['cta_bg_image']['url']; ?>
                        <div class="cta-image-holder" style="background-image: url('<?php echo esc_url( $image_url ); ?>');"></div>
                        <?php
                    }
                ?>
                <div class="cta-content-holder">
                    <div class="cta-content">
                        <<?php Utils::print_validated_html_tag( $settings['cta_title_tag'] ); ?> class="ste-cta-title">
                            <?php echo esc_html( $settings['cta_title'] ); ?>
                        </<?php Utils::print_validated_html_tag( $settings['cta_title_tag'] ); ?>>
                        <?php 
                            if( $settings['cta_text'] ) echo '<div class="content">' . wpautop( wp_kses_post( $settings['cta_text'] ) ) . '</div>';
                        ?>
                    </div> 
                    <div class="cta-buttons">               
                        <?php
                            if( $settings['cta_primary_button_label'] && $settings['cta_primary_button_url']  ) { 
                                $this->add_render_attribute( 'cta_primary_button_url', 'class', 'btn-readmore' );
                                
                                if( $settings['cta_primary_button_url']['url'] ){
                                    $this->add_render_attribute( 'cta_primary_button_url', 'href', esc_url( $settings['cta_primary_button_url']['url'] ) );
                                }
                        
                                if( 'on' == $settings['cta_primary_button_url']['is_external'] ){
                                    $this->add_render_attribute( 'cta_primary_button_url', 'target', '_blank' );
                                }
                        
                                if( 'on' == $settings['cta_primary_button_url']['nofollow'] ){
                                    $this->add_render_attribute( 'cta_primary_button_url', 'rel', 'nofollow' );
                                } ?>
                                <div class="cta-button-one">
                                    <a <?php echo $this->get_render_attribute_string( 'cta_primary_button_url' ); ?>>
                                        <?php
                                            if( $settings['cta_primary_button_alignment'] == 'left' && $settings['cta_primary_button_icon']['library'] ){
                                                echo '<span class="ste-primary-icon ste-primary-icon-left">';
                                                Icons_Manager::render_icon( $settings['cta_primary_button_icon'], [ 'aria-hidden' => 'true' ] );
                                                echo '</span>';
                                            }
                                        ?>
                                        <span class="cta-primary-button-label"><?php echo esc_html( $settings['cta_primary_button_label'] ); ?></span>
                                        <?php
                                            if( $settings['cta_primary_button_alignment'] == 'right' && $settings['cta_primary_button_icon']['library'] ){
                                                echo '<span class="ste-primary-icon ste-primary-icon-right">';
                                                Icons_Manager::render_icon( $settings['cta_primary_button_icon'], [ 'aria-hidden' => 'true' ] );
                                                echo '</span>';
                                            }
                                        ?>
                                    </a>
                                </div>
                                <?php
                            }

                            if( $settings['show_cta_secondary_button'] == 'yes' && $settings['cta_secondary_button_label'] && $settings['cta_secondary_button_url']  ) { 
                                $this->add_render_attribute( 'cta_secondary_button_url', 'class', 'btn-readmore' );
                                
                                if( $settings['cta_secondary_button_url']['url'] ){
                                    $this->add_render_attribute( 'cta_secondary_button_url', 'href', esc_url( $settings['cta_secondary_button_url']['url'] ) );
                                }
                        
                                if( 'on' == $settings['cta_secondary_button_url']['is_external'] ){
                                    $this->add_render_attribute( 'cta_secondary_button_url', 'target', '_blank' );
                                }
                        
                                if( 'on' == $settings['cta_secondary_button_url']['nofollow'] ){
                                    $this->add_render_attribute( 'cta_secondary_button_url', 'rel', 'nofollow' );
                                } ?>
                                <div class="cta-button-two">
                                    <a <?php echo $this->get_render_attribute_string( 'cta_secondary_button_url' ); ?>>
                                        <?php
                                            if( $settings['cta_secondary_button_alignment'] == 'left' && $settings['cta_secondary_button_icon']['library'] ){
                                                echo '<span class="ste-secondary-icon ste-secondary-icon-left">';
                                                Icons_Manager::render_icon( $settings['cta_secondary_button_icon'], [ 'aria-hidden' => 'true' ] );
                                                echo '</span>';
                                            }
                                        ?>
                                        <span class="cta-secondary-button-label"><?php echo esc_html( $settings['cta_secondary_button_label'] ); ?></span>
                                        <?php
                                            if( $settings['cta_secondary_button_alignment'] == 'right' && $settings['cta_secondary_button_icon']['library'] ){
                                                echo '<span class="ste-secondary-icon ste-secondary-icon-right">';
                                                Icons_Manager::render_icon( $settings['cta_secondary_button_icon'], [ 'aria-hidden' => 'true' ] );
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
        </div>
        <?php
        $html = ob_get_clean();
        echo apply_filters( 'saafe_cta_filter', $html, $settings );
    }
}