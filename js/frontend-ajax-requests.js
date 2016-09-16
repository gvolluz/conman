/**
 *  All the Ajax requests for the frontend
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */

/*********** AJAX HELLO ******************/

jQuery(document).ready(function() {
    jQuery('#conman_hello_button').click(function() { //start function when conman_hello_button button is clicked
        jQuery.ajax({
            type: "post",
            url: CONMANFrontAjax.ajaxurl,
            data: {
                    action: 'conman_hello',
                    message: jQuery('#conman_hello_param_message').val(),
                    _ajax_nonce: CONMANFrontAjax._ajax_nonce
                },
                before: function(){jQuery("#conman_hello_loading").fadeIn('fast');}, //fadeIn loading just when link is clicked},
                success: function(html){ //so, if data is retrieved, store it in html
                    jQuery("#conman_hello_loading").fadeOut('slow');
                    jQuery("#conman_hello_results").html("");
                    jQuery("#conman_hello_results").html(html); //fadeIn the html inside container div
                    jQuery("#conman_hello_results").fadeIn("fast"); //animation
                }
        }); //close jQuery.ajax

        return false;
    });
});