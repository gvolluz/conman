<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *	Common config, constants, variables, etc. included in top plugin file
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */

define( 'CONMAN_ROOTPATH', plugin_dir_path( __FILE__ ) );
define( 'CONMAN_ROOTURL', plugin_dir_url( __FILE__ ) );
define( 'CONMAN_IMAGEURL', plugin_dir_url( __FILE__) . 'img/' );
define( 'CONMAN_STYLEURL', plugin_dir_url( __FILE__) . 'css/' );
define( 'CONMAN_SCRIPTURL', plugin_dir_url( __FILE__) . 'js/' );
define( 'CONMAN_DATEFORMAT_DISPLAY', 'd.m.Y H:i:s' );
define( 'CONMAN_DATEFORMATSHORT_DISPLAY', 'd.m.Y' );
define( 'CONMAN_DATEFORMAT_STORE', 'Y-m-d H:i:s' );
define( 'CONMAN_FRONTEND_NONCE_KEY', 'conman_frontend_nonce' );
define( 'CONMAN_BACKEND_NONCE_KEY', 'conman_backend_nonce' );

/** GROUPED COMMON INCLUDES **/
//Basic utilities
include( CONMAN_ROOTPATH . 'includes/utilities.php' );