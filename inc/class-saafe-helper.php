<?php
/**
 * Helper Class
 * 
 * @package SublimeTheme_Advanced_Addons_For_Elementor
 */

namespace SublimeTheme_Advanced_Addons_For_Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Helper{
    
    /**
     * Get WPForms List
     *
     * @return array
     */
    public static function get_wpforms_list() {
        $options = array();

        if( class_exists('\WPForms\WPForms') ){
            $args = array(
                'post_type' => 'wpforms',
                'posts_per_page' => -1,
            );

            $contact_forms = get_posts( $args );

            if( !empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ){
                $options[0] = esc_html__( 'Select a WPForm', 'sublimetheme-advanced-addons-for-elementor' );
                foreach( $contact_forms as $post ){
                    $options[$post->ID] = $post->post_title;
                }
            }else{
                $options[0] = esc_html__( 'Create a Form First', 'sublimetheme-advanced-addons-for-elementor' );
            }
        }

        return $options;
    }

    public static function fetch_color_or_global_color( $settings, $control_name = '' ){
        if( !isset( $settings[$control_name] ) ){
            return '';
        }

        $color = $settings[$control_name];

        if( !empty( $settings['__globals__'] ) && !empty( $settings['__globals__'][$control_name] ) ){
            $color = $settings['__globals__'][$control_name];
            $color_arr = explode( '?id=', $color ); //E.x. 'globals/colors/?id=primary'

            $color_name = count( $color_arr ) > 1 ? $color_arr[1] : '';
            if( !empty( $color_name ) ) {
                $color = "var( --e-global-color-$color_name )";
            }
        }

        return $color;
    }
}