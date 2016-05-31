<?php
namespace WP_Unsafe_Comment_Links\Includes\Model;

/**
 * Check Status 
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

if( !class_exists( 'CheckStatus' ) ) {
  class CheckStatus {

    /**
     * Check Status
     *
     * @since  1.0.0
     * @return string $comment The comment
     */
    public static function check( $array, $comment ) {
      $status_types = apply_filters( 'wpucl-status-types-filter', array( 'phishing', 'malware', 'unwanted', 'phishing,malware', 'phishing,unwanted', 'malware,unwanted', 'phishing,malware,unwanted' ) );
      foreach( $array as $key => $value ) {
        $url     = $array[$key]['url'];
        $data    = $array[$key]['data'];
        $status  = ( in_array( $data, $status_types ) ) ? true : false;
        $comment = StatusWarning::warning( $status, $url, $comment );
      }
      return $comment;
    } // end checkStatus

  }
} // end CheckStatus