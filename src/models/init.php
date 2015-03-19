<?php

$config = require_once('../../config/config.php');
$dbConf = $config['db'];

// Mongo
$mongo = new MongoClient(
	"{$dbConf['driver']}://{$dbConf['host']}:{$dbConf['port']}"
);

$db = $mongo->selectDB($dbConf['dbname']);

$collection = $db->selectCollection("system.users");

$collection->insert(array(
	'user' => $dbConf['user'], 
	'pwd' => md5($dbConf['user'] . ":mongo:" . $dbConf['password']), 
	'readOnly' => false
));

//$dbname = $db->createCollection($dbConf['dbname']);