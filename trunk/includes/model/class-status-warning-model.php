<?php
namespace WP_Unsafe_Comment_Links\Includes\Model;

/**
 * Status Warning
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

if( !class_exists( 'StatusWarning' ) ) {
  class StatusWarning {

    /**
     * Status Warning
     *
     * @since  1.0.0
     * @return string $comment The comment
     */
    public static function warning( $status, $url, $comment ) {
      $span_class     = apply_filters( 'wpucl-span-class-filter', 'wpucl-unsafe-link' );
      $warning        = apply_filters( 'wpucl-warning-filter', __( 'Warning!', 'wpucl' ) );
      $message        = apply_filters( 'wpucl-message-filter', __( 'This is an unsafe link!', 'wpucl' ) );
      $message_styles = apply_filters( 'wpucl-message-styles-filter', 'background: #FFBABA; color: #9F6000; padding: 0 2px;' );
      $warning_styles = apply_filters( 'wpucl-warning-styles-filter', 'color: #D8000C' );
      if( $status == true ) {
        $pattern     = "#(<a[^>]*?)$url(.*?)<\/a>#si";
        $replacement = '<span class="' . $span_class . '" style="' . $message_styles . '"><span style="' . $warning_styles . '">' . $warning . '</span> ' . $message . '</span>';
        $comment     = preg_replace( $pattern, $replacement, $comment );
      }
      return $comment;
    } // end warning

  }
} // end StatusWarning