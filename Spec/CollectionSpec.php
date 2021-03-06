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

    public function it_sholud_return_true_when_contains_is_called_if_the_item_exists_in_the_collection()
    {
        $dummy = \Mockery::mock('\Spec\Moltin\Collection\Dummy');

        $this->attach($dummy);

        $this->contains($dummy)->shouldReturn(true);
    }

    public function it_sholud_return_false_when_contains_is_called_if_the_item_does_not_exist_in_the_collection()
    {
        $dummy = \Mockery::mock('\Spec\Moltin\Collection\Dummy');
        $dummyTwo = \Mockery::mock('\Spec\Moltin\Collection\Dummy');

        $this->attach($dummy);

        $this->contains($dummyTwo)->shouldReturn(false);
    }

    public function it_should_return_the_count_of_all_objects_in_the_collection()
    {
        $dummyOne = \Mockery::mock('\Spec\Moltin\Collection\Dummy');
        $dummyTwo = \Mockery::mock('\Spec\Moltin\Collection\Dummy');

        $this->attach($dummyOne);
        $this->attach($dummyTwo);

        $this->count()->shouldReturn(2);
    }

    public function it_should_find_an_item_based_on_a_getter()
    {
        $dummy = \Mockery::mock('\Spec\Moltin\Collection\Dummy');
        $dummy->shouldReceive('getId')
            ->once()
            ->andReturn(1);

        $this->attach($dummy);

        $this->findOneBy('id', 1)
            ->shouldReturn($dummy);
    }

    public function it_should_return_false_if_the_value_isnt_found()
    {
        $dummy = \Mockery::mock('\Spec\Moltin\Collection\Dummy');
        $dummy->shouldReceive('getId')
            ->once()
            ->andReturn(2);

        $this->attach($dummy);

        $this->findOneBy('id', 1)
            ->shouldReturn(false);
    }

    public function it_should_remove_all_items_from_the_collection()
    {
        $dummyOne = \Mockery::mock('\Spec\Moltin\Collection\Dummy');
        $dummyTwo = \Mockery::mock('\Spec\Moltin\Collection\Dummy');

        $this->attach($dummyOne);
        $this->attach($dummyTwo);

        $this->removeAll();
        $this->count()->shouldReturn(0);
    }

    public function it_should_allow_you_to_attach_many_items_at_once()
    {
        $dummies = [
            \Mockery::mock('\Spec\Moltin\Collection\Dummy'),
            \Mockery::mock('\Spec\Moltin\Collection\Dummy')
        ];

        $this->attachMany($dummies);
        $this->count()->shouldReturn(2);
    }

}

class DummyCollection extends Collection
{
    // Make properties public for testing
    public $type = '\Spec\Moltin\Collection\Dummy';
    public $collection = [];
}