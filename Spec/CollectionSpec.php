<?php

namespace Spec\Moltin\Collection;

use Moltin\Collection\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CollectionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf('Spec\Moltin\Collection\DummyCollection');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Spec\Moltin\Collection\DummyCollection');
    }

    public function it_should_throw_an_exception_if_type_is_not_a_valid_class()
    {
        $this->shouldThrow('InvalidArgumentException')->during('__construct');
    }

    public function it_should_add_an_object_to_the_collection()
    {
        $dummy = \Mockery::mock('\Spec\Moltin\Collection\Dummy');

        $this->attach($dummy);

        $this->collection->shouldContain($dummy);
    }

    public function it_should_throw_an_exception_if_added_item_does_not_match_type()
    {
        $dummy = \Mockery::mock('\Spec\Moltin\Collection\NotDummy');

        $this->shouldThrow('InvalidArgumentException')->during('attach', [$dummy]);
    }

    public function it_should_remove_an_object_from_the_collection()
    {
        $dummy = \Mockery::mock('\Spec\Moltin\Collection\Dummy');

        $this->attach($dummy);
        $this->detach($dummy);

        $this->collection->shouldNotContain($dummy);
    }

}

class DummyCollection extends Collection
{
    // Make properties public for testing
    public $type = '\Spec\Moltin\Collection\Dummy';
    public $collection = [];
}