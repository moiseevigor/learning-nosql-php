<?php
/**
 * Main entrance point
 */

error_reporting(E_ALL);

// composer autoloader
require '../vendor/autoload.php';

$config = require_once('../config/config.php');

$app = new \Slim\Slim(array(
    'cookies.encrypt' => true
));

$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires' => '1 month',
    'path' => '/',
    'domain' => 'corso.onelife.fm',
    'secure' => true,
    'httponly' => false,
    'name' => 'myspritz_session',
    'secret' => 'ad7234k234k234n234h324rtynv',
    'cipher' => MCRYPT_RIJNDAEL_256,
    'cipher_mode' => MCRYPT_MODE_CBC
)));

$db = $config['db'];
// Mongo
$mongo = new MongoClient(
	"{$db['driver']}://{$db['user']}:{$db['password']}@{$db['host']}:{$db['port']}/{$db['dbname']}"
);

$app->get("/foto",  array('FotoController', 'index'));
$app->post("/foto", array('FotoController', 'create'));

$app->post("/utenti", array('UtentiController', 'create'));

$app->run();