<?php
/**
 * Utente controller
 */

class UtenteController extends Controller
{
    public static function index()
    {
        Controller::response(Utente::find());
    }

    public static function show($name)
    {
        Controller::response(Utente::find(array('nome' => $name)));
    }
}