<?php

namespace Cart\Controllers;

use Slim\Router;
use Cart\Models\Product;
use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProductController
{
    protected $view;
    protected $router;
    public function __construct(Twig $view, Router $router)
    {
        // getting the view and router globally, so we don't have to inject it in every method
        $this->view = $view;
        $this->router = $router;
    }


    public function get( $slug, Request $request, Response $response, Product $product )
    {
        // fetching data by product slug
        $product = $product->where('slug', $slug)->first();

        // if no product found, redirect
        if(!$product)
        {
            return $response->withRedirect($this->router->pathFor('home'));
        }

        return $this->view->render($response, 'products\product.twig', [
            'product'   =>  $product,
        ]);
    }

}
