<?php
namespace WP_Unsafe_Comment_Links\Includes\Model;

/**
 * Check API Model 
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

if( !class_exists( 'FilterComments' ) ) {
  class FilterComments {

    /**
     * Filter the comments
     *
     * @since  1.0.0
     * @return string $comment The comment
     */
    public static function filteredComments( $comment ) {
      $option   = get_option( 'wpucl_settings' );
      $gbs_key  = $option['wpucl_gsb_key'];
      $links    = wp_extract_urls( $comment );
      $urls     = array();
      if( APICheck::check() == true ) {
        foreach( $links as $link ) {
          $url = 'https://sb-ssl.google.com/safebrowsing/api/lookup?client=wpucl&key=' . $gbs_key . '&appver=' . WPUCL_VERSION . '&pver=3.1&url=' . $link;
          $response = APIConnect::connect( $url );
          $response['url'] = $link;
          $urls[] = $response;
        }
        $urls = array_map( 'unserialize', array_unique( array_map( 'serialize', $urls ) ) );
        return CheckStatus::check( $urls, $comment);
      }
      return $comment;
    } // end filteredComments

  }
} // end FilterComments