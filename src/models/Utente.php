<?php
/**
 * Utente
 */

class Utente
{
    public static function find($params = array())
    {
        global $mongo;
        $utenti = array();

        $cursorUtenti = $mongo->spritzdb->utenti->find($params);

        foreach($cursorUtenti as $id => $ut)
        {
            $utenti[] = $ut;
        }

        return $utenti;
    }
}
