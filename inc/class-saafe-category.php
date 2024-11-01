<?php
/**
 * Elementor Category
 *
 * @package SublimeTheme_Advanced_Addons_For_Elementor
 */

if( ! defined( 'ABSPATH' ) ) exit();

/**
 * Category class.
 */
class SublimeTheme_Advanced_Addons_For_Elementor_Category {
    
    private static $instance = null;
    
    public function __construct() {
        $this->create_category();
    }
    
    public function create_category() {
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'sublimetheme-advanced-addons-for-elementor',
            array(
                'title' => __( 'SublimeTheme - Advanced Addons for Elementor', 'sublimetheme-advanced-addons-for-elementor' ),
            ),
            1
        );
    }
    
    public static function get_instance() {
        if( self::$instance == null ) {
           self::$instance = new self;
        }
        return self::$instance;
    }
}
SublimeTheme_Advanced_Addons_For_Elementor_Category::get_instance();