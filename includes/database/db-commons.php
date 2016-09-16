<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Common variables, globals, functions shared etc.
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */

global $conman_db_version;
$conman_db_version = '1.0';
$installed_ver = get_option( "conman_db_version" );

//Business objects
include(CONMAN_ROOTPATH . 'includes/database/conman-db.php');
include(CONMAN_ROOTPATH . 'includes/database/conman-derivation.php');