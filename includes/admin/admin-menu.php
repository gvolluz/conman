<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Renders the backend menus
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */

add_action( 'admin_menu', 'conman_add_menu_page' );
function conman_add_menu_page(){
    add_menu_page( 'CONMAN', 'Convention Manager', 'edit_pages', 'conman', 'conman_render_admin', CONMAN_IMAGEURL . 'conman.png', 0);
}

function conman_render_admin(){
    $render = '<div id="conman_admin_main_container">';

    $render .= '<h2>Convention Manager - '.__('Administration', 'conman' ) .'</h2>';
    $render .= '<div id="conman_update_options_container">';
    $render .= '<table>';
    $render .=      '<tr>';
    $render .=          '<th>' . __( "Option", 'conman' ) . '</th>' ;
    $render .=          '<td><input name="conman_cron_import_activated" type="checkbox" id="conman_cron_import_activated" value="1" ' . checked( '1', get_option( 'conman_cron_import_activated' ), false ) . ' /></td>';
    $render .=      '</tr>';
    $render .=      '<tr><td>&nbsp;</td></tr>';
    $render .= '</table>';
    $render .= '<div id="conman_submit_update_options_button" class="conman-text-button">' . __( "Sauver les options", 'conman' ) . '</div>';
    $render .= '<div id="conman_update_options_results"></div>';
    $render .= '</div>'; //END conman_update_options_container
    $render .= '</div>'; // END conman_admin_main_container

    echo $render;
}

/************ AJAX HANDLERS *****************/

/**************************** UPDATE OPTIONS *********************/
add_action( 'wp_ajax_conman_update_options', 'conman_update_options' );
function conman_update_options() {
    $options = urldecode( $_POST[ 'conman_options' ] );
    //var_dump( $options);
    $decoded_options = json_decode( stripslashes( $options ) );
    //var_dump( $decoded_options );

    //update_option also adds the option if the option isn't there
    // if( isset( $decoded_options->cron_import_activated ) ){
    //     update_option( 'conman_cron_import_activated', $decoded_options->cron_import_activated );
    // }

    echo '<h4>'. __("Options sauvées", 'conman' ) . '</h4>';
    wp_die();
}