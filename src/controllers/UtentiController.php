<?php
/**
 * Utenti controller
 */

class UtentiController extends Controller
{
    public static function info()
    {
        if (isset($_SESSION['email']) && $utente = Utenti::findOne(array('email' => $_SESSION['email']))) {
            unset($utente['password']);
            Controller::response(array(
                'status' => 200,
                'utente' => $utente
            ));
        } else {
            Controller::response(array(
                'status' => 401,
                'message' => 'Non è autenticato'
            ));
        }
    }
    
    public static function login()
    {
        $email = $_POST['email']; 
        $password = $_POST['password'];

        if ($utente = Utenti::findOne(array('email' => $email, 'password' => $password))) {
            $_SESSION['email'] = $utente['email'];
            Controller::response(array(
                'status' => 200,
                'message' => 'Benvenuto ' . $utente['nome']
            ));
        } else {
            Controller::response(array(
                'status' => 401,
                'message' => 'Errore di autenticazione'
            ));
        }
    }
    
    public static function logout()
    {
        global $app;
        
        if(isset($_SESSION['email'])) {
            unset($_SESSION['email']);
            $app->redirect("/");

        } 
    }
    
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
    	if (Utenti::findOne(array('email' => $email))) {
            $errors['email'] = "Ti sei già registrato.";
        }
        
        if (isset($errors)) {
            Controller::response(array(
                'status' => 401,
                'errors' => $errors
            ));
        } else {
            Controller::response(Utenti::create(array(
                "nome" => $nome,
                "cognome" => $cognome,
                "email" => $email,
                "password" => $password,
                "privacy" => $privacy
            )));
        }
    
    }
}