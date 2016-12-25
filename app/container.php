<?php

use Slim\Views\Twig;
use \Interop\Container\ContainerInterface;

return [
    'router'    => get(Slim\Router::class),
    Twig::class => function(ContainerInterface $c){
        $twig = new Twig(__DIR__ . '/../resources/views', [
            'cache' =>  false   //for development
        ]);
    }
];