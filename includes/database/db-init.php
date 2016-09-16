<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Database table creation/upgrade on plugin activation
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */

 /**
 *  Installs the required tables or upgrades them
 *
 *  @author  Gilles Volluz (gilles.volluz@gmail.com)
 *  @since   1.0
 *
 */
function conman_install() {
	global $wpdb;
	global $conman_db_version;

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE " . $wpdb->prefix . 'conman_derivation' . " (
              `id` INTEGER NOT NULL AUTO_INCREMENT,
              `field` VARCHAR(255),
              PRIMARY KEY (`id`),
              INDEX `index_field` (`field`)
            ) engine=innodb $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    //Update does also add if the option isn't there
    update_option( 'conman_db_version', $conman_db_version );
}