<?php
/**
 * Main entrance point
 */

require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get("/hello",         array('HelloController', 'index'));
$app->get("/hello/:name",   array('HelloController', 'show'));

$app->run();