/**
 *  All the Ajax requests for the frontend
 *
 *  @author Gilles Volluz (gilles.volluz@gmail.com)
 *  @since 1.0
 *
 */

/*********** AJAX HELLO ******************/

//Handler functions
function conman_hello_param_message_keypress(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) { //Enter keycode
        e.preventDefault();
        conman_hello();
        return;
    }
}

function conman_hello(){
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
}

//Ready binds
jQuery(document).ready(function() {
    jQuery('#conman_hello_button').click(function() { //start function when conman_hello_button button is clicked
        conman_hello();
        return false;
    });

    jQuery('#conman_hello_param_message').bind("keypress", {}, conman_hello_param_message_keypress);
});