<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Misc global functions/data structures used all around
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 */

//Little trick to force the commit of session variables
function conman_flush_session(){
	session_write_close();
	session_start();
}