<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Illuminate\Database\Capsule;

$capsule = new Capsule\Manager();

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'illuminate_non_laravel',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
], 'mysql');

$capsule->addConnection([
    'driver'    => 'sqlite',
    'database' => 'database.sqlite',
    'prefix' => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
