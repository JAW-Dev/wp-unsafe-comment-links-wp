<?php
namespace WP_Unsafe_Comment_Links\Includes\Model;

/**
 * API Connect
 *
 * @package     WP_Unsafe_Comment_Links
 * @subpackage  WP_Unsafe_Comment_Links/Includes/Model
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// If this file is called directly, abort.
if( !defined( 'WPINC' ) ) { die; }

if( !class_exists( 'APIConnect' ) ) {
  class APIConnect {

    /**
     * Connect to API
     *
     * @since  1.0.0
     * @return void
     */
    public static function connect( $url ) {
      $ch = curl_init();
      curl_setopt( $ch, CURLOPT_URL, $url );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 120);
      $data = curl_exec( $ch );
      $httpStatus = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
      curl_close( $ch );
      return array (
        'status'  => $httpStatus,
        'data'    => $data,
        'checked' => '0'
      );
    } // end connect
  }
} // end APIConnect