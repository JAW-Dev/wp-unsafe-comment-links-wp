<?php
namespace WP_Unsafe_Comment_Links;
use WP_Unsafe_Comment_Links\Includes\Classes as Includes;
use WP_Unsafe_Comment_Links\Admin\Classes    as Admin;
use WP_Unsafe_Comment_Links\Helpers\Classes  as Helpers;

/**
 * Activation
 *
 * Called on plugin activation
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

if( !class_exists( 'WPUCL_Activation' ) ) {
  class WPUCL_Activation {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function init() {
      flush_rewrite_rules();
    } // end init

  }
} // end WPUCL_Activation
$activation = new WPUCL_Activation();
register_activation_hook( WPUCL_PLUGIN_FILE, array( $activation, 'init' ) );