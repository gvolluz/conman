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

  $sql .= 'CREATE TABLE ' . $wpdb->prefix .'conman_convention' . ' (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `description` LONGTEXT,
    PRIMARY KEY (`id`)
  )engine=innodb '.$charset_collate.';';

  $sql .= 'CREATE TABLE ' . $wpdb->prefix .'conman_convention_spawn'. ' (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `convention_id` INTEGER NOT NULL,
    `start_date` DATETIME,
    `end_date` DATETIME,
    `general_info` LONGTEXT,
    `contact_name` VARCHAR(255),
    `contact_email` VARCHAR(255),
    `contact_phone` VARCHAR(20),
    `address` VARCHAR(255),
    PRIMARY KEY (`id`)
  )engine=innodb '.$charset_collate.';';
  $sql .= 'CREATE TABLE ' . $wpdb->prefix .'conman_event' .'(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `event_type_id` INTEGER NOT NULL,
    `date` DATETIME NOT NULL,
    `duration` INTEGER,
    `required_age` INTEGER,
    `admin_code` VARCHAR(255),
    `description` LONGTEXT,
    `host_name` VARCHAR(255),
    `host_email` VARCHAR(255),
    `remarks` LONGTEXT,
    `attendance_fee` VARCHAR(255),
    `custom_fields` LONGTEXT,
    PRIMARY KEY (`id`)
  )engine=innodb '.$charset_collate.';';

  $sql .= 'CREATE TABLE ' . $wpdb->prefix .'conman_event_type' .'(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(255) NOT NULL,
    `custom_fields` LONGTEXT,
    PRIMARY KEY (`id`)
  )engine=innodb '.$charset_collate.';';

  $sql .= 'CREATE TABLE ' . $wpdb->prefix .'conman_event_registree' .'(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `event_id` INTEGER NOT NULL,
    `name` VARCHAR(255),
    `email` VARCHAR(255),
    `age` INTEGER,
    PRIMARY KEY (`id`)
  )engine=innodb '.$charset_collate.';';

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );

  //Update does also add if the option isn't there
  update_option( 'conman_db_version', $conman_db_version );
}