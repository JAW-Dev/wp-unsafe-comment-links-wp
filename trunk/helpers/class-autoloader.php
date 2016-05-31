<?php
namespace WP_Unsafe_Comment_Links\Helpers;

/**
 * Autoloader
 *
 * @package    WP_Unsafe_Comment_Links
 * @subpackage WP_Unsafe_Comment_Links/Helpers
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2016, Jason Witt
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

// If this file is called directly, abort.
if( !defined( 'WPINC' ) ) { die; }

if( !class_exists( 'Autoloader' ) ) {
  class Autoloader {

    /**
     * The directory path to your classes.
     * No leading or training slashed required.
     * 
     * @var string $dir the directory containing the classes to load
     */
    public $dir;

    /**
     * Initialize the class
     *
     * @uses       spl_autoload_register()
     * @since      1.0.0
     */
    public function __construct( $dir ) {
      $this->dir = $dir;
      spl_autoload_register( array( $this, 'autoloader') );
    } // end __construct

    /**
     * Autoloader
     *
     * @uses       glob()
     * @since      1.0.0
     * @return     void
     */
    public function autoloader() {
      foreach( glob( WPUCL_PLUGIN_DIR . $this->dir .'/*.php' ) as $filename ) {
        require_once $filename;
      }
    } // end autoloder
  }
} // end Autoloader

/**
 * Autoloader
 *
 * Load classes in specifided directory
 *
 * @version    1.0.0
 * @uses       Autoloader() helpers/class-autoload.php
 * @param      string $dir the directory pointing to the classes
 * @return     void
 */
if( !function_exists( 'pre_fixx_autoloader') ) {
  function pre_fixx_autoloader( $dir ) {
    $pre_fixx_autoloader = new Autoloader( $dir );
  }
} // end pre_fixx_autoloader