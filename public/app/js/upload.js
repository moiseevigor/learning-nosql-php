/**
 * Gestione upload
 */

$(document).ready(function() {

    // Upload immagine
   $(".insert-form > form").submit(function() {
        console.log('submit');
        $(".loader").fadeIn("slow");
        return true;
    });
        
});
