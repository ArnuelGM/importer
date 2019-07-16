<?php

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'sqlsrv',
    'host'      => '192.168.1.20',
    'database'  => 'SW2DOMICILIARIA',
    'username'  => 'sa',
    'password'  => 'Innova2017',
    'charset'   => 'utf8',
    'prefix'    => '',
]);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

/*Capsule::schema()->create('profiles_import', function ($table) {
	$table->increments('id');
	$table->string('name')->unique();
	$table->string('table');
	$table->json('fields');
	$table->boolean('skip_first_row');
});*/

require_once 'Pacientes.php';
require_once 'ProfilesImport.php';