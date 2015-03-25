<?php
/**
 * Utenti
 */

class Utenti
{
    public static function create($utenteDati)
    {
        global $mongo;

        $collection = $mongo->spritzdb->selectCollection('utenti');
        $collection->insert($utenteDati);

        return $utenteDati;
    }
}
