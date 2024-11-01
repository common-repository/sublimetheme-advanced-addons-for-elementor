<?php
/**
 * Register Elementor Widgets
 * 
 * @package SublimeTheme_Advanced_Addons_For_Elementor
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SublimeTheme_Advanced_Addons_For_Elementor_Widgets{
    
    /**
	 * Initialize class
	 */
	public static function init() {
		add_action( 'elementor/widgets/widgets_registered', array( __CLASS__, 'register_widgets' ) );
	}

    /**
     * Widget Lists
     */
    public static function get_widgets_list() {
		$widget_array = array(
			'saafe-blog' => array(
                'classname' => 'SAAFE_Blog',
                'slug'      => 'blog',                
            ),
            'saafe-icon' => array(
                'classname' => 'SAAFE_Icon',
                'slug'      => 'icon',                
            ),
            'saafe-cta' => array(
                'classname' => 'SAAFE_Cta',
                'slug'      => 'cta',                
            ),
            'saafe-counter' => array(
                'classname' => 'SAAFE_Counter',
                'slug'      => 'counter',                
            ),
            'saafe-pricing' => array(
                'classname' => 'SAAFE_Pricing',
                'slug'      => 'pricing',                
            ),
            'saafe-team' => array(
                'classname' => 'SAAFE_Team',
                'slug'      => 'team',                
            ),
            'saafe-wpforms' => array(
                'classname' => 'SAAFE_WPForms',
                'slug'      => 'wpforms',                
            ),
        );
        
        return $widget_array;
    }

    /**
     * Registering Elementor Widgets
     */
    public static function register_widgets(){        
        foreach ( self::get_widgets_list() as $key => $value ) {
			$widget_file = SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_PATH . 'inc/widgets/' . $key . '/'. $value['slug'] .'.php';
            if ( is_readable( $widget_file ) ) {

                include_once( $widget_file );
    
                $widget_class = '\SublimeTheme_Advanced_Addons_For_Elementor\Widgets\\' .  $value['classname'];

                if ( class_exists( $widget_class ) ) {
                    \Elementor\Plugin::instance()->widgets_manager->register( new $widget_class );
                }
            }
		}
    }
}
SublimeTheme_Advanced_Addons_For_Elementor_Widgets::init();