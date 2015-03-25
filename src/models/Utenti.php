<?php
/**
 * Utenti
 */

class Utenti
{
    public static function findOne($params)
    {
        global $mongo;

        $utente = $mongo->spritzdb->utenti->findOne($params);

        return $utente;
    }

    public static function create($utenteDati)
    {
        global $mongo;

        $collection = $mongo->spritzdb->selectCollection('utenti');
        $collection->insert($utenteDati);

        return $utenteDati;
    }
}
