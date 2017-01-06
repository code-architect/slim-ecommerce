<?php

namespace Cart\Basket;

use Cart\Models\Product;
use Cart\Support\Storage\Contracts\StorageInterface;

class Basket
{
    protected $storage;
    protected $product;

    public function __construct(StorageInterface $storage, Product $product)
    {
        $this->storage = $storage;
        $this->product = $product;
    }

    public function add(Product $product, $quantity)
    {
        if($this->has($product))
        {
            // set quantity to the current quantity + new quantity

        }
        // update the session with product
    }


    public function update(Product $product, $quantity)
    {
        // check if a product has stock
        if(!$this->product->find($product->id)->hasStock($quantity))
        {
            // throw an exception
        }

        // Remove the product if the quantity is passed 0
        if($quantity === 0)
        {
            $this->remove($product);
            return;

        }
    }


    /**
     * Remove the item
     * @param Product $product
     */
    public function remove(Product $product)
    {
        $this->storage->unsetItem($product->id);
    }


    /**
     * Check if the product exists
     * @param Product $product
     * @return mixed
     */
    public function has(Product $product)
    {
        return $this->storage->exists($product->id);
    }



}
