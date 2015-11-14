<?php

namespace Moltin\Collection;

abstract class Collection
{
    public function __construct($type)
    {
        if (!class_exists($type)) {
            throw new \InvalidArgumentException("{$type} is not a valid class");
        }
    }
}
