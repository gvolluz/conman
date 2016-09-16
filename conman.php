<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
    Plugin Name: Convention Manager
    Plugin URI: https://www.avansis.ch/
    Description: Provides management tools for gaming conventions
    Author: Gilles Volluz (gilles.volluz@gmail.com)
    Author URI: https://plus.google.com/u/0/+GillesVolluzGasdia
    Text Domain: conman
    Domain Path: /languages
    Version: 1.0
*/

define( 'PLUGIN_VERSION', 1.9 );

//Multilingual text-domain
add_action( 'init', 'conman_load_textdomain' );
function conman_load_textdomain() {
    load_plugin_textdomain( 'conman', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

//Global/common variables and constants
include( 'common.php' );

//DB objects are used in the back and the front-end
include( CONMAN_ROOTPATH . 'includes/database/db-commons.php');

//Are we in the backend?
if ( is_admin() ){
    include( CONMAN_ROOTPATH . 'admin-load-scripts.php' );
    //Include this one as last, it calls on the others
    include( CONMAN_ROOTPATH . 'includes/admin/admin-menu.php' );
}

include( CONMAN_ROOTPATH . 'frontend-load-scripts.php');
include( CONMAN_ROOTPATH . 'includes/shortcodes/shortcode-hello.php');

//Register some hooks
/* SESSION is NOT used in WordPress, so here a little tweak */

add_action('init', 'conman_start_session', 1);
add_action('wp_logout', 'conman_end_session');
add_action('wp_login', 'conman_end_session');

function conman_start_session() {
    if(!session_id()) {
        session_start();
    }
}

function conman_end_session() {
    session_destroy ();
}

// //Check if the event is scheduled, if not schedule it
// if ( false === wp_next_scheduled( 'conman_cron_process_imports_queue' ) ) {
//   wp_schedule_event( time(), 'hourly', 'conman_cron_process_imports_queue' );
// }

/**
*   Performs activation tasks
 *
 *  @author  Gilles Volluz (gilles.volluz@gmail.com)
 *  @since   1.0
 */
register_activation_hook( __FILE__, 'conman_activate' );
function conman_activate() {
    //Perform activation tasks
    include( CONMAN_ROOTPATH . 'includes/database/db-init.php');
    conman_install();
}

/**
*   Performs activation tasks
 *
 *  @author  Gilles Volluz (gilles.volluz@gmail.com)
 *  @since   1.0
 */
register_deactivation_hook( __FILE__, 'conman_deactivate' );
function conman_deactivate() {
   //Perform deactivation tasks
}