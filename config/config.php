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
        'appId' => '402586513256342',
        'secret' => '30ccc4374f456dd8cf323821ae847b09'
    )
  );