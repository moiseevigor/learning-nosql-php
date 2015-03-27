/**
 * Gestione hash
 */

$(document).ready(function() {

    // Inserisco l'ascoltatore sui link che puntano alle pagine,
    // cioè tutti i link che cominciano con "#pagina-"
    $("a[href^=#pagina-]").click(function() {

        // nascondo tutte le pagine.
        $('.page').removeClass('active');

        // Ottengo l'id della pagina da mostrare
        var id_pagina = $(this).attr('href');

        // Mostro solo la pagina cliccata.
        $(id_pagina).addClass('active');

        // Chiudo il menu
        $('.side-menu').removeClass("open");

        location.hash = id_pagina;
        
        return false;
        
    });
    
    console.log(location.hash);
    $("a[href*="+location.hash+"]").trigger('click');

    window.onhashchange = function () {
        $("a[href*="+location.hash+"]").trigger('click');
    }

});

