/**
 * Gestione registrazione
 */

$(document).ready(function() {

    
    $(".register-form > form").submit(function() {
        if (validaForm()) {
            $.post('/utenti', $(".register-form > form").serialize(), function(response) {
                $("a[href^=#pagina-feed]").trigger('click');
            }).fail(function(response) {
               // validazione sul server fallita
            });
        }    
    });


});

// funzione per la validazione del form
function validaForm() {
    $('.error').remove();
    var inputVal = new Array(
        $('#id_nome').val(),
        $('#id_cognome').val(),
        $('#id_email').val(),
        $('#id_password').val(),
        $('#id_password2').val());
        
    for (var i = 0; i < inputVal.length; i++) {
        if (inputVal[i] != "") {
          if (i == 0) {
            if (inputVal[i].length > 100) {
                $('#id_nome').after('<div class="error"> Il campo può contenere al massimo 100 caratteri</div>');
                //return false;
            }
          }
          if (i == 1) {
            if (inputVal[i].length > 100) {
                $('#id_cognome').after('<div class="error"> Il campo può contenere al massimo 100 caratteri</div>');
                //return false;
            }
          } 
          if (i == 2) {
            var at = /@/g; 
            if (!at.test(inputVal[i])) {
                $('#id_email').after('<div class="error">'+"L'email deve contenere la @ </div>");
                //return false;
            }  
          }
          if (i == 3) {
            if (inputVal[3] != inputVal[4]) {
                $('#id_password2').after('<div class="error">Le due password devono coincidere</div>');
                //return false;
            }   
          } 
        } else {
            $('.register-form').before('<div class="erro">Ci sono dei campi vuoti</div>');
            return false;
        }
        
    }
    
    return true;
        
};
