<?php

namespace Moltin\Collection;

abstract class Collection implements \Countable
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
     * Check whether the supplied object exists in the collection
     *
     * @param $item
     * @return bool
     */
    public function contains($item)
    {
        $this->checkType($item);

        $hash = $this->generateKey($item);

        return array_key_exists(
            $hash,
            $this->collection
        );
    }

    /**
     * Return the number of items in the collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * Find an item based on a field
     *
     * @param $field
     * @param $value
     * @return bool
     */
    public function findOneBy($field, $value)
    {
        $getterName = 'get'.ucwords($field);

        foreach($this->collection as $item) {
            if ($item->{$getterName}() === $value) {
                return $item;
            }
        }

        return false;
    }

    /**
     * Generate an identifier for the supplied object
     *
     * @param $item
     * @return string
     * @todo Base the hash on the data in the object rather than the spl hash?
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
