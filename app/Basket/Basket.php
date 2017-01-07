<?php

namespace Cart\Basket;

use Cart\Basket\Exceptions\QuantityExceededException;
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


//------------------------------------------------------------------------------------------------------


    public function add(Product $product, $quantity)
    {
        if($this->has($product))
        {
            // set quantity to the current quantity + new quantity
            $quantity = $this->get($product)['quantity'] + $quantity;

        }
        // update the session with product
        $this->update($product, $quantity);
    }

//------------------------------------------------------------------------------------------------------


    public function update(Product $product, $quantity)
    {
        // check if a product has stock
        if(!$this->product->find($product->id)->hasStock($quantity))
        {
            // throw an exception
            throw new QuantityExceededException;
        }

        // Remove the product if the quantity is passed 0
        if($quantity === 0)
        {
            $this->remove($product);
            return;
        }

        $this->storage->set($product->id, [
            'product_id'    =>  (int)$product->id,
            'quantity'      =>  (int)$quantity,
        ]);
    }

//------------------------------------------------------------------------------------------------------


    /**
     * Remove the item
     * @param Product $product
     */
    public function remove(Product $product)
    {
        $this->storage->unsetItem($product->id);
    }

//------------------------------------------------------------------------------------------------------


    /**
     * Check if the product exists
     * @param Product $product
     * @return mixed
     */
    public function has(Product $product)
    {
        return $this->storage->exists($product->id);
    }

//------------------------------------------------------------------------------------------------------

    public function get(Product $product)
    {
        return $this->storage->get($product->id);
    }

//------------------------------------------------------------------------------------------------------


    public function clear()
    {
        $this->storage->clear();
    }

//------------------------------------------------------------------------------------------------------

    public function all()
    {
        $ids = [];
        $items = [];

        foreach($this->storage->all() as $product)
        {
            $ids[] = $product['product_id'];
        }

        $products = $this->product->find($ids);

        foreach($products as $product)
        {
            $product->quantity = $this->get($product)['quantity'];
            $items[] = $product;
        }
        return $items;
    }

//------------------------------------------------------------------------------------------------------

    public function itemCount()
    {
        return count($this->storage);
    }

//------------------------------------------------------------------------------------------------------
}
