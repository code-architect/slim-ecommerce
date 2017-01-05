<?php

namespace Cart\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * Check if the stock is low, and return a boolian value
     * @return bool
     */
    public function hasLowStock()
    {
        if($this->outOfStock())
        {
            return false;
        }
        // casting the result as bool
        return (bool)($this->stock <= 5);
    }

//----------------------------------------------------------------------------------------------------------

    /**
     * Check if stock is 0
     * @return bool
     */
    public function outOfStock()
    {
        return $this->stock === 0;
    }

//----------------------------------------------------------------------------------------------------------

    /**
     * Check if atleast one product is in stock
     * @return bool
     */
    public function inStock()
    {
        return $this->stock >= 1;
    }

//----------------------------------------------------------------------------------------------------------

    /**
     * This will take a quantity and check if the quantity given is grater than
     * or equal to the amount of products in database
     * @param $quantity
     */
    public function hasStock($quantity)
    {
        return $this->stock >= $quantity;
    }
}