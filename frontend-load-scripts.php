<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Loads the global scripts for the Frontend (CSS/JS)
 *
 *  @author  Gilles Volluz (gilles.volluz@gmail.com)
 *  @since   1.0
 *
 */
add_action( 'wp_enqueue_scripts', 'conman_frontend_load_scripts' );
function conman_frontend_load_scripts() {
    $base_style_path = 'css/';
    $base_script_path = 'js/';

    //For all the js and css that are not imported (e.g. jquery plugins with a version)
    //determine at runtime the timestamp for last modification and it as a version number
    //to handle cache issues (forcing the reload because the version has changed even if
    //there's caching in the .htaccess or via a plugin)

    /******** SCRIPTS ****************/
    //This is an input mask jquery plugin, used for dates input fields mainly
    wp_enqueue_script(  'jquery-inputmask',
                        CONMAN_ROOTURL . $base_script_path . 'jquery.inputmask.bundle.min.js',
                        array( 'jquery' )
                      );

    //This script handles all the ajax requests (from shortcodes or the admin menu)
    wp_enqueue_script(  'conman-frontend-ajax-requests',
                        CONMAN_ROOTURL . $base_script_path . 'frontend-ajax-requests.js',
                        array( 'jquery' ),
                        filemtime( CONMAN_ROOTPATH . $base_script_path . 'frontend-ajax-requests.js' )
                      );

    //Use wp_localize_script to define one or many globals for javascript
    $frontend_nonce = wp_create_nonce( CONMAN_FRONTEND_NONCE_KEY );
    //var_dump(admin_url( 'admin-ajax.php' ));
   // var_dump($frontend_nonce);
    wp_localize_script( 'conman-frontend-ajax-requests',
                        'CONMANFrontAjax',
                        array(  // URL to wp-admin/admin-ajax.php to process the request
                                'ajaxurl'       => admin_url( 'admin-ajax.php' ),
                                '_ajax_nonce'   => $frontend_nonce,
                             )
                      );

    /******** STYLES ****************/
    wp_enqueue_style(   'conman-common-style',
                        CONMAN_ROOTURL . $base_style_path . 'common-style.css',
                        null,
                        filemtime( CONMAN_ROOTPATH . $base_style_path . 'common-style.css' )
                     );

    wp_enqueue_style(   'conman-frontend-style',
                        CONMAN_ROOTURL . $base_style_path . 'frontend-style.css',
                        null,
                        filemtime( CONMAN_ROOTPATH . $base_style_path . 'frontend-style.css' )
                     );

}