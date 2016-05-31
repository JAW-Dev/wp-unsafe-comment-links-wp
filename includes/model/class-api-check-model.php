<?php
namespace WP_Unsafe_Comment_Links\Includes\Model;

/**
 * API Check
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

if( !class_exists( 'APICheck' ) ) {
  class APICheck {

    /**
     * Connect to API
     *
     * @since  1.0.0
     * @return void
     */
    public static function check() {
      $option   = get_option( 'wpucl_settings' );
      $gbs_key  = $option['wpucl_gsb_key'];
      $url = 'https://sb-ssl.google.com/safebrowsing/api/lookup?client=wpucl&key=' . $gbs_key . '&appver=' . WPUCL_VERSION . '&pver=3.1&url=http://www.google.com';
      $ch = curl_init();
      curl_setopt( $ch, CURLOPT_URL, $url );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 120);
      $data = curl_exec( $ch );
      $httpStatus = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
      curl_close( $ch );
      if( $httpStatus == '204' ) {
        return true;
      } else {
        return false;
      }
    } // end check
  }
} // end APICheck