<?php
namespace WP_Unsafe_Comment_Links\Admin\Controller;

use WP_Unsafe_Comment_Links\Admin\Model as Model;

/**
 * Action Links Controller
 *
 * @package     WP_Unsafe_Comment_Links
 * @subpackage  WP_Unsafe_Comment_Links/Admin/Controller
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// If this file is called directly, abort.
if( !defined( 'WPINC' ) ) { die; }

if( !class_exists( 'ActionLinks' ) ) {
  class ActionLinks {

    /**
     * Initialize the class
     *
     * @uses  add_action()
     * @since 1.0.0
     */
    public function __construct() { 
      add_filter( 'plugin_action_links_' . plugin_basename( WPUCL_PLUGIN_FILE ), array( $this, 'settingsLink' ) );
    } // end __construct

    /**
     * Settings Link
     *
     * @since  1.0.0
     * @param  $links The current array of action links
     * @return array $links The new array of action links
     */
    public function settingsLink( $links ) {
      $links[] = '<a href="' . admin_url( 'options-general.php?page=' . WPUCL_SETTINGS ) . '">Settings</a>';
      return $links;
    } // end settingsLink
  }
} // end ActionLinks