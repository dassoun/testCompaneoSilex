<?php

// Doctrine (db)
$app['db.options'] = array(
	'driver'   => 'pdo_pgsql',
	'charset'  => 'utf8',
	'host'     => '127.0.0.1',  // Mandatory for PHPUnit testing
	'port'     => '5432',
	'dbname'   => 'WouldYouRestDB',
	'user'     => 'postgres',
	'password' => 'admin',
);

// enable the debug mode
$app['debug'] = true;
