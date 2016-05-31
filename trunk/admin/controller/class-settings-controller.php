<?php
namespace WP_Unsafe_Comment_Links\Admin\Controller;

use WP_Unsafe_Comment_Links\Admin\Model as Model;

/**
 *
 * Settings Controller
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

if( !class_exists( 'SettingsController' ) ) {
  class SettingsController {

    /**
     * Initialize the class
     *
     * @uses  add_action()
     * @since 1.0.0
     */
    public function __construct() {
      new Model\SettingsModel();
    } // end __construct

  }
} // end SettingsController