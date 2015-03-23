<?php
/**
 * Main entrance point
 */

error_reporting(E_ALL);

// composer autoloader
require '../vendor/autoload.php';

$config = require_once('../config/config.php');

$app = new \Slim\Slim();

$db = $config['db'];
// Mongo
$mongo = new MongoClient(
	"{$db['driver']}://{$db['user']}:{$db['password']}@{$db['host']}:{$db['port']}/{$db['dbname']}"
);

$app->get("/foto",  array('FotoController', 'index'));
$app->post("/foto", array('FotoController', 'create'));

$app->run();