<?php
/**
 * Foto
 */

class Foto
{
    public static function find($skip, $limit)
    {
        global $mongo;
        $foto = array();

        $cursorFoto = $mongo->spritzdb->foto->find()->skip($skip)->limit($limit);

        foreach($cursorFoto as $id => $f)
        {
            $f['data'] = date('Y-M-d h:i:s', $f['data']->sec); 
            $foto[] = $f;
        }

        return $foto;
    }

    public static function create($fotoDati)
    {
        global $mongo;

        $collection = $mongo->spritzdb->selectCollection('foto');
        $collection->insert($fotoDati);

        return $fotoDati;
    }
    
     public static function destroy($params)
    {
        global $mongo;
        
        return    $mongo->spritzdb->foto->remove($params);
        
    }
}
