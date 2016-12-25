<?php

namespace Cart;

use DI\ContainerBuilder;

use DI\Bridge\Slim\App as DIBridge;

class App extends DIBridge
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        // turn error handling on in slim
        $builder->addDefinitions([

            'settings.displayErrorDetails' => true,
        ]);

        //Pulling in all the definitions from container
        $builder->addDefinitions(__DIR__.'/container.php');
    }

}