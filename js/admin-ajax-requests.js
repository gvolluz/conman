/**
 *  Handles all ajax requests client side
 *  for the Admin section
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */
 /* AUTO REFRESH */

/************ UPDATE THE OPTIONS ******************/
jQuery(document).ready(function() {
    jQuery('#conman_submit_update_options_button').click(function() { //start function when conman_submit_test_button button is clicked
        //Parse the options defined in the "form"
        var o_cron_import_activated = false;
        if( '1' === jQuery('#conman_cron_import_activated:checked').val() ){
            o_cron_import_activated = true;
        }

        var options = {
                    cron_import_activated:o_cron_import_activated
        };

        jQuery.ajax({
            type: "post",
            url: CONMANAdminAjax.ajaxurl,
            data: {
                    action: 'conman_update_options',
                    conman_options: JSON.stringify( options ),
                    _ajax_nonce: CONMANAdminAjax._ajax_nonce
                },
                success: function(html){ //so, if data is retrieved, store it in html
                    jQuery("#conman_update_options_results").fadeIn('fast');
                    jQuery("#conman_update_options_results").html("");
                    jQuery("#conman_update_options_results").html(html);
                    jQuery("#conman_update_options_results").fadeOut(5000);
                }
            }); //close jQuery.ajax

        return false;
    })
});
/************ END UPDATE THE OPTIONS ******************/