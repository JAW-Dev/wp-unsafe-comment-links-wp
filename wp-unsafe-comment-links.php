<?php
namespace WP_Unsafe_Comment_Links;

use WP_Unsafe_Comment_Links\Helpers as Helpers;
use WP_Unsafe_Comment_Links\Admin as Admin;
use WP_Unsafe_Comment_Links\Includes as Includes;

/**
 * WP_Unsafe_Comment_Links
 *
 * @package     WP Unsafe Comment Links
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) The_The_Year, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       WP Unsafe Comment Links
 * Plugin URI:        https://github.com/jawittdesigns/wp-unsafe-comment-links
 * Description:       Check the links in your WordPress comments for unsafe links using Google Safe Browsing API
 * Version:           1.0.4
 * Author:            Jason Witt
 * Author URI:        http://jawittdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpucl
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/jawittdesigns/wp-unsafe-comment-links
 * GitHub Branch:     master
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) { die; }

if( !class_exists( 'WPUCL' ) ) {
  class WPUCL {

    /**
     * Instance of the class
     *
     * @since 1.0.0
     * @var Instance of WPUCL class
     */
    private static $instance;

    /**
     * Instance of the plugin
     *
     * @since 1.0.0
     * @static
     * @staticvar array
     * @return Instance
     */
    public static function instance() {
      if ( !isset( self::$instance ) && ! ( self::$instance instanceof WPUCL ) ) {
        self::$instance = new WPUCL;
        self::$instance->define_constants();
        add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
        self::$instance->includes();
        self::$instance->init = new Includes\Includes_Init();
        if( is_admin() ) {
          self::$instance->admin_init = new Admin\Admin_Init();
        }
      }
    return self::$instance;
    }

    /**
     * Define the plugin constants
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function define_constants() {
      // Plugin Environment
      if ( !defined( 'WPUCL_ENVIRONMENT' ) ) {
        define( 'WPUCL_ENVIRONMENT', 'Production' );
      }
      // Plugin Version
      if ( !defined( 'WPUCL_VERSION' ) ) {
        define( 'WPUCL_VERSION', '1.0.4' );
      }
      // WPUCL
      if ( !defined( 'WPUCL_PREFIX' ) ) {
        define( 'WPUCL_PREFIX', 'wpucl' );
      }
      // Plugin Directory
      if ( !defined( 'WPUCL_PLUGIN_DIR' ) ) {
        define( 'WPUCL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
      }
      // Plugin URL
      if ( !defined( 'WPUCL_PLUGIN_URL' ) ) {
        define( 'WPUCL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
      }
      // Plugin Root File
      if ( !defined( 'WPUCL_PLUGIN_FILE' ) ) {
        define( 'WPUCL_PLUGIN_FILE', __FILE__ );
      }
      // Plugin WP Repo Link
      if ( !defined( 'WPUCL_SETTINGS' ) ) {
        define( 'WPUCL_SETTINGS', 'wpucl_settings' );
      }
      // Plugin WP Repo Link
      $option = get_option( 'wpucl_metabox' );
      if ( !defined( 'WPUCL_WP_REPO_LINK' ) ) {
        define( 'WPUCL_WP_REPO_LINK', $option['wpucl_gsb_key'] );
      }
    }

    /**
     * Load the required files
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function includes() {
      // Autoloader
      if ( file_exists( WPUCL_PLUGIN_DIR . 'helpers/class-autoloader.php' ) ) {
        require_once WPUCL_PLUGIN_DIR . 'helpers/class-autoloader.php';
      }
      // Helpers
      Helpers\pre_fixx_autoloader( 'helpers/classes' );
      Helpers\pre_fixx_autoloader( 'helpers/vendor/classes' );
      Helpers\pre_fixx_autoloader( 'helpers/vendor/classes/cmb2' );
      // Template Functions
      if ( file_exists( WPUCL_PLUGIN_DIR . 'helpers/template-functions.php' ) ) {
        include WPUCL_PLUGIN_DIR . 'helpers/template-functions.php';
      }
      // Includes
      Helpers\pre_fixx_autoloader( 'includes/controller' );
      Helpers\pre_fixx_autoloader( 'includes/model' );
      Helpers\pre_fixx_autoloader( 'includes/vendor/classes' );
      if ( file_exists( WPUCL_PLUGIN_DIR . 'includes/class-includes-init.php' ) ) {
        include WPUCL_PLUGIN_DIR . 'includes/class-includes-init.php';
      }
      // admin
      if( is_admin() ) {
        Helpers\pre_fixx_autoloader( 'admin/controller' );
        Helpers\pre_fixx_autoloader( 'admin/model' );
        Helpers\pre_fixx_autoloader( 'admin/vendor/classes' );
        if ( file_exists( WPUCL_PLUGIN_DIR . 'admin/class-admin-init.php' ) ) {
          include WPUCL_PLUGIN_DIR . 'admin/class-admin-init.php';
        }
      }
      // Activation
      if ( file_exists( WPUCL_PLUGIN_DIR . 'admin/class-admin-init.php' ) ) {
        include WPUCL_PLUGIN_DIR . 'activation.php';
      }
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since  1.0.0
     * @access public
     */
    public function load_textdomain() {
      $pre_fixx_lang_dir = dirname( plugin_basename( WPUCL_PLUGIN_FILE ) ) . '/languages/';
      $pre_fixx_lang_dir = apply_filters( 'pre_fixx_lang_dir', $pre_fixx_lang_dir );
      $locale = apply_filters( 'plugin_locale',  get_locale(), 'textdomain' );
      $mofile = sprintf( '%1-%2.mo', 'textdomain', $locale );
      $mofile_local  = $pre_fixx_lang_dir . $mofile;
      if ( file_exists( $mofile_local ) ) {
        load_textdomain( 'textdomain', $mofile_local );
      } else {
        load_plugin_textdomain( 'textdomain', false, $pre_fixx_lang_dir );
      }
    }

    /**
     * Throw error on object clone
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function __clone() {
      _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'textdomain' ), '1.6' );
    }

    /**
     * Disable unserializing of the class
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function __wakeup() {
      _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'textdomain' ), '1.6' );
    }

  }
} // end WPUCL
/**
 * Return the instance
 *
 * @since 1.0.0
 * @return object The Safety Links instance
 */
function WPUCL_Run() {
  return WPUCL::instance();
} // end WPUCL_Run
WPUCL_Run();