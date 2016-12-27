<?php

use Cart\App;
use Illuminate\Database\Capsule\Manager as Capsule;
session_start();

require __DIR__.'/../vendor/autoload.php';

$app = new App;

//pulling eloquent in
$capsule = new Capsule;

//connection to DB
$capsule->addConnection([
    'driver'    =>  'mysql',
    'host'      =>  'localhost',
    'database'  =>  'slim_ecommerce',
    'username'  =>  'root',
    'password'  =>  '',
    'charset'   =>  'utf8',
    'collation' =>  'utf8_unicode_ci',
    'prefix'    =>  ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

require __DIR__ .'/../App/routes.php';