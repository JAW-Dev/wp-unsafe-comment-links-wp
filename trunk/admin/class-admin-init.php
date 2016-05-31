<?php
namespace WP_Unsafe_Comment_Links\Admin;

use WP_Unsafe_Comment_Links\Admin\Controller as Controller;
use WP_Unsafe_Comment_Links\Admin\Model as Model;

/**
 * Admin Instantiate
 *
 * @package    Package
 * @subpackage Package/SubPackage
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2016, Jason Witt
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) { die; }

if( !class_exists( 'Admin_Init' ) ) {
  class Admin_Init {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
      new Controller\SettingsController();
      new Controller\ActionLinks();
    } // end __construct

  }
} // end Admin_Init