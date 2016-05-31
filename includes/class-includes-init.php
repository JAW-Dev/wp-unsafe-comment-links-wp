<?php
namespace WP_Unsafe_Comment_Links\Includes;

use WP_Unsafe_Comment_Links\Includes\Controller as Controller;

/**
 * Public Instantiate
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

if( !class_exists( 'Includes_Init' ) ) {
  class Includes_Init {

    /**
     * Initialize the class
     *
     * @since 1.0.0
     */
    public function __construct() {
      new Controller\UnsafeLinksController();
    } // end __construct
  }
} // end Includes_Init