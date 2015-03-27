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


// funzione per la validazione del form
function validaForm() {
    var inputVal = new Array(
        $('#id_nome').val(),
        $('#id_cognome').val(),
        $('#id_email').val(),
        $('#id_password').val(),
        $('#id_password2').val());
        
    for (var i = 0; i < inputVal.length; i++) {
        if (inputVal[i] != "") {
          if (i == 0 || i == 1) {
            if (inputVal[i].length > 100) {
                alert("Devi inserire al max 100 caratteri");
                return false;
            }
          } else if (i == 2) {
            var at = "@";  
            if (!at.test(inputVal[i])) {
                alert("Non è una email valida");
                return false;
            }  
          } else if (i == 3) {
            if (inputVal[3] != inputVal[4]) {
                alert("Le password devono essere uguali");
                return false;
            }   
          } 
        }  else {
            alert("ci sono dei campi vuoti");
            return false;
        }
    }
    
    return true;
        
};
