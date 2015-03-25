<?php
/**
 * Utenti controller
 */

class UtentiController extends Controller
{
    public static function create()
    {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
    
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conferma_password = $_POST['conferma_password'];
    
        // Se una checkbox non è selezionata il parametro non viene inviato, quindi non va controllato se è vuoto,
        // ma se esiste (isset) il parametro
        $privacy = isset($_POST['privacy']); 
    
        if (!$email) {
            $errors['email'] = "Scrivi la tua email.";    
        }
    
        if ($nome == '') {
            $errors['nome'] = "Scrivi il tuo nome.";    
        }
        if ($cognome == '') {
            $errors['cognome'] = "Scrivi il tuo cognome.";    
        }
        
        
        if (!$password) {
            $errors['password'] = "Non puoi usare una password vuota.";
        } else if ($password != $conferma_password) {
            $errors['password'] = "Le due password non coincidono.";
        }
    
        if (!$privacy) {
            $errors['privacy'] = "Devi consentire il trattamento dei tuoi dati.";
        }
    
        // Controllo se l'utente esiste già
        /*
    	$query = "SELECT * FROM utenti WHERE email = '$email';";
    	$result = mysqli_query($connessione, $query);
    	
    	if (mysqli_num_rows($result)) {
            $errors['email'] = "Ti sei già registrato.";
        }
        */
        
        //$nome = $cognome = $email = $password = $privacy = '';
        
        Utenti::create(array(
            $nome,
            $cognome,
            $email,
            $password,
            $privacy
        ));

    }
}