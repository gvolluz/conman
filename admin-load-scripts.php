<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Loads the global scripts for the Backend (CSS/JS)
 *
 *  @author  Gilles Volluz (gilles.volluz@gmail.com)
 *  @since   1.0
 *
 */
add_action( 'admin_enqueue_scripts', 'conman_admin_load_scripts' );
function conman_admin_load_scripts( $hook ) {
    //echo 'HOOOOOK -------------------------------------------------->' .  $hook ;
    $valid_hooks = array(   'toplevel_page_conman'
        );

    if( false === in_array( $hook, $valid_hooks ) ){
        return;
    }

    $base_style_path = 'css/';
    $base_script_path = 'js/';

    //For all the js and css that are not imported (e.g. jquery plugins with a version)
    //determine at runtime the timestamp for last modification and it as a version number
    //to handle cache issues (forcing the reload because the version has changed even if
    //there's caching in the .htaccess or via a plugin)

    /******** SCRIPTS ****************/

    //This script handles all the ajax requests (from shortcodes or the admin menu)
    wp_enqueue_script(  'conman-admin-ajax-requests',
                        CONMAN_ROOTURL . $base_script_path . 'admin-ajax-requests.js',
                        array( 'jquery' ),
                        filemtime( CONMAN_ROOTPATH . $base_script_path . 'admin-ajax-requests.js' )
                    );

    //Use wp_localize_script to define one or many globals for javascript
    $backend_nonce = wp_create_nonce( CONMAN_BACKEND_NONCE_KEY );
    wp_localize_script( 'conman-admin-ajax-requests',
                        'CONMANAdminAjax',
                        array(   // URL to wp-admin/admin-ajax.php to process the request
                                 'ajaxurl'      => admin_url( 'admin-ajax.php' ),
                                 '_ajax_nonce'  => $backend_nonce,
                             )
                      );

    /******** STYLES ****************/
    wp_enqueue_style(   'conman-common-style',
                        CONMAN_ROOTURL . $base_style_path . 'common-style.css',
                        null,
                        filemtime( CONMAN_ROOTPATH . $base_style_path . 'common-style.css' )
                     );

    wp_enqueue_style(   'conman-admin-style',
                        CONMAN_ROOTURL . $base_style_path . 'admin-style.css',
                        null,
                        filemtime( CONMAN_ROOTPATH . $base_style_path . 'admin-style.css' )
                     );
}