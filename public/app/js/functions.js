// API per caricare i dati delle foto
//var API_URL = 'http://javaspritz.it/cff/myspritz/api.php';
var API_URL = '/foto';

// Numero di elementi da caricare ogni volta che si raggiunge il fondo della pagina
var NUMBER = 2;

// Booleano per indicare se sto caricando altre foto, ed evitare di fare altre richieste prima che una sia completata
var loading = false;

var utente = {};

function init(response) {
    if (response.status === 200)
        utente = response.utente;
}

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

        return false;


    });


    // Esegui Login
    $(".login-form > form").submit(function() {
        $.post('/utenti/login', $(".login-form > form").serialize(), function(response) {
            $("a[href^=#pagina-feed]").trigger('click');
        }).fail(function(response) {
            alert(response.responseJSON.message);
        });
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
                var new_line = $('.feedlist .placeholder').clone().removeClass('placeholder');
                $('.feedlist').append(new_line);
                new_line.find('h2').text(nome);
                new_line.find('img').attr('src', '../' + foto.link)
                new_line.find('.data').text(foto.data)
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