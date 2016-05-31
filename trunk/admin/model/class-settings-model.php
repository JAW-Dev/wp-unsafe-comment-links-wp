<?php
namespace WP_Unsafe_Comment_Links\Admin\Model;

use WP_Unsafe_Comment_Links\Includes\Model as IncludesModel;

/**
 * Settings
 *
 * @package     WP_Unsafe_Comment_Links
 * @subpackage  WP_Unsafe_Comment_Links/Admin/Model
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// If this file is called directly, abort.
if( !defined( 'WPINC' ) ) { die; }

if( !class_exists( 'SettingsModel' ) ) {
  class SettingsModel {

    private $wpucl_settings;

    public function __construct() {
      add_action( 'admin_init', array( $this, 'settingsPageInit' ) );
      add_action( 'admin_menu', array( $this, 'addSettingsPage' ) );
    }

    public function addSettingsPage() {
      $settings_page = add_options_page(
        __( 'WP Unsafe Comment Links', 'wpucl' ),
        __( 'Unsafe Links', 'wpucl'),
        'manage_options',
        WPUCL_SETTINGS,
        array( $this, 'renderSettingsPage' )
      );
      add_action( "admin_print_styles-{$settings_page}", array( $this, 'enqueueStyles' ) );
      add_action( "admin_print_scripts-{$settings_page}", array( $this, 'enqueueScripts' ) );
    }

    public function settingsPageInit() {
      register_setting(
        WPUCL_SETTINGS . '_group',
        WPUCL_SETTINGS,
        array( $this, 'sanitize' )
      );

      add_settings_section(
        WPUCL_SETTINGS . '_section',
        __( 'Google Safe Browsing API Key', 'wpucl' ),
        array( $this, 'renderGSBInstructions' ),
        WPUCL_SETTINGS
      );

      add_settings_field(
        'wpucl_gsb_key',
        __( 'Google Safe Browsing API Key', 'wpucl' ),
        array( $this, 'renderGSBField' ),
        WPUCL_SETTINGS,
        WPUCL_SETTINGS . '_section'
      );
    }

    public function renderSettingsPage() {
      $this->wpucl_settings = get_option( WPUCL_SETTINGS ); ?>
      <div class="wrap">
        <h2><?php echo _e( 'WP Unsafe Comment Links Settings', 'wpucl' ); ?></h2>

        <form method="post" action="options.php">
          <?php
            settings_fields( WPUCL_SETTINGS . '_group' );
            do_settings_sections( WPUCL_SETTINGS );
            submit_button();
          ?>
        </form>
      </div>
    <?php }

    public function renderGSBInstructions() {
      $html = '<div class="wpucl__gsb-instrunctions wpucl__show">
                  <h4 class="cmb2-metabox-title">How to get a Google Safe Browsing API Key</h4>
                  <p>In order to interact with the Safe Browsing service, you need an API key to authenticate as an API user.</p>
                    <ol>
                      <li>First, you need to create an project in the <a href="https://code.google.com/apis/console/">Google Developers Console</a>.
                      <li>Click on <strong>Create Project</strong> and name your project. <em>You can name this anything you want to</em></li>
                      <li>In the search field start typing <strong>safe</strong> and click on the <strong>Safe Browsing API</strong>.</li>
                      <li>Click <strong>Enable</strong>.</li>
                      <li>Then click <strong>Go to Credentials</strong>.</li>
                      <li>Where it says <strong>Where will you be calling the API from?</strong> choose <strong>Web Browser</strong>.</li>
                      <li>Click <strong>What credentials do I need?</strong>.</li>
                      <li>Name yourAPI key in the <strong>name</strong> field. <em>You can name this anything you want to</em>.</li>
                      <li>Add your website URL in the next field.</li>
                      <li>Click <strong>Create API Key</strong>.</li>
                      <li>Click <strong>Done</strong>.</li>
                      <li>Copy API key into the <strong>Google Safe Browsing API Key</strong> field above.</li>
                      <li>Click <strong>Save</strong> below to save your settings.</li>
                    </ol>
                  </div>';
      echo $html;
    }

    public function renderGSBField() {
      $option = isset( $this->wpucl_settings['wpucl_gsb_key'] ) ? esc_attr( $this->wpucl_settings['wpucl_gsb_key']) : '';
      echo '<input class="regular-text wpucl__gsb-key" type="text" name="' . WPUCL_SETTINGS . '[wpucl_gsb_key]" value="' . $option . '" required="required">';
    }

    /**
     * Enqueue Scripts
     *
     * @uses   wp_register_script()
     * @uses   wp_enqueue_script()
     * @since  1.0.0
     * @return void
     */
    public function enqueueScripts() {
      wp_register_script( WPUCL_PREFIX . '_admin_js', WPUCL_PLUGIN_URL . 'admin/assets/js/scripts.min.js', array(), WPUCL_VERSION, true );
      wp_enqueue_script(  WPUCL_PREFIX . '_admin_js' );
    } // end admin_scripts()

    /**
     * Enqueue Styles
     *
     * @uses   wp_register_style()
     * @uses   wp_enqueue_style()
     * @since  1.0.0
     * @return void
     */
    public function enqueueStyles() {
      wp_register_style( WPUCL_PREFIX . '_admin', WPUCL_PLUGIN_URL . 'admin/assets/css/styles.css', array(), WPUCL_VERSION, 'all' );
      wp_enqueue_style(  WPUCL_PREFIX . '_admin' );
    } // end admin_styles

    public function sanitize($input) {
      $sanitary_values = array();
      if ( isset( $input['wpucl_gsb_key'] ) ) {
        $sanitary_values['wpucl_gsb_key'] = sanitize_text_field( $input['wpucl_gsb_key'] );
      }

      return $sanitary_values;
    }

  }
} // end SettingsModel