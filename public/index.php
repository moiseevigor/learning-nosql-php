<?php
/**
 * Main entrance point
 */

error_reporting(E_ALL);

define('FACEBOOK_SDK_V4_SRC_DIR','/var/www/html/vendor/facebook/php-sdk-v4/src//Facebook/');

// composer autoloader
require '../vendor/autoload.php';

$config = require_once('../config/config.php');

$app = new \Slim\Slim(array(
    'cookies.encrypt' => true
));

$app = new \Slim\Slim(array(
    'templates.path' => '../src/view'
));

$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires' => '1 month',
    'path' => '/',
    'domain' => '192.168.88.250',
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
    //"{$db['driver']}://{$db['user']}:{$db['password']}@{$db['host']}:{$db['port']}/{$db['dbname']}"
    "{$db['driver']}://{$db['host']}:{$db['port']}/{$db['dbname']}"
);

$app->get("/",  function() use($app) {
    $app->render('index.html') ;
});


$app->get("/foto",  array('FotoController', 'index'));
$app->post("/foto", array('FotoController', 'create'));
$app->delete("/foto", array('FotoController', 'destroy'));

$app->get("/utenti/info", array('UtentiController', 'info'));
$app->post("/utenti", array('UtentiController', 'create'));
$app->post("/utenti/login", array('UtentiController', 'login'));
$app->get("/facebook/login", array('FacebookController', 'login'));
$app->get("/facebook/callback", array('FacebookController', 'callback'));
$app->run();