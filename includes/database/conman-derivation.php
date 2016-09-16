<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Derivation from CONMAN_DB, example
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */

class CONMAN_Derivation extends CONMAN_DB{

     /**
     * Get things started
     *
     * @access  public
     * @since   1.0
    */
    public function __construct() {
        global $wpdb;
        $this->table_name  = $wpdb->prefix . 'conman_derivation';
        $this->primary_key = 'id';
        $this->version     = '1.0';
    }

    /**
     * Get columns and formats
     *
     * @access  public
     * @since   1.0
    */
    public function get_columns() {
        return array(
            'id'                => '%d',
            'field'             => '%s',
        );
    }

    /**
     * Get default column values
     *
     * @access  public
     * @since   1.0
    */
    public function get_column_defaults() {
        return array(
            'field'         => 'a default value',
        );
    }
}