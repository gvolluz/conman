<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

/**
 *  Performs the uninstallation scripts (tables removal etc.)
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */

//Global/common variables and constants
include( 'common.php' );

/**
 *  Remove the specific plugin roles
 *
 *  -
 *
 *  @author  Gilles Volluz (gilles.volluz@gmail.com)
 *  @since   1.0
 */

register_uninstall_hook(    __FILE__, 'conman_clean_on_uninstall' );
function conman_clean_on_uninstall() {
    if ( ! current_user_can( 'activate_plugins' ) )
        return;

    check_admin_referer( 'bulk-plugins' );

    // Important: Check if the file is the one
    // that was registered during the uninstall hook.
    if ( __FILE__ != WP_UNINSTALL_PLUGIN )
    return;
}