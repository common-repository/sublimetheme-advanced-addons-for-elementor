<?php
/**
 * WPForms Elementor Widget
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
use Elementor\Widget_Base;
use SublimeTheme_Advanced_Addons_For_Elementor\Helper;

class SAAFE_WPForms extends Widget_Base {
    public function get_name(){
		return 'saafe-wpforms';
	}

	public function get_title(){
		return esc_html__( 'WPForms', 'sublimetheme-advanced-addons-for-elementor' );
	}

	public function get_icon(){
		return 'eicon-form-horizontal';
	}

	public function get_categories(){
		return ['sublimetheme-advanced-addons-for-elementor'];
	}

    public function get_style_depends() {
        wp_register_style( 'saafe-wpforms', SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_URL . 'inc/widgets/saafe-wpforms/wpforms.css', array(), SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION );
        return ['saafe-wpforms'];
    }

    public function get_keywords()
    {
        return [
            'contact form',
            'form styler',
            'elementor form',
            'feedback',
            'wp forms',
            'wpforms',
            'sublime',
            'sublimetheme',
            'sublimetheme elements',
        ];
    }

    protected function register_controls(){
        if( ! class_exists( '\WPForms\WPForms' ) ){
            $this->start_controls_section(
                'wpform_warning',
                [
                    'label' => esc_html__( 'Warning!!!', 'sublimetheme-advanced-addons-for-elementor' ),
                ]
            );

            $this->add_control(
                'wpform_warning_text',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf( esc_html__( '%1$sWPForms%2$s is not installed/activated on your site. Please install and activate %1$sWPForms%2$s first.', 'sublimetheme-advanced-addons-for-elementor' ), '<strong>', '</strong>' ),
                    'content_classes' => 'st-warning',
                ]
            );

            $this->end_controls_section();
        }else{
            /**
             * WPForms
             */
            $this->start_controls_section(
                'wpforms_section',
                [
                    'label' => esc_html__( 'WPForms', 'sublimetheme-advanced-addons-for-elementor' ),
                ]
            );

            $this->add_control(
                'contact_form_list',
                [
                    'label'       => esc_html__( 'Select Form', 'sublimetheme-advanced-addons-for-elementor' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options'     => Helper::get_wpforms_list(),
                    'default'     => '0',
                ]
            );

            $this->add_control(
                'form_title',
                [
                    'label'     => esc_html__( 'Title', 'sublimetheme-advanced-addons-for-elementor' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'label_on'  => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                    'label_off' => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
                ]
            );

            $this->add_control(
                'form_description',
                [
                    'label'     => esc_html__( 'Description', 'sublimetheme-advanced-addons-for-elementor' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'label_on'  => esc_html__( 'Show', 'sublimetheme-advanced-addons-for-elementor' ),
                    'label_off' => esc_html__( 'Hide', 'sublimetheme-advanced-addons-for-elementor' ),
                ]
            );

            $this->end_controls_section(); //End WPForms Settings.

            /**
             * WPForm Box Style ( Style Tab )
             */
            $this->start_controls_section(
                'wpform_box_style_settings',
                [
                    'label' => esc_html__( 'WPForm Box Style', 'sublimetheme-advanced-addons-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'wpform_box_padding',
                [
                    'label'      => esc_html__( 'WPForm Box Padding', 'sublimetheme-advanced-addons-for-elementor' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'rem' ],
                    'selectors' => [
                    	'{{WRAPPER}} .ste-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'wpform_box_bg_color',
                [
                    'label'   => esc_html__( 'Background Color', 'sublimetheme-advanced-addons-for-elementor' ),
                    'type'    => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .ste-contact-form' => 'background: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'  => 'wpform_box_border',
                    'label' => esc_html__( 'WPForm Box Border', 'sublimetheme-advanced-addons-for-elementor' ),
                    'selector' => '{{WRAPPER}} .ste-contact-form',
                ]
            );

            $this->add_control(
                'wpform_box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'sublimetheme-advanced-addons-for-elementor' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                    	'{{WRAPPER}} .ste-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'wpform_box_shadow',
                    'selector' => '{{WRAPPER}} .ste-contact-form',
                ]
            );

            $this->end_controls_section(); //End WPForm Box Style Settings.
        }
    }

    protected function render(){
        if( ! class_exists( '\WPForms\WPForms' ) ){
            return;
        }

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'contact-form', 'class', [
            'ste-contact-form',
            'ste-wpforms',
        ]);

        if( ! empty( $settings['contact_form_list'] ) ){ ?>
            <div <?php echo $this->get_render_attribute_string( 'contact-form' ); ?>>
                <?php
                    $form_title       = $settings['form_title'];
                    $form_description = $settings['form_description'];

                    echo wpforms_display( $settings['contact_form_list'], $form_title, $form_description );
                ?>
            </div>
            <?php
        }
    }
}