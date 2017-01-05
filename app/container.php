<?php

use Slim\Views\Twig;
use Interop\Container\ContainerInterface;
use Slim\Views\TwigExtension;
use function DI\get;
use Cart\Models\Product;
use Cart\Support\Storage\Contracts\StorageInterface;


return [
    'router'    => get(Slim\Router::class),
    StorageInterface::class => function(ContainerInterface $c){
        return new \Cart\Support\Storage\SessionStorage('cart');
    },
    Twig::class => function(ContainerInterface $c){
        $twig = new Twig(__DIR__ . '/../resources/views', [
            'cache' =>  false   //for development
        ]);


        $twig->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        return $twig;
    },
    Product::class  =>  function(ContainerInterface $c)
    {
        return new Product;
    }
];