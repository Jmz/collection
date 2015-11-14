<?php

namespace Moltin\Collection;

abstract class Collection
{
    /**
     * @var
     */
    protected $type;

    public function __construct($type)
    {
        if (!class_exists($type)) {
            throw new \InvalidArgumentException("{$type} is not a valid class");
        }

        $this->type = $type;
    }
}
