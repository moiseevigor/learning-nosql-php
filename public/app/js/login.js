/**
 * Gestione login
 */

$(document).ready(function() {

    // Esegui Login
    $(".login-form > form").submit(function() {
        $.post('/utenti/login', $(".login-form > form").serialize(), function(response) {
            $("a[href^=#pagina-feed]").trigger('click');
        }).fail(function(response) {
            alert(response.responseJSON.message);
        });
    });

});
