<?php
/**
 * Config
 */

return array(

   // Database conection config
  'db' => array(
    'driver'    => 'mongodb',
    'host'      => 'localhost',
    'user'      => 'spruser',
    'password'  => 'password',
    'port'      => '27017',
    'dbname'    => 'spritzdb'
    ),
    
    'facebook' => array(
        'appId' => '419034941606438',
        'secret' => 'd1c9715064cd6d7f52a8797332f7c278'
    )
  );