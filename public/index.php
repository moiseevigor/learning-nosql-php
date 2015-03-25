<?php
/**
 * Main entrance point
 */

error_reporting(E_ALL);

// composer autoloader
require '../vendor/autoload.php';

$config = require_once('../config/config.php');

$app = new \Slim\Slim(array(
    'cookies.encrypt' => false
));

$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires' => '1 month',
    'path' => '/',
    'domain' => 'corso.onelife.fm',
    'secure' => false,
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

$app->get("/utenti/info", array('UtentiController', 'info'));
$app->post("/utenti", array('UtentiController', 'create'));
$app->post("/utenti/login", array('UtentiController', 'login'));

$app->run();