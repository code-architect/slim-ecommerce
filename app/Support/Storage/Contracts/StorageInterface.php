<?php

namespace Cart\Support\Storage\Contracts;

interface StorageInterface
{
    //To get an item out of storage, by a particular index
    public function get($index);

    // Setting an item into storage with value
    public function set($index, $value);

    // Get every item from the storage
    public function all();

    // Check if a particular item exists in the storage
    public function exists($index);

    // get rid of an item by index
    public function unsetItem($index);

}