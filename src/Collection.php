<?php

namespace Moltin\Collection;

abstract class Collection
{
    /**
     * The type of object that this collection should accept
     *
     * @var string
     */
    protected $type;

    /**
     * Holds the collection items
     *
     * @var array
     */
    protected $collection = [];

    public function __construct()
    {
        if (!class_exists($this->type)) {
            throw new \InvalidArgumentException("{$this->type} is not a valid class");
        }
    }

    /**
     * Attach an item to the collection
     *
     * @param $item
     */
    public function attach($item)
    {
        $this->checkType($item);

        $hash = $this->generateKey($item);

        $this->collection[$hash] = $item;
    }

    /**
     * Remove an object from the collection
     *
     * @param $item
     */
    public function detach($item)
    {
        $this->checkType($item);

        $hash = $this->generateKey($item);

        unset($this->collection[$hash]);
    }

    /**
     * Generate an identifier for the supplied object
     *
     * @param $item
     * @return string
     */
    protected function generateKey($item)
    {
        return spl_object_hash($item);
    }

    /**
     * Check that the provided item object matches the $type property
     *
     * @param $item
     */
    protected function checkType($item)
    {
        if (!$item instanceof $this->type) {
            throw new \InvalidArgumentException("Items in this collection must be instances of {$this->type}");
        }
    }
}
