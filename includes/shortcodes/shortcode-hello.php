<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Provides a basic shortcode with an Ajax Hello
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */

/*** SHORT CODE AND RENDERING ***/
add_shortcode( 'conman_hello', 'conman_shortcode_hello' );
function conman_shortcode_hello ( ){
    $render = '';

    //Add the loading div to the form, to display the loading animation
    $render .= '<span id="conman_hello_loading" class="loading">' . __( "Recherche", 'conman' ) . '</span>';
    $render .= '<div id="conman_hello_container">';
    $render .= conman_render_hello( );
    $render .= '</div>'; //END conman_hello_container

    return $render;
}

function conman_render_hello() {
    $render = '';

    $render .= conman_render_hello_form();

    $render .= '<div id="conman_hello_results"></div>';

    return $render;
}

function conman_render_hello_form(){
    $render = '';

    $render .= '<div id="conman_hello_form_container">';
    $render .= '<div id="conman_hello_form_wrapper">';

    //Fields
    $render .= '<table>';
    $render .=  '<tr>';
    $render .=      '<th>' . __( 'Message', 'conman' ) . '</th>';
    $render .=      '<td><input id="conman_hello_param_message" type="text" value=""/></td>';
    $render .=  '</tr>';

    //Button
    $render .=  '<tr>';
    $render .=      '<td colspan="2"><img id="conman_hello_button" class="conman-button to-right" src="'. CONMAN_IMAGEURL . 'base_button.svg" /></td>';
    $render .=  '</tr>';
    $render .= '</table>';

    $render .= '</div>'; //END conman_hello_form_wrapper">';
    $render .= '</div>';//END conman_hello_form_container

    return $render;
}

/*** AJAX PART ****/
add_action( 'wp_ajax_conman_hello', 'conman_hello' );
add_action( 'wp_ajax_nopriv_conman_hello', 'conman_hello' );
function conman_hello(){
    check_ajax_referer( CONMAN_FRONTEND_NONCE_KEY );

    $message = urldecode( $_POST[ 'message' ] );
    $render  = $message;
    echo $render;
    wp_die();
}
