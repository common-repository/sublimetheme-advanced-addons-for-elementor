<?php
/**
 * Pricing Elementor Widget
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
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use SublimeTheme_Advanced_Addons_For_Elementor\Helper;

class SAAFE_Pricing extends Widget_Base {
    public function get_name(){
		return 'saafe-pricing';
	}

	public function get_title(){
		return esc_html__( 'Pricing', 'sublimetheme-advanced-addons-for-elementor' );
	}

	public function get_icon(){
		return 'eicon-table-of-contents';
	}

	public function get_categories(){
		return ['sublimetheme-advanced-addons-for-elementor'];
	}

    public function get_style_depends() {
        wp_register_style( 'saafe-pricing', SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL . 'inc/widgets/saafe-pricing/pricing.css', array(), SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION );
        return ['saafe-pricing'];
    }

    public function get_keywords()
    {
        return [
            'pricing',
            'price menu',
            'price',
            'price table',
            'pricing plan',
            'dynamic price',
            'comparison table',
            'woocommerce pricing',
            'sublime',
            'sublimetheme',
            'sublimetheme elements',
        ];
    }

    protected function register_controls(){
        /**
         * Price Settings
         */
        $this->start_controls_section(
            'price_settings',
            [
                'label' => esc_html__( 'Price Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'price',
            [
                'label'   => esc_html__( 'Price', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( '99', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'onsale',
            [
                'label' => esc_html__( 'On Sale?', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'sale_price',
            [
                'label'     => esc_html__( 'Sale Price', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( '89', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition' => [
                    'onsale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'price_currency',
            [
                'label'   => esc_html__( 'Price Currency', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( '$', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'price_period',
            [
                'label'   => esc_html__( 'Price Period (per)', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'month', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'period_separator',
            [
                'label'   => esc_html__( 'Period Separator', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( '/', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->end_controls_section(); //End Price Settings.

        /**
         * Content Settings
         */
        $this->start_controls_section(
            'pricing_content_settings',
            [
                'label' => esc_html__( 'Content Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'pricing_title',
            [
                'label'       => esc_html__( 'Title', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Lite', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'pricing_title_tag',
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
            'pricing_text',
            [
                'label'       => esc_html__( 'Content', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default'     => esc_html__( 'Write a short description, that will describe about pricing.', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->end_controls_section(); //End Content Settings.

        /**
         * Pricing Table Features
         */
        $this->start_controls_section(
            'pricing_table_features',
            [
                'label' => esc_html__( 'Pricing Table Features', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_item',
            [
                'label'       => esc_html__( 'List Item', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Pricing table list item', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $repeater->add_control(
            'list_icon',
            [
                'label'   => esc_html__( 'List Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-check-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'list_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'item_tooltip',
            [
                'label' => esc_html__( 'Enable Tooltip?', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $repeater->add_control(
            'item_tooltip_content',
            [
                'label'     => esc_html__( 'Tooltip Content', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => esc_html__( 'Awesome ToolTips', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition' => [
                    'item_tooltip' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pricing_table_items',
            [
                'type'    => Controls_Manager::REPEATER,
                'default' => [
                    [ 'list_item' => esc_html__( '10GB Storage', 'sublimetheme-advanced-addons-for-elementor' ) ],
                    [ 'list_item' => esc_html__( '1 User', 'sublimetheme-advanced-addons-for-elementor' ) ],
                    [ 'list_item' => esc_html__( 'Support Forum', 'sublimetheme-advanced-addons-for-elementor' ) ],
                    [ 'list_item' => esc_html__( 'Free Hosting', 'sublimetheme-advanced-addons-for-elementor' ) ],
                    [ 'list_item' => esc_html__( 'Perfect for modern startups', 'sublimetheme-advanced-addons-for-elementor' ) ],
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{list_item}}',
            ]
        );

        $this->end_controls_section(); //End Pricing Table Features Settings.

        /**
         * Button Settings
         */
        $this->start_controls_section(
            'pricing_icon_button',
            [
                'label' => esc_html__( 'Button Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'show_pricing_icon_button',
            [
                'label' => esc_html__( 'Show Button', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'pricing_icon_button_label',
            [
                'label'       => esc_html__( 'Button Label', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Start my free trial', 'sublimetheme-advanced-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Enter button label', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition'   => [
                    'show_pricing_icon_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pricing_icon_button_url',
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
                    'show_pricing_icon_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pricing_icon_button_icon',
            [
                'label'   => esc_html__( 'Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_pricing_icon_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pricing_icon_button_alignment',
            [
                'label'   => esc_html__( 'Icon Position', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'  => esc_html__( 'Before', 'sublimetheme-advanced-addons-for-elementor' ),
                    'right' => esc_html__( 'After', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'condition' => [
                    'show_pricing_icon_button' => 'yes',
                ],
            ]
        );

        $this->end_controls_section(); //End Button Settings.

        /**
         * Ribbon Setting
         */
        $this->start_controls_section(
            'pricing_table_ribbon',
            [
                'label' => esc_html__( 'Ribbon Setting', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'pricing_table_featured',
            [
                'label' => esc_html__( 'Show Featured Text', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'featured_text',
            [
                'label'     => esc_html__( 'Featured Text', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Most Popular', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition' => [
                    'pricing_table_featured' => 'yes',
                ],
            ]
        );

        $this->end_controls_section(); //End Button Settings.

        /**
         * Pricing Box Style ( Style Tab )
         */
        $this->start_controls_section(
            'pricing_box_style_settings',
            [
                'label' => esc_html__( 'Pricing Box Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'pricing_box_padding',
			[
				'label'      => esc_html__( 'Pricing Box Padding', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ste-pt-block .ste-pt-block-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'pricing_box_bg_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'pricing_box_border',
                'label' => esc_html__( 'Pricing Box Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-pt-block',
            ]
        );

        $this->add_control(
			'pricing_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ste-pt-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pricing_box_shadow',
                'selector' => '{{WRAPPER}} .ste-pt-block',
            ]
        );

        $this->end_controls_section(); //End Pricing Box Style Settings.

        /**
         * Title Style ( Style Tab )
         */
        $this->start_controls_section(
            'pricing_title_style_settings',
            [
                'label' => esc_html__( 'Title Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pricing_title_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner .ste-pt-header .ste-pt-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pricing_title_typography',
                'selector' => '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner .ste-pt-header .ste-pt-title',
            ]
        );

        $this->add_responsive_control(
			'pricing_title_bottom_margin',
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
					'{{WRAPPER}} .ste-pt-block .ste-pt-block-inner .ste-pt-header .ste-pt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Title Style Settings.

        /**
         * Pricing Style ( Style Tab )
         */
        $this->start_controls_section(
            'pricing_style_settings',
            [
                'label' => esc_html__( 'Pricing Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'pricing_price_bottom_margin',
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
					'{{WRAPPER}} .ste-pt-block .ste-pt-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'original_price_heading',
            [
                'label'     => esc_html__( 'Original Price', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'original_price_color',
            [
                'label'     => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#999',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-header .ste-pt-price .original-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'original_price_typography',
                'selector' => '{{WRAPPER}} .ste-pt-block .ste-pt-header .ste-pt-price .original-price',
            ]
        );

        $this->add_control(
            'sale_price_heading',
            [
                'label'     => esc_html__( 'Sale Price', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'onsale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'sale_price_color',
            [
                'label'     => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#999',
                'condition' => [
                    'onsale' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-header .ste-pt-price .sale-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sale_price_typography',
                'condition' => [
                    'onsale' => 'yes',
                ],
                'selector' => '{{WRAPPER}} .ste-pt-block .ste-pt-header .ste-pt-price .sale-price',
            ]
        );

        $this->add_control(
            'pricing_period_heading',
            [
                'label'     => esc_html__( 'Pricing Period', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pricing_period_color',
            [
                'label'     => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#999',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-header .ste-pt-price .ste-pt-duration' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'pricing_period_typography',
                'selector' => '{{WRAPPER}} .ste-pt-block .ste-pt-header .ste-pt-price .ste-pt-duration',
            ]
        );

        $this->end_controls_section(); //End Pricing Style Settings.

        /**
         * Content Style ( Style Tab )
         */
        $this->start_controls_section(
            'pricing_content_style_settings',
            [
                'label' => esc_html__( 'Content Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pricing_content_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner .ste-pt-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pricing_content_typography',
                'selector' => '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner .ste-pt-desc',
            ]
        );

        $this->add_responsive_control(
			'pricing_content_bottom_margin',
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
					'{{WRAPPER}} .ste-pt-block .ste-pt-block-inner .ste-pt-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section(); //End Content Style Settings.

        /**
         * Ribbon Style ( Style Tab )
         */
        $this->start_controls_section(
            'ribbon_style_settings',
            [
                'label' => esc_html__( 'Ribbon Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pricing_table_featured' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ribbon_text_color',
            [
                'label'     => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-tag' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ribbon_bg_color',
            [
                'label'     => esc_html__( 'Background', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-tag' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ribbon_typography',
                'selector' => '{{WRAPPER}} .ste-pt-block .ste-pt-tag',
            ]
        );

        $this->end_controls_section(); //End Ribbon Style Settings.

        /**
         * Feature List Style ( Style Tab )
         */
        $this->start_controls_section(
            'feature_list_style_settings',
            [
                'label' => esc_html__( 'Feature List Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'feature_list_top_margin',
			[
				'label'      => esc_html__( 'Top Margin', 'sublimetheme-advanced-addons-for-elementor' ),
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
					'{{WRAPPER}} .ste-pt-block .ste-pt-list li' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'feature_list_item_color',
            [
                'label'     => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner ul.ste-pt-list li .ste-pt-txt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'feature_list_item_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner ul.ste-pt-list li .ste-pt-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner ul.ste-pt-list li .ste-pt-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner ul.ste-pt-list li .ste-pt-icon' => 'margin-right: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'feature_list_item_typography',
                'selector' => '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner ul.ste-pt-list li .ste-pt-txt',
            ]
        );

        $this->end_controls_section(); //End Feature List Style Settings.

        /**
         * Tooltip Style ( Style Tab )
         */
        $this->start_controls_section(
            'tooltip_style_settings',
            [
                'label' => esc_html__( 'Tooltip Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tooltip_text_color',
            [
                'label'     => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner ul.ste-pt-list li .ste-pt-tooltip-txt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tooltip_bg_color',
            [
                'label'     => esc_html__( 'Background', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner ul.ste-pt-list li .ste-pt-tooltip-txt' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ste-pt-block .ste-pt-list .ste-pt-tooltip .ste-pt-tooltip-txt::before' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tooltip_typography',
                'selector' => '{{WRAPPER}} .ste-pt-block .ste-pt-block-inner ul.ste-pt-list li .ste-pt-tooltip-txt',
            ]
        );

        $this->end_controls_section(); //End Tooltip Style Settings.

        /**
         * Button Style ( Style Tab )
         */
        $this->start_controls_section(
            'pricing_button_style_settings',
            [
                'label'     => esc_html__( 'Button Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pricing_icon_button' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
			'pricing_button_bottom_margin',
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
					'{{WRAPPER}} .ste-pt-block .ste-pt-btn-holder' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'pricing_button_width',
            [
                'label' => esc_html__( 'Button fullwidth?', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pricing_button_typography',
                'selector' => '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn .icon-button-label',
            ]
        );

        $this->add_control(
            'pricing_button_spacing',
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
            'pricing_button_size',
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
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pricing_button_padding',
            [
                'label'      => esc_html__( 'Button Padding', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'pricing_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'pricing_button_style_tab' );

        $this->start_controls_tab( 
            'pricing_button_normal', 
            [
                'label' => esc_html__( 'Normal', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'pricing_button_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn .icon-button-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_button_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn .ste-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn .ste-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_button_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing_button_border',
                'selector' => '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pricing_button_box_shadow',
                'selector' => '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn',
            ]
        );

        $this->end_controls_tab(); // End Normal Tab

        $this->start_controls_tab( 
            'pricing_button_hover', 
            [
                'label' => esc_html__( 'Hover', 'sublimetheme-advanced-addons-for-elementor' ),
            ] 
        );

        $this->add_control(
            'pricing_button_hover_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn:hover .icon-button-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blog_button_hover_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn:hover .ste-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn:hover .ste-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_button_hover_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing_button_hover_border',
                'selector' => '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pricing_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .ste-pt-btn-holder .ste-pt-btn:hover',
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Button Style Tab

        $this->end_controls_section(); //End Button Style Settings.
    }

    protected function render(){
        $settings = $this->get_settings_for_display(); 
        
        $this->add_render_attribute( 'pricing_feature', 'class', 'ste-pt-block' );
        
        if( $settings['pricing_table_featured'] == 'yes' ){
            $this->add_render_attribute( 'pricing_feature', 'class', 'featured' );
        }

        ?>

        <div <?php echo $this->get_render_attribute_string( 'pricing_feature' ); ?>>
            <?php 
                if( $settings['pricing_table_featured'] == 'yes' && $settings['featured_text'] ){
                    echo '<span class="ste-pt-tag">' . esc_html( $settings['featured_text'] ) . '</span>';
                }            
            ?>

            <div class="ste-pt-block-inner">
                <div class="ste-pt-header">
                    <<?php Utils::print_validated_html_tag( $settings['pricing_title_tag'] ); ?> class="ste-pt-title">
                        <?php echo esc_html( $settings['pricing_title'] ); ?>
                    </<?php Utils::print_validated_html_tag( $settings['pricing_title_tag'] ); ?>>

                    <div class="ste-pt-price">
                        <?php 
                            if( $settings['onsale'] == 'yes' ){ ?>
                                <span class="original-price">
                                    <span class="ste-pt-currency"><?php echo esc_html( $settings['price_currency'] );?></span>
                                    <span class="ste-pt-amt"><?php echo esc_html( $settings['price'] ); ?></span>
                                </span>
                                <span class="sale-price">
                                    <span class="ste-pt-currency"><?php echo esc_html( $settings['price_currency'] );?></span>
                                    <span class="ste-pt-amt"><?php echo esc_html( $settings['sale_price'] ); ?></span>
                                </span>                                
                                <?php
                            }else{ ?>
                                <span class="original-price">
                                    <span class="ste-pt-currency"><?php echo esc_html( $settings['price_currency'] );?></span>
                                    <span class="ste-pt-amt"><?php echo esc_html( $settings['price'] ); ?></span>
                                </span>
                                <?php
                            }
                            
                            if( $settings['period_separator'] && $settings['price_period'] ){
                                echo '<span class="ste-pt-duration">' . esc_html( $settings['period_separator'] . $settings['price_period'] ) . '</span>';
                            }
                        ?>
                    </div>

                </div>

                <?php 
                    if( $settings['pricing_text'] ) echo '<div class="ste-pt-desc">' . wpautop( wp_kses_post( $settings['pricing_text'] ) ) . '</div>';

                    if( 'yes' == $settings['show_pricing_icon_button'] && $settings['pricing_icon_button_label'] && $settings['pricing_icon_button_url']  ) { 
                        

                        if( $settings['pricing_button_width'] == 'yes' ) {
                            $this->add_render_attribute( 'pricing_icon_button_url', 'class', 'ste-pt-btn btn-full' );
                        } else {
                            $this->add_render_attribute( 'pricing_icon_button_url', 'class', 'ste-pt-btn' );
                        }
                        
                        if( $settings['pricing_icon_button_url']['url'] ){
                            $this->add_render_attribute( 'pricing_icon_button_url', 'href', esc_url( $settings['pricing_icon_button_url']['url'] ) );
                        }
                
                        if( 'on' == $settings['pricing_icon_button_url']['is_external'] ){
                            $this->add_render_attribute( 'pricing_icon_button_url', 'target', '_blank' );
                        }
                
                        if( 'on' == $settings['pricing_icon_button_url']['nofollow'] ){
                            $this->add_render_attribute( 'pricing_icon_button_url', 'rel', 'nofollow' );
                        } ?>
                        <div class="ste-pt-btn-holder">
                            <a <?php echo $this->get_render_attribute_string( 'pricing_icon_button_url' ); ?>>
                                <?php
                                    if( $settings['pricing_icon_button_alignment'] == 'left' && $settings['pricing_icon_button_icon']['library'] ){
                                        echo '<span class="ste-icon ste-icon-left">';
                                        Icons_Manager::render_icon( $settings['pricing_icon_button_icon'], [ 'aria-hidden' => 'true' ] );
                                        echo '</span>';
                                    }
                                ?>
                                <span class="icon-button-label"><?php echo esc_html( $settings['pricing_icon_button_label'] ); ?></span>
                                <?php
                                    if( $settings['pricing_icon_button_alignment'] == 'right' && $settings['pricing_icon_button_icon']['library'] ){
                                        echo '<span class="ste-icon ste-icon-right">';
                                        Icons_Manager::render_icon( $settings['pricing_icon_button_icon'], [ 'aria-hidden' => 'true' ] );
                                        echo '</span>';
                                    }
                                ?>
                            </a>
                        </div>
                        <?php
                    }

                    if( $settings['pricing_table_items'] ){ ?>
                        <ul class="ste-pt-list">
                            <?php 
                                foreach( $settings['pricing_table_items'] as $item ){ ?>
                                    <li>
                                        <span class="ste-pt-icon" style="color:<?php echo esc_attr( Helper::fetch_color_or_global_color( $item, 'list_icon_color' ) ); ?>;fill:<?php echo esc_attr( Helper::fetch_color_or_global_color( $item, 'list_icon_color' ) ); ?>;">
                                            <?php Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </span>
                                        <span class="ste-pt-txt"><?php echo wp_kses_post( $item['list_item'] ); ?>                                
                                            <?php 
                                                if( $item['item_tooltip'] && $item['item_tooltip_content'] ){ ?>
                                                    <span class="ste-pt-tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M160 448h-32V224c0-17.69-14.33-32-32-32L32 192c-17.67 0-32 14.31-32 32s14.33 31.1 32 31.1h32v192H32c-17.67 0-32 14.31-32 32s14.33 32 32 32h128c17.67 0 32-14.31 32-32S177.7 448 160 448zM96 128c26.51 0 48-21.49 48-48S122.5 32.01 96 32.01s-48 21.49-48 48S69.49 128 96 128z"/></svg>
                                                        <span class="ste-pt-tooltip-txt"><?php echo esc_html( $item['item_tooltip_content'] ); ?></span>
                                                    </span>
                                                    <?php 
                                                } 
                                            ?>
                                        </span>
                                    </li>
                                    <?php 
                                } 
                            ?>
                        </ul>
                        <?php
                    }
                ?>
            </div>
        </div>
        <?php
    }
}