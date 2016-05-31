<?php
namespace WP_Unsafe_Comment_Links\Includes\Controller;
use WP_Unsafe_Comment_Links\Includes\Model as Model;

/**
 * Unsafe Links Controller 
 *
 * @package     WP_Unsafe_Comment_Links
 * @subpackage  WP_Unsafe_Comment_Links/Includes/Controller
 * @author      Jason Witt <contact@jawittdesigns.com>
 * @copyright   Copyright (c) 2016, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// If this file is called directly, abort.
if( !defined( 'WPINC' ) ) { die; }

if( !class_exists( 'UnsafeLinksController' ) ) {
  class UnsafeLinksController {

    /**
     * Initialize the class
     *
     * @uses  add_filter();
     * @since 1.0.0
     */
    public function __construct() { 
      add_filter( 'comment_text', array( $this, 'outputComments' ) );
    } // end __construct

    /**
     * Output Comments
     *
     * @since  1.0.0
     * @param  array $comment The comments
     * @return void
     */
    public function outputComments( $comment ) {
      return Model\FilterComments::filteredComments( $comment );
    } // end outputComments

  }
} // end UnsafeLinksController