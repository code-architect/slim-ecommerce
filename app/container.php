<?php

use Slim\Views\Twig;
use Interop\Container\ContainerInterface;
use Slim\Views\TwigExtension;
use function DI\get;
use Cart\Models\Product;
use Cart\Support\Storage\Contracts\StorageInterface;
use Cart\Support\Storage\SessionStorage;
use Cart\Basket\Basket;


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

        $twig->getEnvironment()->addGlobal('basket', $c->get(Basket::class));

        return $twig;
    },
    Product::class  =>  function(ContainerInterface $c)
    {
        return new Product;
    },
    Basket::class => function(ContainerInterface $c)
    {
      return new Basket(
          $c->get(SessionStorage::class),
          $c->get(Product::class)
      );
    },
];