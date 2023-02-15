<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Illuminate\Database\Capsule;

$capsule = new Capsule\Manager();

$capsule->addConnection([
    'driver'    => 'sqlite',
    'database' => 'database.sqlite',
    'prefix' => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
