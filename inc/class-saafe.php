<?php
/**
 * Main Class of the plugin.
 * 
 * @package SublimeTheme_Advanced_Addons_For_Elementor
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SublimeTheme_Advanced_Addons_For_Elementor{

    /**
     * Member Variable
     */
    private static $instance = null;

    /**
     * Creates and returns an instance of the class
     */
    public static function get_instance() {
        if( self::$instance == null ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Hooks fired upon activation
     */
    public function __construct(){
		//Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', array( $this, 'elementor_missing_notice' ) );
            return;
        }

        add_action( 'plugins_loaded', array( $this, 'load_required_files' ) );
        add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scrpts' ) );
    }

    /**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain(){
		load_plugin_textdomain( 'sublimetheme-advanced-addons-for-elementor', false, SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_PATH . 'languages/' );
	}    
	
	/**
     * Elementor missing admin notice
     */
    public function elementor_missing_notice() { ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <?php 
                    printf( esc_html__( '%1$sSublimeTheme - Advanced Addons for Elementor%2$s requires %1$sElementor%2$s plugin to be installed and activated to function properly.', 'sublimetheme-advanced-addons-for-elementor' ), '<strong>', '</strong>' );
                ?>
                <a href="<?php echo esc_url( admin_url( 'plugin-install.php?s=Elementor&tab=search&type=term' ) ); ?>">
                    <?php esc_html_e( 'Please click on this link and install Elementor plugin first.', 'sublimetheme-advanced-addons-for-elementor' ); ?>
                </a>
            </p>
        </div>
        <?php
    }

    /**
     * Load Required files
     */
    public function load_required_files() {
        require_once SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_PATH . '/inc/class-saafe-widgets.php';
        require_once SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_PATH . '/inc/class-saafe-helper.php';
    }

    /**
     * Elementor Init
     */
    public function add_elementor_category() {
        require_once SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_PATH . '/inc/class-saafe-category.php';          
    }
    
    public function enqueue_scrpts(){
        // register fontawesome as fallback
        wp_register_style(
            'font-awesome-5-all', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css', false, SUBLIMETHEME_ADVANCED_ADDONS_FOR_ELEMENTOR_VERSION
        );
    }
}

/**
 * Begins execution of the plugin.
 */
SublimeTheme_Advanced_Addons_For_Elementor::get_instance();