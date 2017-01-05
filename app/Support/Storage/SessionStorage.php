<?php

namespace Cart\Support\Storage;

use Cart\Support\Storage\Contracts\StorageInterface;

class SessionStorage implements StorageInterface, \Countable
{
    protected $bucket;
    public function __construct($bucket = 'default')
    {
        // if there is no bucket in session , create one
        if(!isset($_SESSION[$bucket]))
        {
            $_SESSION[$bucket] = [];
        }
        $this->bucket = $bucket;
    }


//---------------------------------------------------------------------------------------------------------

    /**
     * Get the selected item from bucket
     * @param $index
     * @return null
     */
    public function get($index)
    {
        if(!$this->exists($index))
        {
            return null;
        }
        return $_SESSION[$this->bucket][$index];
    }


//---------------------------------------------------------------------------------------------------------

    /**
     * Set selected items and values into the bucket
     * @param $index
     * @param $value
     */
    public function set($index, $value)
    {
        $_SESSION[$this->bucket][$index] = $value;
    }


//---------------------------------------------------------------------------------------------------------

    /**
     * Grab all items from the session i.e. bucket
     * @return mixed
     */
    public function all()
    {
       return $_SESSION[$this->bucket];
    }


//---------------------------------------------------------------------------------------------------------

    /**
     * Check it requested item exists in the bucket or not
     * @param $index
     * @return bool
     */
    public function exists($index)
    {
        return isset($_SESSION[$this->bucket][$index]);
    }


//---------------------------------------------------------------------------------------------------------

    /**
     * Unset item from bucket
     * @param $index
     */
    public function unsetItem($index)
    {
        if($this->exists($index))
        {
            unset($_SESSION[$this->bucket][$index]);
        }
    }


//---------------------------------------------------------------------------------------------------------

    /**
     * Unset everything from the bucket
     */
    public function clear()
    {
        unset($_SESSION[$this->bucket]);
    }


//---------------------------------------------------------------------------------------------------------


    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     *
     * Count all the items
     */
    public function count()
    {
        return count($this->all());
    }
}