<?php
/**
 * Team Elementor Widget
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
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

class SAAFE_Team extends Widget_Base {
    public function get_name(){
		return 'saafe-team';
	} 

	public function get_title(){
		return esc_html__( 'Team', 'sublimetheme-advanced-addons-for-elementor' );
	}

	public function get_icon(){
		return 'eicon-person';
	}

	public function get_categories(){
		return ['sublimetheme-advanced-addons-for-elementor'];
	}

    public function get_style_depends() {
        wp_register_style( 'saafe-team', SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL . 'inc/widgets/saafe-team/team.css', array(), SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION );
        return [ 'font-awesome-5-all', 'saafe-team' ];
    }

    public function get_keywords()
    {
        return [
            'team',
            'sublime',
            'sublimetheme',
            'sublimetheme elements',
        ];
    }

    protected function register_controls(){
        /**
         * Image Settings
         */
        $this->start_controls_section(
            'team_image_settings',
            [
                'label' => esc_html__( 'Image Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'team_layout',
            [
                'label'   => esc_html__( 'Layouts', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'simple',
                'options' => [
                    'simple'          => esc_html__( 'Simple', 'sublimetheme-advanced-addons-for-elementor' ),
                    'overlay'         => esc_html__( 'Overlay', 'sublimetheme-advanced-addons-for-elementor' ),
                    'social-on-right' => esc_html__( 'Social On Right', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'prefix_class' => 'ste-team-layout-',
            ]
        );

        $this->add_control(
            'team_image',
            [
                'label'   => esc_html__( 'Image', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section(); //End Image Settings.
        
        $this->start_controls_section(
            'team_content_settings',
            [
                'label' => esc_html__( 'Content Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
			'team_name',
			[
				'label' => esc_html__( 'Name', 'sublimetheme-advanced-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'sublimetheme-advanced-addons-for-elementor' ),
			]
		);

        $this->add_control(
            'name_title_tag',
            [
                'label'   => esc_html__( 'Select Name Tag', 'sublimetheme-advanced-addons-for-elementor' ),
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
			'team_job_designation',
			[
				'label' => esc_html__( 'Job Designation', 'sublimetheme-advanced-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Software Engineer', 'sublimetheme-advanced-addons-for-elementor' ),
			]
		);

        $this->end_controls_section(); //End Content Settings.

        /**
         * Social Settings
         */
        $this->start_controls_section(
            'team_social_settings',
            [
                'label' => esc_html__( 'Social Settings', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition' => [
                    'team_layout!' => 'slider',
                ]
            ]
        );

        $this->add_control(
			'enable_team_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'sublimetheme-advanced-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
            'social_icon',
            [
                'label'   => esc_html__( 'Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fab fa-pinterest-p',
                    'library' => 'fa-brands',
                ],
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'name'        => 'link',
                'label'       => esc_html__( 'Link', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => '#',
                    'is_external' => 'on',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );
		
		$this->add_control(
			'team_social_profiles',
			[
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'enable_team_social_profiles!' => '',
				],
				'default' => [
					[
						'social_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value' => 'fab fa-linkedin-in',
							'library' => 'fa-brands'
						]
					],
                    [
						'social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value' => 'fab fa-instagram',
							'library' => 'fa-brands'
						]
					],
					
				],
				'fields' => $repeater->get_controls(),
				'title_field' => '<i class="{{ social_icon.value }}"></i>',
			]
		);

        $this->end_controls_section(); //End Social Settings.

        /**
         * Team Box Style ( Style Tab )
         */
        $this->start_controls_section(
            'team_box_style_settings',
            [
                'label' => esc_html__( 'Team Box Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_alignment',
            [
                'label'       => esc_html__( 'Team Alignment', 'sublimetheme-advanced-addons-for-elementor' ),
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
                'prefix_class' => 'ste-team-align-',
                'selectors' => [
                    '{{WRAPPER}} .ste-team' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'team_box_padding',
			[
				'label'      => esc_html__( 'Team Box Padding', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .ste-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'team_box_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-team' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'team_box_border',
                'label'    => esc_html__( 'Team Box Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-team',
            ]
        );

        $this->add_control(
			'team_box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ste-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'team_box_shadow',
                'selector' => '{{WRAPPER}} .ste-team',
            ]
        );

        $this->end_controls_section(); //End Team Box Style Settings.

        /**
         * Image Style ( Style Tab )
         */
        $this->start_controls_section(
            'team_image_style_settings',
            [
                'label' => esc_html__( 'Image Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'team_image',
                'default' => 'full',
            ]
        );

        $this->add_control(
            'team_image_resize',
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
                    '{{WRAPPER}} .ste-team .ste-team-image' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
			'team_image_bottom_margin',
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
					'{{WRAPPER}} .ste-team .ste-team-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'team_image_shape',
            [
                'label'       => esc_html__( 'Image Shape', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'square',
                'label_block' => false,
                'options'     => [
                    // 'none'    => esc_html__( 'None' ),
                    'rounded' => esc_html__( 'Rounded', 'sublimetheme-advanced-addons-for-elementor' ),
                    'square'  => esc_html__( 'Square', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'prefix_class' => 'ste-team-image-shape-',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'team_image_border',
                'label' => esc_html__( 'Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-team .ste-team-image',
            ]
        );

        $this->add_control(
			'team_image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
                'condition' => [
                    'team_image_shape' => 'square',
                ],
				'selectors' => [
					'{{WRAPPER}} .ste-team .ste-team-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Image Style Settings.

        /**
         * Name Style ( Style Tab )
         */
        $this->start_controls_section(
            'team_title_style_settings',
            [
                'label' => esc_html__( 'Name Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_title_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-team .team-content .ste-team-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'team_title_typography',
                'selector' => '{{WRAPPER}} .ste-team .team-content .ste-team-title',
            ]
        );

        $this->add_responsive_control(
			'team_title_bottom_margin',
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
					'{{WRAPPER}} .ste-team .team-content .ste-team-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Name Style Settings.

        /**
         * Job Description Style ( Style Tab )
         */
        $this->start_controls_section(
            'team_jd_style_settings',
            [
                'label' => esc_html__( 'Job Description Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_jd_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-team .team-content .designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'team_jd_typography',
                'selector' => '{{WRAPPER}} .ste-team .team-content .designation',
            ]
        );

        $this->add_responsive_control(
			'team_jd_bottom_margin',
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
					'{{WRAPPER}} .ste-team .team-content .designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Job Description Style Settings.

        /**
         * Social Profile Style ( Style Tab )
         */
        $this->start_controls_section(
            'social_profile_style_settings',
            [
                'label' => esc_html__( 'Social Profile Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'social_profile_icon_size',
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
                    '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon i' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;',
                ],
            ]
        );

        // $this->add_responsive_control(
		// 	'social_profiles_padding',
		// 	[
		// 		'label' => esc_html__( 'Social Profiles Padding' ),
		// 		'type' => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'rem' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .ste-team .team-content .team-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_responsive_control(
		// 	'social_icon_padding',
		// 	[
		// 		'label'      => esc_html__( 'Social Icon Padding' ),
		// 		'type'       => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'rem' ],
		// 		'selectors'  => [
		// 			'{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );
		$this->add_responsive_control(
			'social_icon_spacing',
			[
				'label'      => esc_html__( 'Social Icon Margin', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ste-team .ste-team-wrap .team-social' => 'margin-left: -{{LEFT}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'social_profile_bg_shape',
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
                'prefix_class' => 'ste-social-icon-bg-shape-',
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
                    'social_profile_bg_shape!' => 'none',
                ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 300,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon a' => 'height: {{SIZE}}px; width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
			'social_profile_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
                'condition' => [
                    'social_profile_bg_shape' => 'rounded',
                ],
				'selectors' => [
					'{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'social_icon_style_tab' );

        $this->start_controls_tab( 
            'social_icon_normal', 
            [
                'label' => esc_html__( 'Normal', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'social_icon_text_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_icon_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'social_icon_border',
                'selector' => '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon a',
            ]
        );

        $this->end_controls_tab(); // End Normal Tab

        $this->start_controls_tab( 
            'social_icon_hover', 
            [
                'label' => esc_html__( 'Hover', 'sublimetheme-advanced-addons-for-elementor' ),
            ] 
        );

        $this->add_control(
            'social_icon_hover_text_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon a:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_icon_hover_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon a:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'social_icon_hover_border',
                'selector' => '{{WRAPPER}} .ste-team .team-content .team-social .ste-social-icon a:hover',
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Social Icon Style Tab

        $this->end_controls_section(); //End Social Profile Style Settings.
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        ob_start(); ?>
        <div class="ste-team">
            <div class="ste-team-wrap">
                <div class="ste-team-image">
                    <?php 
                        $team_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['team_image']['id'], 'team_image', $settings );
                        if( ! $team_image_url ) $team_image_url = $settings['team_image']['url']; 
                    ?>
                    <img src="<?php echo esc_url( $team_image_url ); ?>" alt="<?php echo esc_attr( get_post_meta( $settings['team_image']['id'], '_wp_attachment_image_alt', true) ); ?>">
                </div>
                <div class="team-content">
                    <<?php Utils::print_validated_html_tag( $settings['name_title_tag'] ); ?> class="ste-team-title">
                        <?php echo esc_html( $settings['team_name'] ); ?>
                    </<?php Utils::print_validated_html_tag( $settings['name_title_tag'] ); ?>>
                    <?php
                        if( $settings['team_job_designation'] ) echo '<div class="designation">' . esc_html( $settings['team_job_designation'] ) . '</div>';
                        
                        if( $settings['enable_team_social_profiles'] == 'yes' && $settings['team_social_profiles'] ){
                            $target = '';
                            $rel = '';
                            echo '<ul class="team-social">';
                            foreach( $settings['team_social_profiles'] as $team_social ){
                                if( 'on' == $team_social['social_link']['is_external'] ){
                                    $target = ' target="_blank"';
                                }
                        
                                if( 'on' == $team_social['social_link']['nofollow'] ){
                                    $rel =  ' rel="nofollow"';
                                } ?>
                                <li class="ste-social-icon">    
                                    <a href="<?php echo esc_url( $team_social['social_link']['url'] ); ?>"<?php echo $target . $rel; ?>>
                                        <?php Icons_Manager::render_icon( $team_social['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </a>
                                </li>   
                                <?php
                            }
                            echo '</ul>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
        $html = ob_get_clean();
        echo apply_filters( 'saafe_team_filter', $html, $settings );
    }
}