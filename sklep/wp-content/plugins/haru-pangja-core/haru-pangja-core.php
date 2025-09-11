<?php
/**
 * Plugin Name: Haru Pangja Core
 * Plugin URI: http://harutheme.com
 * Description: The Haru Pangja Core plugin.
 * Version: 1.1.8
 * Author: HaruTheme
 * Author URI: http://harutheme.com
 *
 * Text Domain: haru-pangja
 * Domain Path: /languages/
 *
 * @package Haru Pangja Core
 * @category Core Plugin
 * @author HaruTheme
 *
 **/

if (!defined('ABSPATH')) {
    exit; // Exit if access directly
}

if ( ! class_exists( 'Haru_PangjaCore' ) ) {
    class Haru_PangjaCore {
        protected $loader;

        protected $prefix;

        protected $version;

        function __construct() {
            $this->version = '1.1.5';
            $this->prefix = 'haru-pangja-core';
            $this->define_constants();
            $this->include_files();
            $this->load_plugin_textdomain();
            $this->init();
        }

        function init() {
            add_action( 'plugins_loaded', array($this, 'load_plugin_textdomain' ));
            add_action( 'admin_init', array($this, 'haru_admin_script' ));
            add_action( 'wp_enqueue_scripts', array($this, 'haru_frontend_script' ), 1);
            // Apply filter do_shortcode
            add_filter( 'widget_text', 'do_shortcode' );
            add_filter( 'widget_content', 'do_shortcode' );
        }

        function define_constants() {
            if( !defined( 'PLUGIN_HARU_PANGJA_CORE_DIR' ) ) {
                define( 'PLUGIN_HARU_PANGJA_CORE_DIR', plugin_dir_path(__FILE__) );
            }
            if( !defined( 'PLUGIN_HARU_PANGJA_CORE_URL' ) ) {
                define( 'PLUGIN_HARU_PANGJA_CORE_URL', plugin_dir_url( __FILE__ ) );
            }
            if( !defined( 'PLUGIN_HARU_PANGJA_CORE_FILE' ) ) {
                define( 'PLUGIN_HARU_PANGJA_CORE_FILE', __FILE__ );
            }
            if( !defined( 'PLUGIN_HARU_PANGJA_CORE_NAME' ) ) {
                define( 'PLUGIN_HARU_PANGJA_CORE_NAME', 'haru-pangja-core' );
            }
            if( !defined( 'HARU_PANGJA_CORE_SHORTCODE_CATEGORY' ) ) {
                define( 'HARU_PANGJA_CORE_SHORTCODE_CATEGORY', esc_html__( 'Pangja Shortcodes', 'haru-pangja' ) );
            }
        }

        function include_files() {
            // Libraries
            if ( !class_exists('WPAlchemy_MetaBox') ) {
                include_once( 'includes/libraries/wpalchemy/MetaBox.php' );
            }

            require_once( 'includes/maintenance/_init.php' );
            require_once( 'includes/posttypes/_init.php' );
            require_once( 'includes/shortcodes/shortcodes.php' );
            require_once( 'includes/widgets/widgets.php' );
            require_once( 'includes/term-meta/index.php' ); // Add term meta to product attributes
        }

        public function load_plugin_textdomain() {
            load_plugin_textdomain( 'haru-pangja', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
        }

        // Load script admin
        public function haru_admin_script() {
            // CSS
            $pages = isset($_GET['page']) ? $_GET['page'] : '';
            // if ($pages == '_options') return;

            wp_enqueue_style( $this->prefix.'-admin', plugins_url( PLUGIN_HARU_PANGJA_CORE_NAME.'/admin/assets/css/admin.css'), array(), $this->version, 'all' );
            wp_enqueue_style( $this->prefix.'-select2', plugins_url( PLUGIN_HARU_PANGJA_CORE_NAME.'/admin/assets/plugins/jquery.select2/select2.min.css'), array(), $this->version, 'all' );
            wp_enqueue_style( $this->prefix.'-datetimepicker', plugins_url( PLUGIN_HARU_PANGJA_CORE_NAME.'/admin/assets/plugins/datetimepicker/jquery.datetimepicker.css'), array(), $this->version, 'all' );

            // JS
            wp_enqueue_script( $this->prefix .'-admin', plugins_url( PLUGIN_HARU_PANGJA_CORE_NAME.'/admin/assets/js/admin.js'), array( 'jquery' ), $this->version, false );

            $screen = get_current_screen(); // @TODO: Doesn't need now
            // if ( !empty($screen) && ($screen->post_type != 'product') ) {
                wp_enqueue_script( $this->prefix .'-select2', plugins_url( PLUGIN_HARU_PANGJA_CORE_NAME.'/admin/assets/plugins/jquery.select2/select2.full.min.js'), array( 'jquery' ), $this->version, false );
            // }
            
            wp_enqueue_script( $this->prefix .'-datetimepicker', plugins_url( PLUGIN_HARU_PANGJA_CORE_NAME.'/admin/assets/plugins/datetimepicker/jquery.datetimepicker.js'), array( 'jquery' ), $this->version, false );
            wp_enqueue_script( $this->prefix .'-media-select', plugins_url( PLUGIN_HARU_PANGJA_CORE_NAME.'/admin/assets/js/media-select.js'), array( 'jquery' ), $this->version, false );

            wp_localize_script( $this->prefix .'admin' , 'haru_core_meta' , array(
                'ajax_url' => admin_url( 'admin-ajax.php?activate-multi=true' )
            ) );
        }
        // Load script front-end
        public function haru_frontend_script() {
            // CSS

            // JS

        }
    }

    // Run Haru_PangjaCore
    if( !function_exists( 'init_haru_pangja_core' ) ) {
        function init_haru_pangja_core() {
            $haruPangjaFramework = new Haru_PangjaCore();
        }
    }

    init_haru_pangja_core();
}
