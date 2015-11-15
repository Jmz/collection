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
        if (!$item instanceof $this->type) {
            throw new \InvalidArgumentException("Attached items must be an instance of {$this->type}");
        }

        $this->collection[] = $item;
    }
}
