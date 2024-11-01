<?php
/**
 * Blog Elementor Widget
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
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Utils;

class SAAFE_Blog extends Widget_Base{

    public function get_name(){
		return 'saafe-blog';
	}

	public function get_title(){
		return esc_html__( 'Latest Posts', 'sublimetheme-advanced-addons-for-elementor' );
	}

	public function get_icon(){
		return 'eicon-post-list';
	}

	public function get_categories(){
		return ['sublimetheme-advanced-addons-for-elementor'];
	}

    public function get_style_depends() {
        wp_register_style( 'saafe-blog', SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL . 'inc/widgets/saafe-blog/blog.css', array(), SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION );
        return ['saafe-blog'];
    }

    public function get_keywords()
    {
        return [
            'blog',
            'post',
            'blog list',
            'post list',
            'sublime',
            'sublimetheme',
            'sublimetheme elements',
        ];
    }

    protected function register_controls(){
        /**
         * Post Settings
        */
        $this->start_controls_section(
            'blog_settings',
            [
                'label' => esc_html__( 'Blog Post Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'blog_layout',
            [
                'label'   => esc_html__( 'Layouts', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'simple',
                'options' => [
                    'simple'  => esc_html__( 'Classic', 'sublimetheme-advanced-addons-for-elementor' ),
                    'overlay' => esc_html__( 'Overlay', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'prefix_class' => 'ste-blog-layout-',
            ]
        );
            
        $this->add_control(
            'show_image',
            [
                'label'        => esc_html__( 'Show Featured Image', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                'label_off'    => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label'        => esc_html__( 'Show Category', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                'label_off'    => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
                'default'      => 'yes',
            ]
        ); 

        $this->add_control(
            'show_title',
            [
                'label'        => esc_html__( 'Show Title', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                'label_off'    => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'post_title_tag',
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
            'show_excerpt',
            [
                'label'        => esc_html__( 'Show Excerpt', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                'label_off'    => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'     => esc_html__( 'Excerpt Words Limit', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 20,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'show_author',
            [
                'label'        => esc_html__( 'Show Author', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                'label_off'    => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'author_by_text',
            [
                'label'       => esc_html__( 'Author By Text', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'by', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition'   => [
                    'show_author' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'author_avatar',
            [
                'label'       => esc_html__( 'Show Author Avatar', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                'label_off'    => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition'   => [
                    'show_author' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'show_date',
            [
                'label'        => esc_html__( 'Show Date', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                'label_off'    => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section(); //End Post Settings.

        /**
         * Button Settings
         */
        $this->start_controls_section(
            'blog_button',
            [
                'label' => esc_html__( 'Button Settings', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'show_blog_button',
            [
                'label'     => esc_html__( 'Show Button', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'blog_button_label',
            [
                'label'       => esc_html__( 'Button Label', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Learn More', 'sublimetheme-advanced-addons-for-elementor' ),
                'placeholder' => esc_html__( 'Enter button label', 'sublimetheme-advanced-addons-for-elementor' ),
                'condition'   => [
                    'show_blog_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'blog_button_url',
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
                    'show_blog_button' => 'yes',
                    'blog_button_label!' => '',
                ],
            ]
        );

        $this->add_control(
            'blog_button_icon',
            [
                'label'     => esc_html__( 'Icon', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_blog_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'blog_button_alignment',
            [
                'label'   => esc_html__( 'Icon Position', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'  => esc_html__( 'Before', 'sublimetheme-advanced-addons-for-elementor' ),
                    'right' => esc_html__( 'After', 'sublimetheme-advanced-addons-for-elementor' ),
                ],
                'condition' => [
                    'show_blog_button' => 'yes',
                ],
            ]
        );

        $this->end_controls_section(); //End Button Settings.

        /**
         * Latest Posts Box Style ( Style Tab )
         */
        $this->start_controls_section(
            'latest_post_box_style_settings',
            [
                'label' => esc_html__( 'Latest Posts Box Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'latest_post_box_padding',
			[
				'label'      => esc_html__( 'Latest Posts Box Padding', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .ste-blog-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'latest_post_box_bg_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'  => 'latest_post_box_border',
                'label' => esc_html__( 'Latest Posts Box Border', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-blog-item',
            ]
        );

        $this->add_control(
			'latest_post_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ste-blog-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'latest_post_box_shadow',
                'selector' => '{{WRAPPER}} .ste-blog-item',
            ]
        );

        $this->end_controls_section(); //End Latest Posts Box Style Settings.

        /**
         * Image Style ( Style Tab )
         */
        $this->start_controls_section(
            'blog_image_style_settings',
            [
                'label'     => esc_html__( 'Image Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'blog_image',
                'default' => 'full',
            ]
        );

        $this->add_responsive_control(
			'blog_image_bottom_margin',
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
					'{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-img' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->end_controls_section(); //End Image Style Settings.

        /**
         * Category Style ( Style Tab )
         */
        $this->start_controls_section(
            'blog_category_style_settings',
            [
                'label' => esc_html__( 'Category Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'blog_category_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-cat a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blog_category_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-cat a:hover' => 'color: {{VALUE}}',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_category_typography',
                'selector' => '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-cat a',
            ]
        );

        $this->add_responsive_control(
			'blog_category_bottom_margin',
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
					'{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-cat a' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->end_controls_section(); //End Category Style Settings.

        /**
         * Title Style ( Style Tab )
         */
        $this->start_controls_section(
            'blog_title_style_settings',
            [
                'label' => esc_html__( 'Title Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'blog_title_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blog_title_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-title a:hover' => 'color: {{VALUE}}',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_title_typography',
                'selector' => '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-title a',
            ]
        );

        $this->add_responsive_control(
			'blog_title_bottom_margin',
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
					'{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-title a' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->end_controls_section(); //End Title Style Settings.

        /**
         * Content Style ( Style Tab )
         */
        $this->start_controls_section(
            'blog_content_style_settings',
            [
                'label' => esc_html__( 'Content Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'blog_content_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_content_typography',
                'selector' => '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-desc',
            ]
        );

        $this->add_responsive_control(
			'blog_content_bottom_margin',
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
					'{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-desc' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
        
        $this->end_controls_section(); //End Content Style Settings.

        /**
         * Author Style ( Style Tab )
         */
        $this->start_controls_section(
            'blog_author_style_settings',
            [
                'label' => esc_html__( 'Author Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'show_author' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'author_avatar_resize',
            [
                'label'   => esc_html__( 'Avatar Resize', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'condition'   => [
                    'author_avatar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'blog_author_color',
            [
                'label'   => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-footer .ste-blog-author, {{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-footer .ste-blog-author a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blog_author_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-footer .ste-blog-author a:hover' => 'color: {{VALUE}}',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_author_typography',
                'selector' => '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-footer .ste-blog-author',
            ]
        );

        $this->add_responsive_control(
			'blog_author_top_margin',
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
					'{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-footer .ste-blog-author' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Author Style Settings.

        /**
         * Date Style ( Style Tab )
         */
        $this->start_controls_section(
            'blog_date_style_settings',
            [
                'label' => esc_html__( 'Date Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'blog_date_color',
            [
                'label'     => esc_html__( 'Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-footer .ste-blog-date' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_date_typography',
                'label'    => esc_html__( 'Typography', 'sublimetheme-advanced-addons-for-elementor' ),
                'selector' => '{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-footer .ste-blog-date',
            ]
        );

        $this->add_responsive_control(
			'blog_date_top_margin',
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
					'{{WRAPPER}} .ste-blog-holder .ste-blog-item .ste-blog-content .ste-blog-footer .ste-blog-date' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); //End Date Style Settings.

        /**
         * Button Style ( Style Tab )
         */
        $this->start_controls_section(
            'blog_button_style_settings',
            [
                'label'     => esc_html__( 'Button Style', 'sublimetheme-advanced-addons-for-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_blog_button' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'blog_button_typography',
                'selector' => '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button .blog-button-label',
            ]
        );

        $this->add_control(
            'blog_button_spacing',
            [
                'label' => esc_html__( 'Button Icon Spacing', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ste-blog-icon-right' => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .ste-blog-icon-left' => 'margin-right: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_button_size',
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
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_button_padding',
            [
                'label'      => esc_html__( 'Button Padding', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'blog_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'blog_button_style_tab' );

        $this->start_controls_tab( 
            'blog_button_normal', 
            [
                'label' => esc_html__( 'Normal', 'sublimetheme-advanced-addons-for-elementor' ),
            ]
        );

        $this->add_control(
            'blog_button_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button .blog-button-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blog_button_icon_color',
            [
                'label'   => esc_html__( 'Icon Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button .ste-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button .ste-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blog_button_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'blog_button_border',
                'selector' => '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'blog_button_box_shadow',
                'selector' => '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button',
            ]
        );

        $this->end_controls_tab(); // End Normal Tab

        $this->start_controls_tab( 
            'blog_button_hover', 
            [
                'label' => esc_html__( 'Hover', 'sublimetheme-advanced-addons-for-elementor' ),
            ] 
        );

        $this->add_control(
            'blog_button_hover_text_color',
            [
                'label'   => esc_html__( 'Text Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button:hover .blog-button-label' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button:hover .ste-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button:hover .ste-icon' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blog_button_hover_background_color',
            [
                'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'blog_button_hover_border',
                'selector' => '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'blog_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .ste-load-more-button-wrap .ste-load-more-button:hover',
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Button Style Tab

        $this->add_responsive_control(
            'blog_loadmore_button_alignment',
            [
                'label'   => esc_html__( 'Button Alignment', 'sublimetheme-advanced-addons-for-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'        => [
                        'title' => esc_html__( 'Center', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'      => [
                        'title' => esc_html__( 'Right', 'sublimetheme-advanced-addons-for-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ste-load-more-button-wrap' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section(); //End Button Style Settings.
    }

    protected function render(){
        $settings = $this->get_settings_for_display();

        $qry = new \WP_Query( array( 
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => 3,
            'ignore_sticky_posts' => true
        ) );

        ob_start();
        if( $qry->have_posts() ){
            echo '<div class="ste-blog-holder"><div class="ste-blog-holder-inner">';
            while( $qry->have_posts() ){
                $qry->the_post(); ?>
                    <div class="ste-blog-item">
                        <?php 
                            if( $settings['show_image'] == 'yes' ){ ?>
                                <figure class="ste-blog-img">
                                    <a href=<?php the_permalink(); ?> title="<?php the_title_attribute(); ?>">
                                        <?php 
                                            if( has_post_thumbnail() ){
                                                $blog_img_url = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id(), 'blog_image', $settings );
                                            }else{
                                                $blog_img_url = Utils::get_placeholder_image_src();
                                            }
                                        ?>
                                        <img src="<?php echo esc_url( $blog_img_url );?>" alt="<?php echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); ?>">
                                    </a>
                                </figure>
                                <?php
                            }
                        ?>
                        <div class="ste-blog-content">
                            <?php
                                if( $settings['show_category'] || $settings['show_title'] ){
                                    echo '<header class="ste-blog-header">';
                                    if( $settings['show_category'] ) {
                                        $categories_list = get_the_category_list( ' ' );
                                        if( $categories_list ) {
                                            echo '<span class="ste-blog-cat" itemprop="about">' . wp_kses_post( $categories_list ) . '</span>';
                                        }
                                    }

                                    if ( $settings['show_title'] ) { ?>
                                        <<?php Utils::print_validated_html_tag( $settings['post_title_tag'] ); ?> class="ste-blog-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></<?php Utils::print_validated_html_tag( $settings['post_title_tag'] ); ?>>
                                        <?php
                                    }
                                    echo '</header>';
                                }

                                if( $settings['show_excerpt'] ){
                                    echo '<div class="ste-blog-desc">';
                                    if( has_excerpt() ){
                                        the_excerpt();
                                    }else{
                                        echo wpautop( wp_kses_post( wp_trim_words( strip_shortcodes( get_the_content() ), $settings['excerpt_length'] ) ) );
                                    }
                                    echo '</div>';
                                }

                                if( $settings['show_author'] || $settings['show_date'] ){
                                    echo '<footer class="ste-blog-footer">';
                                    if( $settings['show_author'] ){
                                        echo '<span class="ste-blog-author">';
                                        if ( $settings['author_avatar'] ) {
                                            echo '<span class="ste-author-avatar"><a href="' . get_author_posts_url( get_the_author_meta('ID') ) . '">' . get_avatar( get_the_author_meta( 'ID' ), $settings['author_avatar_resize']['size'] ) . '</a></span>';
                                        }
                                        if( $settings['author_by_text'] ) echo '<span class="ste-authorby">' . esc_html( $settings['author_by_text'] ) . '</span>';
                                        echo get_the_author_posts_link() . '</span>';
                                    }
                                    if( $settings['show_date'] ){
                                        echo '<span class="ste-blog-date"><time>' . esc_html( get_the_date() ) . '</time></span>';
                                    }
                                    echo '</footer>';
                                }
                            ?>
                        </div>
                    </div><!--ste-blog-item-->
                <?php
            }
            echo '</div></div>';
         
            wp_reset_postdata();

            if ( 'yes' == $settings['show_blog_button'] && $settings['blog_button_label'] && $settings['blog_button_url']  ) { 
                $this->add_render_attribute( 'blog_button_url', 'class', 'ste-load-more-button' );
                
                if( $settings['blog_button_url']['url'] ){
                    $this->add_render_attribute( 'blog_button_url', 'href', esc_url( $settings['blog_button_url']['url'] ) );
                }
        
                if( 'on' == $settings['blog_button_url']['is_external'] ){
                    $this->add_render_attribute( 'blog_button_url', 'target', '_blank' );
                }
        
                if( 'on' == $settings['blog_button_url']['nofollow'] ){
                    $this->add_render_attribute( 'blog_button_url', 'rel', 'nofollow' );
                } ?>
                <div class="ste-load-more-button-wrap">
                    <a <?php echo $this->get_render_attribute_string( 'blog_button_url' ); ?>>
                        <?php
                            if( $settings['blog_button_alignment'] == 'left' && $settings['blog_button_icon']['library'] ){
                                echo '<span class="ste-icon ste-blog-icon-left">';
                                Icons_Manager::render_icon( $settings['blog_button_icon'], [ 'aria-hidden' => 'true' ] );
                                echo '</span>';
                            }
                        ?>
                        <span class="blog-button-label"><?php echo esc_html( $settings['blog_button_label'] ); ?></span>
                        <?php
                            if( $settings['blog_button_alignment'] == 'right' && $settings['blog_button_icon']['library'] ){
                                echo '<span class="ste-icon ste-blog-icon-right">';
                                Icons_Manager::render_icon( $settings['blog_button_icon'], [ 'aria-hidden' => 'true' ] );
                                echo '</span>';
                            }
                        ?>
                    </a>
                </div>
                <?php
            }

        }
        $html = ob_get_clean();
        echo apply_filters( 'saafe_blog_list_filter', $html, $qry, $settings );   
    }
}