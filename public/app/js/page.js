/**
 * Gestione generica alla pagina
 */

// API per caricare i dati delle foto
var API_URL = '/foto';

// Numero di elementi da caricare ogni volta che si raggiunge il fondo della pagina
var NUMBER = 2;

// Booleano per indicare se sto caricando altre foto, ed evitare di fare altre richieste prima che una sia completata
var loading = false;

$(document).ready(function() {



    // Apri-chiudi menu cassetto.
    $('.open-menu').on('click', function() {
        $('.side-menu').toggleClass("open");
        return false;
    });

    $('.content').on('touchend', function() {
        if ($('.side-menu').hasClass('open')) {
            $('.side-menu').removeClass('open');
        }
    });

    // Info login
    if (utente.email !== undefined) {
        $(".login")
            .html(utente.nome)
            .attr('href', '#pagina-registrati');

        $("#id_nome").val(utente.nome);
    }

    // Carico i primi elementi
    loadNext();

});


// Carica i prossimi elementi
function loadNext() {
    var elementi = $('.feedlist li:not(.placeholder)').size();
    var params = {
        'skip': elementi,
        'limit': NUMBER
    };

    if (!loading) {
        loading = true;
        $.getJSON(API_URL, params, function(data) {
            for (var i = 0; i < data.length; i++) {
                var foto = data[i];
                var nome = foto.nome;
                var id = foto._id.$id;
                var new_line = $('.feedlist .placeholder').clone().removeClass('placeholder');

                $('.feedlist').append(new_line);
                new_line.find('h2').text(nome);
                new_line.find('img').attr('src', '../' + foto.link);
                new_line.find('.data').text(foto.data);
                new_line.find('.elimina-foto').data('fotoId', id);
                  
                new_line.find('.elimina-foto').click( function() {
                    console.log("fatto");
                    $.post( "/foto/"+$(this).data("fotoId"), { id: $(this).data("fotoId"), _METHOD: "DELETE" }, function(){
                    } );
                    location.reload();
                });
                
                new_line.find('.modifica-foto').data('fotoId', id);
                  
                new_line.find('.modifica-foto').click( function() {
                    console.log("fatto");
                    $.post( "/foto/"+$(this).data("fotoId"), { id: $(this).data("fotoId"), _METHOD: "PUT" }, function(){
                    } );
                });
                             
            }
            loading = false;
        })
    }
}


$(window).scroll(function() {
    if ($('body').height() <= ($(window).height() + $(window).scrollTop())) {
        loadNext();
    }
});